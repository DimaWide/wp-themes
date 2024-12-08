<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'image-size-6');
?>
<!-- Acf Block #20 – A Unique Sauna Experience at Reway Ankara SPA -->
<div class="wcl-acf-block-20" itemscope itemtype="https://schema.org/Article">
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

        <div class="data-block">
            <?php if (!empty($image)) : ?>
                <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-info data-info">
                    <div class="wcl-cmp-desc data-desc" itemprop="description">
                        <?php echo $description; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>