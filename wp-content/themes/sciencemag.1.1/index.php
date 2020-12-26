<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */

get_header();
?>
  <div id="sciencemag_particles">
  </div><!-- #sciencemag_particles -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			$postindexnum = 0;
			while ( have_posts() ) :
				the_post();
        /* Get the featured image of the post */
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        /* Assign $categorycolor a HEX code related to the category of the post */
        $categorycolour = '';
        foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);}
        /* Convert $categorycolor to a RGB value for the RGBA shadow */
        list($r, $g, $b) = sscanf($categorycolour, "#%02x%02x%02x");
        $rgb_categorycolour =  $r . "," . $g . "," . $b;

        /* If it's the first post, display it as a hero. Otherwise, use templates */
				if ( $postindexnum == 0 ) : ?>
          <article>
				  <div class="sciencemag__hero__wrapper">
						<div class="hero__text">
							<div class="sciencemag__wrapper__title">
				      <h4 style="color:<?php echo $categorycolour; ?>;">
                <?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?>
              </h4>
					    <h2><?php the_title(); ?></h2>
							<a href="<?php the_permalink(); ?>">Läs artikel</a>
							<h6><?php echo 'publicerad ' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' sedan'; ?></h6>
              </div><!-- .sciencemag__wrapper__title -->
						</div>
					  <a href="<?php the_permalink(); ?>">
					  <div class="sciencemag__post__planet" style="border-color:<?php echo $categorycolour; ?>;
            -webkit-box-shadow: -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.9), inset -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.6);;
            -moz-box-shadow: -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.9), inset -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.6);;
            box-shadow: -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.9), inset -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.6);">
              <svg viewBox="0 0 400 400">
          	    <path id="curve" fill="transparent" d="M 0 200 A 50 50 0 1 1 400 200 A 50 50 0 1 1 0 200"></path>
          	    <text width="100%" style="transform:translate3d(0,0,0);">
          	        <textPath style="transform:translate3d(0,0,0);" alignment-baseline="top" xlink:href="#curve">klicka för att läsa</textPath>
          	    </text>
          	  </svg>
					  	<div class="sciencemag__post__feat__image">
                <?php if (has_post_thumbnail( $post->ID ) ):
          				the_post_thumbnail( 'large' );
          			endif; ?>
							</div><!-- .sciencemag__post__feat__image -->
					  </div>
				    </a>
						<a class="sciencemag__wrapper__scroller">↓ utforska fler artiklar</a>
            <script>window.onscroll = function() {document.querySelector('.sciencemag__wrapper__scroller').style.opacity = "0";}</script>
				  </div><!-- .sciencemag__hero__wrapper -->
          </article>
				<?php
				elseif ($postindexnum%2 == 0 && $postindexnum <= 4):
					get_template_part( 'template-parts/content-right-aligned', get_post_type() );
				elseif (! $postindexnum%2 == 0  && $postindexnum <= 4):
					get_template_part( 'template-parts/content-left-aligned', get_post_type() );
				endif;
				$postindexnum = $postindexnum + 1;
			endwhile;


		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
    if (  $wp_query->max_num_pages > 1 ) :
      echo '<a class="sciencemag__ajax__loadmore loadmore__designtwo">+ Ladda fler</a>';
    endif;
    get_template_part( 'template-parts/prefooter', 'none' );
		?>
	</main><!-- #main -->
  </div><!-- #primary -->
<?php
get_sidebar();
get_footer();
