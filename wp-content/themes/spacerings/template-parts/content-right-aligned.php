<?php
/**
 * Template part for displaying posts right aligned on the home page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */

?>
<?php
/* Get the featured image of the post */
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
/* Assign $categorycolor a HEX code related to the category of the post */
$categorycolour = '';
foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);}
/* Convert $categorycolor to a RGB value for the RGBA shadow */
list($r, $g, $b) = sscanf($categorycolour, "#%02x%02x%02x");
$rgb_categorycolour =  $r . "," . $g . "," . $b;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="sciencemag__extraposts__wrapper extraposts__wrapper__rightaligned">
    <div class="extraposts__text"><!--USED FOR RESPONSIVE LAYPUT-->
      <div class="sciencemag__wrapper__title extraposts__title extraposts__title__rightaligned">
        <div class="extraposts__headercontainer">
          <h4 style="color:<?php echo $categorycolour; ?>;"><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?></h4>
        </div>
        <a href="<?php the_permalink(); ?>">
          <h2><?php the_title(); ?></h2>
          <?php the_excerpt(); ?>
        </a>
        <div class="bottom_row_wrapper">
          <span class="post_reading_time"><?php echo reading_time(); ?></span>
          <?php
								$attachments = get_children(
									array(
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'post_parent' => $post->ID
									));
								if(count($attachments) > 2) { ?>
									<span class="post_has_images">Innehåller bilder</span>
					<?php } ?>
        </div>
      </div><!-- .sciencemag__extraposts__title -->
    </div>
    <a href="<?php the_permalink(); ?>">
    <div class="sciencemag__post__planet extraposts__planet planet__rightaligned" style="border-color:<?php echo $categorycolour; ?>;
    -webkit-box-shadow: -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.9), inset -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.6);;
    -moz-box-shadow: -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.9), inset -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.6);;
    box-shadow: -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.9), inset -20px 20px 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.6);">
      <svg viewBox="0 0 400 400">
        <path id="curve" fill="transparent" d="M 0 200 A 50 50 0 1 1 400 200 A 50 50 0 1 1 0 200"></path>
        <text width="100%" style="transform:translate3d(0,0,0);">
            <textPath style="transform:translate3d(0,0,0);" alignment-baseline="top" xlink:href="#curve">klicka för att läsa</textPath>
        </text>
      </svg>
      <div class="sciencemag__post__feat__image extraposts__feat__image">
        <?php if (has_post_thumbnail( $post->ID ) ):
          the_post_thumbnail( 'large' );
        endif; ?>
      </div><!-- .sciencemag__post__feat__image -->
    </div>
    </a>
  </div><!-- .sciencemag__extraposts__wrapper -->
</article>
