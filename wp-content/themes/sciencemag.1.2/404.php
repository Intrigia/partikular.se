<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Science_Mag
 */

get_header();
?>
<style>
#sciencemag_particles {
	margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
  position:absolute;
  top: 0;
  left: 0;
  z-index: 0;
}
.page-content {
	position: relative;
	margin-top: 70px;
}
.ticker {
	position: relative;
	overflow: hidden;
	white-space: nowrap;
}
.ticker__info {
	display: inline-block;
}
.errorcode__first__ticker .ticker__info {
	margin-top: 20px;
}
.page-content span, .page-content h2, .page-content h3 {
	margin: 0 25px;
}
.page-content h2, .page-content h3, .page-content h1 {
	display: inline;
}
.page-content h2, .page-content h3, .button__fifth__ticker div span {
	font-size: 30px;
}
.errorcode__first__ticker span {
	font-size: 20px;
}
.title__scnd__ticker .ticker__info h1 {
	font-size: 360px;
	margin: 0 30px;
}
.information__third__ticker .ticker__info {
	margin-bottom: 30px;
}
.information__forth__ticker {
	background-color: #212121;
}
.information__forth__ticker .ticker__info, .button__fifth__ticker .ticker__info {
	margin: 30px 0;
}
.information__forth__ticker .ticker__info h3 {
	font-weight: 400;
	color: #eee;
}
.button__fifth__ticker {
	background: linear-gradient(-45deg, #019F87, #4E6E99);
	transition: 0.3s;
	color: white;
}
.button__fifth__ticker:hover  {
	color: #202020;
}
a {
	text-decoration: none;
}
.ticker__info {
	animation: firstticker 20s infinite;
	animation-timing-function: linear;
}

.site-footer {
	margin-top: 0;
}
@keyframes firstticker {
	100% {transform: translateX(-100%);}
}
@media all and (max-width: 576px) {
	.errorcode__first__ticker span {
		font-size: 2.5vh;
	}
	.title__scnd__ticker .ticker__info h1 {
		font-size: 40vh;
		margin: 0 15px;
	}
	.information__third__ticker .ticker__info h2 {
		font-size: 3.5vh;
	}
	.information__forth__ticker .ticker__info h3 {
		font-size: 3.5vh;
	}
	.button__fifth__ticker div span {
		font-size: 3.5vh;
	}
}
</style>
<div id="sciencemag_particles">
</div><!-- #sciencemag_particles -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-content">
					<div class="errorcode__first__ticker ticker">
						<div class="ticker__info">
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
						</div>
						<div class="ticker__info ticker__info__2">
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
							<span>Felkod</span>
						</div>
					</div>
					<div class="title__scnd__ticker ticker">
						<div class="ticker__info">
						  <h1>404</h1>
						  <h1>404</h1>
						</div>
						<div class="ticker__info ticker__info__2">
						  <h1>404</h1>
						  <h1>404</h1>
						</div>
					</div>
					<div class="information__third__ticker ticker">
						<div class="ticker__info">
							<h2>Sidan som du försöker hitta existerar inte.</h2>
							<h2>Sidan som du försöker hitta existerar inte.</h2>
							<h2>Sidan som du försöker hitta existerar inte.</h2>
						</div>
						<div class="ticker__info ticker__info__2">
							<h2>Sidan som du försöker hitta existerar inte.</h2>
							<h2>Sidan som du försöker hitta existerar inte.</h2>
							<h2>Sidan som du försöker hitta existerar inte.</h2>
						</div>
					</div>
					<div class="information__forth__ticker ticker">
						<div class="ticker__info">
						  <h3>Du kanske har skrivit fel, eller så har sidan tagits bort.</h3>
						  <h3>Du kanske har skrivit fel, eller så har sidan tagits bort.</h3>
						</div>
						<div class="ticker__info ticker__info__2">
						  <h3>Du kanske har skrivit fel, eller så har sidan tagits bort.</h3>
						  <h3>Du kanske har skrivit fel, eller så har sidan tagits bort.</h3>
						</div>
					</div>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<div class="button__fifth__ticker ticker">
							<div class="ticker__info">
								<span>Ta mig hem</span>
						  	<span>Ta mig hem</span>
						  	<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
							</div>
							<div class="ticker__info ticker__info__2">
								<span>Ta mig hem</span>
						  	<span>Ta mig hem</span>
						  	<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
					  		<span>Ta mig hem</span>
							</div>
						</div>
				  </a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
