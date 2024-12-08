<?php



/**
 * portal_page_load_post
 */
function portal_page_load_post() {
    $page_items = 4;
    $nav_val    = $_POST['nav_val'];
    $cat        = $_POST['cat'];
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if ($nav_val == 'most-recent') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } elseif ($nav_val == 'category') {

        $args['tax_query'] = [
            'relation' => 'AND',
        ];

        if (!empty($cat) && $cat != 'all') {
            $arr = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $cat,
            );
            $args['tax_query'][] = $arr;
        }
    } elseif ($nav_val == 'most-popular') {
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            get_template_part('template-parts/stories/item', null, $args);
            ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty wcl-label-empty">
            Nothing found
        </div>
    <?php endif; ?>
<?php
    $output['posts'] = ob_get_clean();
    $output['count_posts'] = count($query_obj->posts);
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_portal_page_load_post', 'portal_page_load_post');
add_action('wp_ajax_nopriv_portal_page_load_post', 'portal_page_load_post');




/**
 * stories_page_load_post
 */
function stories_page_load_post() {
    $page_items   = 4;
    $tag          = $_POST['tag'];
    $cat          = $_POST['cat'];
    $search       = $_POST['search'];
    $section_name = $_POST['section_name'];
    $paged        = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset       = ($paged - 1) * $page_items;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'offset'         => $offset,
        's'              => $search,
        'post_status'    => 'publish',
    );

    $args['tax_query'] = [
        'relation' => 'AND',
    ];

    if (!empty($tag) && $tag != 'all') {
        $arr = array(
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $tag,
        );
        $args['tax_query'][] = $arr;
    }

    if (!empty($cat) && $cat != 'all') {
        $arr = array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $cat,
        );
        $args['tax_query'][] = $arr;
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $args =  array(
                'tag' => $tag,
            );
            get_template_part('template-parts/stories/item', null, $args);
            ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty wcl-label-empty">
            Nothing found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($section_name == 'exclusive') : ?>
        <?php if ($pages_el > 1) : ?>
            <button class="t4-btn" data-page="<?php echo $paged; ?>">
                More Stories
            </button>
        <?php else : ?>
            <button class="t4-btn" data-page="<?php echo $paged; ?>" disabled="true">
                All Viewed
            </button>
        <?php endif; ?>
    <?php else : ?>
        <?php if ($pages_el > 1) : ?>
            <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>">
                More Stories
            </button>
        <?php else : ?>
            <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
                All Viewed
            </button>
        <?php endif; ?>
    <?php endif; ?>
<?php
    $output['count_posts'] = count($query_obj->posts);
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_stories_page_load_post', 'stories_page_load_post');
add_action('wp_ajax_nopriv_stories_page_load_post', 'stories_page_load_post');




/**
 * shop_page_load_post
 */
function shop_page_load_post() {
    $page_items = 28;
    $cycle      = $_POST['cycle'];
    $tag        = $_POST['tag'];
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;

    if (!empty($cycle)) {
        $cycle = json_decode(stripslashes($_POST['cycle']), true);
    } else {
        $cycle = ['counter' => 0, 'cycle_trig' => 0, 'switcher' => true, 'multi' => -1, 'rand_start' => false, 'rand_index_row' => null, 'counter_product' => 0, 'post_ids' => ['']];
    }

    $offset = $cycle['counter_product'];

    $args = array(
        'post_type'      => 'wcl-product',
        'posts_per_page' => $page_items,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if (!empty($tag) && $tag != 'all') {
        $tax_query = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => $tag,
            )
        );

        $args['tax_query'] = $tax_query;
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $counter = $cycle['counter'];
        $page_items_temp = $page_items;
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            global $post;
            $counter++;
            $cycle['counter'] = $counter;
            $post_temp = $post;
            // var_dump( $cycle['counter'] );

            if ($cycle['switcher'] == true) {
                $cycle['switcher']   = false;
                $cycle['multi']      = $cycle['multi'] + 1;
                $cycle['cycle_trig'] = $cycle['cycle_trig'] + 28;
            }

            if ($counter % ($cycle['cycle_trig']) == 0) {
                $cycle['switcher'] = true;
            }

            $args =  array(
                'cycle' => $cycle,
            );


            if ($counter >= (1 + ($cycle['multi'] * 28)) && $counter <= (4 + ($cycle['multi'] * 28))) {
                if ($counter == (3 + ($cycle['multi'] * 28))) {
                    $posts = shop_page_get_post($cycle['post_ids']);
                    if (!empty($posts)) {
                        shop_page_render_post($posts);
                        setup_postdata($post_temp);
                        $post = $post_temp;
                        $cycle['post_ids'][] = $posts[0]->ID;
                        $page_items_temp = $page_items_temp - 1;
                        $counter++;
                    }
                }
            } elseif ($counter >= (5 + ($cycle['multi'] * 28)) && $counter <= (8 + ($cycle['multi'] * 28))) {
                if ($counter == (6 + ($cycle['multi'] * 28))) {
                    $posts = shop_page_get_post($cycle['post_ids']);
                    if (!empty($posts)) {
                        shop_page_render_post($posts);
                        setup_postdata($post_temp);
                        $post = $post_temp;
                        $cycle['post_ids'][] = $posts[0]->ID;
                        $page_items_temp = $page_items_temp - 1;
                        $counter++;
                    }
                }
            } elseif ($counter >= (14 + ($cycle['multi'] * 28)) && $counter <= (20 + ($cycle['multi'] * 28))) {
                if ($counter == (14 + ($cycle['multi'] * 28))) {
                    $posts = shop_page_get_post($cycle['post_ids']);
                    if (!empty($posts)) {
                        shop_page_render_post($posts);
                        setup_postdata($post_temp);
                        $post = $post_temp;
                        $cycle['post_ids'][] = $posts[0]->ID;
                        $page_items_temp = $page_items_temp - 1;
                        $counter++;
                    }
                }
            } elseif ($counter >= (25 + ($cycle['multi'] * 28)) && $counter <= (28 + ($cycle['multi'] * 28))) {
                if ($counter == (28 + ($cycle['multi'] * 28))) {
                    $posts = shop_page_get_post($cycle['post_ids']);
                    if (!empty($posts)) {
                        shop_page_render_post($posts);
                        setup_postdata($post_temp);
                        $post = $post_temp;
                        $cycle['post_ids'][] = $posts[0]->ID;
                        $page_items_temp = $page_items_temp - 1;
                        //  $counter++;
                    }
                }
            }
            if ($counter >= $cycle['cycle_trig']) {
                break;
            }
            get_template_part('template-parts/shop/item', null, $args);
            ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty wcl-label-empty">
            Nothing found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    ob_start();
    $cycle['counter_product'] = $cycle['counter_product'] + $page_items_temp;
    $pages_el = $total_count - $cycle['counter_product'];
    ?>
    <?php if ($pages_el > 0) : ?>
        <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" data-cycle="<?php echo esc_attr(json_encode($cycle)); ?>">
            More Items
        </button>
    <?php else : ?>
        <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_shop_page_load_post', 'shop_page_load_post');
add_action('wp_ajax_nopriv_shop_page_load_post', 'shop_page_load_post');





/*
* wcl_change_user_avatar
*/
function wcl_change_user_avatar() {
    $user = wp_get_current_user();

    if (!empty($_FILES['user_avatar'])) {
        $attachment_id = media_handle_upload('user_avatar', 0);
        //  update_post_meta($attachment_id, '_wp_attachment_image_alt', 'hidden');
        update_field('avatar', $attachment_id, 'user_' . $user->ID);
    }

    $data['submit'] = 'Avatar Updated.';

    echo json_encode($data);
    wp_die();
}
add_action('wp_ajax_wcl_change_user_avatar', 'wcl_change_user_avatar');
add_action('wp_ajax_nopriv_wcl_change_user_avatar', 'wcl_change_user_avatar');




/**
 * Allow access to own content only
 */
// function my_authored_content($query) {

//     //get current user info to see if they are allowed to access ANY posts and pages
//     $current_user = wp_get_current_user();
//     // set current user to $is_user
//     $is_user = $current_user->user_login;

//     //if is admin or 'is_user' does not equal #username
//     if (!current_user_can('manage_options')) {
//         //if in the admin panel
//         if ($query->is_admin) {

//             global $user_ID;
//             $query->set('author',  $user_ID);
//         }
//         return $query;
//     }
//     return $query;
// }
// add_filter('pre_get_posts', 'my_authored_content');
