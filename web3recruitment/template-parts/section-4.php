<?php


$title = get_sub_field('title');
$desc = get_sub_field('desc');
$link = get_sub_field('link');
$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'full');
?>
<div class="wcl-section-4">
    <div class="data-el"></div>
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <div class="data-row">
            <?php if (!empty($link)) : ?>
                <?php
                $link_url    = $link['url'];
                $link_title  = $link['title'];
                $link_target = $link['target'] ?: '_self';
                ?>
                <div class="data-link">
                    <a href="<?php echo $link_url; ?>" class="wcl-link mod-b" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                        <img width="25" height="16" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-black.svg'; ?>" alt="img">
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($image)) : ?>
                <div class="data-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($desc)) : ?>
                <div class="data-desc">
                    <div class="data-desc-inner">
                        <?php echo wpautop($desc); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>