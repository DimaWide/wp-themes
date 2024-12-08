<?php

$title       = get_field('title');
$description = get_field('description');
$link        = get_field('link');
$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'image-size-1');
?>
<!-- Acf Block #37 – For a Stronger and Fitter Body, Choose Reway -->
<div class="wcl-acf-block-37" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($image)) : ?>
            <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
            </div>
        <?php endif; ?>

        <div class="wcl-cmp-head data-head">
            <?php if (!empty($title)) : ?>
                <h2 class="wcl-cmp-title data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>

    <div class="data-cotainer-two wcl-container">
        <?php if (!empty($description) || !empty($link)) : ?>
            <div class="wcl-cmp-info data-info">
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
                        <button class="wcl-cmp-button js-popup-open" data-target="make-a-reservation">
                            <?php echo $link_title; ?>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>