<?php /* Template Name: Page display template */ ?>
<!DOCTYPE html>
<html lang="sv/SE">
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
  <style>
  body {
    background-color: black;
    font-family: 'Poppins',sans-serif;
  }
  @keyframes glitch {
    0% {transform: skewX(0deg);}
    5% {transform: skewX(30deg);}
    10% {transform: skewX(10deg);}
    15% {transform: skewX(120deg);}
    20% {transform: skewX(-230deg);}
    25% {transform: skewX(24deg);}
    30% {transform: skewX(53deg);}
    35% {transform: skewX(-60deg);}
    40% {transform: skewX(3deg);}
    45% {transform: skewX(-23deg);}
    50% {transform: skewX(10deg);}
    55% {transform: skewX(-36deg);}
    60% {transform: skewX(-29deg);}
    65% {transform: skewX(30deg);}
    70% {transform: skewX(2deg);}
    75% {transform: skewX(30deg);}
    80% {transform: skewX(-24deg);}
    85% {transform: skewX(23deg);}
    90% {transform: skewX(-40deg);}
    95% {transform: skewX(-30deg);}
    100% {transform: skewX(0deg);}
  }
  @keyframes noise {
    0% {background-position: -41px -57px}
    10% {background-position: 40px -23px}
    20% {background-position: -99px -42px}
    30% {background-position: -11px -38px}
    40% {background-position: -25px -43px}
    50% {background-position: -49px -60px}
    60% {background-position: -28px 69px}
    70% {background-position: -44px -6px}
    80% {background-position: 19px 67px}
    90% {background-position: 71px 21px}
    100% {background-position: -60px 6px}
  }
  @keyframes bar {
    0% {height:603px;top:99%;opacity:0.3;}
    10% {height:292px;top:60%;opacity:0.76;}
    20% {height:52px;top:10%;opacity:0.12;}
    30% {height:191px;top:35%;opacity:0.2;}
    40% {height:596px;top:47%;opacity:1;}
    50% {height:630px;top:73%;opacity:0.43;}
    60% {height:210px;top:95%;opacity:0.89;}
    70% {height:348px;top:87%;opacity:0.12;}
    80% {height:306px;top:39%;opacity:0.89;}
    90% {height:124px;top:9%;opacity:0.55;}
    100% {height:244px;top:93%;opacity:0.12;}
  }
  @keyframes hidenshow {
    0% {opacity: 0;}
    86% {opacity: 0;}
    100‰ {opacity: 1;}
  }
  .glitch__wrapper {
    animation: hidenshow 15s linear infinite;
    position: absolute;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 99999999;
  }
  .glitch {
    background-image: url('https://www.partikular.se/wp-content/uploads/2020/03/white-noise-1.png');
    overflow: hidden;
    text-align: center;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    animation: noise .3s infinite;
  }
  .glitch::before {
    content: '';
    display: inline-block;
    vertical-align: middle;
    height: 100%;
  }
  .glitch::after {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    background: url('https://www.partikular.se/wp-content/uploads/2020/03/white-noise-2.png');
    animation: bar .5s infinite;
  }
  .glitch img {
    animation: glitch 4s infinite alternate;
    position: fixed;
    top: calc(50vh - 80px);
    left: calc(50vw - 300px);
    height: 160px;
    z-index: 50;
  }
  .progr__container {
    position: fixed;
    bottom: 60px;
    left: 40px;
  }
  @keyframes progressing {
    0% {background-position: right;}
    100% {background-position: left;}
  }
  .progress__bar__with__balls {
    display: block;
    background: linear-gradient(90deg,white 50%, black 50.05%);
    background-size: 200%;
    height: 4px;
    width: 60vw;
    animation: progressing 90s linear infinite;
  }
  .progress__bar__with__balls ol {
    display: flex;
    justify-content: space-between;
    list-style-type: none;
    padding-left: 0;
  }
  .progress__bar__with__balls ol li {
    flex: 2;
    position: relative;
    overflow: visible;
  }
  .progress__bar__with__balls ol li:first-child, .progress__bar__with__balls ol li:last-child {
    flex: 1;
  }
  .progress__bar__with__balls ol li::before {
    content: '';
    display: block;
    width: 15px;
    height: 15px;
    background-color: black;
    border-radius: 50%;
    border: 4px solid white;
    position: absolute;
    left: calc(50% - 6px);
    bottom: -13px;
    z-index: 3;
  }
  .progress__bar__with__balls ol li:first-child::before {
    left: 0;
    background-color: white;
  }
  .progress__bar__with__balls ol li:last-child::before {
    right: 0;
    left: auto;
  }
  .progress__bar__with__balls ol #progress__is__active::before {
    background-color: white;
  }
  .partikular__banner__wrap {
    position: fixed;
    bottom: 27px;
    right: 40px;
    background: linear-gradient(-45deg,#019f87,#118586,#4e6e99,#803397,#833e9b,#704e97,#605d92,#4b7195,#257f93);
    color: white;
    border-radius: 32.5px;
  }
  .partikular__banner__wrap span {
    display: inline-block;
    vertical-align: middle;
    padding: 0 20px;
    font-size: 1.2em;
  }
  .banner__logo__wrap {
    background-color: white;
    display: inline-block;
    border-radius: 32.5px;
    vertical-align: middle;
    margin: 4px 0 4px 4px;
  }
  .banner__logo__wrap img {
    filter: invert(1);
    padding: 15px 35px 10px 35px;
    height: 40px;
  }
  .page__hero {
    display: grid;
    grid-template-columns: 50% 50%;
    height: 92vh;
    position: relative;
  }
  .left__side {
    position: relative;
  }
  .bigskewed {
    position: absolute;
    top: 20%;
    right: 0;
    transform: translate(55px,-20%);
    z-index: 1;
  }
  @keyframes showup {
    0% {transform: translate(-80px,30%);}
    15% {transform: translate(-80px,30%);}
    25% {transform: translate(-80px,-20%);}
    100% {transform: translate(-80px,-20%);}
  }
  #smallskewed {
    background-color: #F44500;
    filter: brightness(0.8);
    position: absolute;
    top: 20%;
    right: 0;
    transform: translate(-80px,-20%);
    z-index: 1;
    animation: showup 15s ease-out infinite;
  }
  #smallskewed h6 {
    font-weight: 700;
    color: black;
    opacity: 0.4;
    text-align: right;
    font-size: 2.1em;
    margin: 0;
    padding: 10px 30px 50px 30px;
  }
  .page__hero .left__side .hero__text {
    z-index: 5;
    position: absolute;
    right: 0;
    margin-right: 70px;
    margin-left: 20px;
    top: 55%;
    transform: translateY(-55%);
  }
  @-webkit-keyframes slide-top {
    0% {
      -webkit-transform: translateY(0);
              transform: translateY(0);
      opacity: 0;
    }
    100% {
      -webkit-transform: translateY(-100px);
              transform: translateY(-100px);
      opacity: 1;
    }
  }
  @keyframes slide-top {
    0% {transform: translateY(20px);opacity: 0;}
    15% {transform: translateY(0px);opacity: 1;}
    100% {transform: translateY(0px);opacity: 1;}
  }

  .page__hero .left__side .hero__text h1 {
    font-weight: 500;
    color: white;
    text-align: right;
    font-size: 4.6em;
    line-height: 1.25;
    margin: 0;
    margin-bottom: 20px;
	   -webkit-animation: slide-top 15s cubic-bezier(0.175, 0.885, 0.320, 1.275) infinite;
	  animation: slide-top 15s cubic-bezier(0.175, 0.885, 0.320, 1.275) infinite;
  }
  .page__hero .left__side .hero__text .dashed__line {
    background-image: linear-gradient(to right, white 33%, rgba(0,0,0,0) 0%);
    background-position: bottom;
    background-size: 40px 5px;
    background-repeat: repeat-x;
    height: 5px;
    width: 300px;
    margin-left: auto;
    margin-right: 0;
  }
  .page__hero .left__side .hero__text h3 {
    font-weight: 400;
    color: grey;
    text-align: right;
    font-size: 1.8em;
    line-height: 1.25;
  }
  .right__side {
    position: relative;
  }
  @keyframes slideleft {
    0% {transform: translateX(20%) scale(0.9) translateY(-50%);}
    10% {transform: translateX(0) scale(1) translateY(-50%);}
    100% {transform: translateX(0) scale(1) translateY(-50%);}
  }
  #image__ellipse {
    height: 700px;
    width: 591px;
    border-radius: 50%;
	background-color: #202020;
    position: absolute;
    top: 50%;
    left: 20px;
    z-index: 5;
    animation: slideleft 15s ease-in infinite;
  }
  #gradient__ring {
    height: 700px;
    width: 583px;
    border-radius: 50%;
    border: 30px solid #F44500;
    position: absolute;
    top: 50%;
    left: 28px;
    transform: translateY(-50%);
    z-index: 4;
    box-shadow: 0px 0px 150px 0px rgba(244,69,0,1), inset 0px 0px 150px 0px rgba(244,69,0,1);
    animation: slideleft 15s ease-out infinite;
  }
  .credits__wrapper {
    position: fixed;
    bottom: 120px;
    right: 40px;
    background: black;
    border: 3px solid white;
    border-radius: 32.5px;
    padding: 5px 30px;
    opacity: 0.4;
  }
  .credits__wrapper span {
    color: white;
  }
  #sciencemag_particles {
	position: fixed;
	top: 0;
	left: 0;
	z-index: 0;
	height: 100% !important;
	width: 100%;
  }
  #sciencemag_particles canvas {
	display: block;
	vertical-align: bottom;
	margin: 0;
	padding: 0;
	height: 100% !important;
	width: 100%;
	background-color: #000;
  }
  </style>
</head>
<body>
  <div class="glitch__wrapper">
    <div class="glitch">
    <img src="https://www.partikular.se/wp-content/uploads/2019/09/partikular-logo.png">
    </div>
  </div>
<div id="sciencemag_particles">
</div><!-- #sciencemag_particles -->
<div class="page-content">
  <div class="page__hero">
    <div class="left__side">
      <div id="smallskewed">
        <h6 id="d_category">Teknik</h6>
      </div>
      <svg class="bigskewed" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="891.265" height="643.645" viewBox="0 0 891.265 643.645">
        <defs>
          <filter id="a" x="0" y="0" width="891.265" height="643.645" filterUnits="userSpaceOnUse">
            <feOffset dy="-20" input="SourceAlpha"/>
            <feGaussianBlur stdDeviation="49.5" result="b"/>
            <feFlood id="svg_flood" flood-color="#f44500" flood-opacity="0.702"/>
            <feComposite operator="in" in2="b"/>
            <feComposite in="SourceGraphic"/>
          </filter>
        </defs>
        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#a)">
          <path id="svg_path" d="M0-50.245,594.265-23.094V262.224L0,296.4Z" transform="translate(220 218.75)" fill="#f44500"/>
        </g>
      </svg>
      <div class="hero__text">
        <h1 id="d_title">Uppsamling och användning av koldioxid kan bli en global industri</h1>
        <div class="dashed__line"></div>
        <h3>Publicerad <span id="d_pubdate">1 vecka sedan</span>av<br><span id="d_author">Josefine Byström</span></h3>
      </div>
    </div>
    <div class="right__side">
      <div id="image__ellipse"></div>
      <div id="gradient__ring"></div>
    </div>
  </div>
  <div class="progr__container">
    <div class="progress__bar__with__balls">
      <ol>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ol>
    </div>
  </div>
  <div class="credits__wrapper">
    <span>Made with ❤ by Karl Sellergren</span>
  </div>
  <div class="partikular__banner__wrap">
    <div class="banner__logo__wrap">
      <img src="https://www.partikular.se/wp-content/uploads/2019/09/partikular-logo.png">
    </div>
    <span>Läs artiklarna på partikular.se.</span>
  </div>
</div>



<script type="text/javascript">
  var titles = [];
  var authors = [];
  var pubdate = []
  var colors = []
  var imgurl = []
  var categories = []
  var looped = 0

<?php
  $the_query = new WP_Query( array('posts_per_page' => 6 ) );
  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
  $categorycolour = '';
  foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);}?>
        titles.push("<?php the_title();?>");
		authors.push("<?php the_author();?>");
		pubdate.push("<?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' sedan '; ?>");
		colors.push("<?php echo $categorycolour;?>");
		imgurl.push("<?php echo get_the_post_thumbnail_url(get_the_ID(),'full');?>");
		categories.push("<?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?>");
<?php    endwhile; 
endif;
wp_reset_postdata();
?>
  
  function changer(current) {
    if (current < titles.length) {
      document.getElementById('d_title').innerHTML = titles[current];
      document.getElementById('d_author').innerHTML = authors[current];
      document.getElementById('d_pubdate').innerHTML = pubdate[current];
      document.getElementById('d_category').innerHTML = categories[current];
      var frame = document.getElementById('image__ellipse');
      frame.style.background = "url(\'" + imgurl[current] + "\')";
      frame.style.backgroundRepeat = "no-repeat";
      frame.style.backgroundSize = "cover";
      frame.style.backgroundPosition = "center";
      var ring = document.getElementById('gradient__ring');
      ring.style.borderColor = colors[current];
      ring.style.boxShadow = "0px 0px 150px 0px " + colors[current] + ", inset 0px 0px 150px 0px " + colors[current];
      document.getElementById('smallskewed').style.backgroundColor = colors[current];
      document.getElementById('svg_flood').setAttribute("flood-color", colors[current]);
      document.getElementById('svg_path').setAttribute("fill", colors[current]);
      var stopp = setTimeout(function() {
        changer(current + 1)
        var added = current + 2;
        var str = added.toString();
        document.querySelector('.progress__bar__with__balls ol li:nth-child(' + str + ')').id = "progress__is__active";
      }, 15000);
    } else {
      looped = looped + 1;
      if (looped == 10) {
        location.reload();
      }
      changer(0)
      var all = document.querySelectorAll('.progress__bar__with__balls ol li');
      all.forEach(function(ball) {
        ball.removeAttribute("id");
      });
    }
  }
  changer(0)
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/particles.js';?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/app.js';?>"></script>
</body>
</html>
