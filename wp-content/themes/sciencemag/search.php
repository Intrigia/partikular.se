<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Science_Mag
 */

get_header();
?>
  <style>
	.page-header {
		margin-top: calc(70px + 4vw);
		margin-bottom: 4vw;
		margin-left: 3vw;
		margin-right: 3vw;
	}
	.page-header h3 {
		position: relative;
		font-weight: 400;
		font-size: 2vw;
		margin: 0;
	}
	.page-header h1 {
		position: relative;
		font-size: 5.5vw;
		margin: 0;
		margin-bottom: 1vw;
		width: 94vw;
		text-overflow: ellipsis;
		overflow: hidden;
		line-height: 1.25;
	}
	.page-header h6 {
		position: relative;
		font-size: 1.5vw;
		color: #B5B4B4;
		margin: 0;
		font-weight: 400;
	}
	.searchresults__wrapper {
		margin: 0 1.75vw;
		margin-bottom: 8vw;
	}
	.content-area {
		min-height: 60vh !important;
	}
	@media all and (max-width: 770px) {
		.page-header {
			margin-top: calc(70px + 7vw);
			margin-bottom: 7vw;
		}
		.page-header h3 {font-size: 20px;}
		.page-header h1 {font-size: 55px;}
		.page-header h6 {font-size: 15px;}
	}
	</style>
  <div id="sciencemag_particles">
  </div><!-- #sciencemag_particles -->
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<header class="page-header">
				<h3>Sökresultat för</h3>
				<?php
					/* translators: %s: search query. */
					printf( '<h1>' . get_search_query() . '_' . '</h1>' );

		if ( have_posts() ) :
			global $wp_query;
			echo '<h6>Sökningen gav ' . $wp_query->found_posts.' resultat.<h6>';
			echo '</header><!-- .page-header -->';
			echo '<div class="searchresults__wrapper">';
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/shortpost', 'search' );

			endwhile;
			if (  $wp_query->max_num_pages > 1 ) :
		    echo '<a class="sciencemag__ajax__loadmore">Ladda fler</a>'; // you can use <a> as well
			echo '</div>';
		  endif;

		else :

			echo "<h6>Sökningen gav inga resultat.</h6>";
			echo '</header><!-- .page-header -->';

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
