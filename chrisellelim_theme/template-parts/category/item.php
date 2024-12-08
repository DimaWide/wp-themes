<?php

if (!empty($args)) {
    $ajax = $args['ajax'];
}
$new = '';
if (!empty($ajax)) {
    $new = 'mod-new';
}
$image = get_the_post_thumbnail($post->ID, 'image-n');
?>
<div class="data-item <?php echo $new . ' post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink($post->ID); ?>" class="data-item-inner">
        <div class="data-item-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <h2 class="data-item-title">
            <?php echo get_the_title($post->ID); ?>
        </h2>
    </a>
</div>