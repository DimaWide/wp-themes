<?php

/**
 * Template Name: Video Page
 */

get_header();

$logo_third = get_field('logo_third', 'option');
$logo_third = wp_get_attachment_image($logo_third, 'full');
$desc       = get_field('desc');
$link       = get_field('link');
?>
<div class="wcl-video-sc-1">
    <div class="data-container wcl-container">
        <div class="data-group">
            <div class="data-subtitle">
                My channel
            </div>

            <h1 class="data-title">
                Youtube
            </h1>
        </div>

        <?php if (!empty($desc)) : ?>
            <div class="data-desc">
                <?php echo wpautop($desc); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link">
                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                    <?php echo $link_title; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$page_items = 5;
$args = array(
    'post_type'           => 'cd-video',
    'posts_per_page'      => $page_items,
    'ignore_sticky_posts' => 1,
    'post_status'         => ['publish'],
    'meta_query'  => array(
        array(
            'key'     => 'youtube_video',
            'value'   => '',
            'compare' => '!=',
        ),
    ),
);

$query_obj = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<?php if (!empty($total_count)) : ?>
    <div class="wcl-section-6">
        <div class="data-container wcl-container">
            <?php if ($query_obj->have_posts()) : ?>
                <?php
                $videos = get_posts(array(
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

                <div class="data-list-out">
                    <div class="data-list swiper" data-index="<?php echo $page_items; ?>">
                        <div class="data-list-inner swiper-wrapper">
                            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                <?php
                                $tagline     = get_field('tagline');
                                $image       = get_the_post_thumbnail($post->ID, 'image-size-9');
                                $index_video = array_search(get_the_ID(), $videos);
                                $page_num    = ceil(($index_video + 1) / 9);
                                if ($page_num > 1) {
                                    $page_num = '/page/' . $page_num;
                                } else {
                                    $page_num = '';
                                }
                                ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo site_url('/') . 'video' . $page_num  . '#video-' . get_the_ID(); ?>" class="data-item-inner">
                                        <div class="data-item-view">
                                            <?php if (!empty($image)) : ?>
                                                <div class="data-item-img">
                                                    <?php echo $image; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="data-item-play">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-play.svg'; ?>" alt="img">
                                            </div>
                                        </div>

                                        <div class="data-item-info">
                                            <h3 class="data-item-title">
                                                <?php echo get_the_title(); ?>
                                            </h3>

                                            <?php if (!empty($tagline)) : ?>
                                                <div class="data-item-subtitle">
                                                    <?php echo $tagline; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                            <span>Prev</span>
                        </div>

                        <div class="data-list-nav-btn mod-next">
                            <span>Next</span>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>


<?php
$terms = get_terms([
    'taxonomy'   => 'cd-video-category',
    'hide_empty' => true,
    'parent'     => 0,
]);

$term_all       = new stdClass();
$term_all->slug = 'all';
$term_all->name = 'All';
$term_active    = $term_all;

array_unshift($terms, $term_all);

if (is_tax()) {
    $term_active = get_queried_object();
}

$paged = 1;
if (!empty(get_query_var('paged'))) {
    $paged = get_query_var('paged');
}
$page_items = 9;
$offset     = ($paged - 1) * $page_items;
$last_date  = '';

$args = array(
    'post_type'           => 'cd-video',
    'posts_per_page'      => $page_items,
    'offset'              => $offset,
    'paged'               => $paged,
    'ignore_sticky_posts' => 1,
    'post_status'         => ['publish'],
);

if (!empty($term_active) && $term_active->slug != 'all') {
    $args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'cd-video-category',
            'field'    => 'slug',
            'terms'    => $term_active->slug,
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

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
$count_posts = count($query_obj->posts);
$data_posts  = [];

foreach ($query_obj->posts as $item) {
    $date = date("Y-M", (strtotime($item->post_date)));
    $data_posts[$date][] = $item;
    $last_date = $date;
}

?>
<div class="wcl-video-sc-2">
    <?php if (!empty($logo_third)) : ?>
        <div class="data-logo">
            <?php echo $logo_third; ?>
        </div>
    <?php endif; ?>

    <div class="data-nav wcl-nav">
        <div class="d6-inner wcl-container">
            <div class="d6-label">
                Sort by:
            </div>

            <div class="d6-list swiper">
                <div class="d6-list-inner swiper-wrapper">
                    <?php if (!empty($terms)) : ?>
                        <?php foreach ($terms as $key => $term) : ?>
                            <?php
                            $term_active_class = '';
                            if ($term->slug == $term_active->slug) {
                                $term_active_class = 'active';
                            }
                            ?>
                            <?php if ($term->slug == 'all') : ?>
                                <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                    <a href="<?php echo site_url('/') . 'video'; ?>" class="d6-item-link" data-id="all">
                                        <span>All</span>
                                        <span>Posts</span>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                    <a href="<?php echo get_term_link($term->term_id); ?>" class="d6-item-link" data-id="<?php echo $term->slug; ?>">
                                        <span><?php echo $term->name; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="data-label">
        <div class="data-container wcl-container">
            <div class="data-label-a">
                <span>All</span> Videos
            </div>
        </div>
    </div>

    <div class="data-a">
        <div class="data-a-container wcl-container">
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
            <?php else : ?>
                <div class="data-a-empty wcl-label-empty mod-margin-big">Nothing found</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="wcl-load-more">
        <div class="d2-container">
            <?php if ($pages_el > 1) : ?>
                <button class="d2-btn" data-last-date="<?php echo $last_date; ?>" data-page="<?php echo $paged; ?>">
                    View More
                </button>
            <?php else : ?>
                <button class="d2-btn" data-last-date="<?php echo $last_date; ?>" data-page="<?php echo $paged; ?>" disabled="true">
                    All Viewed
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
