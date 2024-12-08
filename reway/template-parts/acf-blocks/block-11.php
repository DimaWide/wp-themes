<?php

$tagline = get_field('tagline');
$title   = get_field('title');
$slider  = get_field('slider');
?>
<!-- Acf Block #11 – Experiences at Reway Ankara Club -->
<div class="wcl-acf-block-11" itemscope itemtype="https://schema.org/Article">
    <div class="data-container">
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

        <?php if (have_rows('slider')) : ?>
            <div class="data-slider swiper" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                <div class="data-slider-inner swiper-wrapper">
                    <?php while (have_rows('slider')) : the_row(); ?>
                        <?php
                        $icon        = get_sub_field('icon');
                        $tagline     = get_sub_field('tagline');
                        $title       = get_sub_field('title');
                        $description = get_sub_field('description');
                        $icon        = wp_get_attachment_image($icon, 'full');
                        ?>
                        <div class="data-item swiper-slide" itemprop="itemListElement">
                            <div class="data-item-inner">
                                <?php if (!empty($icon)) : ?>
                                    <div class="data-item-icon" itemprop="image">
                                        <?php echo $icon; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="wcl-cmp-tagline data-item-tagline">
                                    <?php echo $tagline; ?>
                                </div>

                                <?php if (!empty($title)) : ?>
                                    <h3 class="data-item-title" itemprop="name">
                                        <?php echo $title; ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($description)) : ?>
                                    <div class="wcl-cmp-desc data-item-desc">
                                        <?php echo $description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>