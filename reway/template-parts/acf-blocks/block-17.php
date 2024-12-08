<?php

$class_block = $args['classNameBlock'];

$tagline = get_field('tagline');
$title   = get_field('title');
$image   = get_field('image');
$image   = wp_get_attachment_image($image, 'image-size-1');
$info    = get_field('info');

$title_disable = '';

if (empty($tagline) && empty($title)) {
    $title_disable = 'mod-title-empty';
}
?>
<!-- Acf Block #17 – What You Will Experience at Our Reway Ankara SPA -->
<div class="wcl-acf-block-17 <?php echo $title_disable; ?> <?php echo $class_block; ?>" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="wcl-cmp-head data-head">
            <?php if (!empty($tagline)) : ?>
                <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                    <?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h2 class="wcl-cmp-title data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
        </div>

        <?php if (!empty($image)) : ?>
            <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($info)) : ?>
            <?php
            $title       = $info['title'];
            $description = $info['description'];
            ?>
            <div class="wcl-cmp-info data-info">
                <div class="data-info-inner">
                    <?php if (!empty($title)) : ?>
                        <h3 class="wcl-cmp-title data-info-title">
                            <?php echo $title; ?>
                        </h3>
                    <?php endif; ?>

                    <?php if (!empty($description)) : ?>
                        <div class="wcl-cmp-desc data-info-desc" itemprop="description">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>