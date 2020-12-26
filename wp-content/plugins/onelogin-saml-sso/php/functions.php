<?php

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

use OneLogin\Saml2\Auth;
use OneLogin\Saml2\Settings;

require_once "compatibility.php";

function saml_checker() {
	if (isset($_GET['saml_acs'])) {
		if (empty($_POST['SAMLResponse'])) {
			echo "That ACS endpoint expects a SAMLResponse value sent using HTTP-POST binding. Nothing was found";
			exit();
		}
		saml_acs();
	} else if (isset($_GET['saml_sls'])) {
		saml_sls();
	} else if (isset($_GET['saml_metadata'])) {
		saml_metadata();
	} else if (isset($_GET['saml_validate_config'])) {
		saml_validate_config();
	}
}

function may_disable_saml() {
	if ((defined('WP_CLI') && WP_CLI) ||
	    (function_exists('wp_doing_cron') && wp_doing_cron()) ||
            (function_exists('wp_doing_ajax') && wp_doing_ajax())
	) {
		return true;
	}
	if (apply_filters('onelogin_disable_saml_sso', false)) {
		return true;
	}

	return false;
}

function get_domain() {
	$protocols = array( 'http://', 'https://', 'http://www.', 'https://www.', 'www.' );
	return str_replace($protocols, '', site_url());
}

function redirect_to_relaystate_if_trusted($url) {
	$trusted = false;
	$trustedDomainsOpt = get_option('onelogin_saml_trusted_url_domains', "");
	$trustedDomains = explode(",", trim($trustedDomainsOpt));
	$trustedDomains[] = get_domain();

	$trusted = checkURLAllowed($url, $trustedDomains);

	if ($trusted) {
		wp_redirect($url);
	} else {
		wp_redirect(home_url());
	}
}

function checkURLAllowed($url, $trustedSites = [])
{
	// Allow Relative URL
	if ($url[0] === '/') {
		return true;
	}

	if (!wp_http_validate_url($url)) {
		return false;
	}

	$components = parse_url($url);
	$hostname = $components['host'];

	// check for userinfo
	if ((isset($components['user'])
		&& strpos($components['user'], '\\') !== false)
		|| (isset($components['pass'])
		&& strpos($components['pass'], '\\') !== false)
	) {
		return false;
	}

	// allow URLs with standard ports specified (non-standard ports must then be allowed explicitly)
	if (
		isset($components['port'])
		&& (($components['scheme'] === 'http'
		&& $components['port'] !== 80)
		|| ($components['scheme'] === 'https'
		&& $components['port'] !== 443))
	) {
		if (in_array($hostname.':'.$components['port'], $trustedSites, true)) {
			return true;
		}
	}

	return in_array($hostname, $trustedSites, true);
}

function saml_custom_login_footer() {
	$saml_login_message = get_option('onelogin_saml_customize_links_saml_login');
	if (empty($saml_login_message)) {
		$saml_login_message = "SAML Login";
	}

	echo '<a id="g-user-login" href="'.esc_url( get_site_url().'/wp-login.php?saml_sso') .'"><span id="hYu72D"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M20.64 12.2c0-.63-.06-1.25-.16-1.84H12v3.49h4.84a4.14 4.14 0 0 1-1.8 2.71v2.26h2.92a8.78 8.78 0 0 0 2.68-6.62z" fill="#4285F4"></path><path d="M12 21a8.6 8.6 0 0 0 5.96-2.18l-2.91-2.26a5.4 5.4 0 0 1-8.09-2.85h-3v2.33A9 9 0 0 0 12 21z" fill="#34A853"></path><path d="M6.96 13.71a5.41 5.41 0 0 1 0-3.42V7.96h-3a9 9 0 0 0 0 8.08l3-2.33z" fill="#FBBC05"></path><path d="M12 6.58c1.32 0 2.5.45 3.44 1.35l2.58-2.59A9 9 0 0 0 3.96 7.95l3 2.34A5.36 5.36 0 0 1 12 6.58z" fill="#EA4335"></path></g></svg></span><span id="tRbe90">'.esc_html($saml_login_message).'</span></a>';
}

function saml_load_translations() {
	$domain = 'onelogin-saml-sso';
	$mo_file = plugin_dir_path(dirname(__FILE__)) . 'lang/'.get_locale() . '/' . $domain  . '.mo';

	load_textdomain($domain, $mo_file ); 
	load_plugin_textdomain($domain, false, dirname( plugin_basename( __FILE__ ) ) . '/lang/'. get_locale() . '/' );
}

function saml_lostpassword() {
	$target = get_option('onelogin_saml_customize_links_lost_password');
	if (!empty($target)) {
		wp_redirect($target);
		exit;
	}
}

function saml_user_register() {
	$target = get_option('onelogin_saml_customize_links_user_registration');
	if (!empty($target)) {
		wp_redirect($target);
		exit;
	}
}

function saml_sso() {
	if (may_disable_saml()) {
		return true;
	}

	if (is_user_logged_in()) {
		return true;
	}
	$auth = initialize_saml();
	if ($auth == false) {
		wp_redirect(home_url());
		exit();
	}
	if (isset($_SERVER['REQUEST_URI']) && !isset($_GET['saml_sso'])) {
		$auth->login($_SERVER['REQUEST_URI']);
	} else {
		$auth->login();
	}
	exit();
}

function saml_slo() {
	if (may_disable_saml()) {
		return true;
	}

	$slo = get_option('onelogin_saml_slo');

	if (isset($_GET['action']) && $_GET['action']  == 'logout') {
		if (!$slo) {
			wp_logout();
			return false;
		} else {
			$nameId = null;
			$sessionIndex = null;
			$nameIdFormat = null;

			if (isset($_COOKIE[SAML_NAMEID_COOKIE])) {
				$nameId = sanitize_text_field($_COOKIE[SAML_NAMEID_COOKIE]);
			}
			if (isset($_COOKIE[SAML_SESSIONINDEX_COOKIE])) {
				$sessionIndex = sanitize_text_field($_COOKIE[SAML_SESSIONINDEX_COOKIE]);
			}
			if (isset($_COOKIE[SAML_NAMEID_FORMAT_COOKIE])) {
				$nameIdFormat = sanitize_text_field($_COOKIE[SAML_NAMEID_FORMAT_COOKIE]);
			}

			$auth = initialize_saml();
			if ($auth == false) {
				wp_redirect(home_url());
				exit();
			}
			$auth->logout(home_url(), array(), $nameId, $sessionIndex, false, $nameIdFormat);
			return false;
		}
	}
}

function saml_role_order_get($role) {
	static $role_defaults = array(
		'administrator' => 1,
		'editor'        => 2,
		'author'        => 3,
		'contributor'   => 4,
		'subscriber'    => 5);
	$rv = get_option(sanitize_key('onelogin_saml_role_order_'.$role));
	if (empty($rv))
		if (isset($role_defaults[$role])) {
			return $role_defaults[$role];
		} else {
			return PHP_INT_MAX;
		}
	else {
		return (int)$rv;
	}
}

function saml_role_order_compare($role1, $role2) {
	$r1 = saml_role_order_get($role1);
	$r2 = saml_role_order_get($role2);
	if ($r1 > $r2)
		return 1;
	else if ($r1 < $r2)
		return -1;
	else return 0;
}

function saml_acs() {
	if (may_disable_saml()) {
		return true;
	}

	$auth = initialize_saml();
	if ($auth == false) {
		wp_redirect(home_url());
		exit();
	}

	$auth->processResponse();

	$errors = $auth->getErrors();
	if (!empty($errors)) {
		echo '<br>'.__("There was at least one error processing the SAML Response").': ';
		foreach($errors as $error) {
			echo esc_html($error).'<br>';
		}
		echo __("Contact the administrator");
		exit();
	}

	$attrs = $auth->getAttributes();

	if (empty($attrs)) {
		$nameid = $auth->getNameId();
		if (empty($nameid)) {
			echo __("The SAMLResponse may contain NameID or AttributeStatement");
			exit();
		}
		$username = sanitize_user($nameid);
		$email = sanitize_email($nameid);
	} else {
		$usernameMapping = get_option('onelogin_saml_attr_mapping_username');
		$mailMapping =  get_option('onelogin_saml_attr_mapping_mail'); 

		if (!empty($usernameMapping) && isset($attrs[$usernameMapping]) && !empty($attrs[$usernameMapping][0])){
			$username = sanitize_user($attrs[$usernameMapping][0]);
		}
		if (!empty($mailMapping) && isset($attrs[$mailMapping])  && !empty($attrs[$mailMapping][0])){
			$email = sanitize_email($attrs[$mailMapping][0]);
		}
	}

	if (empty($username)) {
		echo __("The username could not be retrieved from the IdP and is required");
		exit();
	}
	else if (empty($email)) {
		echo __("The email could not be retrieved from the IdP and is required");
		exit();
	} else if (!is_email($email)) {
		echo __("The email provided is invalid");
		exit();
	} else {
		$userdata = array();
		$userdata['user_login'] = wp_slash($username);
		$userdata['user_email'] = wp_slash($email);
	}

	if (!empty($attrs)) {
		$firstNameMapping = get_option('onelogin_saml_attr_mapping_firstname');
		$lastNameMapping = get_option('onelogin_saml_attr_mapping_lastname');
		$roleMapping = get_option('onelogin_saml_attr_mapping_role');

		if (!empty($firstNameMapping) && isset($attrs[$firstNameMapping]) && !empty($attrs[$firstNameMapping][0])){
			$userdata['first_name'] = $attrs[$firstNameMapping][0];
		}

		if (!empty($lastNameMapping) && isset($attrs[$lastNameMapping])  && !empty($attrs[$lastNameMapping][0])){
			$userdata['last_name'] = $attrs[$lastNameMapping][0];
		}

		if (!empty($roleMapping) && isset($attrs[$roleMapping])){
			$multiValued = get_option('onelogin_saml_role_mapping_multivalued_in_one_attribute_value', false);
			if ($multiValued && count($attrs[$roleMapping]) == 1) {
				$roleValues = array();
				$pattern = get_option('onelogin_saml_role_mapping_multivalued_pattern');
				if (!empty($pattern)) {
					preg_match_all($pattern, $attrs[$roleMapping][0], $roleValues);
					if (!empty($roleValues)) {
						$attrs[$roleMapping] = $roleValues[1];
					}
				} else {
					$roleValues = explode(';', $attrs[$roleMapping][0]);
					$attrs[$roleMapping] = $roleValues;
				}
			}

			$all_roles = wp_roles()->get_names();
			$roles_found = array();

			foreach ($attrs[$roleMapping] as $samlRole) {
				$samlRole = trim($samlRole);
				if (empty($samlRole)) {
					continue;
				}

				foreach ($all_roles as $role_value => $role_name) {
					$role_value = sanitize_key($role_value);
					$matchList = explode(',', get_option('onelogin_saml_role_mapping_'.$role_value));
					if (in_array($samlRole, $matchList)) {
						$roles_found[$role_value] = true;
					}
				}
			}

			$multirole = get_site_option('onelogin_saml_multirole');
			$userdata['roles'] = [];

			uksort($roles_found, 'saml_role_order_compare');
			foreach ($roles_found as $role_value => $_role_found) {
				$userdata['roles'][] = $role_value;
				if (!$multirole || is_multisite()) {
					break;
				}
			}
		}
	}

	$matcher = get_option('onelogin_saml_account_matcher');

	if (empty($matcher) || $matcher == 'username') {
		$matcherValue = $userdata['user_login'];
		$user_id = username_exists($matcherValue);
	} else {
		$matcherValue = $userdata['user_email'];
		$user_id = email_exists($matcherValue);
	}

	if ($user_id) {
		if (is_multisite()) {
			if (get_site_option('onelogin_network_saml_global_jit')) {
				enroll_user_on_sites($user_id, $userdata['roles']);
			} else if (!is_user_member_of_blog($user_id)) {
				if (get_option('onelogin_saml_autocreate')) {
					//Exist's but is not user to the current blog id
					$blog_id = get_current_blog_id();
					enroll_user_on_blogs($blog_id, $user_id, $userdata['roles']);
				} else {
					$user_id = null;
					echo __("User provided by the IdP "). ' "'. esc_attr($matcherValue). '" '. __("does not exist in this wordpress site and auto-provisioning is disabled.");
					exit();
				}
			}
		}

		if (get_option('onelogin_saml_updateuser')) {
			$userdata['ID'] = $user_id;
			unset($userdata['$user_pass']);

			$roles = [];
			if (isset($userdata['roles'])) {
				// Prevent to change the role to the superuser (id=1)
				if ($user_id == 1) {
					unset($userdata['roles']);
				} else {
					$roles = $userdata['roles'];
					unset($userdata['roles']);
				}
			}

			$user_id = wp_update_user($userdata);
			if (isset($user_id) && !empty($roles)) {
				update_user_role($user_id, $roles);
			}
		}
	} else if (get_option('onelogin_saml_autocreate')) {
		if (!validate_username($username)) {
			echo __("The username provided by the IdP"). ' "'. esc_attr($username). '" '. __("is not valid and can't create the user at wordpress");
			exit();
		}

		if (!isset($userdata['roles'])) {
			$userdata['roles'] = array();
			$userdata['roles'][] = get_option('default_role');
		}
		$userdata['role'] = array_shift($userdata['roles']);
		$roles = $userdata['roles'];
		unset($userdata['roles']);
		$userdata['user_pass'] = wp_generate_password();
		$user_id = wp_insert_user($userdata);
		if ($user_id && !is_a($user_id, 'WP_Error')) {
			if (is_multisite()) {
				if (get_site_option('onelogin_network_saml_global_jit')) {
					enroll_user_on_sites($user_id, $userdata['roles']);
				} else {
					$blog_id = get_current_blog_id();
					enroll_user_on_blogs($blog_id, $user_id, $userdata['roles']);
				}
			} else if (!empty($roles)) {
				add_roles_to_user($user_id, $roles);
			}
		}
	} else {
		echo __("User provided by the IdP "). ' "'. esc_attr($matcherValue). '" '. __("does not exist in wordpress and auto-provisioning is disabled.");
		exit();
	}

	if (is_a($user_id, 'WP_Error')) {
		$errors = $user_id->get_error_messages();
		foreach($errors as $error) {
			echo esc_html($error).'<br>';
		}
		exit();
	} else if ($user_id) {
		wp_set_current_user($user_id);
		
		$rememberme = false;
		$remembermeMapping = get_option('onelogin_saml_attr_mapping_rememberme');
		if (!empty($remembermeMapping) && isset($attrs[$remembermeMapping]) && !empty($attrs[$remembermeMapping][0])) {
			$rememberme = in_array($attrs[$remembermeMapping][0], array(1, true, '1', 'yes', 'on')) ? true : false;
		}
		wp_set_auth_cookie($user_id, $rememberme);

		setcookie(SAML_LOGIN_COOKIE, 1, time() + YEAR_IN_SECONDS, SITECOOKIEPATH );
		setcookie(SAML_NAMEID_COOKIE, $auth->getNameId(), time() + YEAR_IN_SECONDS, SITECOOKIEPATH );
		setcookie(SAML_SESSIONINDEX_COOKIE, $auth->getSessionIndex(), time() + YEAR_IN_SECONDS, SITECOOKIEPATH );
		setcookie(SAML_NAMEID_FORMAT_COOKIE, $auth->getNameIdFormat(), time() + YEAR_IN_SECONDS, SITECOOKIEPATH );
	}

	do_action( 'onelogin_saml_attrs', $attrs, wp_get_current_user(), get_current_user_id() );

	if (isset($_REQUEST['RelayState'])) {
		$relayState = sanitize_url( $_REQUEST['RelayState'], ['https','http']);

		if (!empty($relayState) && ((substr($relayState, -strlen('/wp-login.php')) === '/wp-login.php') || (substr($relayState, -strlen('/alternative_acs.php')) === '/alternative_acs.php'))) {
			wp_redirect(home_url());
		} else {
			if (strpos($relayState, 'redirect_to') !== false) {
				$query = wp_parse_url($relayState, PHP_URL_QUERY);
				parse_str($query, $parameters);
				redirect_to_relaystate_if_trusted(urldecode($parameters['redirect_to']));
			}  else {
				redirect_to_relaystate_if_trusted($relayState);
			}
		}
	} else {
		wp_redirect(home_url());
	}
	exit();
}

function saml_sls() {
	if (may_disable_saml()) {
		return true;
	}

	$auth = initialize_saml();
	if ($auth == false) {
		wp_redirect(home_url());
		exit();
	}

	$retrieve_parameters_from_server = get_option('onelogin_saml_advanced_settings_retrieve_parameters_from_server', false);
	if (isset($_GET) && isset($_GET['SAMLRequest'])) {
		// Close session before send the LogoutResponse to the IdP
		$auth->processSLO(false, null, $retrieve_parameters_from_server, 'wp_logout');
	} else {
		$auth->processSLO(false, null, $retrieve_parameters_from_server);
	}
	$errors = $auth->getErrors();
	if (empty($errors)) {
		wp_logout();
		setcookie(SAML_LOGIN_COOKIE, 0, time() - 3600, SITECOOKIEPATH );
		setcookie(SAML_NAMEID_COOKIE, null, time() - 3600, SITECOOKIEPATH );
		setcookie(SAML_SESSIONINDEX_COOKIE, null, time() - 3600, SITECOOKIEPATH );
		setcookie(SAML_NAMEID_FORMAT_COOKIE, null, time() - 3600, SITECOOKIEPATH );

		if (get_option('onelogin_saml_forcelogin') && get_option('onelogin_saml_customize_stay_in_wordpress_after_slo')) {
			wp_redirect(home_url().'/wp-login.php?loggedout=true');
		} else {
			if (isset($_REQUEST['RelayState'])) {
				redirect_to_relaystate_if_trusted($_REQUEST['RelayState']);
			} else {
				wp_redirect(home_url());
			}
		}
		exit();
	} else {
		echo __("SLS endpoint found an error.");
		foreach($errors as $error) {
			echo esc_html($error).'<br>';
		}
		exit();
	}
}

function saml_metadata() {
	require_once plugin_dir_path(__FILE__).'_toolkit_loader.php';
	require plugin_dir_path(__FILE__).'settings.php';

	$samlSettings = new Settings($settings, true);
	$metadata = $samlSettings->getSPMetadata();

	header('Content-Type: text/xml');
	echo ent2ncr($metadata);
	exit();
}


function saml_validate_config() {
	saml_load_translations();
	require_once plugin_dir_path(__FILE__).'_toolkit_loader.php';
	require plugin_dir_path(__FILE__).'settings.php';
	require_once plugin_dir_path(__FILE__)."validate.php";
	exit();
}

function initialize_saml() {
	require_once plugin_dir_path(__FILE__).'_toolkit_loader.php';
	require plugin_dir_path(__FILE__).'settings.php';

	if (!is_saml_enabled()) {
		return false;
	}

	try {
		$auth = new Auth($settings);
	} catch (\Exception $e) {
		echo '<br>'.__("The Onelogin SSO/SAML plugin is not correctly configured.", 'onelogin-saml-sso').'<br>';
		echo esc_html($e->getMessage());
		echo '<br>'.__("If you are the administrator", 'onelogin-saml-sso').', <a href="'.esc_url( get_site_url().'/wp-login.php?normal').'">'.__("access using your wordpress credentials", 'onelogin-saml-sso').'</a> '.__("and fix the problem", 'onelogin-saml-sso');
		exit();
	}

	return $auth;
}

function is_saml_enabled() {
	$saml_enabled = get_option('onelogin_saml_enabled', 'not defined');
	if ($saml_enabled == 'not defined') {
		// If no data was saved about enable/disable saml, then
		// check if entityId also is not defined and then consider the
		// plugin disabled
		if (get_option('onelogin_saml_idp_entityid', 'not defined') == 'not defined') {
			$saml_enabled = false;
		} else {
			$saml_enabled = true;
		}
	} else {
		$saml_enabled = $saml_enabled == 'on'? true : false;
	}
	return $saml_enabled;
}

function enroll_user_on_sites($user_id, $roles) {
	$opts = array('number' => 1000);
	$sites = get_sites($opts);
	foreach ($sites as $site) {
		if (get_blog_option($site_id, "onelogin_saml_autocreate") && !is_user_member_of_blog($user_id, $site->id)) {
			foreach($roles as $role) {
				add_user_to_blog($site->id, $user_id, $role);
			}
		}
	}
}

function enroll_user_on_blogs($blog_id, $user_id, $roles) {
	foreach($roles as $role) {
		add_user_to_blog($blog_id, $user_id, $role);
	}
}

function update_user_role($user_id, $roles)
{
	$user = get_user_by('id', $user_id);
	$role = array_shift($roles);
	$user->set_role($role);	// This removes previous assignations

	foreach($roles as $role) {
		$user->add_role($role);
	}
}

function add_roles_to_user($user_id, $roles)
{
	$user = get_user_by('id', $user_id);

	foreach($roles as $role) {
		$user->add_role($role);
	}
}

// Prevent that the user change important fields
class preventLocalChanges
{
	function __construct()
	{
		if (get_option('onelogin_saml_customize_action_prevent_change_mail', false)) {
			add_action('admin_footer', array($this, 'disable_email'));
		}
		if (get_option('onelogin_saml_customize_action_prevent_change_password', false)) {
			add_action('admin_footer', array($this, 'disable_password'));
		}
	}

	function disable_email()
	{
		global $pagenow;
		if ($pagenow == 'profile.php' && !current_user_can( 'manage_options' )) {

			?>
			<script>
				jQuery(document).ready(function ($) {
					if ($('input[name=email]').length) {
						$('input[name=email]').attr("readonly", "readonly");
					}

				});
			</script>
		<?php
		}
	}

	function disable_password()
	{
		global $pagenow;
		if ($pagenow == 'profile.php' && !current_user_can( 'manage_options' )) {

			?>
			<script>
				jQuery(document).ready(function ($) {
					$('tr[id=password]').hide();
					$('tr[id=password]').next().hide();
				});
			</script>
		<?php
		}
	}

}

$preventLocalChanges = new preventLocalChanges();