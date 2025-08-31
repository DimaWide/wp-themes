<?php

$title = get_field('title');

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 99,
);

$query_obj = new WP_Query($args);
$post_count = $query_obj->post_count;

if (empty($post_count)) {
    return;
}
?>
<!-- acf-3-blog – Blog -->
<div class="acf-3-blog">
    <div class="data-container wcl-container">
        <?php if (! empty($title)): ?>
            <h2 class="data-title cmp-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>
    </div>

    <div class="data-slider-out">
        <div class="data-container wcl-container">
            <?php if ($query_obj->have_posts()) : ?>
                <div class="data-slider swiper">
                    <div class="data-slider-inner swiper-wrapper">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <div class="data-slider-item swiper-slide">
                                <?php
                                $image = get_the_post_thumbnail($post->ID, 'image-size-2');
                                $desc  = !empty(get_the_excerpt()) ? get_the_excerpt() : get_the_content();
                                $desc  = strip_tags($desc);

                                $max_length = 100;
                                if (mb_strlen($desc) > $max_length) {
                                    $desc = mb_substr($desc, 0, $max_length) . '...';
                                }
                                ?>
                                <div class="data-item">
                                    <div class="data-item-inner">
                                        <div class="data-item-image">
                                            <?php if (! empty($image)): ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo $image; ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="data-item-info">
                                            <h3 class="data-item-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>

                                            <?php if (!empty($desc)) : ?>
                                                <div class="data-item-desc">
                                                    <?php echo $desc; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
        </div>
    <?php endif; ?>
    </div>
</div>