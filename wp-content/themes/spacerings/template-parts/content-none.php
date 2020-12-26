<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */

?>
<style>
	.not-found {
		position: relative;
		margin-top: 71px;
		width: 100%;
		min-height: 600px;
		text-align: center;
	}
	.page-content {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
	}
	.no-results-drawing {
		width: 15vw;
		height: auto;
		margin-left: auto;
		margin-right: auto;
		display: block;
	}
	#no-results-span-message {
		font-size: 2.6vw;
		font-weight: 700;
		display: block;
		margin-top: 3vw;
	}
	#no-results-search-message {
		font-size: 1.5vw;
		display: block;
		margin-top: 0.5vw;
	}
	#no-results-button {
		margin-top: 3vw;
		display: block;
		padding: 20px 7px;
		background-color: #787878;
		border-radius: .5vw;
		color: white;
		text-decoration: none;
		transition: 0.3s;
	}
	#no-results-button:hover {
		background-color: white;
		color: black;
	}
	@media screen and (max-width: 1045px) {
		.no-results-drawing {width: 30vw;}
		#no-results-span-message {font-size: 4vw;margin-top: 5vw;white-space: nowrap;}
		#no-results-search-message {font-size: 2.3vw;margin-top: 1.5vw;}
		#no-results-button {margin-top: 5vw;}
	}
	@media screen and (max-width: 576px) {
		.no-results-drawing {width: 50vw;}
		#no-results-span-message {font-size: 7vw;margin-top: 8vw;width: 90vw;white-space: normal;}
		#no-results-search-message {font-size: 4vw;margin-top: 3vw;}
		#no-results-button {margin-top: 10vw;}
	}
</style>


<section class="no-results not-found">
	<div class="page-content">
		<img src="<?php echo get_template_directory_uri() . "/assets/no-results.png" ?>" class="no-results-drawing"></img>
		<span id="no-results-span-message"><?php esc_html_e( 'Hoppsan! Inga artiklar hittades!', 'science-mag' ); ?></span>
		<?php if ( is_home() ): ?>

			<span id="no-results-search-message"><?php esc_html_e( 'Inga artiklar på sidan? Kom tillbaka snart!', 'science-mag' ); ?></span>

		<?php elseif ( is_author() ): ?>
			<span id="no-results-search-message"><?php esc_html_e( 'Den här författaren har inte skrivit någonting än!', 'science-mag' ); ?></span>
		<?php else: ?>

			<span id="no-results-search-message"><?php esc_html_e( 'Du verkar ha gått vilse, vill du ta dig hem igen?', 'science-mag' ); ?></span>
			<a id="no-results-button" href="/">Ta mig hem</a>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
