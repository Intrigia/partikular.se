<?php
/**
 * Template part for post excerpts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */
?>
<?php
$categoriesarray = get_the_category();
$onlycategory = $categoriesarray[0]->name;
//Get Category colour
$categorycolour = '';
foreach ((get_the_category()) as $category) {$categorycolour = ColorfulCategories::getColorForTerm($category->term_id);} ?>
<style>
.authorpost__outerwrapper {
  position: relative;
  margin-top: 2vw;
}
.authorpost__category {
  display: block;
  position: absolute;
  top: 0;
  left: 2vw;
  z-index: 800;
  border-radius: 20px;
}
.authorpost__category h4 {
  color: black;
  font-weight: 400;
  opacity: 0.7;
  margin: 0;
  padding: 7px 12px;
}
.authorpost__wrapper {
  background-color: #141414;
  position: relative;
  top: 1vw;
  border-radius: 5px;
  display: grid;
  grid-template-columns: 88% 12%;
}
.authorpost__info {
  padding: 30px 23px;
  padding-right: 0;
}
.authorpost__info a {
  text-decoration: none;
  color: inherit;
}
.authorpost__info h2 {
  font-weight: 400;
  font-size: 2.2vw;
  margin: 0;
  width: 81vw;
  height: 2.6vw;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.authorpost__info p {
  margin: 0;
  padding: 0;
  color: #3B3A3A;
  margin-top: 0.5vw;
  font-size: 1.1vw;
  height: 2.4vw;
  width: 81vw;
  overflow: hidden;
}
.authorpost__link {
  margin: 30px 23px;
  margin-left: 0;
}
.authorpost__link a {
  width: 100%;
  height: 100%;
  background-color: white;
  display: block;
  color: black;
  text-decoration: none;
  border-radius: 5px;
  font-size: 1.3vw;
  line-height: 4.27;
  text-align: center;
  transition: 0.3s;
}
.authorpost__link a:hover {
  background-color: #DDDDDD;
}
@media all and (max-width: 985px) {
  .authorpost__outerwrapper {
    margin-top: 3.5vw;
  }
  .authorpost__wrapper {
    grid-template-columns: 85% 15%;
  }
  .authorpost__info h2 {
    font-size: 3vw;
    width: 76.6vw;
    height: 3.6vw;
  }
  .authorpost__info p {
    margin-top: 0.8vw;
    font-size: 1.4vw;
    height: 3.1vw;
    width: 76.6vw;
  }
  .authorpost__link a {
    font-size: 1.7vw;
  }
}
@media all and (max-width: 780px) {
  .authorpost__wrapper {
    grid-template-columns: 82% 18%;
  }
  .authorpost__info h2 {
    font-size: 3.5vw;
    width: 73vw;
    height: 4.2vw;
  }
  .authorpost__info p {
    margin-top: 0.8vw;
    font-size: 1.6vw;
    height: 3.65vw;
    width: 73vw;
  }
  .authorpost__link a {
    font-size: 2vw;
  }
}
@media all and (max-width: 620px) {
  .authorpost__wrapper {
    grid-template-columns: 78% 22%;
  }
  .authorpost__info h2 {
    font-size: 4vw;
    width: 67vw;
    height: 4.8vw;
  }
  .authorpost__info p {
    font-size: 1.8vw;
    height: 3.95vw;
    width: 67vw;
  }
  .authorpost__link a {
    font-size: 2.3vw;
  }
}
@media all and (max-width: 576px) {
  .authorpost__outerwrapper {
    margin-top: 8vw;
  }
  .authorpost__wrapper {
    top: 18px;
    grid-template-columns: none;
  }
  .authorpost__info {
    padding-right: 23px;
  }
  .authorpost__info h2 {
    font-size: 7vw;
    width: calc(94vw - 46px);
    white-space: normal;
    height: 16vw;
  }
  .authorpost__info p {
    font-size: 3.5vw;
    height: 11.4vw;
    width: calc(94vw - 46px);
  }
  .authorpost__link {
    display: none;
    margin-left: 23px;
  }
  .authorpost__link a {
    font-size: 4vw;
    height: auto;
    line-height: 3;
  }
}
</style>
<div class="post-<?php echo get_the_id();?>-outerwrapper authorpost__outerwrapper">
  <div class="authorpost__category" style="background-color:<?php echo $categorycolour; ?>;">
    <h4><?php echo $onlycategory; ?></h4>
  </div>
  <div class="authorpost__wrapper">
    <div class="authorpost__info">
      <a href="<?php the_permalink(); ?>">
      <h2><?php the_title(); ?></h2>
      <?php the_excerpt(); ?>
      </a>
    </div>
    <div class="authorpost__link">
      <a href="<?php the_permalink(); ?>">Läs</a>
    </div>
  </div>
</div>
