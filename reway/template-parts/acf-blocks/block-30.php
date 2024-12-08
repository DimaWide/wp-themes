<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$link        = get_field('link');
$gallery     = get_field('gallery');
?>
<!-- Acf Block #30 – Sophisticated Culinary Art Filled with Striking Flavors -->
<div class="wcl-acf-block-30" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-block">
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

    <?php if (!empty($image)) : ?>
        <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($gallery)) : ?>
        <div class="data-gallery" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
            <div class="data-gallery-list">
                <?php foreach ((array)$gallery as $img_id) : ?>
                    <?php
                    $image = wp_get_attachment_image($img_id, 'image-size-2');
                    ?>
                    <?php if (!empty($image)) : ?>
                        <div class="data-gallery-item" itemprop="itemListElement">
                            <div class="data-gallery-item-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif; ?>
</div>