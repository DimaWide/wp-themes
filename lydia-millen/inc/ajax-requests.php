<?php


/**
 * shop_load_post
 */
function shop_load_post() {
    $page_items   = 12;
    $category     = $_POST['category'];
    $paged        = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset       = ($paged - 1) * $page_items;

    $args = array(
        'post_type'           => 'cd-product',
        'posts_per_page'      => $page_items,
        'paged'               => $paged,
        'offset'              => $offset,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($category)) {
        $category = explode(',', $category);
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'cd-product-category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);

    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/shop/item'); ?>
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
    <?php if ($pages_el > 1) : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_shop_load_post', 'shop_load_post');
add_action('wp_ajax_nopriv_shop_load_post', 'shop_load_post');


/**
 * collection_load_post
 */
function collection_load_post() {
    $page_items   = 12;
    $collection   = $_POST['collection'];
    $paged        = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset       = ($paged - 1) * $page_items;
    $args = array(
        'post_type'           => 'cd-product',
        'posts_per_page'      => $page_items,
        'paged'               => $paged,
        'offset'              => $offset,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($collection)) {
        $collection = explode(',', $collection);
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'cd-product-collection',
                'field'    => 'slug',
                'terms'    => $collection,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);

    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/shop/item'); ?>
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
    <?php if ($pages_el > 1) : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_collection_load_post', 'collection_load_post');
add_action('wp_ajax_nopriv_collection_load_post', 'collection_load_post');


/**
 * category_page_load_post
 */
function category_page_load_post() {
    $page_items = 9;
    $category   = $_POST['category'];
    $last_date  = $_POST['last_date'];
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'           => 'post',
        'posts_per_page'      => $page_items,
        'offset'              => $offset,
        'paged'               => $paged,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($category) && $category != 'all') {
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $query_obj       = new WP_Query($args);
    $total_count     = $query_obj->found_posts;
    $pages_el        = ceil(($total_count - $offset) / $page_items);
    $data_posts      = [];
    $data_posts_prev = [];
    $last_date_new   = '';

    foreach ($query_obj->posts as $item) {
        $date = date("Y-M", (strtotime($item->post_date)));
        if ($last_date == $date && $paged != 1) {
            $data_posts_prev['date'] = $last_date;
            $data_posts_prev['posts'][] = $item;
        } else {
            $month = date("F", (strtotime($item->post_date)));
            $data_posts[$date][] = $item;
        }

        $last_date_new = $date;
    }

    global $post;
    ob_start();
?>
    <?php if (!empty($data_posts_prev)) : ?>
        <?php foreach ($data_posts_prev['posts'] as $key => $post_item) : ?>
            <?php
            $post = $post_item;
            setup_postdata($post);
            get_template_part('template-parts/category/item');
            ?>
        <?php endforeach; ?>
        <?php
        wp_reset_postdata();
        ?>
    <?php endif; ?>
    <?php
    $output['posts_prev']['date'] = $data_posts_prev['date'];
    $output['posts_prev']['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if (!empty($data_posts)) : ?>
        <?php foreach ($data_posts as $key => $posts) : ?>
            <div class="data-a-item" data-id="<?php echo $key; ?>">
                <div class="data-a-month">
                    <?php
                    $month = date("F", (strtotime($key)));
                    echo $month;
                    ?>
                </div>
                <div class="data-list">
                    <?php foreach ($posts as $key => $post_item) : ?>
                        <?php
                        $post = $post_item;
                        setup_postdata($post);
                        get_template_part('template-parts/category/item');
                        ?>
                    <?php endforeach; ?>
                    <?php
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    $args = array(
        'numberposts' => 1,
    );

    if ($category != 'all') {
        $term = get_term_by('slug', $category, 'category');
        $args['category'] = $term->term_id;
    }

    $featured_post = get_posts($args);
    ob_start();
    ?>
    <?php if (!empty($featured_post)) : ?>
        <?php
        $image     = get_the_post_thumbnail($featured_post[0], 'image-size-14');
        $excerpt   = get_the_excerpt($featured_post[0]);
        $title     = get_the_title($featured_post[0]);
        $permalink = get_the_permalink($featured_post[0]);
        ?>
        <div class="data-a">
            <div class="data-b">
                <span class="data-b-a">FEATURED POST</span>

                <span class="data-b-line"></span>

                <span class="data-b-b">
                    Ad Affiliate
                </span>
            </div>

            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>

            <?php if (!empty($excerpt)) : ?>
                <div class="data-desc">
                    <?php echo $excerpt; ?>
                </div>
            <?php endif; ?>

            <div class="data-link">
                <a href="<?php echo $permalink; ?>" class="wcl-link">
                    View Article
                </a>
            </div>
        </div>

        <?php if (!empty($image)) : ?>
            <div class="data-img">
                <?php echo $image; ?>
            </div>
        <?php else : ?>
            <div class="data-img mod-empty"></div>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    $output['first_post'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="d2-btn" data-last-date="<?php echo $last_date_new; ?>" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-last-date="<?php echo $last_date_new; ?>" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_category_page_load_post', 'category_page_load_post');
add_action('wp_ajax_nopriv_category_page_load_post', 'category_page_load_post');



/**
 * video_page_load_post
 */
function video_page_load_post() {
    $page_items = 9;
    $category   = $_POST['category'];
    $last_date  = $_POST['last_date'];
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'           => 'cd-video',
        'posts_per_page'      => $page_items,
        'offset'              => $offset,
        'paged'               => $paged,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($category) && $category != 'all') {
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'cd-video-category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $args['meta_query'] = array(
        array(
            'key'     => 'youtube_video',
            'value'   => '',
            'compare' => '!=',
        ),
    );

    $query_obj       = new WP_Query($args);
    $total_count     = $query_obj->found_posts;
    $pages_el        = ceil(($total_count - $offset) / $page_items);
    $data_posts      = [];
    $data_posts_prev = [];
    $last_date_new   = '';

    foreach ($query_obj->posts as $item) {
        $date = date("Y-M", (strtotime($item->post_date)));
        if ($last_date == $date && $paged != 1) {
            $data_posts_prev['date'] = $last_date;
            $data_posts_prev['posts'][] = $item;
        } else {
            $month = date("F", (strtotime($item->post_date)));
            $data_posts[$date][] = $item;
        }

        $last_date_new = $date;
    }

    global $post;
    ob_start();
?>
    <?php if (!empty($data_posts_prev)) : ?>
        <?php foreach ($data_posts_prev['posts'] as $key => $post_item) : ?>
            <?php
            $post = $post_item;
            setup_postdata($post);
            get_template_part('template-parts/video/item');
            ?>
        <?php endforeach; ?>
        <?php
        wp_reset_postdata();
        ?>
    <?php endif; ?>
    <?php
    $output['posts_prev']['date'] = $data_posts_prev['date'];
    $output['posts_prev']['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if (!empty($data_posts)) : ?>
        <?php foreach ($data_posts as $key => $posts) : ?>
            <div class="data-a-item" data-id="<?php echo $key; ?>">
                <div class="data-a-month">
                    <?php
                    $month = date("F", (strtotime($key)));
                    echo $month;
                    ?>
                </div>
                <div class="data-list">
                    <?php foreach ($posts as $key => $post_item) : ?>
                        <?php
                        $post = $post_item;
                        setup_postdata($post);
                        get_template_part('template-parts/video/item');
                        ?>
                    <?php endforeach; ?>
                    <?php
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="d2-btn" data-last-date="<?php echo $last_date_new; ?>" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-last-date="<?php echo $last_date_new; ?>" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}

add_action('wp_ajax_video_page_load_post', 'video_page_load_post');
add_action('wp_ajax_nopriv_video_page_load_post', 'video_page_load_post');

/**
 * posts_landing_page_get_posts_by_month
 */
function posts_landing_page_get_posts_by_month($last_date, $category = '', $post_type = 'post') {
    $paged      = 1;
    $page_items = -1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'           => $post_type,
        'posts_per_page'      => $page_items,
        'offset'              => $offset,
        'paged'               => $paged,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($category) && $category != 'all') {
        $args['tax_query'] = [
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $date_from = date("Y-M", strtotime('-0 month', strtotime($last_date)));
    $date_to = date("Y-M", strtotime('+1 month', strtotime($last_date)));

    $arr = array(
        array(
            'after' => $date_from,
        ),
    );
    $args['date_query'][] = $arr;

    $arr = array(
        array(
            'before' => $date_to,
        ),
    );
    $args['date_query'][] = $arr;

    $query_obj     = new WP_Query($args);
    $total_count   = $query_obj->found_posts;
    $pages_el      = ceil(($total_count - $offset) / $page_items);
    $data_posts    = [];

    foreach ($query_obj->posts as $item) {
        $date = date("Y-M", (strtotime($item->post_date)));
        $month = date("F", (strtotime($item->post_date)));
        $data_posts[$month][] = $item;
    }

    if (empty($data_posts)) {
        $args = array(
            'post_type'           => $post_type,
            'posts_per_page'      => 1,
            'ignore_sticky_posts' => 1,
            'post_status'         => ['publish'],
        );

        if (!empty($category) && $category != 'all') {
            $args['tax_query'] = [
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $category,
                ),
            ];
        };

        $arr = array(
            array(
                'before' => $last_date,
            ),
        );
        $args['date_query'][] = $arr;
        $query_obj   = new WP_Query($args);
        $total_count = $query_obj->found_posts;
        if (!empty($total_count)) {
            $last_date = date("Y-M", strtotime('-1 month', strtotime($last_date)));
            return posts_landing_page_get_posts_by_month($last_date, $category, $post_type);
        }
    } else {
        return ['post_date' => $last_date, 'posts' => $data_posts];
    }
}

/**
 * posts_landing_page_if_has_post
 */
function posts_landing_page_if_has_post($data_to, $category = '', $post_type = 'post') {
    $args = array(
        'post_type'           => $post_type,
        'posts_per_page'      => 1,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($category) && $category != 'all') {
        $args['tax_query'] = [
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $data_to = date("Y-M", strtotime('+1 month', strtotime($data_to)));

    $arr = array(
        array(
            'before' => $data_to,
        ),
    );
    $args['date_query'][] = $arr;
    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    return $total_count;
}

function posts_landing_page_render_month($post_date, $category = '', $post_type = 'post') {
    $data       = posts_landing_page_get_posts_by_month($post_date, $category, $post_type);
    $data_posts = $data['posts'];
    $post_date  = $data['post_date'];
    ob_start();
?>
    <?php if (!empty($data_posts)) : ?>
        <?php foreach ($data_posts as $key => $posts) : ?>
            <?php
            $count_posts = count($posts);
            $dots        = $count_posts / 3;
            $dots        = ceil($dots);
            if ($count_posts > 9) {
                $dots = 3;
            }
            $less_three = '';
            $one_item = '';
            if ($count_posts <= 3) {
                $less_three = 'less-three';
            }
            if ($count_posts == 1) {
                $one_item = 'one-item';
            }
            ?>
            <div class="data-a-item" data-id="<?php echo $post_date; ?>">
                <div class="data-a-month">
                    <?php echo $key; ?>
                </div>

                <div class="data-list swiper <?php echo $less_three . ' ' . $one_item; ?>">
                    <div class="data-list-inner swiper-wrapper">
                        <?php foreach ($posts as $key => $post_item) : ?>
                            <?php
                            $args =  array(
                                'item' => $post_item,
                            );
                            if ($post_type == 'cd-outfit') {
                                get_template_part('template-parts/outfits/item', null, $args);
                            } else {
                                get_template_part('template-parts/posts-landing/item', null, $args);
                            }
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($count_posts > 3) : ?>
                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            Previous
                        </div>

                        <?php if ($dots > 0) : ?>
                            <div class="data-list-dots">
                                <?php
                                for ($i = 0; $i < $dots; $i++) {
                                    $active = '';
                                    if ($i == 0) {
                                        $active = 'active';
                                    }

                                    $num   = $count_posts / 3;
                                    $num   = floor($num);
                                    $num_2 = $num * $i;
                                ?>
                                    <div class="data-list-dots-item <?php echo $active ?>" data-index="<?php echo $num_2; ?>"></div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="data-list-nav-btn mod-next">
                            Next
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php
    $output['post_date'] = $post_date;
    $output['posts'] = ob_get_clean();
    return $output;
}

/**
 * posts_landing_page_load_post
 */
function posts_landing_page_load_post() {
    $category  = $_POST['category'];
    $post_date = $_POST['post_date'];
    $has_post  = '';

    ob_start();
    if (empty($post_date)) {
        $post_date   = date("Y-M");
        $count_month = 3;

        while ($count_month > 0) {
            $posts = posts_landing_page_render_month($post_date, $category);
            $post_date = $posts['post_date'];
            $post_date = date("Y-M", strtotime('-1 month', strtotime($post_date)));

            if (!empty($posts)) {
                $count_month--;
                echo $posts['posts'];
            }

            $has_post = posts_landing_page_if_has_post($post_date, $category);
            if (empty($has_post)) {
                break;
            }
        }
    } else {
        $posts = posts_landing_page_render_month($post_date, $category);
        $post_date = $posts['post_date'];
        if (!empty($posts)) {
            echo $posts['posts'];
        }
        $post_date = date("Y-M", strtotime('-1 month', strtotime($post_date)));
        $has_post = posts_landing_page_if_has_post($post_date, $category);
    }
?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if (!empty($has_post)) : ?>
        <button class="d2-btn" data-post-date="<?php echo $post_date; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-post-date="<?php echo $post_date; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_posts_landing_page_load_post', 'posts_landing_page_load_post');
add_action('wp_ajax_nopriv_posts_landing_page_load_post', 'posts_landing_page_load_post');

/**
 * outfit_load_post
 */
function outfit_load_post() {
    $post_date = $_POST['post_date'];
    $has_post  = '';

    ob_start();
    if (empty($post_date)) {
        $post_date   = date("Y-M");
        $count_month = 3;

        while ($count_month > 0) {
            $posts = posts_landing_page_render_month($post_date, '', 'cd-outfit');
            $post_date = $posts['post_date'];
            $post_date = date("Y-M", strtotime('-1 month', strtotime($post_date)));

            if (!empty($posts)) {
                $count_month--;
                echo $posts['posts'];
            }

            $has_post = posts_landing_page_if_has_post($post_date, '', 'cd-outfit');
            if (empty($has_post)) {
                break;
            }
        }
    } else {
        $posts = posts_landing_page_render_month($post_date, '', 'cd-outfit');
        $post_date = $posts['post_date'];
        if (!empty($posts)) {
            echo $posts['posts'];
        }
        $post_date = date("Y-M", strtotime('-1 month', strtotime($post_date)));
        $has_post = posts_landing_page_if_has_post($post_date, '', 'cd-outfit');
    }
?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if (!empty($has_post)) : ?>
        <button class="d2-btn" data-post-date="<?php echo $post_date; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-post-date="<?php echo $post_date; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_outfit_load_post', 'outfit_load_post');
add_action('wp_ajax_nopriv_outfit_load_post', 'outfit_load_post');


/**
 * search_page_load_post
 */
function search_page_load_post() {
    $page_items = 9;
    $post_type  = $_POST['post_type'];
    $search     = $_POST['search'];
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'           => $post_type,
        'posts_per_page'      => $page_items,
        'paged'               => $paged,
        'offset'              => $offset,
        's'                   => $search,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $videos_ids = get_posts(array(
            'post_type'   => 'cd-video',
            'numberposts' => -1,
            'fields'      => 'ids',
            'meta_query'  => array(
                array(
                    'key'     => 'youtube_video',
                    'value'   => '',
                    'compare' => '!=',
                ),
            ),
        ));
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $args =  array(
                'post_type' => $post_type,
                'videos_ids' => $videos_ids,
            );
            get_template_part('template-parts/search/item', null, $args);
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
    <?php if ($pages_el > 1) : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_search_page_load_post', 'search_page_load_post');
add_action('wp_ajax_nopriv_search_page_load_post', 'search_page_load_post');


/**
 * posts_by_month_load_post
 */
function posts_by_month_load_post() {
    $page_items = 9;
    $post_date  = $_POST['post_date'];
    $category   = $_POST['category'];
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'           => 'post',
        'posts_per_page'      => $page_items,
        'paged'               => $paged,
        'offset'              => $offset,
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    if (!empty($category) && $category != 'all') {
        $tax_query = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            )
        );
        $args['tax_query'] = $tax_query;
    }

    $date_from = date("Y-M", strtotime('-0 month', strtotime($post_date)));
    $date_to   = date("Y-M", strtotime('+1 month', strtotime($post_date)));

    $arr = array(
        array(
            'after' => $date_from,
        ),
    );
    $args['date_query'][] = $arr;

    $arr = array(
        array(
            'before' => $date_to,
        ),
    );
    $args['date_query'][] = $arr;

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/posts-by-month/item'); ?>
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
    <?php if ($pages_el > 1) : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_posts_by_month_load_post', 'posts_by_month_load_post');
add_action('wp_ajax_nopriv_posts_by_month_load_post', 'posts_by_month_load_post');


/**
 * shop_page_load_related_posts
 */
function shop_page_load_related_posts() {
    $posts = $_POST['posts'];
    $posts = json_decode($posts, true);

    $args = array(
        'post_type'           => 'post',
        'posts_per_page'      => 100,
        'post__in'            => $posts,
        'orderby'             => 'post__in',
        'ignore_sticky_posts' => 1,
        'post_status'         => ['publish'],
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    ob_start();
?>
    <div class="data-title">
        Featured in <?php echo count($query_obj->posts); ?> post
    </div>

    <div class="data-list-out">
        <div class="data-list swiper">
            <div class="data-list-inner swiper-wrapper">
                <?php if ($query_obj->have_posts()) : ?>
                    <?php
                    $count = 0;
                    ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $count++;
                        $post  = get_post();
                        $image = get_the_post_thumbnail($post->ID, 'image-size-2');
                        ?>
                        <div class="data-item swiper-slide">
                            <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                <div class="data-item-img">
                                    <?php echo $image; ?>

                                    <div class="wcl-post-view">
                                        View Post
                                    </div>
                                </div>

                                <h3 class="data-item-title">
                                    <?php echo get_the_title(); ?>
                                </h3>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-list-nav">
            <div class="data-list-nav-btn mod-prev">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
            </div>

            <div class="data-list-nav-btn mod-next">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
            </div>
        </div>
    </div>
<?php
    $output['posts'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_shop_page_load_related_posts', 'shop_page_load_related_posts');
add_action('wp_ajax_nopriv_shop_page_load_related_posts', 'shop_page_load_related_posts');
