<?php

/* 
custom_excerpt_more
 */
function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');



/* 
wpseo_remove_reply_to_com
 */
add_filter('wpseo_remove_reply_to_com', '__return_false');




/*
* limit_input_title
*/
function limit_input_title() {
    global $current_screen;
    // Not our post type, exit earlier
    if ('shop' != $current_screen->post_type)
        return;
?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            let title = document.querySelector('#title')
            title.addEventListener('keydown', function(e) {
                if (this.value.length > 39) {
                    this.value = this.value.substr(0, 39);
                }
            });
        });
    </script>
<?php
}
add_action('admin_head', 'limit_input_title');




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
* wcl_acf_validate_value_2
*/
function wcl_acf_validate_value_2($valid, $value, $field, $input) {
    if (!$valid) {
        return $valid;
    }

    if (strlen($value) > 39) {
        $valid = 'You can\'t enter more that 400 chars';
    }

    return $valid;
}
add_filter('acf/validate_value/name=s4_desc', 'wcl_acf_validate_value_2', 10, 4);

/*
* wcl_acf_validate_value
*/
function wcl_acf_validate_value($valid, $value, $field, $input) {
    if (!$valid) {
        return $valid;
    }

    if (strlen($value) > 400) {
        $valid = 'You can\'t enter more that 400 chars';
    }

    return $valid;
}
add_filter('acf/validate_value/name=s4_desc', 'wcl_acf_validate_value', 10, 4);


/*
* Creating post type
*/
function wcl_post_type_shop() {
    $labels = array(
        'name'               => _x('Shop', 'Post Type General Name'),
        'singular_name'      => _x('Shop', 'Post Type Singular Name'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Shop'),
        'edit_item'          => __('Edit Shop'),
        'new_item'           => __('New Shop'),
        'all_items'          => __('All Shop'),
        'view_item'          => __('View Shop'),
        'search_items'       => __('Search Shop'),
        'not_found'          => __('Not Found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Shop'),
    );

    $args = array(
        'label'             => __('Shop'),
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'supports'          => array('title', 'thumbnail'),
        'show_in_nav_menus' => true,
        '_builtin'          => false,
        'menu_icon'         => 'dashicons-admin-customizer',
        'has_archive'       => false,
    );

    register_post_type('shop', $args);
}

add_action('init', 'wcl_post_type_shop');

/*
* wcl_taxonomy_shop_category
*/
function wcl_taxonomy_shop_category() {
    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Categories',
            'singular_name'     => 'Category',
            'search_items'      => 'Search Categories',
            'all_items'         => 'All Categories',
            'view_item '        => 'View Category',
            'parent_item'       => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item'         => 'Edit Category',
            'update_item'       => 'Update Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
            'menu_name'         => 'Categories',
            'back_to_items'     => '← Back to Category',
        ),
        'show_ui'       => true,
        'query_var'     => true,
    );

    register_taxonomy('shop_category', 'shop', $args);
}

add_action('init', 'wcl_taxonomy_shop_category');

/*
* wcl_taxonomy_shop_occasion
*/
function wcl_taxonomy_shop_occasion() {
    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Occasions',
            'singular_name'     => 'Occasion',
            'search_items'      => 'Search Occasions',
            'all_items'         => 'All Occasions',
            'view_item '        => 'View Occasion',
            'parent_item'       => 'Parent Occasion',
            'parent_item_colon' => 'Parent Occasion:',
            'edit_item'         => 'Edit Occasion',
            'update_item'       => 'Update Occasion',
            'add_new_item'      => 'Add New Occasion',
            'new_item_name'     => 'New Occasion Name',
            'menu_name'         => 'Occasions',
            'back_to_items'     => '← Back to Occasion',
        ),
        'show_ui'       => true,
        'query_var'     => true,
    );

    register_taxonomy('shop_occasion', 'shop', $args);
}

add_action('init', 'wcl_taxonomy_shop_occasion');


/*
* Creating post type
*/
function wcl_post_type_outfit() {
    $labels = array(
        'name'               => _x('Outfits', 'Post Type General Name'),
        'singular_name'      => _x('Outfit', 'Post Type Singular Name'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Outfit'),
        'edit_item'          => __('Edit Outfit'),
        'new_item'           => __('New Outfit'),
        'all_items'          => __('All Outfits'),
        'view_item'          => __('View Outfit'),
        'search_items'       => __('Search Outfit'),
        'not_found'          => __('Not Found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Outfits'),
    );

    $args = array(
        'label'             => __('Outfits'),
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'supports'          => array('title', 'thumbnail'),
        'show_in_nav_menus' => true,
        '_builtin'          => false,
        'menu_icon'         => 'dashicons-universal-access',
        'has_archive'       => false,
    );

    register_post_type('outfit', $args);
}

add_action('init', 'wcl_post_type_outfit');

/*
* Creating post type
*/
function wcl_post_type_video() {
    $labels = array(
        'name'               => _x('Videos', 'Post Type General Name'),
        'singular_name'      => _x('Video', 'Post Type Singular Name'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Video'),
        'edit_item'          => __('Edit Video'),
        'new_item'           => __('New Video'),
        'all_items'          => __('All Videos'),
        'view_item'          => __('View Video'),
        'search_items'       => __('Search Video'),
        'not_found'          => __('Not Found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Videos'),
    );

    $args = array(
        'label'             => __('Videos'),
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'supports'          => array('title', 'thumbnail'),
        'show_in_nav_menus' => true,
        '_builtin'          => false,
        'has_archive'       => false,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-format-video',
        'taxonomies'        => array('category'),
    );

    register_post_type('video', $args);
}

add_action('init', 'wcl_post_type_video');


/**
 * shop_load_more
 */
function shop_load_more() {
    $page_items = 7;
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;
    $cycle      = $_POST['cycle'];
    $cat        = $_POST['cat'];
    $occasion   = $_POST['occasion'];

    $thing_page = get_field('thing_page', 'option');
    $phlur = get_field('phlur', $thing_page);
    $list_static = get_field('list', $thing_page);

    if (!empty($cycle)) {
        $cycle = json_decode(stripslashes($_POST['cycle']), true);
    } else {
        $cycle = ['counter' => 0, 'cycle_trig' => 0, 'switcher' => true, 'multi' => -1];
    }

    $args = array(
        'post_type'      => 'shop',
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if (!empty($cat) && $cat != 'all') {
        $tax_query = array(
            array(
                'taxonomy' => 'shop_category',
                'field'    => 'slug',
                'terms'    => $cat,
            )
        );
        $args['tax_query'] = $tax_query;
    } elseif (!empty($occasion) && $occasion != 'all') {
        $tax_query = array(
            array(
                'taxonomy' => 'shop_occasion',
                'field'    => 'slug',
                'terms'    => $occasion,
            )
        );
        $args['tax_query'] = $tax_query;
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    $counter = 0;
    ob_start(); ?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $counter = $cycle['counter'];
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $counter++;
            // $multi = 1;
            if ($cycle['switcher'] == true) {
                $cycle['switcher'] = false;
                $cycle['multi'] = $cycle['multi'] + 1;
                $style = wcl_gen_style($cycle['multi'], $cycle['cycle_trig']);
                $cycle['cycle_trig'] = $cycle['cycle_trig'] + 12;
            }
            if ($counter % ($cycle['cycle_trig'])  == 0) {
                $cycle['switcher'] = true;
            }
            set_query_var('shop_counter', $counter);
            $args =  array(
                'cycle'       => $cycle,
                'phlur'       => $phlur,
                'style'       => $style,
                'list_static' => $list_static,
            );
            get_template_part('template-parts/shop/item', null, $args);
            $style = '';
            $cycle['counter'] = get_query_var('shop_counter');
            $counter = $cycle['counter'];
            ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">No Found</div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="data-btn" data-cycle="<?php echo esc_attr(json_encode($cycle)); ?>" data-page="<?php echo $paged; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_shop_load_more', 'shop_load_more');
add_action('wp_ajax_nopriv_shop_load_more', 'shop_load_more');


/**
 * wcl_gen_style
 */
function wcl_gen_style($multi, $trig) {
    ob_start();
?>
    <?php echo '<style>'; ?>
    <?php echo '.item-' . (0 + $trig) . ' {';
    ?>grid-row-start: <?php echo 1 + (6 * $multi); ?>;
    grid-column-start: <?php echo 1 + (0 * $multi); ?>;
    grid-row-end: <?php echo 2 + (6 * $multi); ?>;
    grid-column-end: <?php echo 2 + (0 * $multi); ?>;

    <?php echo '} .item-' . (1 + $trig) . ' {';
    ?>grid-row-start: <?php echo 1 + (6 * $multi); ?>;
    grid-column-start: <?php echo 2 + (0 * $multi); ?>;
    grid-row-end: <?php echo 3 + (6 * $multi); ?>;
    grid-column-end: <?php echo 4 + (0 * $multi); ?>;

    <?php echo '} .item-' . (2 + $trig) . ' {';
    ?>grid-row-start: <?php echo 2 + (6 * $multi); ?>;
    grid-column-start: <?php echo 1 + (0 * $multi); ?>;
    grid-row-end: <?php echo 3 + (6 * $multi); ?>;
    grid-column-end: <?php echo 2 + (0 * $multi); ?>;

    <?php echo '} .item-' . (3 + $trig) . ' {';
    ?>grid-row-start: <?php echo 3 + (6 * $multi); ?>;
    grid-column-start: <?php echo 1 + (0 * $multi); ?>;
    grid-row-end: <?php echo 4 + (6 * $multi); ?>;
    grid-column-end: <?php echo 2 + (0 * $multi); ?>;

    <?php echo '} .item-' . (4 + $trig) . ' {';
    ?>grid-row-start: <?php echo 3 + (6 * $multi); ?>;
    grid-column-start: <?php echo 2 + (0 * $multi); ?>;
    grid-row-end: <?php echo 4 + (6 * $multi); ?>;
    grid-column-end: <?php echo 3 + (0 * $multi); ?>;

    <?php echo '} .item-' . (5 + $trig) . ' {';
    ?>grid-row-start: <?php echo 3 + (6 * $multi); ?>;
    grid-column-start: <?php echo 3 + (0 * $multi); ?>;
    grid-row-end: <?php echo 4 + (6 * $multi); ?>;
    grid-column-end: <?php echo 4 + (0 * $multi); ?>;

    <?php echo '} .item-' . (6 + $trig) . ' {';
    ?>grid-row-start: <?php echo 4 + (6 * $multi); ?>;
    grid-column-start: <?php echo 1 + (0 * $multi); ?>;
    grid-row-end: <?php echo 6 + (6 * $multi); ?>;
    grid-column-end: <?php echo 3 + (0 * $multi); ?>;

    <?php echo '} .item-' . (7 + $trig) . ' {';
    ?>grid-row-start: <?php echo 4 + (6 * $multi); ?>;
    grid-column-start: <?php echo 3 + (0 * $multi); ?>;
    grid-row-end: <?php echo 5 + (6 * $multi); ?>;
    grid-column-end: <?php echo 4 + (0 * $multi); ?>;

    <?php echo '} .item-' . (8 + $trig) . ' {';
    ?>grid-row-start: <?php echo 5 + (6 * $multi); ?>;
    grid-column-start: <?php echo 3 + (0 * $multi); ?>;
    grid-row-end: <?php echo 6 + (6 * $multi); ?>;
    grid-column-end: <?php echo 4 + (0 * $multi); ?>;
    <?php echo '}'; ?>

    <?php echo '} .item-' . (9 + $trig) . ' {';
    ?>grid-row-start: <?php echo 6 + (6 * $multi); ?>;
    grid-column-start: <?php echo 1 + (0 * $multi); ?>;
    grid-row-end: <?php echo 7 + (6 * $multi); ?>;
    grid-column-end: <?php echo 2 + (0 * $multi); ?>;
    <?php echo '}'; ?>

    <?php echo '} .item-' . (10 + $trig) . ' {';
    ?>grid-row-start: <?php echo 6 + (6 * $multi); ?>;
    grid-column-start: <?php echo 2 + (0 * $multi); ?>;
    grid-row-end: <?php echo 7 + (6 * $multi); ?>;
    grid-column-end: <?php echo 3 + (0 * $multi); ?>;
    <?php echo '}'; ?>

    <?php echo '} .item-' . (11 + $trig) . ' {';
    ?>grid-row-start: <?php echo 6 + (6 * $multi); ?>;
    grid-column-start: <?php echo 3 + (0 * $multi); ?>;
    grid-row-end: <?php echo 7 + (6 * $multi); ?>;
    grid-column-end: <?php echo 4 + (0 * $multi); ?>;
    <?php echo '}'; ?>
    <?php echo '</style>'; ?>
    <?php
    $output = ob_get_clean();
    return $output;
    ?>
<?php
}

/**
 * shop_outfit_load
 */
function shop_outfit_load() {
    $page_items = get_option('posts_per_page');
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;
    $cycle      = $_POST['cycle'];
    $cat        = $_POST['cat'];
    $occasion   = $_POST['occasion'];

    $phlur = get_field('phlur', 163);

    if (!empty($cycle)) {
        $cycle = json_decode(stripslashes($_POST['cycle']), true);
    } else {
        $cycle = ['counter' => 0, 'cycle_trig' => 0, 'switcher' => true, 'multi' => -1];
    }

    $args = array(
        'post_type'      => 'outfit',
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if (!empty($cat) && $cat != 'all') {
        $tax_query = array(
            array(
                'taxonomy' => 'shop_category',
                'field'    => 'slug',
                'terms'    => $cat,
            )
        );
        $args['tax_query'] = $tax_query;
    } elseif (!empty($occasion) && $occasion != 'all') {
        $tax_query = array(
            array(
                'taxonomy' => 'shop_occasion',
                'field'    => 'slug',
                'terms'    => $occasion,
            )
        );
        $args['tax_query'] = $tax_query;
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    $counter = 0;
    ob_start(); ?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $counter = $cycle['counter'];
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $counter++;
            if ($cycle['switcher'] == true) {
                $cycle['switcher'] = false;
                $cycle['multi'] = $cycle['multi'] + 1;
                $style = wcl_gen_style_2($cycle['multi'], $cycle['cycle_trig']);
                $cycle['cycle_trig'] = $cycle['cycle_trig'] + 15;
            }
            if ($counter % ($cycle['cycle_trig'])  == 0) {
                $cycle['switcher'] = true;
            }
            set_query_var('shop_counter', $counter);
            $args =  array(
                'cycle' => $cycle,
                'phlur' => $phlur,
                'style' => $style,
            );
            get_template_part('template-parts/shop-outfits/item', null, $args);
            $style = '';
            $cycle['counter'] = get_query_var('shop_counter');
            $counter = $cycle['counter'];
            ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">No Found</div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="data-btn" data-cycle="<?php echo esc_attr(json_encode($cycle)); ?>" data-page="<?php echo $paged; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_shop_outfit_load', 'shop_outfit_load');
add_action('wp_ajax_nopriv_shop_outfit_load', 'shop_outfit_load');


/**
 * wcl_gen_style_2
 */
function wcl_gen_style_2($multi, $trig) {
    ob_start();
?>
    <?php echo '<style>'; ?>
    <?php echo '.item-' . (0 + $trig) . ' {';
    ?>grid-row-start: <?php echo 1 + (7 * $multi); ?>;
    grid-column-start: <?php echo 1; ?>;
    grid-row-end: <?php echo 2 + (7 * $multi); ?>;
    grid-column-end: <?php echo 2; ?>;

    <?php echo '} .item-' . (1 + $trig) . ' {';
    ?>grid-row-start: <?php echo 1 + (7 * $multi); ?>;
    grid-column-start: <?php echo 2; ?>;
    grid-row-end: <?php echo 3 + (7 * $multi); ?>;
    grid-column-end: <?php echo 4; ?>;

    <?php echo '} .item-' . (2 + $trig) . ' {';
    ?>grid-row-start: <?php echo 2 + (7 * $multi); ?>;
    grid-column-start: <?php echo 1; ?>;
    grid-row-end: <?php echo 3 + (7 * $multi); ?>;
    grid-column-end: <?php echo 2; ?>;

    <?php echo '} .item-' . (3 + $trig) . ' {';
    ?>grid-row-start: <?php echo 3 + (7 * $multi); ?>;
    grid-column-start: <?php echo 1; ?>;
    grid-row-end: <?php echo 4 + (7 * $multi); ?>;
    grid-column-end: <?php echo 2; ?>;

    <?php echo '} .item-' . (4 + $trig) . ' {';
    ?>grid-row-start: <?php echo 3 + (7 * $multi); ?>;
    grid-column-start: <?php echo 2; ?>;
    grid-row-end: <?php echo 4 + (7 * $multi); ?>;
    grid-column-end: <?php echo 3; ?>;

    <?php echo '} .item-' . (5 + $trig) . ' {';
    ?>grid-row-start: <?php echo 3 + (7 * $multi); ?>;
    grid-column-start: <?php echo 3; ?>;
    grid-row-end: <?php echo 4 + (7 * $multi); ?>;
    grid-column-end: <?php echo 4; ?>;

    <?php echo '} .item-' . (6 + $trig) . ' {';
    ?>grid-row-start: <?php echo 4 + (7 * $multi); ?>;
    grid-column-start: <?php echo 1; ?>;
    grid-row-end: <?php echo 5 + (7 * $multi); ?>;
    grid-column-end: <?php echo 2; ?>;

    <?php echo '} .item-' . (7 + $trig) . ' {';
    ?>grid-row-start: <?php echo 4 + (7 * $multi); ?>;
    grid-column-start: <?php echo 2; ?>;
    grid-row-end: <?php echo 5 + (7 * $multi); ?>;
    grid-column-end: <?php echo 2; ?>;

    <?php echo '} .item-' . (8 + $trig) . ' {';
    ?>grid-row-start: <?php echo 4 + (7 * $multi); ?>;
    grid-column-start: <?php echo 3; ?>;
    grid-row-end: <?php echo 5 + (7 * $multi); ?>;
    grid-column-end: <?php echo 4; ?>;

    <?php echo '} .item-' . (9 + $trig) . ' {';
    ?>grid-row-start: <?php echo 5 + (7 * $multi); ?>;
    grid-column-start: <?php echo 1; ?>;
    grid-row-end: <?php echo 7 + (7 * $multi); ?>;
    grid-column-end: <?php echo 3; ?>;

    <?php echo '} .item-' . (10 + $trig) . ' {';
    ?>grid-row-start: <?php echo 5 + (7 * $multi); ?>;
    grid-column-start: <?php echo 3; ?>;
    grid-row-end: <?php echo 6 + (7 * $multi); ?>;
    grid-column-end: <?php echo 4; ?>;

    <?php echo '} .item-' . (11 + $trig) . ' {';
    ?>grid-row-start: <?php echo 6 + (7 * $multi); ?>;
    grid-column-start: <?php echo 3; ?>;
    grid-row-end: <?php echo 7 + (7 * $multi); ?>;
    grid-column-end: <?php echo 4; ?>;

    <?php echo '} .item-' . (12 + $trig) . ' {';
    ?>grid-row-start: <?php echo 7 + (7 * $multi); ?>;
    grid-column-start: <?php echo 1; ?>;
    grid-row-end: <?php echo 8 + (7 * $multi); ?>;
    grid-column-end: <?php echo 2; ?>;

    <?php echo '} .item-' . (13 + $trig) . ' {';
    ?>grid-row-start: <?php echo 7 + (7 * $multi); ?>;
    grid-column-start: <?php echo 2; ?>;
    grid-row-end: <?php echo 8 + (7 * $multi); ?>;
    grid-column-end: <?php echo 3; ?>;

    <?php echo '} .item-' . (14 + $trig) . ' {';
    ?>grid-row-start: <?php echo 7 + (7 * $multi); ?>;
    grid-column-start: <?php echo 3; ?>;
    grid-row-end: <?php echo 8 + (7 * $multi); ?>;
    grid-column-end: <?php echo 4; ?>;
    <?php echo '</style>'; ?>
    <?php
    $output = ob_get_clean();
    return $output;
    ?>
<?php
}


/**
 * video_load_more
 */
function video_load_more() {
    $page_items = get_option('posts_per_page');
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;
    $cat        = $_POST['cat'];

    $args = array(
        'post_type'      => 'video',
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if (!empty($cat) && $cat != 'all') {
        $tax_query = array(
            array(
                'key'          => 'type',
                'value'          => $cat,
                'compare'     => 'LIKE'
            ),
        );
        $args['meta_query'] = $tax_query;
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start(); ?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $count = $offset;
        ?>
        <div class="d5-list">
            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                <?php
                $count++;
                $align = 'left';
                if ($count % 2 == 0) {
                    $align = 'right';
                }
                $args =  array(
                    'align' => $align,
                );
                ?>
                <?php get_template_part('template-parts/videos/item', null, $args); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <div class="d5-list-empty">No Found</div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="data-btn" data-page="<?php echo $paged; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_video_load_more', 'video_load_more');
add_action('wp_ajax_nopriv_video_load_more', 'video_load_more');


/**
 * blog_load_more
 */
function blog_load_more() {
    $page_items = get_option('posts_per_page');
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start(); ?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $count = 0;
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $count++;
            $align = 'left';
            if ($count % 2 == 0) {
                $align = 'right';
            }
            $args =  array(
                'align' => $align,
            );
            ?>
            <?php get_template_part('template-parts/blog/item', null, $args); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">No Found</div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="data-btn" data-page="<?php echo $paged; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_blog_load_more', 'blog_load_more');
add_action('wp_ajax_nopriv_blog_load_more', 'blog_load_more');


/**
 * search_load_more
 */
function search_load_more() {
    $page_items  = get_option('posts_per_page');
    $paged       = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset      = ($paged - 1) * $page_items;
    $search_term = $_POST['search_term'];

    $args = array(
        'post_type'      => ['post', 'page', 'video'],
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        'offset'         => $offset,
        's'              => $search_term,
        'post_status'    => 'publish',
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start(); ?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/search/item'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="data-btn wcl-link" data-page="<?php echo $paged; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo  json_encode($output);
    wp_die();
}
add_action('wp_ajax_search_load_more', 'search_load_more');
add_action('wp_ajax_nopriv_search_load_more', 'search_load_more');






/**
 * category_load_more
 */
function category_load_more() {
    $page_items = 6;
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    // $paged  = 0;
    $offset      = ($paged - 1) * $page_items;
    $cat         = $_POST['cat'];
    $item_height = $_POST['item_height'];

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if (!empty($cat) && $cat != 'all') {
        $tax_query = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $cat,
            )
        );
        $args['tax_query'] = $tax_query;
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    $count = 0;
    $col_1 = '';
    $col_2 = '';
    $col_3 = '';
    $cols = [];
    $count_post_2  =  $query_obj->post_count;
    $count_post_2  = ceil($count_post_2 / 3);
    $count_post  = $page_items;
    $count_post  = ceil(($count_post * $paged) / 3);
    if ($count_post_2  < 2) {
        $count_post =   $count_post - $count_post_2;
    }
    $height = $count_post *  (0 + $item_height);
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $count++;
            $args = [
                'ajax' => true
            ];

            if ($count == 1) {
                ob_start();
                get_template_part('template-parts/category/item', null, $args);
                $col_1 .= ob_get_clean();
            } elseif ($count == 2) {
                ob_start();
                get_template_part('template-parts/category/item', null, $args);
                $col_2 .= ob_get_clean();
            } elseif ($count == 3) {
                $count = 0;
                ob_start();
                get_template_part('template-parts/category/item', null, $args);
                $col_3 .= ob_get_clean();
            }
            ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
        <?php
        $cols[] = $col_1;
        $cols[] = $col_2;
        $cols[] = $col_3;
        ?>
    <?php else : ?>
        <div class="data-list-empty">Nothing found</div>
    <?php endif; ?>
    <?php
    $output['posts'] = $cols;
    ob_start();
    ?>
    <style>
        @media (min-width: 768px) {
            .wcl-category .data-list .col-2 {
                transform: translateY(calc(<?php echo '-' . (($count_post - 1) * $item_height) . 'px'; ?>));
            }

            .wcl-category .data-list-out {
                height: <?php echo $height + 10 . 'px'; ?>;
            }
        }
    </style>
    <?php if ($pages_el > 1) : ?>
        <button class="data-btn wcl-link" data-page="<?php echo $paged; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_category_load_more', 'category_load_more');
add_action('wp_ajax_nopriv_category_load_more', 'category_load_more');

/*
* wcl_subscribe
*/
function wcl_subscribe() {
    $email     = $_POST["email"];
    $name      = $_POST["name"];
    $list_id   = '4344d49d13';
    $api_key   = 'da19b5e26b4c2d7f628dd7f49284d37e-us19';
    $mailchimp = get_field('mailchimp', 'option');
    $data      = [];

    if (!empty($mailchimp)) {
        $list_id = $mailchimp['list_id'];
        $api_key =  $mailchimp['api_key'];
    }

    $data_center = substr($api_key, strpos($api_key, '-') + 1);
    $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
    $json = json_encode([
        'email_address' => $email,
        'status'        => 'subscribed',
        'merge_fields'  => [
            'FNAME'     => $name,
        ],
    ]);

    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (200 == $status_code) {
            $data[0] = "You have successfully subscribed";
            $data[1] = "true";
        } else {
            $val = json_decode($result);
            $data[0] = str_replace('Use PUT to insert or update list members.', '', $val->detail);
        }
    } catch (Exception $e) {
        $data[0] = $e->getMessage();
    }

    if (empty($data)) {
        $data = 'An error has occurred';
        $data[0] = 'An error has occurred';
    }

    echo json_encode($data);
    wp_die();
}

add_action('wp_ajax_wcl_subscribe', 'wcl_subscribe');
add_action('wp_ajax_nopriv_wcl_subscribe', 'wcl_subscribe');


















/* 
NEW
 */




// Check if function exists and hook into setup.
if (function_exists('acf_register_block_type')) {
    $blocks_path = get_stylesheet_directory() . '/template-parts/blocks';
    add_action('acf/init', function ($blocks_path) {
        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'image-overlap',
            'title'             => __('Image + Text overlap'),
            'description'       => __('It will insert an image with a overlapped text over it.'),
            'render_callback'    => function ($block) {
                $slug = str_replace('acf/', '', $block['name']);
                if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php"))) {
                    include(get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
                }
            },
            'category'          => 'formatting',
            'icon'              => 'format-image',
            'keywords'          => array('image', 'text', 'overlap'),
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'two-images-overlapped',
            'title'             => __('Two Images + Quote overlapped'),
            'description'       => __('It will insert two images with a overlapped text over it.'),
            'render_callback'    => function ($block) {
                $slug = str_replace('acf/', '', $block['name']);
                if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php"))) {
                    include(get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
                }
            },
            'category'          => 'formatting',
            'icon'              => 'format-image',
            'keywords'          => array('image', 'text', 'overlap'),
            'mode' => 'edit',
            'enqueue_assets' => function () {
                wp_enqueue_style('gfonts', 'https://fonts.googleapis.com/css?family=Darker+Grotesque:400,600&display=swap');
            },
        ));

        acf_register_block_type(array(
            'name'              => 'shop-product-list',
            'title'             => __('Product List'),
            'description'       => __('It will show a list of products in a carousel.'),
            'render_callback'    => function ($block) {
                $slug = str_replace('acf/', '', $block['name']);
                if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php"))) {
                    include(get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
                }
            },
            'category'          => 'formatting',
            'icon'              => 'cart',
            'keywords'          => array('shop', 'list', 'products'),
            'mode' => 'edit',
            'enqueue_assets' => function () {
                wp_enqueue_style('fontawesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
                wp_enqueue_style('slick-block', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css');
                wp_enqueue_script('slick-block', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '', false);
                wp_enqueue_script('blocks', get_template_directory_uri() . '/blocks.js', array('jquery'), '', false);
            },
        ));

        acf_register_block_type(array(
            'name'              => 'product-focus',
            'title'             => __('Product Focus'),
            'description'       => __('It allow you to insert a highlighted product.'),
            'render_callback'    => function ($block) {
                $slug = str_replace('acf/', '', $block['name']);
                if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php"))) {
                    include(get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
                }
            },
            'category'          => 'formatting',
            'icon'              => 'cart',
            'keywords'          => array('shop', 'list', 'products', 'focus'),
            'mode' => 'edit',
        ));
    }, 10, 1);
}

function get_main_cat($post) {
    $primary_cat = get_post_meta($post->ID, '_yoast_wpseo_primary_category', true);
    if ($primary_cat) {
        $category = get_category($primary_cat);
        if (!$category) {
            $category = get_the_category($post->ID);
            $category = $category[0];
        }
    } else {
        $category = get_the_category($post->ID);
        $category = $category[0];
    }

    return $category;
}

function exsite_time_ago($post_date) {
    $orig_time = strtotime($post_date);
    return human_time_diff($orig_time, current_time('timestamp')) . ' ' . __('ago');
}






/* Image Rewrites */
function exsite_images_check($content) {
    $content = preg_replace_callback('#<img([^>]*) src="([^"/]*/?[^".]*\.[^"]*)"([^>]*)>#', "exsite_images_rewrite", $content);
    return $content;
}

function exsite_images_rewrite($match) {
    global $post;
    $src = $match[2];
    $classes = '';

    $class = str_replace(array('class="', '"'), '', $classes);

    if (strpos($match[1], 'notpin2') !== false)
        return '<img src="' . $src . '" class="' . $class . '">';
    if (strpos($match[2], 'notpin2') !== false)
        return '<img src="' . $src . '" class="' . $class . '">';
    if (strpos($match[3], 'notpin2') !== false)
        return '<img src="' . $src . '" class="' . $class . '">';


    // if ($match[1] == 'notpin') {
    //  //return $match;
    //  var_dump(123);
    // }

    if ($match[1])
        $classes = $match[1];

    $gal_image = false;
    if (strpos($match[1], 'exsite-gal-img') !== false)
        $gal_image = true;
    if (strpos($match[2], 'exsite-gal-img') !== false)
        $gal_image = true;
    if (strpos($match[3], 'exsite-gal-img') !== false)
        $gal_image = true;


    $wrap_pin = true;
    if (strpos($match[1], 'no-wrap') !== false)
        $wrap_pin = false;
    if (strpos($match[2], 'no-wrap') !== false)
        $wrap_pin = false;
    if (strpos($match[3], 'no-wrap') !== false)
        $wrap_pin = false;

    $old_src = $src;
    $id = exsite_get_attachment_id_by_url($src);
    $size = '784x0';


    if ($id) {
        $image = wp_get_attachment_image_src($id, $size);
        if (strpos($image[0], '.gif') !== false) {
            $image = wp_get_attachment_image_src($id, 'full');
            $src = $image[0];
        } else {
            $image = exsite_image_resize($id, $size);
            $src = $image;
        }
    } else {
        $src = $old_src;
    }


    $class = str_replace(array('class="', '"'), '', $classes);
    $pinclass = '';

    if (strpos($src, 'sig') !== false) {
        $wrap_pin = false;
        $class .= ' chriselle-sig';
    }

    $image_details = '';
    if ($id)
        $image_details = get_post($id);
    $output = '';

    if (!$gal_image)
        $class .= ' no-p';



    if ($image_details->post_excerpt != '' && $id)
        $output .= '<figure>';


    if ($full_image)
        $pinclass .= 'full-size';

    if ($wrap_pin)
        $output .= '<div class="pin-wrap ' . $pinclass . '">';
    $output .= '<img src="' . $src . '" class="' . $class . '">';

    if ($wrap_pin)
        $output .= '<a href="http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink($post->ID)) . '&media=' . urlencode($src) . '&description=' . urlencode(get_bloginfo('name') . " | " . $post->post_title) . '" class="pin-it"><svg class="p"><use xlink:href="#pi"></use></svg>PIN IT</a>';
    if ($wrap_pin)
        $output .= '</div>';


    if ($image_details->post_excerpt != '' && $id) {
        $output .= '<figcaption>' . $image_details->post_excerpt . '</figcaption>';
        $output .= '</figure>';
    }



    return $output;
}

function exsite_get_attachment_id_by_url($url) {

    // Split the $url into two parts with the wp-content directory as the separator.
    $parse_url  = explode(parse_url(WP_CONTENT_URL, PHP_URL_PATH), $url);

    // Get the host of the current site and the host of the $url, ignoring www.
    $this_host = str_ireplace('www.', '', parse_url(home_url(), PHP_URL_HOST));
    $file_host = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));

    // Return nothing if there aren't any $url parts or if the current host and $url host do not match.
    if (!isset($parse_url[1]) || empty($parse_url[1])) {
        return;
    }

    $parse_url[1] = preg_replace('/-[0-9]{1,4}x[0-9]{1,4}\.(jpg|jpeg|png|gif|bmp)$/i', '.$1', $parse_url[1]);
    global $wpdb;

    $parse_url[1] = '%' . $parse_url[1];

    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}posts WHERE guid LIKE %s;", $parse_url[1]));
    // Returns null if no attachment is found.
    return $attachment[0];
}


function exsite_get_post_images($post) {
    $x = 0;
    $content = apply_filters('the_content', $post->post_content);

    //Images within post content
    preg_match_all('#<img([^>]*) src="([^"/]*/?[^".]*\.[^"]*)"([^>]*)>#', $content, $matches);
    $images = array();
    foreach ($matches[2] as $src) {
        $image_id = exsite_get_attachment_id_by_url($src);
        $img = wp_get_attachment_image_src($image_id, '1500_900f');
        $images[$x]['id'] = $image_id;
        $images[$x]['url'] = $img[0];
        $x++;
    }

    /*
    $gallery = get_post_gallery( $post->ID, false );
    
    if($gallery)
    {
	    $gallery_images = explode(",", $gallery['ids']);
	    foreach($gallery_images as $image_id)
	    {
			$img = wp_get_attachment_image_src($image_id, '1500_900f');
			$images[$image_id] = $img[0];
	    }
    }
    */

    return $images;
}


function cdGetCommentsCount($displayText = null) {
    $commentscount = get_comments_number();
    if ($commentscount == 1) : $commenttext = 'Comment';
    endif;
    if ($commentscount > 1 || $commentscount == 0) : $commenttext = 'Comments';
    endif;
    if ($displayText) {
        return $commentscount . ' ' . $commenttext;
    }
    return $commentscount;
}




function exsite_image_resize($attachment_id, $size, $crop = true) {

    if ($attachment_id == '')
        return false;

    $size_new = $size;
    $size = explode('x', $size);
    $width = $size[0];
    $ret_width = $size[0] * 2;
    $height = $size[1];
    $ret_height = $size[1] * 2;

    $upload = wp_upload_dir();

    if ($height == "0")
        $crop = false;

    //If file doesn't exist, copy over
    $path = get_attached_file($attachment_id);
    if (!file_exists($path) && $path != '') {
        $whereto = str_replace($upload['basedir'], '', $path);

        $file_name = explode('/', $whereto);
        $file_name = $file_name[3];
        $whereto = str_replace($file_name, '', $path);

        if (!file_exists($whereto))
            mkdir($whereto, 0777, true);

        $image = wp_get_attachment_image_src($attachment_id, $size_new);

        if ($image) {
            $content = file_get_contents($image[0]);
            $path_new = $whereto . $file_name;
            $fp = fopen($path_new, "w");
            fwrite($fp, $content);
            fclose($fp);
        }
    }

    $path_info = pathinfo($path);
    $base_url  = $upload['baseurl'] . str_replace($upload['basedir'], '', $path_info['dirname']);
    $base_path  = $upload['basedir'] . str_replace($upload['basedir'], '', $path_info['dirname']);

    $meta = wp_get_attachment_metadata($attachment_id);


    //create 2x
    $retina_exists = false;
    foreach ($meta['sizes'] as $key => $size) {
        if ($key == 'resized-' . $ret_width . 'x' . $ret_height) {
            $retina_exists = true;
            break;
        }
    }


    if (!$retina_exists) {
        $new_path = explode('.', $path);
        $new_path = $new_path[0] . '@2x.' . $new_path[1];
        $resized = image_make_intermediate_size($path, $ret_width, $ret_height, $crop);
        if ($resized && !is_wp_error($resized)) {
            $new_hw = $resized['width'] . 'x' . $resized['height'];
            $rename_hw = floor($resized['width'] / 2) . 'x' . floor($resized['height'] / 2);
            $resized_file = str_replace($new_hw, $rename_hw, $resized['file']);
            $new_path = explode('.', $resized_file);
            $new_path = $base_path . '/' . $new_path[0] . '@2x.' . $new_path[1];
            $did_it = rename($base_path . '/' . $resized['file'], $new_path);
            $key                 = sprintf('resized-%dx%d', $ret_width, $ret_height);
            $meta['sizes'][$key] = $resized;
            wp_update_attachment_metadata($attachment_id, $meta);
        }
    }


    //Create 1x
    $orginal_exists = false;
    foreach ($meta['sizes'] as $key => $size) {
        if ($key == 'resized-' . $width . 'x' . $height) {
            $orig_image = "{$base_url}/{$size['file']}";
            $orginal_exists = true;
        }
    }

    if (!checkRemoteFile($orig_image))
        $orginal_exists = false;
    else
        return $orig_image;


    // Generate new size
    if (!$orginal_exists) {
        $resized = image_make_intermediate_size($path, $width, $height, $crop);
        if ($resized && !is_wp_error($resized)) {
            // Let metadata know about our new size.
            $key                 = sprintf('resized-%dx%d', $width, $height);
            $meta['sizes'][$key] = $resized;
            wp_update_attachment_metadata($attachment_id, $meta);
            return "{$base_url}/{$resized['file']}";
        }
    }

    // Return original if fails
    return "{$base_url}/{$path_info['basename']}";
}




function exsite_excerpt($text, $id = '', $length = 35, $read_more = true) {
    $text = strip_shortcodes($text);

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', $length);
    $excerpt_more = '...';
    if ($read_more == true)
        $excerpt_more = new_excerpt_more('...', $id);
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if (count($words) > $excerpt_length) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    }

    return apply_filters('wp_trim_excerpt', '<p class="excerpt">' . $text . '</p>');
}

function checkRemoteFile($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (curl_exec($ch) !== FALSE) {
        return true;
    } else {
        return false;
    }
}





/* ---------------------------------
	Metaboxes
--------------------------------- */
add_action('cmb2_init', 'nys_shop_metaboxes');
function nys_shop_metaboxes() {

    $prefix = '_shop_';

    $cmb = new_cmb2_box(array(
        'id'            => $prefix . 'metabox',
        'title'         => __('Shop Extras', 'cmb2'),
        'object_types'  => array('shop'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ));


    $cmb->add_field(array(
        'name' => __('Price', 'cmb2'),
        'id'   => 'price',
        'type' => 'text',
    ));

    $cmb->add_field(array(
        'name' => __('Brand', 'cmb2'),
        'id'   =>  'brand',
        'type' => 'text',
    ));

    $cmb->add_field(array(
        'name' => __('Link', 'cmb2'),
        'id'   =>  'link',
        'type' => 'text_url',
    ));

    $cmb->add_field(array(
        'name' => __('Short Name', 'cmb2'),
        'id'   => 'short_name',
        'type' => 'text',
    ));

    $cmb->add_field(array(
        'name' => __('Hide on shop pages?', 'cmb2'),
        'id'   => $prefix . 'hide',
        'type' => 'checkbox',
    ));
}
