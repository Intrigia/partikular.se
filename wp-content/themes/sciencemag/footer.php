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
					<h4>Bli en del av Partikular.</h4>
					<h3>Nu kan du bli medlem i vår ideella förening.</h3>
			  </div>
			</div>
			<div class="newsletter__signup" style="background-image: url('<?php echo get_template_directory_uri() . '/becomemember.png';?>');"</div>
				<div class="newsletter__form">
			  	<a href="/bli-medlem">Bli medlem &#8594;</a>
			  </div>
			</div>
		</div>
		<div class="sciencemag__footer__wrap">
			<div class="sciencemag__footer">
			<div class="footer__logo">
				<div class="">
					<!-- WAS SITE-BRANDING BEFORE, NOW REASSIGNED-->
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
					<li><a href="https://www.instagram.com/partikular.se" target="_blank">&#128241; @partikular.se</a></li>
					<li><a href="mailto:kontakt@partikular.se">&#128231; kontakt@partikular.se</a></li>
					<li><a href="tel:0727441083">&#128222; 072-744 1083</a></li>
					<li><a href="https://m.me/partikular.se" target="_blank">&#128172; Messenger</a></li>
					<li><a href="/kontakt">&#128221; Kontaktformulär</a></li>
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
			<span class="site__info__fun">Organisationsnummer: 802530-4257</span>
			<span class="site__info__credit">Hemsida utvecklad av <a href="https://www.linkedin.com/in/karlsellergren" target="_blank">Karl Sellergren</a></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="sciencemag__newsletter__modal" id="nyhetsbrev__modal">
	<div class="modal__body">
		<div class="modal__image" style="background-image:url('<?php echo get_template_directory_uri() . '/enheter.jpg';?>');"></div>
		<div class="modal__text">
			<div class="modal__text__header">
				<span class="logo__p">p</span>
				<span>IDEELL FÖRENING</span>
			</div>
			<div class="modal__content">
				<p>Förlåt för att vi stör, men:<br/><br/>Bli medlem i vår ideella förening
				 för att få medlemsförmåner och bli skribent hos oss. Det är helt gratis och
				 genom att bli medlem hjälper du oss att expandera.</p>
			</div>
			<div class="modal__form">
				<a id="mc-embedded-subscribe" href="/bli-medlem">Bli medlem ⬈</a>
			</div>
			<button class="modal__close" onclick="closenewslettermodal()">
				<hr class="first__line"/>
				<hr class="scnd__line"/>
			</button>
		</div>
	</div>
</div>
<div class="sciencemag__donation__modal" id="donate__button__click__modal">
	<div class="donation__modal__body">
		<div class="donation__header">
			<span>Donera till Partikular</span>
			<span>Skanna koden nedan med hjälp av<br>Swish för att donera ett<br>valfritt belopp.</span>
		</div>
		<img src="<?php echo get_template_directory_uri() . '/qrcode.png';?>" id="swishqrcode">
		<div class="donation__footer">
			<button onclick="zoomin(this)">Förstora</button>
			<span>Referensnummer: 5219930281</span>
			<span>Utvecklad av Karl Sellergren</span>
		</div>
		<button class="modal__close" onclick="donatemodal(this)" id="modal__topright__close">
			<hr class="first__line"/>
			<hr class="scnd__line"/>
		</button>
	</div>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/particles.js';?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/app.js';?>"></script>
<?php wp_footer(); ?>

</body>
</html>