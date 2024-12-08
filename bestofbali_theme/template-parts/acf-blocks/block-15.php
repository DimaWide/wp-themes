<?php


$categories = get_field('categories');
$places     = get_field('places');

$number_of_places = get_field('number_of_places');
$page_items = !empty($number_of_places) ? $number_of_places : get_option('posts_per_page');

$place_ids = array();
if (!empty($categories)) {
    $place_ids = $places;
}

$category_ids = array();
if (!empty($categories)) {
    $category_ids = $categories;
}

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'fields'         => 'ids',
    'meta_key'       => 'place_info_booking_place_aggregated_rating',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
    'post_status'    => ['private', 'publish'],
    'tax_query'      => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'wcl-place',
            'field'    => 'id',
            'terms'    => $place_ids,
        ),
        array(
            'taxonomy' => 'category',
            'field'    => 'id',
            'terms'    => $category_ids,
        ),
    ),
);

$args['meta_query'] = [
    'relation' => 'AND',
    array(
        'key'     => 'place_info_booking_place_aggregated_rating',
        'compare' => 'EXISTS',
    ),
    array(
        'key'     => 'place_info_booking_place_aggregated_rating',
        'compare' => '!=',
        'value'   => '0',
        'type'    => 'NUMERIC',
    ),
];

$query_obj   = new WP_Query($args);
$total_count = $query_obj->post_count;
?>
<!-- Acf Block #15 - Automatic Generate Places with Order by Priority -->
<?php if ($query_obj->have_posts()) : ?>
    <div class="wcl-acf-block-15">
        <div class="data-container wcl-container">
            <?php
            $GLOBALS['wcl_place_counter'] = 0;
            ?>
            <div class="m4-content">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $GLOBALS['wcl_place_counter']++;

                    $args = array(
                        'block-id' => 15,
                        'place'    => get_the_ID(),
                    );

                    get_template_part('template-parts/acf-blocks/block-9', null, $args);
                    ?>
                <?php endwhile;
                $GLOBALS['wcl_place_counter'] = 0;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>