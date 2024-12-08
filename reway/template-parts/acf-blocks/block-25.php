<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$gallery     = get_field('gallery');
?>
<!-- Acf Block #25 – Meet Your NASM Certified Personal Sports Trainer -->
<div class="wcl-acf-block-25" itemscope itemtype="https://schema.org/Article">
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

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-info data-info">
                    <div class="wcl-cmp-desc data-desc" itemprop="description">
                        <?php echo $description; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="data-container-two wcl-container">
        <?php if (!empty($gallery)) : ?>
            <div class="data-list-out">
                <div class="data-list" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                    <?php foreach ((array)$gallery as $img_id) : ?>
                        <?php
                        $image = wp_get_attachment_image($img_id, 'image-size-3');
                        ?>
                        <?php if (!empty($image)) : ?>
                            <div class="data-item" itemprop="itemListElement">
                                <div class="data-item-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                    <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>