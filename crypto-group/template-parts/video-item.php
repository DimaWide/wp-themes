<?php


$terms   = wp_get_post_terms($post->ID, 'project_category');
$image   = get_the_post_thumbnail($post->ID, 'full');
$excerpt = get_the_excerpt();

if (!empty($excerpt)) {
    if (mb_strlen($excerpt) > 120) {
        $excerpt = mb_substr($excerpt, 0, 120) . "...";
    }
}
?>
<div class="data-item <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
        <div class="data-item-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>

            <div class="data-item-play-btn">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-btn-video-2.svg'; ?>" alt="img">
            </div>
        </div>

        <div class="data-item-info">
            <h3 class="data-item-title">
                <?php echo get_the_title(); ?>
            </h3>

            <?php if (!empty($excerpt)) : ?>
                <div class="data-item-desc">
                    <?php echo $excerpt; ?>
                </div>
            <?php endif; ?>
        </div>
    </a>
</div>