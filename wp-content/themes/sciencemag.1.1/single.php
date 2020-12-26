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
<script>
window.onscroll = function Scrollindicator() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.querySelector(".sciencemag__navbar__gradient").style.width = scrolled + "%";
}
function ToCategory(categoryname) {
  location.assign('http://www.vetenskapstidningen.local/category' + categoryname);
}
</script>
<?php
while ( have_posts() ) :
  the_post();
/* Assign $categorycolor a HEX code related to the category of the post */
$categorycolour = '';
foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);}
?>
<style>
.sciencemag__navbar__gradient {
  background: <?php echo $categorycolour; ?>;
	height: 4px;
	width: 0%;
}
.site-footer {
  margin-top: 0;
}
.wp-block-group {
  border-color: <?php echo $categorycolour; ?>;
}
.wp-block-group h2, .wp-block-group h3, .wp-block-group h4, .wp-block-group h5, .wp-block-group h6 {
  color: <?php echo $categorycolour; ?>;
}
</style>
<div id="sciencemag_particles">
</div><!-- #sciencemag_particles -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
    <?php

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
  <script>
  //1 = SVART, 0 = NORMAL
  if (localStorage.getItem('svart') != '1') {
    localStorage.setItem('svart', '1');
  } else {
    localStorage.removeItem('svart');
  }
  function darkmode() {
    if (localStorage.getItem('svart') != '1') {
      document.querySelector(".sciencemag__post__content").classList.add("sciencemag__post__content__dark");
      document.querySelector(".share__buttons").classList.add("buttons__dark");
      document.querySelector(".darkmode__button").classList.add("buttons__dark");
      document.querySelector(".sciencemag__post__about").classList.add("sciencemag__post__about__dark");
      Array.from(document.getElementsByClassName("wp-block-table")).forEach(c => {c.classList.add("wp-block-table-dark")});
	  Array.from(document.getElementsByClassName("wp-block-group")).forEach(c => {c.classList.add("wp-block-group-dark")});
	  Array.from(document.getElementsByClassName("wp-citation-start")).forEach(c => {c.classList.add("wp-citation-start-dark")});
	  Array.from(document.getElementsByClassName("sciencemag-citation-block")).forEach(c => {c.classList.add("sciencemag-citation-block-dark")});
      localStorage.setItem('svart', '1');
    } else {
      document.querySelector(".sciencemag__post__content").classList.remove("sciencemag__post__content__dark");
      document.querySelector(".share__buttons").classList.remove("buttons__dark");
      document.querySelector(".darkmode__button").classList.remove("buttons__dark");
      document.querySelector(".sciencemag__post__about").classList.remove("sciencemag__post__about__dark");
      Array.from(document.getElementsByClassName("wp-block-table")).forEach(c => {c.classList.remove("wp-block-table-dark")});
	  Array.from(document.getElementsByClassName("wp-block-group")).forEach(c => {c.classList.remove("wp-block-group-dark")});
	  Array.from(document.getElementsByClassName("wp-citation-start")).forEach(c => {c.classList.remove("wp-citation-start-dark")});
	  Array.from(document.getElementsByClassName("sciencemag-citation-block")).forEach(c => {c.classList.remove("sciencemag-citation-block-dark")});
      localStorage.removeItem('svart');
    }
  }
  darkmode();
  document.querySelector(".hero__image img").sizes = "(min-width: 768px) 40vw, (min-width: 768px) and (max-width: 1045px)    100vw, 80vw";
  document.querySelector(".sharedaddy").style.display = "none";
  </script>
<?php
get_sidebar();
get_footer();
