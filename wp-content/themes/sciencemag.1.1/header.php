<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Science_Mag
 */

?>
<!doctype html>
<!--



      _.-'''-._
     .'   .-'``|'.
    /    /    -*- \
   ;   <{      |   ;
   |    _\ |       |
   ;   _\ -*- |    ;
    \   \  | -*-  /
     '._ '.__ |_.'
        '-----'

Website developed by Karl Sellergren. Check out my LinkedIn profile: https://www.linkedin.com/in/karlsellergren/



-->
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
	if ( is_user_logged_in() ) { ?>
		<style>
		.sciencemag__navigation {transform: translateY(32px);}
		#wpadminbar {background-color: black !important;}
		.sciencemag__mobile__menu {top: 32px !important;}
		#menu-categories-for-mobile-menu:first-child {border-top: 1px solid #555;}
		@media screen and (max-width: 782px) {
			.sciencemag__navigation {transform: translateY(46px);}
			#wpadminbar {position: fixed !important;}
			.sciencemag__mobile__menu {top: 46px !important;}
		}
		</style>
	<?php }
	wp_head(); ?>
	<meta name="msapplication-TileColor" content="#000000">
  	<meta name="theme-color" content="#ffffff">
</head>

<body <?php body_class(); ?> >
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'science-mag' ); ?></a>
	<?php if ( is_home() ) {?>
	<h1 id="visibilityhidden">Partikular Ungdomstidning</h1>
	<?php }?>
	<header id="masthead" class="site-header">
		<div class="sciencemag__cookie__notice__wrapper">
			<div class="cookie__notice__text">
				<span>Vi använder cookies för att du ska få den bästa möjliga upplevelsen, läs mer i vår
					<a href="<?php echo esc_url( home_url( '/' ) ) . "integritetspolicy"; ?>">integritetspolicy</a>.</span>
			</div>
			<a onclick="closecookiebanner()" class="cookie__notice__btn">X</a>
		</div>
		<nav class="sciencemag__navigation">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<div class="branding__header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<span id="site__title"><?php bloginfo( 'name' ); ?></span>
						<span id="site__subtitle">vetenskaplig ungdomstidning</span>
					</a>
				</div>
				<?php
			endif;?>
		</div><!-- .site-branding -->

		<div>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'depth'          => '2',
			) );
			?>
		</div>

		<button class="sciencemag__navbar__search" type="button" onclick="OpenSearchWindow()">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 475.084 475.084" style="enable-background:new 0 0 475.084 475.084;" xml:space="preserve" class=""><g><g>
				<path d="M464.524,412.846l-97.929-97.925c23.6-34.068,35.406-72.047,35.406-113.917c0-27.218-5.284-53.249-15.852-78.087   c-10.561-24.842-24.838-46.254-42.825-64.241c-17.987-17.987-39.396-32.264-64.233-42.826   C254.246,5.285,228.217,0.003,200.999,0.003c-27.216,0-53.247,5.282-78.085,15.847C98.072,26.412,76.66,40.689,58.673,58.676   c-17.989,17.987-32.264,39.403-42.827,64.241C5.282,147.758,0,173.786,0,201.004c0,27.216,5.282,53.238,15.846,78.083   c10.562,24.838,24.838,46.247,42.827,64.234c17.987,17.993,39.403,32.264,64.241,42.832c24.841,10.563,50.869,15.844,78.085,15.844   c41.879,0,79.852-11.807,113.922-35.405l97.929,97.641c6.852,7.231,15.406,10.849,25.693,10.849   c9.897,0,18.467-3.617,25.694-10.849c7.23-7.23,10.848-15.796,10.848-25.693C475.088,428.458,471.567,419.889,464.524,412.846z    M291.363,291.358c-25.029,25.033-55.148,37.549-90.364,37.549c-35.21,0-65.329-12.519-90.36-37.549   c-25.031-25.029-37.546-55.144-37.546-90.36c0-35.21,12.518-65.334,37.546-90.36c25.026-25.032,55.15-37.546,90.36-37.546   c35.212,0,65.331,12.519,90.364,37.546c25.033,25.026,37.548,55.15,37.548,90.36C328.911,236.214,316.392,266.329,291.363,291.358z   " data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFFFFF"/>
			</g></g> </svg>
		</button>
		<div class="mobile__menu__blur" onclick="openmenu()"></div>
		<button class="sciencemag__navbar__hamburger" type="button" data-toggle="collapse" onclick="openmenu()">
	    <div class="sciencemag__hamburger__icon">
	      <hr id="top_line"/>
	      <hr id="middle_line"/>
	      <hr id="bottom_line"/>
				<hr id="cross_line"/>
	    </div>
	  </button><!-- #sciencemag__navbar__hamburger -->
		<div class="sciencemag__search__wrap">
			<div class="searchbox__wrap">
				<?php get_search_form(); ?>
			</div>
		</div>
		<div class="sciencemag__navbar__gradient"></div>
		</nav><!-- #site-navigation -->


		<div class="sciencemag__mobile__menu">
			<div class="mobile__menu__links">
				<?php
          wp_nav_menu( array(
	          'theme_location' => 'mobile-menu-categories' ) );
        ?>
				<ul id="mobile_menu__default">
					<?php wp_list_pages( array(
						'title_li'    => '',
					) ); ?>
				</ul>
			</div>
		</div>
	</header><!-- #masthead -->
