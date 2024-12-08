<?php


$title       = get_field('title');
$tagline     = get_field('tagline');
$description = get_field('description');

$type_heading = get_field('type_heading');
$type_heading = !empty($type_heading) ? $type_heading : 'h2';
?>
<!-- Acf Block #2 – An Extraordinary World Awaiting Discovery -->
<div class="wcl-acf-block-2 <?php echo 'mod-heading-' . $type_heading; ?>" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($tagline)) : ?>
            <div class="data-tagline-out">
                <?php if (!empty($type_heading) && $type_heading == 'h1') : ?>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/marker.svg'; ?>" alt="img">
                    <h1 class="wcl-cmp-tagline data-tagline" itemprop="headline">
                        <?php echo $tagline; ?>
                    </h1>
                <?php else : ?>
                    <div class="wcl-cmp-tagline data-tagline" itemprop="headline">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/marker.svg'; ?>" alt="img"><?php echo $tagline; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <h2 class="wcl-cmp-title data-title" itemprop="alternativeHeadline">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>
    </div>

    <?php if (!empty($description)) : ?>
        <div class="data-container wcl-container">
            <div class="wcl-cmp-info data-info">
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (have_rows('list')) : ?>
        <div class="data-list" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
            <?php while (have_rows('list')) : the_row(); ?>
                <?php
                $image = get_sub_field('image');
                $image = wp_get_attachment_image($image, 'image-size-2');
                $title = get_sub_field('title');

                $slide_to_section = get_sub_field('slide_to_section');
                ?>
                <div class="data-item" data-target="<?php echo $slide_to_section; ?>" itemprop="itemListElement">
                    <?php if (!empty($image)) : ?>
                        <div class="data-item-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <div class="data-item-title" itemprop="name">
                            <?php echo $title; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>