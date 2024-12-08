<?php

$tags = get_the_terms($post->ID, 'post_tag');
$tags = wp_list_pluck($tags, 'slug');

if (empty($tags)) {
    $tags = [''];
}

$page_items = 3;
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'post__not_in'   => [get_the_ID()],
    'post_status'    => 'publish',
);

$tax_query = array(
    array(
        'taxonomy' => 'post_tag',
        'field'    => 'slug',
        'terms'    => $tags,
    )
);
$args['tax_query'] = $tax_query;

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<?php if (!empty($total_count)) : ?>
    <div class="wcl-related-posts">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                Related
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <div class="data-list swiper">
                    <div class="data-list-inner swiper-wrapper">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $image = get_the_post_thumbnail($post->ID, 'image-size-9');
                            $logo  = get_field('logo_private_black', 'option');
                            $logo  = wp_get_attachment_image($logo, 'full');

                            $tag_start = '<a href="' . get_permalink() . '" class="data-item-inner">';
                            $tag_end   = '</a>';

                            $access_to_read = 'mod-have-access';

                            $is_exclusive       = wcl_is_exclusive_storie();
                            $is_exclusive_class = '';
                            $popup_class        = '';

                            if ($is_exclusive) {
                                $is_exclusive_class = 'mod-is-exclusive';
                            }

                            if (!wcl_is_subscriber() && $is_exclusive) {
                                $access_to_read = 'mod-not-have-access';
                                $tag_start      = '<div class="data-item-inner">';
                                $tag_end        = '</div>';
                                $popup_class    = 'js-popup-1';
                            } else {
                                $access_to_read = 'mod-have-access';
                            }
                            ?>
                            <div class="data-col swiper-slide">
                                <div class="data-item <?php echo $access_to_read . ' ' . $is_exclusive_class . ' ' . $popup_class . '  post-' . $post->ID; ?>">
                                    <?php echo $tag_start; ?>

                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="data-item-content">
                                        <h3 class="data-item-title">
                                            <?php echo get_the_title(); ?>
                                        </h3>

                                        <div class="data-item-link">
                                            <div class="wcl-link-underline">
                                                Read
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($logo && $access_to_read == 'mod-not-have-access')) : ?>
                                        <div class="data-item-logo">
                                            <?php echo $logo; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php echo $tag_end; ?>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>