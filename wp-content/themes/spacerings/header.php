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
		<nav class="sciencemag__navigation">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="125" viewBox="0 0 200 50.587">
					<defs>
					<clipPath id="clip-svglogo">
						<rect width="200" height="50.587"/>
					</clipPath>
					</defs>
					<g id="svglogo" clip-path="url(#clip-svglogo)">
					<text id="partikular" transform="translate(-3 32)" fill="#fff" font-size="41.5" font-family="Poppins-Medium, Poppins" font-weight="500"><tspan x="0" y="0">partikular</tspan></text>
					<text id="vetenskaplig_ungdomstidning" data-name="vetenskaplig ungdomstidning" transform="translate(14 47)" fill="#fff" font-size="12.3" font-family="Poppins-Medium, Poppins" font-weight="500"><tspan x="0" y="0">vetenskaplig ungdomstidning</tspan></text>
					</g>
			  </svg>
			</a>
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
		<div class="header_right_container">
			<div id="menu_sites">Mer
				<div>
					<ul>
						<li><a href="/om-oss">Om oss</a></li>
						<li><a href="/vanliga-fragor">Vanliga frågor</a></li>
						<li><a href="/press">Press</a></li>
						<li><a href="/kontakt">Kontakta oss</a></li>
					</ul>
				</div>
			</div>
			<button class="sciencemag__navbar__search" type="button" onclick="OpenSearchWindow()">Sök</button>
			<a class="donate-button" href="/donera">Donera</button>
			<a id="signup_button" href="<?php echo esc_url( home_url( '/bli-medlem' ) ); ?>">Bli medlem</a>
			<div class="mobile__menu__blur" onclick="openmenu()"></div>
			<!-- Blur must be before hamburger icon so z-index isn't needed-->
			<button class="sciencemag__navbar__hamburger" type="button" data-toggle="collapse" onclick="openmenu()"><div class="sciencemag__hamburger__icon"><hr id="top_line"/><hr id="middle_line"/><hr id="bottom_line"/><hr id="cross_line"/></div></button>
		</div>
		<div class="sciencemag__search__wrap">
			<div class="searchbox__wrap">
				<?php get_search_form(); ?>
			</div>
		</div>
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
		<div class="temp-referrer-message" style="width:calc(100% - 30px);position:fixed;top:70px;padding: 9px 15px;background: #202020;color:white;font-size:13px;z-index:1000;">
			<span>Just nu på Partikular – Sök till nästa års styrelse. <a href="https://www.partikular.se/sok-till-styrelsen/" style="font-weight: bold;font-size: 72px;background: -webkit-linear-gradient(#803397, #019f87);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Klicka här för att läsa mer</a>
		</div>
	</header><!-- #masthead -->
