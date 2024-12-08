<?php

$align = isset($args['align']) ? $args['align'] : 'left';
$align = 'mod-' . $align;

$image = get_the_post_thumbnail($post->ID, 'image-size-9');

$image_empty = '';

if (empty($image)) {
    $image_empty = 'mod-empty';
}


$name        = get_field('name', $post->ID);
$place       = get_field('place', $post->ID);
$description = get_field('description', $post->ID);

$external_link = get_field('external_link', $post->ID);
$external_link = ! empty($external_link) ?  $external_link : '#';
?>
<div class="data-item <?php echo 'post-' . $post->ID . ' ' . $align; ?>">
    <div class="data-item-inner">
        <div class="data-item-image <?php echo $image_empty; ?>">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <div class="data-item-info">
            <?php if (!empty($place)) : ?>
                <div class="data-item-place">
                    <?php echo $place; ?>
                </div>
            <?php endif; ?>

            <?php if (! empty($name)): ?>
                <h2 class="data-item-name">
                    <?php echo $name; ?>
                </h2>
            <?php else: ?>
                <h2 class="data-item-name">
                    <?php echo get_the_title(); ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="data-item-desc">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <?php if (! empty($external_link) && $external_link != '#'): ?>
                <div class="data-item-link">
                    <a href="<?php echo $external_link; ?>" class="cmp-button" target="_blank">
                        Read more
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>