<?php

if (!is_month()) {
    wp_redirect(home_url());
    exit();
}

get_header();

$year = get_query_var('year');
$month = get_query_var('monthnum');

$args = array(
    'post_type'           => 'post',
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

$date = $year . '-' . $month;
$date = date("Y-M", strtotime($date));
$date_from = date("Y-M", strtotime('-0 month', strtotime($date)));
$date_to   = date("Y-M", strtotime('+1 month', strtotime($date)));

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
?>
<div class="wcl-posts-by-month-sc-1">
    <div class="data-container">
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-row">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $image = get_the_post_thumbnail($post->ID, 'image-size-16');
                    $desc  = get_field('ot_text_1', 'option');
                    ?>
                    <div class="data-col data-a <?php echo 'post-' . $post->ID; ?>">
                        <?php if (!empty($image)) : ?>
                            <div class="data-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-col data-b">
                        <div class="data-info">
                            <?php
                            $chapter = date("n", (strtotime($date)));
                            ?>
                            <div class="data-chapter">
                                <span>Chapter</span>
                                <br>
                                <?php echo 'N°' . $chapter; ?>
                            </div>

                            <div class="data-month">
                                <?php echo date("F", (strtotime($post->post_date))); ?>
                            </div>

                            <?php if (!empty($desc)) : ?>
                                <div class="data-desc">
                                    <?php echo $desc; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php
$logo_third = get_field('logo_third', 'option');
$logo_third = wp_get_attachment_image($logo_third, 'full');

$terms = get_terms([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'parent'     => 0,
    'exclude'    => 1,
]);

$term_all       = new stdClass();
$term_all->slug = 'all';
$term_all->name = 'All';
$term_active    = $term_all;

array_unshift($terms, $term_all);

if (is_category()) {
    $term_active = get_queried_object();
}

$paged       = 1;
$page_items  = 9;
$offset      = ($paged - 1) * $page_items;

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
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $category,
        ),
    ];
};

$date = $year . '-' . $month;
$date = date("Y-M", strtotime($date));
$date_from = date("Y-M", strtotime('-0 month', strtotime($date)));
$date_to   = date("Y-M", strtotime('+1 month', strtotime($date)));

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
?>
<div class="wcl-posts-by-month" data-post-date="<?php echo $date; ?>">
    <div class="data-logo">
        <?php echo $logo_third; ?>
    </div>

    <div class="data-nav wcl-nav">
        <div class="d6-inner wcl-container">
            <div class="d6-list swiper">
                <div class="d6-list-inner swiper-wrapper">
                    <?php foreach ($terms as $key => $term) : ?>
                        <?php
                        $term_active_class = '';
                        if ($term->slug == $term_active->slug) {
                            $term_active_class = 'active';
                        }
                        if ($month < 10) {
                            $month = 0 . $month;
                        }
                        ?>
                        <?php if ($term->slug == 'all') : ?>
                            <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                <a href="<?php echo site_url('/') . $year . '/' . $month; ?>" class="d6-item-link" data-id="all">
                                    All posts
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                <a href="<?php echo get_term_link($term->term_id); ?>" class="d6-item-link" data-id="<?php echo esc_attr($term->slug); ?>">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
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
            <?php if ($query_obj->have_posts()) : ?>
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/posts-by-month/item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="wcl-load-more">
        <div class="d2-container">
            <?php if ($pages_el > 1) : ?>
                <button class="d2-btn" data-page="<?php echo $paged; ?>">
                    View More
                </button>
            <?php else : ?>
                <button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
                    All Viewed
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
