<?php

if (display_preview_image($block)) {
    return;
}

$tagline = get_field('tagline');
$title   = get_field('title');
?>
<!-- Acf Block #4 – Latest news -->
<div class="wcl-acf-block-4">
    <div class="data-container wcl-container">
        <?php if (!empty($tagline)) : ?>
            <div class="data-tagline">
                <?php echo $tagline; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
        );

        $query_obj  = new WP_Query($args);
        $post_count = $query_obj->post_count;
        ?>
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list-out">
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        global $post;
                        $image = get_the_post_thumbnail($post->ID, 'image-size-3');

                        $image_miss = '';

                        if (empty($image)) {
                            $image_miss = 'mod-image-miss';
                        }
                        ?>
                        <div class="data-item <?php echo $image_miss; ?> <?php echo 'post-' . $post->ID; ?>">
                            <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <div class="data-item-img-inner">
                                            <?php echo $image; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="data-item-info">
                                    <h3 class="data-item-title">
                                        <?php echo get_the_title(); ?>
                                    </h3>

                                    <div class="data-item-arrow">
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-red.svg', false); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>