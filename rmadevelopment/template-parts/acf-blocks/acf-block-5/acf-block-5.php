<?php

if (display_preview_image($block)) {
    return;
}

$title    = get_field('title');
$subtitle = get_field('subtitle');
$link     = get_field('link');

$args = array(
    'post_type'      => 'project',
    'posts_per_page' => -1,
);

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<!-- Acf Block #5 – Recent projects -->
<div class="wcl-acf-block-5">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>

        <?php if ($query_obj->have_posts()) : ?>
            <?php
            global $post;
            ?>
            <div class="data-slider-out">
                <div class="data-lines">
                    <div class="line-container" data-length="570" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                </div>

                <div class="data-slider swiper">
                    <div class="data-slider-inner swiper-wrapper">
                        <?php
                        $posts_html = [];

                        while ($query_obj->have_posts()) :
                            $query_obj->the_post();

                            ob_start();

                            $image         = get_the_post_thumbnail($post->ID, 'image-size-3');
                            // $external_link = get_field('external_link', $post->ID);
                            // $external_link = ! empty($external_link) ?  $external_link : '#';
                            // $target = 'target="_blank"';

                            $external_link = site_url('/recent-projects/');

                            // if ($external_link == '#') {
                            //     $target        = '';
                            // }

                            $thumb_id = get_post_thumbnail_id($post->ID);
                            $image_metadata = wp_get_attachment_metadata($thumb_id);

                            if ($image_metadata) {
                                $width = $image_metadata['width'];
                                $height = $image_metadata['height'];

                                if ($height > $width) {
                                    $class = 'vertical-image';
                                } else {
                                    $class = 'horizontal-image';
                                }
                            }
                        ?>
                            <div class="data-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
                                <a href="<?php echo $external_link; ?>" class="data-item-inner">
                                    <h3 class="data-item-title">
                                        <?php echo get_the_title(); ?>
                                    </h3>

                                    <div class="data-item-img <?php echo $class; ?>">
                                        <?php if (!empty($image)) : ?>
                                            <?php echo $image; ?>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        <?php
                            // Capture the output and store it in the array
                            $posts_html[] = ob_get_clean();

                        endwhile;
                        wp_reset_postdata();

                        // Calculate how many posts we need to reach 10
                        $posts_count = count($posts_html);
                        $needed_posts = 15 - $posts_count;

                        // If there are fewer than 10 posts, duplicate the stored HTML markup
                        if ($needed_posts > 0) {
                            $duplicated_posts = [];
                            for ($i = 0; $i < $needed_posts; $i++) {
                                $duplicated_posts[] = $posts_html[$i % $posts_count]; // Reuse posts in order
                            }
                            // Merge original HTML with duplicated HTML
                            $posts_html = array_merge($posts_html, $duplicated_posts);
                        }

                        // Output the final HTML for all posts (including duplicates)
                        echo implode('', $posts_html);
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link">
                <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                    <?php echo $link_title; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>