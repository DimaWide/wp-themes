<?php

$title = get_sub_field('title');
$desc = get_sub_field('desc');
$link_1 = get_sub_field('link_1');
$link_2 = get_sub_field('link_2');
$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'full');
?>
<div class="wcl-section-1">
    <div class="data-container wcl-container">
        <div class="data-a">
            <?php if (!empty($title)) : ?>
                <h1 class="data-title">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>

            <?php if (!empty($desc)) : ?>
                <div class="data-desc">
                    <?php echo wpautop($desc); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($image)) : ?>
                <div class="data-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="data-links">
                <div class="data-links-item">
                    <?php if (!empty($link_1)) : ?>
                        <?php
                        $link_url    = $link_1['url'];
                        $link_title  = $link_1['title'];
                        $link_target = $link_1['target'] ?: '_self';
                        ?>
                        <a href="<?php echo $link_url; ?>" class="wcl-link mod-b" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                            <img width="25" height="16" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-black.svg'; ?>" alt="img">
                        </a>
                    <?php endif; ?>
                </div>

                <div class="data-links-item">
                    <?php if (!empty($link_2)) : ?>
                        <?php
                        $link_url    = $link_2['url'];
                        $link_title  = $link_2['title'];
                        $link_target = $link_2['target'] ?: '_self';
                        ?>
                        <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                            <img width="25" height="16" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-white.svg'; ?>" alt="img">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>