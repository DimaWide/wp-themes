<?php

$title       = get_field('title');
$description = get_field('description');
$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'image-size-1');
?>
<!-- Acf Block #5 – Privileged Services -->
<div class="wcl-acf-block-5" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-group">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($image)) : ?>
        <div class="data-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
        </div>
    <?php endif; ?>
</div>