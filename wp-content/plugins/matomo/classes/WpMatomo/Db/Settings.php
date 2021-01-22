<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package matomo
 */

namespace WpMatomo\Db;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Settings {

	/**
	 * This feature can be used to read data from matomo tables without needing to bootstrap matomo
	 *
	 * @param string $table_name_to_prefix
	 *
	 * @return string
	 * @api
	 */
	public function prefix_table_name( $table_name_to_prefix ) {
		global $wpdb;

		return $wpdb->prefix . MATOMO_DATABASE_PREFIX . $table_name_to_prefix;
	}

	public function get_installed_matomo_tables() {
		global $wpdb;

		$table_names = array();
		$tables      = $wpdb->get_results( 'SHOW TABLES LIKE "' . $wpdb->prefix . str_replace( '_', '\_', MATOMO_DATABASE_PREFIX ) . '%"', ARRAY_N );
		foreach ( $tables as $table_name_to_look_for ) {
			$table_names[] = array_shift( $table_name_to_look_for );
		}

		// we need to hard code them unfortunately for tests cause there are temporary tables used and we can't find a
		// list of existing temp tables
		$table_names_to_look_for = array(
			'access',
			'archive_invalidations',
			'brute_force_log',
			'goal',
			'locks',
			'log_action',
			'log_conversion',
			'log_conversion_item',
			'log_link_visit_action',
			'log_profiling',
			'log_visit',
			'logger_message',
			'option',
			'plugin_setting',
			'privacy_logdata_anonymizations',
			'report',
			'report_subscriptions',
			'segment',
			'sequence',
			'session',
			'site',
			'site_setting',
			'site_url',
			'tagmanager_container',
			'tagmanager_container_release',
			'tagmanager_container_version',
			'tagmanager_tag',
			'tagmanager_trigger',
			'tagmanager_variable',
			'tracking_failure',
			'twofactor_recovery_code',
			'user',
			'user_dashboard',
			'user_language',
			'user_token_auth',
		);
		foreach ( range( 2010, gmdate( 'Y' ) + 1 ) as $year ) {
			foreach ( range( 1, 12 ) as $month ) {
				$table_names_to_look_for[] = 'archive_numeric_' . $year . '_' . str_pad( $month, 2, '0' );
				$table_names_to_look_for[] = 'archive_blob_' . $year . '_' . str_pad( $month, 2, '0' );
			}
		}
		$table_names_to_look_for = apply_filters( 'matomo_install_tables', $table_names_to_look_for );

		foreach ( $table_names_to_look_for as $table_name_to_look_for ) {
			$table_name_to_test = $this->prefix_table_name($table_name_to_look_for);
			if ( ! in_array( $table_name_to_test, $table_names, true ) ) {
				$table_names[] = $table_name_to_test;
			}
		}

		return $table_names;
	}

}
