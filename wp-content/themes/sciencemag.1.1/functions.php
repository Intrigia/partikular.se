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

  wp_enqueue_style( 'science-mag-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,900|Poppins:500,600,700&display=swap', false );

	wp_enqueue_style( 'science-mag-style', get_stylesheet_uri() );

	wp_enqueue_script( 'science-mag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'science-mag-javascript', get_template_directory_uri() . '/main.js', array(), '', true );

	wp_enqueue_script( 'science-mag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() ) {
		wp_enqueue_style( 'science-mag-single-style', get_template_directory_uri() . '/single.css' );
	}
	if ( is_page() ) {
		wp_enqueue_script( 'science-mag-parallax', get_template_directory_uri() . '/parallax.min.js', array(), '', false );
	}
	if ( is_author() ) {
    wp_enqueue_style( 'science-mag-authorpage-style', get_template_directory_uri() . '/author.css' );
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
			wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/ajaxloadmore.js', array('jquery') );

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
        #login h1 a,.login h1 a{background-image:url(/wp-content/uploads/2019/10/cropped-favicon-for-particular-180x180.png);height:100px;width:100px;background-size:100px 100px;background-repeat:no-repeat;padding-bottom:0}body.login{background:linear-gradient(-45deg,grey,#fff);filter:invert(1);font-family:Poppins,sans-serif}body.login div#login form#loginform{border-radius:0}body.login div#login p#backtoblog{color:#fff}body.login div#login p#backtoblog a{color:#fff}body.login div#login .privacy-policy-page-link .privacy-policy-link{color:#202020}body.login div#login p#nav{color:#fff}body.login div#login p#nav a{color:#fff}body.login div#login form#loginform p.submit input#wp-submit{background-color:#000;border:none;box-shadow:none;color:#fff;text-shadow:none}
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