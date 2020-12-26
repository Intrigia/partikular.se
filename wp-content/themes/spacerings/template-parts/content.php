<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */

?>
<?php
$categoriesarray = get_the_category();
$onlycategory = $categoriesarray[0]->name;
// Get the ID of a given category
$category_id = get_cat_ID($onlycategory);
// Get the URL of this category
$category_link = get_category_link( $category_id );
//Get Category colour
$categorycolour = '';
foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);}
/* Convert $categorycolor to a RGB value for the RGBA shadow */
list($r, $g, $b) = sscanf($categorycolour, "#%02x%02x%02x");
$rgb_categorycolour =  $r . "," . $g . "," . $b;
/* Get the author id to display photo and get url */
$author_id = get_the_author_meta('id')
?>
<style>
.sciencemag__post__content .entry-content a {
  background-image: linear-gradient(120deg, <?php echo $categorycolour; ?> 0%, rgba(<?php echo $rgb_categorycolour; ?>,0.5) 100%);
  color: black;
  background-repeat: no-repeat;
  background-size: 100% 0.2em;
  background-position: 0 88%;
  transition: background-size 0.25s ease-in;
}
.sciencemag__post__content__dark .entry-content a {
	color: white;
}
.sciencemag__post__content .entry-content a:hover {
    background-size: 100% 88%;
}
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="sciencemag__post__hero">
		<div class="hero__image__wrapper">
			<div class="hero__image">
				<?php if (has_post_thumbnail( $post->ID ) ):
					the_post_thumbnail( 'medium' );
				endif; ?>
			</div>
		</div>
		<div class="hero__text__wrapper">
			<div class="post__hero__text">
		    <h4 style="color:<?php echo $categorycolour; ?>;"><?php echo $onlycategory; ?></h4>
		    <?php
		    if ( is_singular() ) :
		    	the_title( '<h1 class="entry-title">', '</h1>' );
    		else :
		    	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    		endif;
    		?>
    		<h5><?php echo 'publicerad ' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' sedan av'; ?></h5>
	    	<a href="<?php echo get_author_posts_url($author_id) ?>">
	    	<div class="hero__author">
	    		<div class="author__image" style="background-image: url('<?php echo get_avatar_url($author_id) ?>');"></div>
	    		<h6><?php the_author(); ?></h6>
	    	</div>
	    	</a>
	    </div>
			<div class="post__hero__magicring" style="border-color:<?php echo $categorycolour; ?>;
			-webkit-box-shadow: 0 0 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.5), inset 0 0 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.3);;
			-moz-box-shadow: 0 0 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.5), inset 0 0 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.3);;
			box-shadow: 0 0 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.5), inset 0 0 100px 0px rgba(<?php echo $rgb_categorycolour; ?>,0.3);"></div>
		</div>
	</div>

	<div class="sciencemag__post__content">
		<div class="share__wrapper">
			<div class="share__buttons">
				<a rel="noreferrer nofollow noopener" data-shared="sharing-facebook-17" href="<?php echo get_permalink() . "?share=facebook&nb=1";?>" target="_blank" title="Klicka för att dela artikeln på Facebook"><div class="button__share share__facebook"><img src="<?php echo get_template_directory_uri() . "/assets/facebook.svg" ?>"/></div></a>
				<a rel="noreferrer nofollow noopener" data-shared="sharing-twitter-17" href="<?php echo get_permalink() . "?share=twitter&nb=1";?>" target="_blank" title="Klicka för att dela artikeln på Twitter"><div class="button__share share__twitter"><img src="<?php echo get_template_directory_uri() . "/assets/twitter.svg" ?>"/></div></a>
				<a rel="noreferrer nofollow noopener" data-shared href="<?php echo get_permalink() . "?share=jetpack-whatsapp&nb=1";?>" target="_blank" title="Klicka för att dela artikeln på Whatsapp"><div class="button__share share__facebook"><img src="<?php echo get_template_directory_uri() . "/assets/whatsapp.svg" ?>"/></div></a>
				<a rel="noreferrer nofollow noopener" data-shared href="<?php echo get_permalink() . "?share=reddit&nb=1";?>" target="_blank" title="Klicka för att dela artikeln på Reddit"><div class="button__share share__facebook"><img src="<?php echo get_template_directory_uri() . "/assets/reddit.svg" ?>"/></div></a>
				<a onclick="window.print();return false;" value="" title="Skriv ut artikeln"><div class="button__share share__print"><img src="<?php echo get_template_directory_uri() . "/assets/print.svg" ?>"/></div></a>
				<a onclick="darkmode()" title="Sätt på mörkt läge"><div class="button__share mobile__dark__btn"><img src="<?php echo get_template_directory_uri() . "/assets/lightbulb.svg" ?>" style="height: 6.5vw;"/></div></a>
			</div>
		</div>
		<div class="darkmode__wrapper">
			<div class="right__side__buttons">
				<div class="darkmode__button" onclick="darkmode()">
				<img src="<?php echo get_template_directory_uri() . "/assets/lightbulb.svg" ?>"/>
			  </div>
				<!--
				<div class="darkmode__button views__counter">
					<span><?php echo do_shortcode( '[views]' ); ?></span>
				</div>
				-->
			</div>
		</div>
	  <div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'science-mag' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>
	  </div><!-- .entry-content -->
		<?php echo $categories[0]->name; ?>
		<div class="sciencemag__post__pagination">
			<?php wp_link_pages( array(
			'before'           => '',
			'after'            => '',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'next_or_number'   => 'next',
			'separator'        => '',
			'nextpagelink'     => __( 'kommande sida →', 'sciencemag'),
			'previouspagelink' => __( '← föregående sida', 'sciencmag' ),
			'pagelink'         => '%',
			'echo'             => 1
		)); ?>
		</div>
		<footer class="entry-footer">
			<div class="sciencemag__post__about">
				<div class="about__author">
					<div class="author__bigimage" style="background-image: url('<?php echo get_avatar_url($author_id, ['size' => '350']); ?>');"></div>
					<div class="about__author__text">
						<h3><?php the_author(); ?></h3>
						<p>Favoritkategori:<br/><?php echo get_the_author_meta('favorite'); ?></p>
						<a href="<?php echo get_author_posts_url($author_id) ?>">Läs mer</a>
					</div>
				</div>
				<a href="<?php echo $category_link; ?>">
				<div class="about__postabout" style="background-color:<?php echo $categorycolour; ?>;">
					<span>Läs fler artiklar om<br><?php echo $onlycategory; ?></span>
				</div>
				</a>
			</div>
		</footer><!-- .entry-footer -->
  </div><!-- .sciencemag__post__content -->
</article><!-- #post-<?php the_ID(); ?> -->
