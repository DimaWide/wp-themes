<?php

$tagline = get_field('tagline');
$title   = get_field('title');
$group_1 = get_field('group_1');
$group_2 = get_field('group_2');
?>
<!-- Acf Block #23 – Experiences at Reway Ankara Sports -->
<div class="wcl-acf-block-23" itemscope itemtype="https://schema.org/Article">
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

        <div class="data-list">
            <?php if (!empty($group_1)) : ?>
                <?php
                $tagline     = $group_1['tagline'];
                $description = $group_1['description'];
                $title       = $group_1['title'];
                $image       = $group_1['image'];
                $image       = wp_get_attachment_image($image, 'image-size-3');
                ?>
                <div class="data-item" itemprop="subjectOf" itemscope itemtype="https://schema.org/Article">
                    <div class="data-item-head">
                        <?php if (!empty($tagline)) : ?>
                            <div class="wcl-cmp-tagline data-item-tagline" itemprop="alternativeHeadline">
                                <?php echo $tagline; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="wcl-cmp-desc data-item-desc" itemprop="description">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($title)) : ?>
                        <h2 class="wcl-cmp-title data-item-title" itemprop="headline">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($image)) : ?>
                        <div class="data-item-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($group_2)) : ?>
                <?php
                $tagline     = $group_2['tagline'];
                $description = $group_2['description'];
                $title       = $group_2['title'];
                $image       = $group_2['image'];
                $image       = wp_get_attachment_image($image, 'image-size-3');
                ?>
                <div class="data-item" itemprop="subjectOf" itemscope itemtype="https://schema.org/Article">
                    <div class="data-item-head">
                        <?php if (!empty($tagline)) : ?>
                            <div class="wcl-cmp-tagline data-item-tagline" itemprop="alternativeHeadline">
                                <?php echo $tagline; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="wcl-cmp-desc data-item-desc" itemprop="description">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($title)) : ?>
                        <h2 class="wcl-cmp-title data-item-title" itemprop="headline">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($image)) : ?>
                        <div class="data-item-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>