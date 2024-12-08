<?php

$tagline           = get_field('tagline');
$title             = get_field('title');
$description       = get_field('description');
$image             = get_field('image');
$image             = wp_get_attachment_image($image, 'image-size-1');
$hotel_information = get_field('hotel_information', 'option');

$type_heading = get_field('type_heading');
$type_heading = !empty($type_heading) ? $type_heading : 'h2';
?>
<!-- Acf Block #34 – Journey to Health with Reway Ankara -->
<div class="wcl-acf-block-34 wcl-acf-block-22" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="wcl-cmp-info data-info">
            <?php if (!empty($tagline)) : ?>
                <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                    <?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <?php if ($type_heading == 'h1') : ?>
                    <h1 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h1>
                <?php else : ?>
                    <h2 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($image)) : ?>
        <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
        </div>
    <?php endif; ?>
</div>