<?php

/**
 * Template Name: Shop Page
 */

get_header();

$curr_tag = get_query_var('stories_tag');

if (!empty($curr_tag) && $curr_tag !== 'instagram') {
    $curr_tag = get_term_by('slug', $curr_tag, 'post_tag');

    if (empty($curr_tag)) {
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}

$tags      = get_terms_by_post_type(['post_tag'], ['wcl-product']);
$tags_slug = wp_list_pluck($tags, 'slug');

$tag_all       = new stdClass();
$tag_all->slug = 'all';
$tag_all->name = 'All';
$tag_active    = $tag_all;

array_unshift($tags, $tag_all);

$tag_key = 0;
if (!empty($curr_tag)) {
    $tag_active = $curr_tag;
    $tag_key    = array_search($curr_tag->slug, $tags_slug);
}
?>
<div class="wcl-shop-sc-1" data-tag-key="<?php echo $tag_key; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <h1 class="data-title">
                    <span>The</span> Shop
                </h1>
            </div>

            <div class="data-col">
                <?php if (!empty($tags)) : ?>
                    <div class="data-nav swiper">
                        <div class="data-nav-inner swiper-wrapper">
                            <?php foreach ($tags as $key => $tag) : ?>
                                <?php
                                $tag_active_class = '';
                                if ($tag->slug == $tag_active->slug) {
                                    $tag_active_class = 'active';
                                }
                                ?>
                                <?php if ($tag->slug == 'all') : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo site_url('/') . 'stories'; ?>" data-id="all">
                                            All
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo get_permalink() . $tag->slug; ?>" data-id="<?php echo $tag->slug; ?>">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>

                            <div class="data-nav-item swiper-slide">
                                <a href="#" data-id="instagram">
                                    Instagram
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="wcl-shop-sc-1 mod-sticky" data-tag-key="<?php echo $tag_key; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <h1 class="data-title">
                    <span>The</span> Shop
                </h1>
            </div>

            <div class="data-col">
                <?php if (!empty($tags)) : ?>
                    <div class="data-nav swiper">
                        <div class="data-nav-inner swiper-wrapper">
                            <?php foreach ($tags as $key => $tag) : ?>
                                <?php
                                $tag_active_class = '';
                                if ($tag->slug == $tag_active->slug) {
                                    $tag_active_class = 'active';
                                }
                                ?>
                                <?php if ($tag->slug == 'all') : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo site_url('/') . 'stories'; ?>" data-id="all">
                                            All
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo get_permalink() . $tag->slug; ?>" data-id="<?php echo $tag->slug; ?>">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>

                            <div class="data-nav-item swiper-slide">
                                <a href="#" data-id="instagram">
                                    Instagram
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php
$splendor_collective = get_field('pages', 'option');
$splendor_collective = $splendor_collective['the_splendor_collective'];

$page_items = 28;
$paged      = $_POST['paged'] ? $_POST['paged'] : 1;
$offset     = ($paged - 1) * $page_items;

$args = array(
    'post_type'      => 'wcl-product',
    'posts_per_page' => $page_items,
    'offset'         => $offset,
    'post_status'    => 'publish',
);

$cycle = ['counter' => 0, 'cycle_trig' => 0, 'switcher' => true, 'multi' => -1, 'rand_start' => false, 'rand_index_row' => null, 'counter_product' => 0, 'post_ids' => ['']];

if (!empty($tag_active) && $tag_active->slug != 'all') {
    $tax_query = array(
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $tag_active,
        )
    );
    $args['tax_query'] = $tax_query;
}

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
?>
<div class="wcl-shop-sc-2">
    <div class="data-tab data-tab-1 active">
        <div class="data-container wcl-container">
            <div class="data-inner">
                <div class="data-list ">
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
                </div>
            </div>

            <?php
            $cycle['counter_product'] = $cycle['counter_product'] + $page_items_temp;

            $pages_el = ceil(($total_count - $cycle['counter_product']) / $page_items);
            $pages_el = $total_count - $cycle['counter_product'];
            ?>
            <div class="wcl-t4-load-more">
                <div class="t4-container">
                    <?php if ($pages_el > 1) : ?>
                        <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" data-cycle="<?php echo esc_attr(json_encode($cycle)); ?>">
                            More Items
                        </button>
                    <?php else : ?>
                        <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
                            All Viewed
                        </button>
                    <?php endif; ?>
                </div>

                <a href="<?php echo get_permalink($splendor_collective); ?>" class="wcl-link mod-gradient">
                    <span>Splendor Collective</span>
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="data-tab data-tab-2">
        <?php
        $shortcode = get_field('shop_instagram_shortcode', 'option');
        ?>
        <?php if (!empty($shortcode)) : ?>
            <div class="wcl-shop-instagram">
                <div class="d2-container wcl-container">
                    <div class="d2-inner">
                        <?php
                        echo do_shortcode($shortcode);
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
