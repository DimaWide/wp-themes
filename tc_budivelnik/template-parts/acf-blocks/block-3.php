<?php

$title = get_field('title');

$args = array(
    'post_type'      => 'wcl-review',
    'posts_per_page' => 100,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'status',
            'value'   => 'approved',
            'compare' => 'LIKE',
        ),
    ),
);

$query_obj   = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<!-- Acf Block #3 – Відгуки наших клієнтів -->
<div class="wcl-acf-block-3">
    <div class="data-container wcl-container">
        <div class="cmp-1-heading">
            <?php if (!empty($title)) : ?>
                <h2 class="cmp1-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <div class="cmp1-link">
                <div class="cmp-button mod-white mod-hover-3 js-popup-open" data-target="review-form">
                    Залишити відгук
                </div>
            </div>
        </div>

        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-slider-out">
                <div class="data-slider swiper">
                    <div class="data-slider-inner swiper-wrapper">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $name        = get_field('name', $post->ID);
                            $description = get_field('description', $post->ID);
                            $rating      = get_field('rating', $post->ID);
                            $avatar_url  = get_field('avatar_url', $post->ID);
                            $status      = get_field('status', $post->ID);

                            $use_custom_avatar = get_field('use_custom_avatar', $post->ID);
                            $custom_avatar     = get_field('custom_avatar', $post->ID);

                            if (!empty($use_custom_avatar)) {
                                $custom_avatar = wp_get_attachment_image($custom_avatar, 'image-size-3');
                            }
                            ?>
                            <div class="data-item swiper-slide">
                                <div class="data-item-inner">
                                    <div class="data-item-b1">
                                        <div class="data-item-img">
                                            <?php if (!empty($use_custom_avatar) && !empty($custom_avatar)) : ?>
                                                <?php echo $custom_avatar; ?>
                                            <?php else : ?>
                                                <?php if (!empty($avatar_url)) : ?>
                                                    <img src="<?php echo $avatar_url; ?>" alt="avatar">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>

                                        <div class="data-item-b1-info">
                                            <?php if (!empty($name)) : ?>
                                                <div class="data-item-name">
                                                    <?php echo $name; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="data-item-b1-e1">
                                                <?php if (!empty($rating)) : ?>
                                                    <?php
                                                    $rating = round((float)$rating);
                                                    ?>
                                                    <div class="data-item-rating">
                                                        <?php

                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i > 5) {
                                                                break;
                                                            }
                                                        ?>
                                                            <?php if ($rating >= $i) : ?>
                                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/star-ico.svg'; ?>" alt="img">
                                                            <?php endif; ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="data-item-date">
                                                    <?php echo time_ago_in_ukrainian(get_the_time('U')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($description)) : ?>
                                        <div class="data-item-desc">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="data-slider-nav">
                    <div class="data-slider-nav-btn mod-prev">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf3-arrow-left.svg'; ?>" alt="img">
                    </div>

                    <div class="data-slider-nav-btn mod-next">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf3-arrow-left.svg'; ?>" alt="img">
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="data-link">
            <div class="cmp-button mod-white js-popup-open" data-target="review-form">
                Залишити відгук
            </div>
        </div>
    </div>
</div>