<?php

$class_block = '';

if (!empty($args)) {
    $class_block = $args['classNameBlock'];
}

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$link        = get_field('link');
$section_id  = get_field('section_id');

$style = get_field('style');
$style = !empty($style) ? $style : '';

if (!empty($style)) {
    $style = 'mod-' . $style;
}

$unique_style = get_field('unique_style');
$unique_style = !empty($unique_style) ? $unique_style : '';

if (!empty($unique_style)) {
    $unique_style = 'mod-unique-' . $unique_style;
}

?>
<!-- Acf Block #3 – A Haven of Peace and Renewal -->
<div class="wcl-acf-block-3 <?php echo $style; ?> <?php echo $unique_style; ?> <?php echo $class_block; ?>" data-id="<?php echo $section_id; ?>" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
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
                        <a href="<?php echo $link_url; ?>" class="wcl-cmp-button mod-type-1" target="<?php echo $link_target; ?>" itemprop="url">
                            <?php echo $link_title; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('list_images')) : ?>
            <div class="data-list" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                <?php while (have_rows('list_images')) : the_row(); ?>
                    <?php
                    $image = get_sub_field('image');
                    $image = wp_get_attachment_image($image, 'image-size-3');
                    ?>
                    <?php if (!empty($image)) : ?>
                        <div class="data-item" itemprop="itemListElement">
                            <div class="data-item-image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>