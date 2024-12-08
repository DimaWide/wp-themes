<?php

$static_mode = isset($args['static-mode']) ? $args['static-mode'] : '';

$image = get_field('image');
$image = wp_get_attachment_image_url($image, 'image-size-1');

if (!empty($static_mode)) {
    $title = get_the_title();
} else {
    $title    = get_field('title');
    $subtitle = get_field('subtitle');

}
if (empty($image)) {
    $image = get_the_post_thumbnail_url($post->ID, 'image-size-1');
}
?>
<!-- Acf Block – Banner -->
<div class="wcl-acf-block-banner" style="background-image: url(<?php echo $image; ?>);">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h1 class="data-title">
                <?php echo $title; ?>
            </h1>
        <?php endif; ?>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (is_page_template('page-templates/destination.php') || is_single()) : ?>
    <?php get_template_part('template-parts/share-media'); ?>
<?php endif; ?>