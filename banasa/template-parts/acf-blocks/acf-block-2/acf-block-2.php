<?php

if (display_preview_image($block)) {
    return;
}

$pages            = get_field('pages', 'option');
$projects_listing = $pages['projects_listing'];

$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-1');

$group = get_field('group');
$logo  = $group['logo'];
$title = $group['title'];
$desc  = $group['description'];

$logo = wp_get_attachment_image($logo, 'full');

$slider = get_field('slider');
?>
<!-- Acf Block #2 – Slider -->
<div class="wcl-acf-block-2">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($image)) : ?>
                <div class="data-image">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="data-info">
                <?php if (!empty($logo)) : ?>
                    <div class="data-logo">
                        <?php echo $logo; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo $desc; ?>
                    </div>
                <?php endif; ?>

                <div class="data-arrow">
                    <a href="<?php echo get_permalink($projects_listing); ?>">
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-red.svg', false); ?>
                    </a>
                </div>
            </div>

            <div class="wcl-project-symilar">
                <?php if (!empty($slider)) : ?>
                    <?php
                    $count = -1;
                    ?>
                    <div class="data-slider-out">
                        <div class="data-slider swiper">
                            <div class="data-slider-inner swiper-wrapper">
                                <?php foreach ($slider as $key => $item) : ?>
                                    <?php
                                    if (empty($item['project'])) {
                                        continue;
                                    }

                                    global $post;
                                    $image_id = $item['image'];
                                    $project  = get_post($item['project']);
                                    $post     = $project;
                                    setup_postdata($project);

                                    $count++;
                                    $terms = wp_get_post_terms($post->ID, 'project_category');
                                    $image = wp_get_attachment_image($image_id, 'image-size-2');
                                    ?>
                                    <div class="data-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
                                        <a href="<?php echo get_permalink(); ?>" class="data-item-inner" target="_blank">
                                            <div class="data-item-img">
                                                <div class="data-item-img-item">
                                                    <?php if (!empty($image)) : ?>
                                                        <?php echo $image; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="data-item-img-item mod-2">
                                                    <?php if (!empty($image)) : ?>
                                                        <?php echo $image; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="data-item-b1">
                                                <h3 class="data-item-title">
                                                    <?php echo get_the_title(); ?>
                                                </h3>

                                                <div class="data-item-b2">
                                                    <div class="data-item-b2-col">
                                                        <?php if (!is_wp_error($terms) && !empty($terms)) : ?>
                                                            <div class="data-item-cat">
                                                                <?php echo $terms[0]->name; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="data-item-arrow">
                                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-right-2.svg', false); ?>
                                                </div>
                                            </div>
                                        </a>

                                        <?php if ($count === 0) : ?>
                                            <div class="data-slider-arrow">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-2.svg'; ?>" alt="img">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach;

                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>