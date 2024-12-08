<?php



$image   = get_the_post_thumbnail($post->ID, 'image-size-2');
$excerpt = get_the_excerpt();

if (empty($excerpt)) {
    $content = get_the_content();
    $excerpt = mb_strimwidth($content, 0, 80);
} else {
    $excerpt = mb_strimwidth($excerpt, 0, 80);
}
?>
<div class="cmp-4-post data-item">
    <a href="<?php echo get_permalink(); ?>" class="cmp4-inner">
        <div class="cmp4-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <h3 class="cmp4-title">
            <?php echo get_the_title(); ?>
        </h3>

        <?php if (!empty($excerpt)) : ?>
            <div class="cmp4-desc">
                <?php echo $excerpt; ?>
            </div>
        <?php endif; ?>

        <div class="cmp4-read">
            Читати далі
        </div>
    </a>
</div>