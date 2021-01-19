<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Science_Mag
 */

get_header();
?>
<?php
while ( have_posts() ) :
  the_post();
/* Assign $categorycolor a HEX code related to the category of the post */
$categorycolour = '';
foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);}
?>
<style>
.sciencemag__navbar__gradient {background: <?php echo $categorycolour; ?>;height: 4px;width: 0%;}.site-footer {margin-top: 0;}
.wp-block-group {border: 2px solid <?php echo $categorycolour; ?>;}
.wp-block-group h2, .wp-block-group h3, .wp-block-group h4, .wp-block-group h5, .wp-block-group h6 {color: <?php echo $categorycolour; ?>;}
</style>
<div id="sciencemag_particles"></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    <?php get_template_part( 'template-parts/content', get_post_type() );
endwhile; // End of the loop.?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
