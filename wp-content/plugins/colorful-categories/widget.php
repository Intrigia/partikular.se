<?php
/**
 * Class ColorfulCategoriesWidget
 * Colorful categories widget
 */
class ColorfulCategoriesWidget extends WP_Widget
{
    /**
     * ColorfulCategoriesWidget constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'colorful_categories_widget',
            __('Colorful categories', 'colorful-categories'),
            array('description' => __('A list of categories in awesome colors', 'colorful-categories'))
        );
    }

    /**
     * @return array
     */
    protected function getThemes()
    {
        return apply_filters('colorful_categories_themes', array(
            ''       => __('No theme', 'colorful-categories'),
            'bubble' => __('Bubble', 'colorful-categories'),
            'box'    => __('Box', 'colorful-categories')
        ));
    }

    /**
     * @param array $instance
     */
    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'taxonomy' => ''));
        $title = esc_attr($instance['title']);
        $empty = isset($instance['empty']) && $instance['empty'];
        $count = isset($instance['count']) ? (bool) $instance['count'] : false;
        $excluded = isset($instance['excluded']) ? trim($instance['excluded']) : '';
        $limit = isset($instance['limit']) ? (int) $instance['limit'] : '';
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'colorful-categories'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></p>

        <p>
            <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:', 'colorful-categories'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
                <?php
                $taxonomies = ColorfulCategories::getTaxonomies();
                foreach ($taxonomies as $taxonomy) {
                    $tax = get_taxonomy($taxonomy);
                    echo '<option value="' . $taxonomy . '" ' . selected($taxonomy, $instance['taxonomy']) . '>' . esc_html($tax->label) . ' [' . $taxonomy . ']</option>';
                }
                ?>
            </select>
        </p>

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('empty'); ?>" name="<?php echo $this->get_field_name('empty'); ?>"<?php checked($empty); ?> />
        <label for="<?php echo $this->get_field_id('empty'); ?>"><?php _e('Show empty categories', 'colorful-categories'); ?></label><br/>

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked($count); ?> />
        <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts', 'colorful-categories'); ?></label><br/>

        <p>
            <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Theme', 'colorful-categories'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('theme'); ?>" name="<?php echo $this->get_field_name('theme'); ?>">
                <?php
                $default = isset($instance['theme']) ? $instance['theme'] : '';
                foreach ($this->getThemes() as $slug => $name) {
                    echo '<option value="' . esc_attr($slug) . '" ' . selected($slug, $default) . '>' . esc_html($name) . '</option>';
                }
                ?>
            </select>
        </p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit items (0 means no limit):', 'colorful-categories'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" maxlength="3" value="<?php echo $limit; ?>"/></p>

        <p>
            <label for="<?php echo $this->get_field_id('excluded'); ?>"><?php _e('Excluded categories IDs (comma separated):', 'colorful-categories'); ?></label>
            <br/>
            <textarea id="<?php echo $this->get_field_id('excluded'); ?>" name="<?php echo $this->get_field_name('excluded'); ?>" style="width: 100%;"><?=esc_textarea($excluded)?></textarea>
        </p>

        <?php
    }

    /**
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['taxonomy'] = strip_tags($new_instance['taxonomy']);
        $instance['empty'] = !empty($new_instance['empty']) ? 1 : 0;
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['theme'] = sanitize_text_field($new_instance['theme']);
        $instance['limit'] = (int) $new_instance['limit'];
        $instance['excluded'] = sanitize_text_field($new_instance['excluded']);
        return $instance;
    }

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Categories', 'colorful-categories') : $instance['title'], $instance, $this->id_base);

        $theme = isset($instance['theme']) ? $instance['theme'] : '';
        $excluded = isset($instance['excluded']) ? $instance['excluded'] : '';
        $t = isset($instance['taxonomy']) ? $instance['taxonomy'] : 'category';
        $c = !empty($instance['count']);
        $e = !empty($instance['empty']);
        $l = $instance['limit'] > 0 ? $instance['limit'] : '';

        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        if ($theme === 'bubble') {
            ?>
            <style type="text/css" scoped="scoped">
                ul.colorful-categories {
                    margin-left: 0;
                    padding-left: 0;
                    margin-right: 0;
                    padding-right: 0;
                }

                ul.colorful-categories:after {
                    display: block;
                    content: '';
                    clear: both;
                }

                ul.colorful-categories li {
                    margin: 2px 4px 0 0;
                    padding: 7px 5px 7px 0;
                    list-style: none;
                    float: left;
                    background-image: none;
                    border-width: 0;
                    width: auto;
                }

                ul.colorful-categories li:hover {
                    margin: 2px 4px 1px 1px;
                    padding: 6px 4px 7px 0;
                }

                ul.colorful-categories li a,
                #content-sidebar ul.colorful-categories li a {
                    border-radius: 8px;
                    -webkit-border-radius: 8px;
                    -moz-border-radius: 8px;
                    padding: 4px 8px;
                    color: #fff;
                }

                .colorful-categories li a sup {
                    font-weight: bold;
                }
            </style>
            <?php
        } elseif ($theme === 'box') {
            ?>
            <style type="text/css" scoped="scoped">
                ul.colorful-categories {
                    margin-left: 0;
                    padding-left: 0;
                    margin-right: 0;
                    padding-right: 0;
                    width: auto;
                }

                ul.colorful-categories:after {
                    display: block;
                    content: '';
                    clear: both;
                }

                ul.colorful-categories li {
                    margin: 2px 4px 0 0;
                    padding: 10px 8px 10px 0;
                    list-style: none;
                    float: left;
                    background-image: none;
                    border-width: 0;
                }

                ul.colorful-categories li:hover {
                    margin: 2px 4px 2px 0;
                    padding: 8px 8px 10px 0;
                }

                ul.colorful-categories li a,
                #content-sidebar ul.colorful-categories li a {
                    padding: 4px 8px;
                    color: #fff;
                }

                .colorful-categories li a sup {
                    font-weight: bold;
                }
            </style>
            <?php
        } else {
            do_action('colorful_categories_styles', $theme, $instance, $args);
        }

        $terms = get_terms(apply_filters('colorful_categories_get_terms', array(
            'taxonomy'   => $t,
            'hide_empty' => !$e,
            'exclude'    => $excluded,
            'number'     => $l
        )));

        if (empty($terms)) {
            echo '<p class="colorful-categories-not-found">' . apply_filters('colorful-categories-not-found', __('List is empty', 'colorful-categories'), $t) . '</p>';
        } else {
            ?>
        <ul class="colorful-categories<?=empty($theme) ? '' : ' ' . esc_attr($theme)?>">
            <?php
            /** @var WP_Term $term */
            foreach ($terms as $term) {

                $text = stripslashes($term->name);
                if ($c) {
                    $text .= ' <sup>' . $term->count . '</sup>';
                }

                $isCurrent = false;

                /** @var WP_Term $category */
                foreach (get_the_category() as $category) {
                    if ($category->term_id === $term->term_id) {
                        $isCurrent = true;
                        break;
                    }
                }

                $color = ColorfulCategories::getColorForTerm($term->term_id, true);

                $text = apply_filters('colorful_categories_term_text', $text, $term, $color, $isCurrent);

                echo '<li class="' . esc_attr($term->slug) . ($isCurrent ? ' current' : '') . '"><a href="' . esc_url(get_term_link($term)) . '" style="background-color: ' . $color . ';">' . $text . '</a></li>';
            }

            echo '</ul>';
        }

        echo $args['after_widget'];
    }
}