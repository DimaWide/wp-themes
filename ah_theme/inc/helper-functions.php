<?php






/*
* plug for vs
*/
if (false) {
    function get_field() {
    }
    function acf_add_options_page() {
    }
    function get_sub_field() {
    }
    function have_rows() {
    }
    function the_row() {
    }
    function get_row_layout() {
    }
    function get_field_object() {
    }
    function update_field() {
    }
    function acf_register_block_type() {
    }
}



/*
* Page Slug Body Class
*/
function add_slug_body_class($classes) {
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter('body_class', 'add_slug_body_class');





/* 
wcl_get_blog_slug
 */
function wcl_get_blog_slug() {
    $slug = 'blog';

    $blog_page = get_field('blog_page', 'option');

    $blog_page = get_post($blog_page);

    if (!empty($blog_page)) {
        $slug = $blog_page->post_name;
    }

    return $slug;
}





/**
 * block_categories_all
 */
add_filter('block_categories_all', function ($categories) {

    // Adding a new category.
    $categories[] = array(
        'slug'  => 'wcl-category',
        'title' => 'WCL Blocks'
    );

    return $categories;
});





/* 
estimated reading time
 */
function reading_time($post_id) {
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200);

    $timer = "min";

    $totalreadingtime = $readingtime . $timer;

    return $totalreadingtime;
}





/*
* wcl_Walker_Nav_Menu
*/
class wcl_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */


    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }

        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';



        // создаем HTML код элемента меню
        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $data_output = '';

        $other_group = get_field('other_group', 'option');
        $vlog_menu_item_id = $other_group['mega_menu_item_id_for_blog'];

        $menuIds = [$vlog_menu_item_id];

        if (in_array($item->ID, $menuIds)) {
            ob_start();
?>

            <div class="wcl-mega-menu">
                <div class="m1-inner">
                    <div class="m1-row">
                        <?php
                        $args = array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'post_status'    => 'publish',
                            'meta_key'       => 'featured_post',
                            'orderby'        => array(
                                'meta_value' => 'DESC',
                                'date'       => 'DESC',
                            ),
                            'order'          => 'DESC',
                        );

                        $args['tax_query'] = [
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => 'case-study',
                            ),
                        ];

                        $query_obj   = new WP_query($args);
                        $total_count = $query_obj->found_posts;
                        ?>
                        <div class="m1-col">
                            <h3 class="m1-title">
                                Case Study
                            </h3>

                            <?php if ($query_obj->have_posts()) : ?>
                                <div class="m1-list">
                                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                        <?php get_template_part('template-parts/mega-menu-item'); ?>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                            <?php
                            $category = get_term_by('slug', 'case-study', 'category');
                            ?>
                            <div class="m1-link">
                                <a href="<?php echo get_term_link($category); ?>">
                                    All case studies

                                    <span class="m1-link-arrow">
                                        <img class="m1-link-img-1" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right.svg'; ?>" alt="img">
                                        <img class="m1-link-img-2" src="<?php echo get_stylesheet_directory_uri() . '/img/dark-arrow-right.svg'; ?>" alt="img">
                                    </span>
                                </a>
                            </div>
                        </div>


                        <?php
                        $args = array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'post_status'    => 'publish',
                            'meta_key'       => 'featured_post',
                            'orderby'        => array(
                                'meta_value' => 'DESC',
                                'date'       => 'DESC',
                            ),
                            'order'          => 'DESC',
                        );

                        $args['tax_query'] = [
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => 'newsletter',
                            ),
                        ];

                        $query_obj   = new WP_Query($args);
                        $total_count = $query_obj->found_posts;
                        ?>
                        <div class="m1-col">
                            <h3 class="m1-title">
                                Newsletter
                            </h3>

                            <?php if ($query_obj->have_posts()) : ?>
                                <div class="m1-list">
                                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                        <?php get_template_part('template-parts/mega-menu-item'); ?>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                            <?php
                            $category = get_term_by('slug', 'newsletter', 'category');
                            ?>
                            <div class="m1-link">
                                <a href="<?php echo get_term_link($category); ?>">
                                    All newsletter

                                    <span class="m1-link-arrow">
                                        <img class="m1-link-img-1" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right.svg'; ?>" alt="img">
                                        <img class="m1-link-img-2" src="<?php echo get_stylesheet_directory_uri() . '/img/dark-arrow-right.svg'; ?>" alt="img">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php

            $data_output = ob_get_clean();
        }
        ?>

        <?php

        if (!is_object($args)) {
            $item_output = '<a' . $attributes . '>';
            $item_output .=  apply_filters('the_title', $item->title, $item->ID);
            $item_output .= '</a>';
            $item_output .= $data_output;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $data_output;
            $item_output .= $args->after;
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "{$indent}</ul>\n";
    }
}






/**
 * wcl_acf_blocks_init
 */
function wcl_acf_blocks_init() {

    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-1',
            'title'           => __('Hero Section'),
            'description'     => __('Hero Section Block'),
            'render_template' => 'template-parts/acf-blocks/block-1.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_1',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_block_1($block, $content = '', $is_preview = false) {
            if ($is_preview) {
        ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_1.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-1');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-2',
            'title'           => __('Cases'),
            'description'     => __('Cases Block'),
            'render_template' => 'template-parts/acf-blocks/block-2.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_2',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_2($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_2.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-2');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-3',
            'title'           => __('From the Blog'),
            'description'     => __('From the Blog Block'),
            'render_template' => 'template-parts/acf-blocks/block-3.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_3',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_3($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_3.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-3');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-4',
            'title'           => __('Case Study & Newsletter'),
            'description'     => __('Case Study & Newsletter Block'),
            'render_template' => 'template-parts/acf-blocks/block-4.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_4',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_4($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_4.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-4');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-5',
            'title'           => __('First Post'),
            'description'     => __('First Post Block'),
            'render_template' => 'template-parts/acf-blocks/block-5.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_5',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_5($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_5.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-5');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-6',
            'title'           => __('Posts Feed with Filters'),
            'description'     => __('Posts Feed with Filters Block'),
            'render_template' => 'template-parts/acf-blocks/block-6.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_6',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_6($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_6.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-6');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-7',
            'title'           => __('Individual Blog Post - Heading'),
            'description'     => __('Individual Blog Post - Heading Block'),
            'render_template' => 'template-parts/acf-blocks/block-7.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_7',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_7($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_7.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-7');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-8',
            'title'           => __('Individual Blog Post – Call Out'),
            'description'     => __('Individual Blog Post – Call Out Block'),
            'render_template' => 'template-parts/acf-blocks/block-8.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_8',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_8($block, $content = '', $is_preview = false) {
            $args = [];

            if (isset($block['className'])) {
                $args['custom_class'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_8.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-8', null, $args);
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-9',
            'title'           => __('Individual Blog Post - Quote'),
            'description'     => __('Individual Blog Post - Quote Block'),
            'render_template' => 'template-parts/acf-blocks/block-9.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_9',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_9($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_9.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-9');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-10',
            'title'           => __('About & Contact Us Page - Hero Section'),
            'description'     => __('About & Contact Us Page - Hero Section Block'),
            'render_template' => 'template-parts/acf-blocks/block-10.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_10',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_10($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_10.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-10');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-11',
            'title'           => __('About Section'),
            'description'     => __('About Section Block'),
            'render_template' => 'template-parts/acf-blocks/block-11.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_11',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_11($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_11.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-11');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-12',
            'title'           => __('Contact Us'),
            'description'     => __('Contact Us Block'),
            'render_template' => 'template-parts/acf-blocks/block-12.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_block_12',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_block_12($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_12.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
        <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-12');
            }
        }
    }
}

add_action('acf/init', 'wcl_acf_blocks_init');







/* 
blog_page_pagination
 */
function blog_page_pagination($query, $ajax_current_page = '', $categories = '') {

    $total_pages = $query->max_num_pages;
    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));

        if (!empty($ajax_current_page)) {
            $current_page = $ajax_current_page;
        }

        $visible_links = 3; // Количество видимых ссылок в пагинации
        ?>

        <div class="data-pagination-mobile">
            <?php if ($current_page > 1) : ?>
                <div class="data-pagination-mobile-prev data-pagination-mobile-b1">
                    <a href="<?php echo custom_get_blog_pagenum_link($current_page - 1, $categories); ?>" data-page="<?php echo ($current_page - 1); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                    </a>
                </div>
            <?php endif; ?>

            <div class="data-pagination-mobile-text">
                <?php
                echo 'Page ' . '<span>' . $current_page . '</span>' . ' of ' . '<span>' . $total_pages . '</span>';
                ?>
            </div>

            <?php if ($current_page < $total_pages) : ?>
                <div class="data-pagination-mobile-next data-pagination-mobile-b1">
                    <a href="<?php echo custom_get_blog_pagenum_link($current_page + 1, $categories); ?>" data-page="<?php echo ($current_page + 1); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-pagination-desktop">
            <?php
            if ($current_page > 1) {
            ?>
                <div class="data-pagination-prev data-pagination-b1">
                    <a href="<?php echo custom_get_blog_pagenum_link($current_page - 1, $categories); ?>" data-page="<?php echo ($current_page - 1); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                        Previous
                    </a>
                </div>
            <?php
            }

            // Вычисляем начало и конец диапазона отображения ссылок
            $start = max(1, $current_page - floor($visible_links / 2));
            $end = min($total_pages, $start + $visible_links - 1);

            // Учитываем, если количество ссылок меньше видимого диапазона
            if ($end - $start + 1 < $visible_links) {
                $start = max(1, $end - $visible_links + 1);
            }
            ?>

            <div class="data-pagination-links">
                <?php
                // Выводим ссылки на страницы в заданном диапазоне
                for ($i = $start; $i <= $end; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="data-pagination-item mod-current" data-page="' .  ($current_page) . '">' . $i . '</span>';
                    } else {
                        echo '<a href="' . custom_get_blog_pagenum_link($i, $categories) . '" class="data-pagination-item" data-page="' .  ($i) . '">' . $i . '</a>';
                    }
                }

                // Добавляем троеточие и три последние страницы при необходимости
                if ($end < $total_pages) {
                    // Если последние страницы не находятся сразу после текущего диапазона

                    // Если последние страницы не находятся сразу после текущего диапазона
                    if ($end < $total_pages - 2) {

                        echo '<span class="data-pagination-item data-pagination-dots">&hellip;</span>';
                        echo '<a href="' . custom_get_blog_pagenum_link($total_pages - 2, $categories) . '" class="data-pagination-item" data-page="' .  ($total_pages - 2) . '">' . ($total_pages - 2) . '</a>';
                        echo '<a href="' . custom_get_blog_pagenum_link($total_pages - 1, $categories) . '" class="data-pagination-item" data-page="' .  ($total_pages - 1) . '">' . ($total_pages - 1) . '</a>';
                    } elseif ($end < $total_pages - 1) {
                        echo '<span class="data-pagination-item data-pagination-dots">&hellip;</span>';
                        echo '<a href="' . custom_get_blog_pagenum_link($total_pages - 1, $categories) . '" class="data-pagination-item" data-page="' .  ($total_pages - 1) . '">' . ($total_pages - 1) . '</a>';
                    }

                    echo '<a href="' . custom_get_blog_pagenum_link($total_pages, $categories) . '" class="data-pagination-item" data-page="' .  ($total_pages) . '">' . $total_pages . '</a>';
                }
                ?>
            </div>

            <?php

            // Добавляем ссылку "Вперед", если не последняя страница

            if ($current_page < $total_pages) {
            ?>
                <div class="data-pagination-next data-pagination-b1">
                    <a href="<?php echo custom_get_blog_pagenum_link($current_page + 1, $categories); ?>" data-page="<?php echo ($current_page + 1); ?>">
                        Next
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                    </a>
                </div>

            <?php
            }
            ?>
        </div>
<?php
    }
}




/* 
custom_pagination_rewrite_rule
 */
function custom_pagination_rewrite_rule() {

    // Blog page

    $blog_page = wcl_get_blog_slug();

    add_rewrite_rule(
        $blog_page . '/page/([0-9]+)/?$',
        'index.php?paged=$matches[1]&pagename=' . $blog_page,
        'top'
    );

    add_rewrite_rule(
        $blog_page . '/([^/]+)/page/([0-9]+)/?$',
        'index.php?wcl_category_name=$matches[1]&paged=$matches[2]&&pagename=' . $blog_page,
        'top'
    );

    add_rewrite_rule('^' . $blog_page . '/([^/]+)/?', 'index.php?wcl_category_name=$matches[1]&pagename=' . $blog_page, 'top');
}
add_action('init', 'custom_pagination_rewrite_rule');





/* 
custom_pagination_rewrite_tag
 */
function custom_pagination_rewrite_tag() {
    add_rewrite_tag('%wcl_category_name%', '([^&]+)');
}
add_action('init', 'custom_pagination_rewrite_tag', 10, 0);






/* 
custom_get_blog_pagenum_link
 */
function custom_get_blog_pagenum_link($pagenum = 1, $categories = '') {
    $pagenum = (int)$pagenum;

    $blog_page = wcl_get_blog_slug();

    $link = site_url() . '/' . $blog_page;

    if (!empty($categories)) {
        $categories = trim($categories);

        $categories_array = explode(',', $categories);
        if (count($categories_array) == 1) {
            $link = site_url('/category/') . $categories;
        } else {
            $link = site_url() . '/' . $blog_page . '/' . $categories;
        }
    }

    if ($pagenum != 1) {
        $link .= '/page/' . $pagenum . '/';
    }

    return $link;
}






/* 
get_new_attr_for_image
 */
function get_new_attr_for_image($image_url) {
    $max_height = 51; // Максимальная высота

    if ($image_url) {
        // Получение размеров изображения
        $image_size = getimagesize($image_url);
        $original_width = $image_size[0];
        $original_height = $image_size[1];

        // Проверка, нужно ли изменять размеры
        if ($original_height > $max_height) {
            // Рассчитываем новые размеры пропорционально максимальной высоте
            $new_height = $max_height;
            $new_width = $original_width * ($max_height / $original_height);
        } else {
            // Если высота изображения не превышает максимальную, используем оригинальные размеры
            $new_width = $original_width;
            $new_height = $original_height;
        }

        // Вывод изображения с установленными размерами
        return '<img src="' . esc_url($image_url) . '" alt="img" width="' . esc_attr($new_width) . '" height="' . esc_attr($new_height) . '">';
    }
}






/* 
generate_post_table_of_contents
 */
function generate_post_table_of_contents($post_content) {

    // Match all H2 headings in the post content
    preg_match_all('/<h2.*?>(.*?)<\/h2>/', $post_content, $matches);

    // Check if there are any matches
    if (!empty($matches[1])) {
        // Start building the HTML
        $html = '<ul>';
        foreach ($matches[1] as $index => $heading) {
            // Create an anchor link
            $anchor_link = sanitize_title_with_dashes($heading);

            // Add the list item with anchor link to the HTML
            $html .= '<li><a href="#' . $anchor_link . '">' . strip_tags($heading) . '</a></li>';
        }
        $html .= '</ul>';

        // Return the generated HTML
        return $html;
    }

    // Return an empty string if no H2 headings are found
    return '';
}





/*
add_ids_to_h2_tags
*/
function add_ids_to_h2_tags($content) {
    if (is_single()) {
        // Match all H2 headings in the content
        preg_match_all('/<h2(.*?)>(.*?)<\/h2>/', $content, $matches);

        // Check if there are any matches
        if (!empty($matches[1])) {
            foreach ($matches[1] as $index => $attributes) {
                // Remove existing id attribute if present
                $attributes = preg_replace('/\bid=[\'"](.*?)[\'"]/', '', $attributes);

                // Create a slug (anchor) from the H2 title
                $anchor_link = sanitize_title_with_dashes($matches[2][$index]);

                // Add the ID to the H2 tag in the content
                $replacement = '<h2' . $attributes . ' id="' . $anchor_link . '">' . $matches[2][$index] . '</h2>';
                $content = str_replace($matches[0][$index], $replacement, $content);
            }
        }
    }

    return $content;
}
add_filter('the_content', 'add_ids_to_h2_tags');



/* 
open_external_links_in_new_tab
 */
function open_external_links_in_new_tab($content) {
    if (is_admin()) {
        return $content;
    }

    if (is_single() && !empty($content)) {
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($content);

        $links = $dom->getElementsByTagName('a');
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if (filter_var($href, FILTER_VALIDATE_URL) && parse_url(home_url(), PHP_URL_HOST) != parse_url($href, PHP_URL_HOST)) {
                $link->setAttribute('target', '_blank');
            }
        }

        $content = $dom->saveHTML();
    }

    return $content;
}

add_filter('the_content', 'open_external_links_in_new_tab');






/* 
ordered_categories
 */
function ordered_categories($type = 'single') {
    // Получаем ID текущего поста
    $post_id = get_the_ID();

    if ($type == 'all') {
        $terms = get_terms([
            'taxonomy'   => 'category',
            'hide_empty' => true,
            'parent'     => 0,
            // 'exclude'    => 1,
        ]);
    } else {
        // Получаем массив терминов (категорий) текущего поста
        $terms = get_the_terms($post_id, 'category');
    }

    $category_counts = [];

    // Если термины существуют, продолжаем
    if ($terms && !is_wp_error($terms)) {
        // Создаем массив для хранения количества постов в каждой категории
        $category_counts = array();

        // Перебираем термины и считаем количество постов
        foreach ($terms as $term) {
            // Исключаем категорию "Uncategorized"
            if ($term->slug !== 'uncategorized') {
                $category_count = $term->count;
                $category_counts[$term->term_id] = $category_count;
            }
        }

        // Сортируем массив по убыванию количества постов
        arsort($category_counts);
    }

    return $category_counts;
}




/* 
custom_seo_meta_description_callback
 */
function custom_seo_meta_description_callback() {
    if (is_single()) {
        $post_excerpt = get_the_excerpt();
        echo '<meta name="description" content="' . esc_attr($post_excerpt) . '">';
    }
}

add_action('wp', 'custom_seo_meta_description_callback');
