<?php
/**
* The Sciencemag Category Page
*/

get_header();
?>
<style>
.sciencemag__category__header {
  z-index: 5;
  position: relative;
  top: 71px;
  margin-bottom: 18vw;
}
.sciencemag__category__header h1 {
  font-weight: 900;
  margin-top: 8vw;
  margin-bottom: 1vw;
  font-size: 10vw;
  text-align: center;
}
.sciencemag__category__header p {
  text-align: center;
  margin-bottom: 1vw;
  line-height: 1.5;
  width: 90vw;
  margin-left: 5vw;
  color: white;
}
#scroll__down {
  opacity: 0.4;
}
.category__noposts {
  z-index: 5;
  position: relative;
  text-align: center;
  font-weight: 400;
  width: 80vw;
  margin-left: 10vw;
  margin-top: 28vw;
}
@media screen and (min-width: 1045px) {
  .sciencemag__category__header {
    margin-bottom: 7vw;
  }
  .sciencemag__category__header h1 {
    margin-top: 4vw;
    margin-bottom: 1vw;
    font-size: 4vw;
  }
  .sciencemag__category__header p {
    width: 50vw;
    margin-left: 25vw;
  }
  #sciencemag_particles {
    height: 142vw;
  }
  .category__noposts {
    width: 100%;
    margin-top: 5vw;
    margin-left: 0;
  }
}
@media screen and (max-width: 1045px) and (min-width: 576px) {
  .category__noposts {
    margin-top: 5vw;
    font-size: 3vw;
  }
}
</style>
<div id="sciencemag_particles">
</div><!-- #sciencemag_particles -->
<div id="primary" class="site-content">
<div id="main" role="main">
  <div class="sciencemag__category__header">
    <h1><?php single_cat_title( '', true ); ?></h1>
    <?php if ( category_description() ) : ?>
    <p class="archive-meta"><?php echo category_description(); ?></p>
    <?php endif;
    if (have_posts()): ?>
    <p id="scroll__down">Läs senaste artiklarna nedan ↓</p>
    <?php endif; ?>
  </div>
<?php
// Check if there are any posts to display
if ( have_posts() ) :
// The Loop
$postindexnum = 1;
while ( have_posts() ) : the_post();
  if ($postindexnum%2 == 0 && $postindexnum <= 5):
    get_template_part( 'template-parts/content-right-aligned', get_post_type() );
  elseif (! $postindexnum%2 == 0  && $postindexnum <= 5):
    get_template_part( 'template-parts/content-left-aligned', get_post_type() );
  endif;
  $postindexnum = $postindexnum + 1;
endwhile;

else:
  get_template_part( 'template-parts/content', 'none' );
endif;
if (  $wp_query->max_num_pages > 1 ) :
  echo '<a class="sciencemag__ajax__loadmore loadmore__designtwo">+ Ladda fler</a>';
endif;
get_template_part( 'template-parts/prefooter', 'none' );
?>
</div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
