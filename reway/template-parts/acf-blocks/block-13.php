<?php

$title = get_field('title');
$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-1');
$group = get_field('group');
?>
<!-- Acf Block #13 – Reway Offers Four Levels of Privilege -->
<div class="wcl-acf-block-13" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title" itemprop="headline">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($group)) : ?>
            <?php
            $title       = $group['title'];
            $description = $group['description'];
            ?>
            <div class="data-info">
                <div class="data-info-col">
                    <?php if (!empty($title)) : ?>
                        <h3 class="data-title-two" itemprop="alternativeHeadline">
                            <?php echo $title; ?>
                        </h3>
                    <?php endif; ?>
                </div>

                <div class="data-info-col">
                    <?php if (!empty($description)) : ?>
                        <div class="wcl-cmp-desc data-desc" itemprop="description">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($image)) : ?>
        <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
        </div>
    <?php endif; ?>
</div>