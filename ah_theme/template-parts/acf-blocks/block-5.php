<?php



$categories = [];

if (!empty(get_query_var('wcl_category_name'))) {
	$categories = get_query_var('wcl_category_name');
}

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'meta_key'       => 'featured_post',
    'orderby'        => array(
        'meta_value' => 'DESC',
        'date'       => 'DESC',
    ),
    'order'          => 'DESC',
);

if (is_category()) {
	$current_category = get_queried_object();
	$categories[] = $current_category->slug;
}

if (!empty($categories)) {
    if (!is_array($categories)) {
        $categories = explode(',', $categories);
    }

    $args['tax_query'] = [
        'relation' => 'OR',
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $categories,
        ),
    ];
};

$query_obj = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<!-- Acf Block #5 – First Post -->
<div class="wcl-acf-block-5">
    <div class="data-container">
        <?php if ($query_obj->have_posts()) : ?>
            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                <?php get_template_part('template-parts/acf-blocks/block-5/item'); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</div>