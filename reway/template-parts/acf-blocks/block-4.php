<?php

$tagline          = get_field('tagline');
$title            = get_field('title');
$description      = get_field('description');
$link             = get_field('link');
$background_image = get_field('background_image');
$background_image = wp_get_attachment_image($background_image, 'image-size-1');
?>
<!-- Acf Block #4 – Reway Club -->
<div class="wcl-acf-block-4" itemscope itemtype="https://schema.org/Article">
    <div class="data-container">
        <div class="data-info">
            <?php if (!empty($tagline)) : ?>
                <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                    <?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h2 class="wcl-cmp-title data-title mod-unique" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($link)) : ?>
                <?php
                $link_url    = $link['url'];
                $link_title  = $link['title'];
                $link_target = $link['target'] ?: '_self';
                ?>
                <div class="data-link">
                    <a href="<?php echo $link_url; ?>" class="wcl-cmp-button mod-type-1" target="<?php echo $link_target; ?>" itemprop="url">
                        <?php echo $link_title; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($background_image)) : ?>
        <div class="data-bg-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <?php echo str_replace('<img ', '<img itemprop="url" ', $background_image); ?>
        </div>
    <?php endif; ?>
</div>