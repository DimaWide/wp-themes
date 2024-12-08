<?php


get_header();

$terms = get_terms([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'parent'     => 0,
    'exclude'    => 1,
]);

$term = get_queried_object();

$term_all       = new stdClass();
$term_all->slug = 'all';
$term_all->name = 'All';
$term_active    = $term_all;

array_unshift($terms, $term_all);

if (is_category()) {
    $term_active = get_queried_object();
}
?>
<div class="wcl-category-sc-1">
    <div class="data-container wcl-container">
        <div class="data-subtitle">
            A little bit of
        </div>

        <h1 class="data-title">
            <?php if (!is_category()) : ?>
                All Posts
            <?php else : ?>
                <?php echo $term->name; ?>
            <?php endif; ?>
        </h1>
    </div>
</div>

<?php
$args = array(
    'numberposts' => 1,
);

if (is_category()) {
    $term_active = get_queried_object();
    $args['category'] = $term->term_id;
}
$featured_post = get_posts($args);
?>
<?php if (!empty($featured_post)) : ?>
    <?php
    $image     = get_the_post_thumbnail($featured_post[0], 'image-size-14');
    $excerpt   = get_the_excerpt($featured_post[0]);
    $title     = get_the_title($featured_post[0]);
    $permalink = get_the_permalink($featured_post[0]);
    ?>
    <div class="wcl-category-sc-2">
        <div class="data-container">
            <div class="data-row">
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
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
$paged      = 1;
$page_items = 9;
$offset     = ($paged - 1) * $page_items;
$last_date  = '';

$args = array(
    'post_type'           => 'post',
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
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $term_active->slug,
        ),
    ];
};

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

$terms_slug = wp_list_pluck($terms, 'slug');
$term_key   = array_search($term_active->slug, $terms_slug);
?>
<div class="wcl-category-sc-3" data-term-key="<?php echo $term_key; ?>">
    <div class="data-nav wcl-nav">
        <div class="d6-inner wcl-container">
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
                                    <a href="<?php echo site_url('/') . 'category-landing'; ?>" class="d6-item-link" data-id="all">
                                        All posts
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                    <a href="<?php echo get_term_link($term->term_id); ?>" class="d6-item-link" data-id="<?php echo $term->slug; ?>">
                                        <?php echo $term->name; ?>
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
                <span><?php echo $term_active->name; ?></span> Posts
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
?>