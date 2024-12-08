<?php


$title = get_sub_field('title');
$desc = get_sub_field('desc');
$link = get_sub_field('link');
$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'full');
?>
<div class="wcl-section-3">
    <div class="data-container wcl-container">
        <div class="data-a">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo wpautop($title); ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($desc)) : ?>
                <div class="data-desc">
                    <?php echo wpautop($desc); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($link)) : ?>
                <?php
                $link_url    = $link['url'];
                $link_title  = $link['title'];
                $link_target = $link['target'] ?: '_self';
                ?>
                <div class="data-link">
                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                        <img width="25" height="16" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-white.svg'; ?>" alt="img">
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($image)) : ?>
            <div class="data-img">
                <?php echo $image; ?>
            </div>
        <?php endif; ?>
    </div>
</div>