<?php

$tagline = get_field('tagline');
$title   = get_field('title');
$group_1 = get_field('group_1');
$group_2 = get_field('group_2');
?>
<!-- Acf Block #19 – The exclusive TurkishBath Pleasure at Reway -->
<div class="wcl-acf-block-19" itemscope itemtype="https://schema.org/Article">
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

        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($group_1)) : ?>
                    <?php
                    $image_1 = $group_1['image_1'];
                    $image_1 = wp_get_attachment_image($image_1, 'image-size-2');
                    $image_2 = $group_1['image_2'];
                    $image_2 = wp_get_attachment_image($image_2, 'image-size-2');
                    ?>
                    <div class="data-images" itemprop="subjectOf" itemtype="https://schema.org/ImageObject">
                        <?php if (!empty($image_1)) : ?>
                            <div class="data-images-item" itemprop="image">
                                <?php echo str_replace('<img ', '<img itemprop="url" ', $image_1); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($image_2)) : ?>
                            <div class="data-images-item" itemprop="image">
                                <?php echo str_replace('<img ', '<img itemprop="url" ', $image_2); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($group_2)) : ?>
                    <?php
                    $description = $group_2['description'];
                    $link        = $group_2['link'];
                    ?>
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
    </div>
</div>