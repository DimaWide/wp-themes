<?php

get_header();

$places_by_rating = get_field('show_the_best_places_by_rating');

if (!empty($places_by_rating)) {
    $enable           = $places_by_rating['enable'];
    $number_of_places = $places_by_rating['number_of_places'];
}
?>
<div class="wcl-destination wcl-page page-template-destination">
    <div class="m4-container wcl-container">
        <div class="m4-row">
            <div class="m4-col">
                <?php if (!empty($enable)) : ?>
                    <?php get_template_part('template-parts/acf-blocks/block-banner', null, ['static-mode' => true]); ?>

                    <?php
                    $page_items = !empty($number_of_places) ? $number_of_places : get_option('posts_per_page');

                    $terms_place = get_the_terms($post->ID, 'wcl-place');
                    $terms_place_ids = array();
                    if ($terms_place && !is_wp_error($terms_place)) {
                        foreach ($terms_place as $term) {
                            $terms_place_ids[] = $term->term_id;
                        }
                    }

                    $terms_category = get_the_terms($post->ID, 'category');
                    $terms_category_ids = array();
                    if ($terms_category && !is_wp_error($terms_category)) {
                        foreach ($terms_category as $term) {
                            $terms_category_ids[] = $term->term_id;
                        }
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
                                'terms'    => $terms_place_ids,
                                'operator' => 'IN',
                            ),
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'id',
                                'terms'    => $terms_category_ids,
                                'operator' => 'IN',
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
                    <?php if ($query_obj->have_posts()) : ?>
                        <?php
                        $GLOBALS['wcl_place_counter'] = 0;
                        ?>
                        <div class="m4-content">
                            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                <?php
                                $GLOBALS['wcl_place_counter']++;

                                $args = array(
                                    'block-id' => 'listing',
                                    'place'    => get_the_ID(),
                                );

                                get_template_part('template-parts/acf-blocks/block-9', null, $args);
                                ?>
                            <?php endwhile;
                            $GLOBALS['wcl_place_counter'] = 0;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="m4-content">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>

                <?php get_template_part('template-parts/share-media'); ?>
            </div>

            <div class="m4-col">
                <?php get_template_part('template-parts/sidebar'); ?>
            </div>
        </div>

        <?php get_template_part('template-parts/best-restaurants'); ?>
    </div>
</div>


<?php
get_footer();
?>