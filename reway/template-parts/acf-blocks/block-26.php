<?php

$title       = get_field('title');
$description = get_field('description');
$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'image-size-1');
$link        = get_field('link');
?>
<!-- Acf Block #26 – Discipline, Order, Motivation. -->
<div class="wcl-acf-block-26" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-block">
                <?php if (!empty($title)) : ?>
                    <h2 class="wcl-cmp-title data-title" itemprop="headline">
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
                        <button class="wcl-cmp-button js-popup-open" data-target="make-a-reservation">
                            <?php echo $link_title; ?>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($image)) : ?>
                <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>