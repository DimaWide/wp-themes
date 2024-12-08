<?php

$pages         = get_field('pages', 'option');
$video_listing = $pages['video_listing'];

$args = array(
    'post_type'      => 'video',
    'posts_per_page' => 3,
    'post__not_in'   => array(get_the_ID()),
);

$terms           = wp_get_post_terms($post->ID, 'video_category');
$categorie_slugs = [];

if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $key => $term) {
        $categorie_slugs[] = $term->slug;
    }
} else {
    return;
}

if (!empty($categorie_slugs)) {
    $args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'video_category',
            'field'    => 'slug',
            'terms'    => $categorie_slugs,
        ),
    ];
}

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<?php if (!empty($post_count)) : ?>
    <div class="wcl-video-symilar wcl-acf-block-12">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                Panašūs vaizdo įrašai
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/video-item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>