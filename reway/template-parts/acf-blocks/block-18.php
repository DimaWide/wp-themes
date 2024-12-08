<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');
$image    = get_field('image');
$image    = wp_get_attachment_image($image, 'image-size-1');
$link     = get_field('link');
?>
<!-- Acf Block #18 – An Unforgettable Massage Experience in Ankara -->
<div class="wcl-acf-block-18" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="wcl-cmp-head data-head">
            <?php if (!empty($title)) : ?>
                <h2 class="wcl-cmp-title data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="wcl-cmp-desc data-subtitle" itemprop="alternativeHeadline">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($image)) : ?>
            <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list-out">
                <div class="data-list" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $title       = get_sub_field('title');
                        $description = get_sub_field('description');
                        ?>
                        <div class="data-item" itemprop="itemListElement">
                            <div class="data-item-container">
                                <div class="data-item-row">
                                    <div class="data-item-col">
                                        <?php if (!empty($title)) : ?>
                                            <h3 class="data-item-title" itemprop="name">
                                                <?php echo $title; ?>
                                            </h3>
                                        <?php endif; ?>
                                    </div>

                                    <div class="data-item-col">
                                        <?php if (!empty($description)) : ?>
                                            <div class="wcl-cmp-desc data-item-desc" itemprop="description">
                                                <?php echo $description; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
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
</div>