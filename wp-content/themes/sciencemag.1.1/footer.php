<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Science_Mag
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="sciencemag__newsletter__wrap">
			<div class="newsletter__title">
				<div>
					<h4>Prenumerera på vårt nyhetsbrev.</h4>
					<h3>Få snabb tillgång till de nyaste artiklarna.</h3>
			  </div>
			</div>
			<div class="newsletter__signup">
				<div class="newsletter__form">
			  	<form action="https://partikular.us5.list-manage.com/subscribe/post?u=6b46285289139ed51ecb621d1&amp;id=d99baed735" method="post" target="_blank">
						<div class="newsletter__inputs">
							<input type="text" value="" name="FNAME" id="FNAME" placeholder="Förnamn" required autocomplete="given-name"/>
					  	<input type="email" value="" name="EMAIL" id="EMAIL" placeholder="E-postadress" required autocomplete="email"/>
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dea2362a754d95ce5eb3c1341_8da7ab9515" tabindex="-1" value=""></div>
						</div>
				  	<input type="submit" value="PRENUMERERA" name="subscribe" id="mc-embedded-subscribe">
				  </form>
			  </div>
			</div>
		</div>
		<div class="sciencemag__footer__wrap">
			<div class="sciencemag__footer">
			<div class="footer__logo">
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						?>
						<div class="branding__text footer__branding">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<span class="site-title-footer"><?php bloginfo( 'name' ); ?></span>
							<span>vetenskaplig ungdomstidning</span>
							</a>
						</div>
						<?php
					endif;?>
				</div><!-- .site-branding -->
				<hr/>
				<p>Partikular är en svensk vetenskapstidning för unga.
					Vi strävar efter att lyfta intresset för forskning samt vidare studier inriktade på naturvetenskap.</p>
			</div>
			<div class="footer__links">
				<h5 class="footer__links__title"><?php bloginfo( 'name' ); ?></h5>
				<ul class="footer__links__list">
					<?php wp_list_pages( array(
						'title_li'    => '',
					) ); ?>
				</ul>
			</div>
			<div class="footer__contact">
				<h5>Kontakt</h5>
				<ul>
					<li><a href="https://www.instagram.com/partikular.se" target="_blank">📱 @partikular.se</a></li>
					<li><a href="mailto:kontakt@partkular.se">📧 kontakt@partikular.se</a></li>
					<li><a href="tel:0727441083">📞 072-744 1083</a></li>
					<li><a href="https://goo.gl/maps/8ELLNee6Sr1bHuoM9" target="_blank">📬 Södra Storgatan 11-13<br/><span>252 23 Helsingborg</span><br/><span>Sverige</span></a></li>
				</ul>
			</div>
			<div class="footer__categories">
				<h5>Kategorier</h5>
				<?php
          wp_nav_menu( array(
	          'theme_location' => 'footer-categories',
	          'container_class' => 'footer__categories__list' ) );
        ?>
			</div>
		  </div>
		</div>
		<div class="sciencemag__site__info">
			<span class="site__info__copyright">© <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>, Alla rättigheter förbehållna.</span>
			<span class="site__info__fun">Älska naturvetenskap!</span>
			<span class="site__info__credit">Hemsida utvecklad av <a href="https://www.linkedin.com/in/karlsellergren" target="_blank">Karl Sellergren</a></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/particles.js';?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/app.js';?>"></script>
<?php wp_footer(); ?>

</body>
</html>
