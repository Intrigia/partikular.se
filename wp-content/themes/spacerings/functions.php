<?php
/**
 * Science Mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Science_Mag
 */

if ( ! function_exists( 'science_mag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function science_mag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Science Mag, use a find and replace
		 * to change 'science-mag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'science-mag', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Yoast SEO breadcrumbs support in Sciencemag theme
		 */
		add_theme_support( 'yoast-seo-breadcrumbs' );


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'science-mag' ),
			'footer-categories' => __( 'Footer Categories' ),
			'mobile-menu-categories' => __( 'Mobile Menu Categories' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'responsive-embeds' );
		add_theme_support('disable-custom-font-sizes');


		// Add support for editor styles.
	  add_theme_support( 'editor-styles' );
		// Enqueue editor styles.
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 40,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'science_mag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function science_mag_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'science_mag_content_width', 640 );
}
add_action( 'after_setup_theme', 'science_mag_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function science_mag_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'science-mag' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'science-mag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'science_mag_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function science_mag_scripts() {
	$issignup = false;
	$isdonate = false;
	if ( is_page() ) {
		global $wp_query;
		$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
		switch ($template_name) {
			case "signup.php":
				global $issignup;
				$issignup = true;
			  break;
			case "donate.php":
				global $isdonate;
				$isdonate = true;
			  break;
		}
	}

	wp_enqueue_script( 'science-mag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( $issignup == false ) {
		wp_enqueue_style( 'science-mag-style', get_stylesheet_uri() );
		wp_enqueue_script( 'science-mag-javascript', get_template_directory_uri() . '/js/main.js', array(), '', true );
		wp_enqueue_script( 'science-mag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
		wp_enqueue_style( 'science-mag-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Poppins:400,500,600,700&display=swap', false );
		if ( is_page() && $isdonate == false) {
			wp_enqueue_script( 'science-mag-parallax', get_template_directory_uri() . '/js/parallax.min.js', array(), '', false );
		}
		if ( $isdonate ) {
			wp_enqueue_style( 'science-mag-donate-style', get_template_directory_uri() . '/css/donate.css' );
		} else {
			wp_enqueue_script( 'science-mag-particles', get_template_directory_uri() . '/js/particles.js', array(), '20151215', true );
			wp_enqueue_script( 'science-mag-particles-app', get_template_directory_uri() . '/js/app.js', array(), '20151215', true );
		}
	} else {
		wp_enqueue_style( 'science-mag-signup-style', get_template_directory_uri() . '/css/signup.css' );
	}
	if ( is_singular() && $issignup == false ) {
		wp_enqueue_style( 'science-mag-single-style', get_template_directory_uri() . '/css/single.css' );
	}
	if ( is_author() ) {
		wp_enqueue_style( 'science-mag-authorpage-style', get_template_directory_uri() . '/css/author.css' );
	}

}
add_action( 'wp_enqueue_scripts', 'science_mag_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


























/* AJAX LOAD MORE BUTTON ON AUTHOR PAGE */
function sciencemag_my_load_more_scripts() {
	if ( ! is_singular() ) {
			global $wp_query;

			// In most cases it is already included on the page and this line can be removed
			wp_enqueue_script('jquery');

			// register our main script but do not enqueue it yet
			wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/ajaxloadmore.js', array('jquery') );

			// we have to pass parameters to ajaxloadmore.js script but we can get the parameters values only in PHP
			// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
			wp_localize_script( 'my_loadmore', 'sciencemag_loadmore_params', array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
				'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
				'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
				'ishome' => $wp_query->is_home,
				'iscategory' => $wp_query->is_category,
				'isauthor' => $wp_query->is_author,
				'issearch' => $wp_query->is_search,
				'max_page' => $wp_query->max_num_pages
			) );

 			wp_enqueue_script( 'my_loadmore' );
  }
}

add_action( 'wp_enqueue_scripts', 'sciencemag_my_load_more_scripts' );

function sciencemag_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :
		// run the loop
		if ( $_POST['ishome'] || $_POST['iscategory'] ):
			$npost = 1;
		  while( have_posts() ):
		    the_post();
		    if ($npost%2 == 0):
		      get_template_part( 'template-parts/content-left-aligned', get_post_type() );
		    else:
		      get_template_part( 'template-parts/content-right-aligned', get_post_type() );
		    endif;
		    $npost = $npost + 1;
		  endwhile;
		elseif ( $_POST['isauthor'] || $_POST['issearch'] ):
			while( have_posts() ): the_post();
		      get_template_part( 'template-parts/shortpost', get_post_type() );
		  endwhile;
		else:
			echo("Argh! Couldn't find any matching conditions. Try again!");
		endif;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'sciencemag_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'sciencemag_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}



















//Add fvourite category for authors
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Ytterligare information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="favorite"><?php _e("Favoritkategori"); ?></label></th>
        <td>
            <input type="text" name="favorite" id="favorite" value="<?php echo esc_attr( get_the_author_meta( 'favorite', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Ange kategorin som du tycker är mest intressant."); ?></span>
        </td>
    </tr>
    </table>
	<script>
          document.querySelector(".user-url-wrap").style.display = "none";
          document.querySelector(".user-facebook-wrap").style.display = "none";
          document.querySelector(".user-instagram-wrap").style.display = "none";
          document.querySelector(".user-myspace-wrap").style.display = "none";
          document.querySelector(".user-pinterest-wrap").style.display = "none";
          document.querySelector(".user-soundcloud-wrap").style.display = "none";
          document.querySelector(".user-tumblr-wrap").style.display = "none";
          document.querySelector(".user-twitter-wrap").style.display = "none";
          document.querySelector(".user-youtube-wrap").style.display = "none";
          document.querySelector(".user-wikipedia-wrap").style.display = "none";
    </script>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'favorite', $_POST['favorite'] );
}


function my_login_logo() { ?>
    <style type="text/css">
    	#login h1 a,.login h1 a{background-image:url(/wp-content/uploads/2019/10/cropped-favicon-for-particular-180x180.png);height:100px;width:100px;background-size:100px 100px;background-repeat:no-repeat;padding-bottom:0}body.login{background:black;}body.login div#login form#loginform{border-radius:0;display:none;}body.login div#login p#backtoblog{color:#fff}body.login div#login p#backtoblog a{color:#fff}body.login div#login .privacy-policy-page-link .privacy-policy-link{color:#202020}body.login div#login p#nav{color:#fff;display:none;}body.login div#login p#nav a{color:#fff}body.login div#login form#loginform p.submit input#wp-submit{background-color:#000;border:none;box-shadow:none;color:#fff;text-shadow:none} #g-user-login{background-color:white;border-radius:0.3em;border:2px solid #eee;display:flex;text-decoration:none;color:black;padding:0.5em;font-size:1.1em;transition:0.3s;} #g-user-login:hover{border-color:#7A7A7A;} #hYu72D{display:flex;justify-content:center;align-items:center;flex-shrink:0;} #tRbe90 {margin: auto;flex:1 1;display:inline-block;max-width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:bold;text-align:center;} input[type=checkbox]:focus,input[type=color]:focus,input[type=date]:focus,input[type=datetime-local]:focus,input[type=datetime]:focus,input[type=email]:focus,input[type=month]:focus,input[type=number]:focus,input[type=password]:focus,input[type=radio]:focus,input[type=search]:focus,input[type=tel]:focus,input[type=text]:focus,input[type=time]:focus,input[type=url]:focus,input[type=week]:focus,select:focus,textarea:focus{border-color:black !important;box-shadow:0 0 0 4px #ddd !important;transition: 0.3s;} .wp-core-ui .button-secondary{color:black !important;} #wp-submit{background-color:black;border:none;} #login > div:nth-child(2) > a{color: black; text-decoration: none; font-weight: bold;}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( "login_headerurl", "custom_loginlogo_url" );
function custom_loginlogo_url($url) {
  return get_bloginfo( 'url' );
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

/**
 * Create custom RSS feed for Mailchimp
 *
 */
add_action('init', 'customRSS');
function customRSS(){
	add_feed('mailchimp', 'customRSSFunc');
}
function customRSSFunc(){
	get_template_part('template-parts/rss-mailchimp', 'rss');
}

/**
 * Remove structured data markup from Yoast, use other plugin instead
 *
 *
 *
 *
 */
add_filter( 'wpseo_json_ld_output', '__return_false' );




//estimated reading time
function reading_time() {
	$content = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = ceil($word_count / 180);
	if ($readingtime == 1) {
		$timer = " minut";
	} else {
		$timer = " minuter";
	}
	$totalreadingtime = $readingtime . $timer;
	return $totalreadingtime;
}




/*
 * Get user's role to determine which blocks to show in Gutenberg editor.
 *
 * If $user parameter is not provided, returns the current user's role.
 * Only returns the user's first role, even if they have more than one.
 *
 * @param mixed $user User ID or object. Pass nothing for current user.
 *
 * @return string The User's role, or an empty string if none.
 */
function get_user_role( $user = null ) {
 $user = $user ? new WP_User( $user ) : wp_get_current_user();

 return $user->roles ? $user->roles[0] : '';
}

/*
 *
 * Restrict Gutenberg blocks to certain users
 *
 */
function partikular_allowed_block_types( $allowed_block_types, $post ) {
    if ( $post->post_type !== 'post' || get_user_role() == 'administrator') {
        return $allowed_block_types;
    }
		if (get_user_role() == 'editor') {
			return array(
				'core/paragraph',
				'core/heading',
				'core/list',
				'core/quote',
				'core/code',
				'core/preformatted',
				'core/table',
				'core/image',
				'core/gallery',
				'core/audio',
				'core/cover',
				'core/file',
				'core/media-text',
				'core/buttons',
				'core/columns',
				'core/group',
				'core/separator',
				'core/nextpage',
				'core/spacer',
				'core/archives',
				'core/categories',
				'core/latest-posts',
				'core-embed/youtube',
				'genesis-custom-blocks/kallor-start',
				'genesis-custom-blocks/kallor-slut',
				'genesis-custom-blocks/book',
				'genesis-custom-blocks/web',
				'genesis-custom-blocks/journal',
				'genesis-custom-blocks/other',
				'genesis-custom-blocks/kallhanvisning',
				'genesis-custom-blocks/comment',
				'genesis-custom-blocks/suggestion'
			);
		} else {
			return array(
				'core/paragraph',
				'core/heading',
				'core/list',
				'core/quote',
				'core/code',
				'core/preformatted',
				'core/table',
				'core/image',
				'core/gallery',
				'core/audio',
				'core/cover',
				'core/file',
				'core/media-text',
				'core/buttons',
				'core/columns',
				'core/group',
				'core/separator',
				'core/nextpage',
				'core/spacer',
				'core/archives',
				'core/categories',
				'core/latest-posts',
				'core-embed/youtube',
				'genesis-custom-blocks/kallor-start',
				'genesis-custom-blocks/kallor-slut',
				'genesis-custom-blocks/book',
				'genesis-custom-blocks/web',
				'genesis-custom-blocks/journal',
				'genesis-custom-blocks/other',
			);
		}
}

add_filter( 'allowed_block_types', 'partikular_allowed_block_types', 10, 2 );



/*
 *
 * Removes unneccessary elements in Gutenberg side panel
 * @tags custom post format
 *
 */
function partikular_remove_page_excerpt_field() {
    remove_post_type_support( 'post', 'excerpt' );
	remove_post_type_support( 'post', 'trackbacks' );
	remove_post_type_support( 'post', 'custom-fields' );
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'post', 'post-formats' );
}
add_action( 'admin_init', 'partikular_remove_page_excerpt_field' );



/**
 * Register a custom menu page.
 */
function register_forbattringar_page(){
    add_menu_page(
        __( 'Förslag på förbättringar', 'forbattringar' ),
        'Förslag på förbättringar',
        'read',
        'forbattringar',
        'forbattringar_menu_page',
        'dashicons-thumbs-up',
        6
    );
}
add_action( 'admin_menu', 'register_forbattringar_page' );

/**
 * Display a custom menu page
 */
function forbattringar_menu_page(){
	echo '<h4 style="width:100%;padding: 20px;">Knappen nedan skickar dig till ett Google Chat-rum där du kan föreslå förbättringar på hemsidan, rättningsprocessen och annat. Hjälp oss att göra Partikular bättre!<h4></h6><a href="https://chat.google.com/room/AAAA_cL4jz4" target="_blank" style="margin-left:20px;margin-top:20px;padding: 15px;background: #189487;font-weight:bold;color:white;text-decoration:none;border-radius: 5px;">Öppna Google Chat <span class="dashicons dashicons-external"></span></a>';
}

/**
 * Custom Author Base
 *
 * @return void
 */
function partikular_custom_author_base() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'skribent';
}
add_action( 'init', 'partikular_custom_author_base' );
