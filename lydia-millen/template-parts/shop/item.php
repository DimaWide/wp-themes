<?php

$link          = get_field('link');
$image         = get_the_post_thumbnail($post->ID, 'image-size-2');
$related_posts = get_post_meta(get_the_ID(), 'related_posts', true);
$related_posts = checkPostsStatus($related_posts);

if (!empty($related_posts)) {
    $related_posts = 'data-related-posts="' .  esc_attr(json_encode($related_posts)) . '"';
} else {
    $related_posts = '';
}
?>
<div class="data-item wcl-product <?php echo 'post-' . $post->ID; ?>" <?php echo $related_posts; ?>>
    <a href="<?php echo $link; ?>" class="d4-inner" target="_blank" onclick="gtag('event', '<?php echo $link; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($post->ID); ?>' })">
        <?php if (!empty($related_posts)) : ?>
            <div class="d4-binding">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/product-bind-ico.svg'; ?>" alt="img">
            </div>
        <?php endif; ?>

        <?php if (!empty($image)) : ?>
            <div class="d4-img">
                <?php echo $image; ?>

                <div class="wcl-post-view mod-two">
                    Shop Now
                </div>
            </div>
        <?php endif; ?>

        <div class="d4-title">
            <?php echo get_the_title(); ?>
        </div>
    </a>
</div>