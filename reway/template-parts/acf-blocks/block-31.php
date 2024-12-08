<?php

$note        = get_field('note');
$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'image-size-1');
?>
<!-- Acf Block #31 – Effective Weight Control with Our Experienced Dietitians -->
<div class="wcl-acf-block-31" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($note)) : ?>
            <div class="data-note" itemprop="text">
                <div class="data-note-inner">
                    <?php echo $note; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="wcl-cmp-head data-head">
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
        </div>

        <?php if (!empty($image)) : ?>
            <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $title = get_sub_field('title');
                    ?>
                    <?php if (!empty($title)) : ?>
                        <div class="data-item" itemprop="itemListElement">
                            <h3 class="data-item-title" itemprop="name">
                                <?php echo $title; ?>
                            </h3>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>