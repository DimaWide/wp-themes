<?php

$by         = get_sub_field('by');
$title      = get_sub_field('title');
$subtitle   = get_sub_field('subtitle');
$logo       = get_sub_field('logo');
$logo       = wp_get_attachment_image($logo, 'full');
$collection = get_sub_field('collection');
$term       = get_term_by('id', $collection, 'cd-product-collection');
?>
<?php if (!empty($term)) : ?>
    <div class="wcl-section-4">
        <div class="data-container wcl-container">
            <?php if (!empty($by)) : ?>
                <div class="data-by">
                    <?php echo $by; ?>
                </div>
            <?php endif; ?>

            <h2 class="data-title">
                <?php if (!empty($title)) : ?>
                    <?php echo $title; ?>
                <?php else : ?>
                    <?php echo $term->name; ?>
                <?php endif; ?>
            </h2>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>

            <?php
            $page_items = 5;

            $args = array(
                'post_type'           => 'cd-product',
                'posts_per_page'      => $page_items,
                'ignore_sticky_posts' => 1,
                'post_status'         => ['publish'],
            );

            $tax_query = array(
                array(
                    'taxonomy' => 'cd-product-collection',
                    'field'    => 'id',
                    'terms'    => $collection,
                )
            );
            $args['tax_query'] = $tax_query;

            $query_obj   = new WP_Query($args);
            $total_count = $query_obj->found_posts;
            ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php if ($query_obj->have_posts()) : ?>
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $image = get_the_post_thumbnail($post->ID, 'image-size-2');
                            $url   = get_field('link');
                            ?>
                            <div class="data-item swiper-slide">
                                <a href="<?php echo $url; ?>" target="_blank" class="data-item-inner" onclick="gtag('event', '<?php echo $url; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($post->ID); ?>' })">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>

                                            <div class="wcl-post-view mod-two">
                                                Shop Now
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php else : ?>
                        <div class="data-list-empty wcl-label-empty">
                            Nothing found
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-logo">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-4-logo.png'; ?>" alt="img">
            </div>

            <div class="data-link">
                <a href="<?php echo get_term_link($collection); ?>" class="wcl-link mod-light">
                    Shop The Edit
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>