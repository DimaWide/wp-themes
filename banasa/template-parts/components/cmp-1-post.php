<?php

$image      = get_the_post_thumbnail($post->ID, 'image-size-3');
$image_miss = '';

if (empty($image)) {
    $image_miss = 'mod-image-miss';
}
?>
<div class="cmp-1-post data-item <?php echo $image_miss; ?> <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="cmp1-inner">
        <?php if (!empty($image)) : ?>
            <div class="cmp1-img">
                <div class="cmp1-img-inner">
                    <?php echo $image; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="cmp1-info">
            <h3 class="cmp1-title">
                <?php echo get_the_title(); ?>
            </h3>

            <div class="cmp1-arrow">
                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-red.svg', false); ?>
            </div>
        </div>
    </a>
</div>