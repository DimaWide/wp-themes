<?php

$subtitle   = get_field('subtitle');
$image      = get_the_post_thumbnail($post->ID, 'image-size-3');
$logo_third = get_field('logo_third', 'option');
$logo_third = wp_get_attachment_image($logo_third, 'full');
$desc       = get_the_excerpt();
?>
<div class="wcl-acf-block-1">
    <div class="data-inner">
        <div class="data-container wcl-container">
            <div class="data-col">
                <h1 class="data-title">
                    <?php echo strtolower(get_the_title()); ?>
                </h1>

                <?php if (!empty($subtitle)) : ?>
                    <div class="data-subtitle">
                        <?php echo $subtitle; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-date">
                <?php echo get_the_date('j\t\h\ F Y'); ?>
            </div>

            <?php if (!empty($logo_third)) : ?>
                <div class="data-logo">
                    <?php echo $logo_third; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($desc)) : ?>
                <div class="data-desc">
                    <?php echo $desc; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>