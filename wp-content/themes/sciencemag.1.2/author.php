<?php
/**
 * The template for displaying a custom author profile page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */

get_header();
?>
<div id="sciencemag_particles">
</div><!-- #sciencemag_particles -->
<?php
// Set the Current Author Variable $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$users = get_users();
$authorid_array = [];
foreach ( $users as $user ) {
  $userid = strval($user->ID);
  array_push($authorid_array, $userid );
}

$curauth_index = array_search( strval($curauth->ID), $authorid_array);
$prev_id = $authorid_array[$curauth_index - 1];
$next_id = $authorid_array[$curauth_index + 1];
$prev_url = get_author_posts_url( intval($prev_id) );
$next_url = get_author_posts_url( intval($next_id) );
if ($prev_id == null) {
  $prev_url = get_author_posts_url( intval(end($authorid_array)) );
}
if ($next_id == null) {
  $next_url = get_author_posts_url( intval($authorid_array[0]) );
}
?>
<div class="sciencemag__author__profileimages">
  <div class="profileimage__wrap">
    <a href="<?php echo $prev_url; ?>" onclick="left()">〈</a>
    <div class="authorimage__ring" id="anim__ring">
      <div class="authorimage__image">
				<?php echo get_avatar( $curauth->user_email , '350 '); ?>
			</div>
    </div>
    <a href="<?php echo $next_url; ?>" onclick="right()">〉</a>
  </div>
  <script>
    function left() {
      document.getElementById("anim__ring").style.transform = "translateX(300px)"
      document.querySelector(".profileimage__wrap a").style.opacity = "0";
    }
    function right() {
      document.getElementById("anim__ring").style.transform = "translateX(-300px)"
      document.querySelector(".profileimage__wrap a").style.opacity = "0";
    }
  </script>
</div>
<div class="sciencemag__author__info">
  <div class="author__profileinfo">
    <h1><?php echo $curauth->display_name; ?></h1>
    <p><?php echo $curauth->user_description; ?></p>
  </div>
</div>
<div class="authorprofile__scroller__wrap">
  <a href="#author__unique__posts" name="author__unique__posts" id="author__unique__posts">
  <div class="authorprofile__scroller">
    <span>↓ läs <?php echo $curauth->first_name; ?>s artiklar</span>
  </div>
  </a>
</div>
<div class="sciencmag__author__posts">
<?php
if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/shortpost', get_post_type() );
  endwhile;

  global $wp_query; // you can remove this line if everything works for you

  // don't display the button if there are not enough posts
  if (  $wp_query->max_num_pages > 1 ) :
    echo '<a class="sciencemag__ajax__loadmore">Ladda fler</a>'; // you can use <a> as well
  endif;

else:
  get_template_part( 'template-parts/content', 'none' );

endif;?>
</div>
<?php get_footer();?>
