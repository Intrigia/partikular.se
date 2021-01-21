<?php
/**
 * The template for displaying all pages
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
  <style>
  .site-footer {
    margin-top: 0;
  }
  #sciencemag_particles {
    z-index: 5;
  }
  #sciencemag_particles canvas {
    background-color: transparent;
  }
  .hero__back__layer {
    z-index: 4;
    height: 100%;
    width: 100%;
    position: relative;
  }
  .sciencemag__page__thumbnail {
    height: 60vh;
    width: 55vw;
    position: absolute;
    left: 50%;
    top: 50% !important;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    top: 0;
    z-index: 5;
  }
  .sciencemag__page__thumbnail img {
    height: 60vh;
    min-height: 280px;
    max-width: 55vw;
    min-width: 435px;
    object-fit: cover;
    filter: brightness(0.6);
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
	.sciencemag__page__hero {
		position: relative;
		margin-top: 70px;
		width: 100%;
		height: calc(100vh - 70px);
    min-height: 400px;
    overflow: hidden;
	}
	.hero__front__layer {
		position: absolute;
		width: 100%;
    height: 100%;
		margin: 0;
    z-index: 6;
	}
  .front__layer__wrapper {
    position: relative;
    top: 50%;
    width: 80vw;
    margin-left: 10vw;
    transform: translateY(-50%);
  }
  .hero__front__layer h1 {
    font-weight: 900;
		font-size: calc(4vw + 25px);
    margin: 0;
    text-align: center;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
  }
  .hero__front__layer hr {
    background-color: white;
    position: relative;
    width: 7vw;
    border: calc(0.15vw + 2px) solid white;
    margin-left: 36.5vw;
    margin-top: 2vw;
  }
  @media all and (max-width: 768px) {
    .sciencemag__page__thumbnail img {
      min-height: 0;
      min-width: 0;
    }
    .hero__front__layer h1 {
  		font-size: calc(6vw + 25px);
    }
  }



  .page__content__wrapper {
    width: 100%;
    background-color: #eee;
    position: relative;
  }
	.single-page-content {
		color: #000;
		font-family: 'Lato', helvetica;
    line-height: 1.7;
		max-width: 70vw;
		padding-left: 15vw;
		padding-top: 5vw;
		padding-bottom: 5vw;
    overflow: hidden;
    position: relative;
	}
  .entry-content a {
    font-weight: 900;
    color: #787878;
    text-decoration-color: #019F87;
    transition: 0.3s;
  }
  .entry-content a:hover {
    color: #118586;
  }
  .single-page-content button {
    border-radius: 100%;
    border-width: 0;
    background-color: #257F93;
    color: white;
    padding: 13px 5px;
  }
  .single-page-content hr {
    height: 2.5px;
    background-color: #7e7e7e;
    border-width: 0;
  }
  .single-page-content h2 {
    font-size: 1.7em;
  }
  .single-page-content h2, .single-page-content h3, .single-page-content h4, .single-page-content h5, .single-page-content h6 {
    margin-bottom: 0;
  }
  .single-page-content p {
    font-size: 17px;
  }
	@media all and (max-width: 576px) {
		.single-page-content {
			max-width: 90vw;
			margin-left: 5vw;
			font-size: 4vw;
		}
	}

  /********FORM DESIGN*********/
  .contact-form .grunion-field-wrap {
    position: relative;
  }
  .contact-form .grunion-field-wrap label {
    position: relative;
    font-size: 13.5px;
    margin-left: 10px;
    margin-bottom: -12px;
    z-index: 10;
    background-color: white;
    display: table;
  }
  .contact-form .grunion-field-wrap input[type="text"], .contact-form .grunion-field-wrap input[type="email"],
  .contact-form .grunion-field-wrap input[type="url"], .contact-form .grunion-field-wrap input[type="tel"],
  .contact-form .grunion-field-wrap textarea {
    position: relative;
    width: 100%;
    border: 3px solid black;
    border-image-source: linear-gradient(45deg, #019F87, #4E6E99);
    border-image-slice: 1;
    padding: 13px 20px 13px 20px;
    background-color: white;
    transition: 0.5s;
  }
  .contact-form .grunion-field-wrap input[type="checkbox"] {
    background: linear-gradient(45deg, #019F87, #4E6E99);
  }
  .contact-form .grunion-field-wrap input[type="text"]:focus, .contact-form .grunion-field-wrap input[type="email"]:focus,
  .contact-form .grunion-field-wrap input[type="url"]:focus, .contact-form .grunion-field-wrap input[type="tel"]:focus,
  .contact-form .grunion-field-wrap textarea:focus {
    border-image-source: linear-gradient(45deg, #4E6E99, #019F87);
    outline: none;
  }
  .contact-form .contact-submit button {
    width: 100%;
    background: linear-gradient(45deg, #019F87, #4E6E99);
    padding: 15px 0;
    border: 3px solid #6285b3;
    -webkit-box-shadow: 0px 7px 0px 0px rgba(15,107,92,1);
    -moz-box-shadow: 0px 7px 0px 0px rgba(15,107,92,1);
    box-shadow: 0px 7px 0px 0px rgba(15,107,92,1);
    color: white;
  }
  .contact-form .contact-submit button:hover {
    -webkit-box-shadow: 0px 2px 0px 0px rgba(15,107,92,1);
    -moz-box-shadow: 0px 2px 0px 0px rgba(15,107,92,1);
    box-shadow: 0px 2px 0px 0px rgba(15,107,92,1);
    margin-top: 5px;
    margin-bottom: -5px;
  }
	</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
		<div id="sciencemag_particles"></div>
		<div class="sciencemag__page__hero">
      <div data-depth="0.2" class="hero__back__layer">
        <div class="sciencemag__page__thumbnail"><?php if (has_post_thumbnail( $post->ID ) ):
					the_post_thumbnail( 'medium-large' );
				endif; ?></div>
      </div>
      <div data-depth="0.6" class="hero__front__layer">
        <div class="front__layer__wrapper">
          <h1><?php the_title(); ?></h1>
          <hr/>
        </div>
      </div>
		</div>
    <div class="sciencemag__post__content">
  		<div class="darkmode__wrapper">
  			<div class="darkmode__button" onclick="darkmode()">
  			<img src="<?php echo get_template_directory_uri() . "/icons/lightbulb.svg" ?>"/>
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
    </div><!-- .sciencemag__post__content -->

		<?php endwhile; // End of the loop.
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
      document.querySelector(".darkmode__button").classList.add("buttons__dark");
      ntableelements = document.getElementsByClassName("wp-block-table");
      if (ntableelements.length > 0) {document.querySelector(".wp-block-table").classList.add("wp-block-table-dark");}
      localStorage.setItem('svart', '1');
    } else {
      document.querySelector(".sciencemag__post__content").classList.remove("sciencemag__post__content__dark");
      document.querySelector(".darkmode__button").classList.remove("buttons__dark");
      ntableelements = document.getElementsByClassName("wp-block-table");
      if (ntableelements.length > 0) {document.querySelector(".wp-block-table").classList.remove("wp-block-table-dark");}
      localStorage.removeItem('svart');
    }
  }
  darkmode();

  var scene = document.querySelector('.sciencemag__page__hero');
  var parallaxInstance = new Parallax(scene);
  </script>
  <script>document.querySelector(".sciencemag__page__thumbnail img").sizes = "55vw";</script>
<?php
get_sidebar();
get_footer();
