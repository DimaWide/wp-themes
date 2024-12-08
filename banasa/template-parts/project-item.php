<?php


$terms   = wp_get_post_terms($post->ID, 'project_category');
$image   = get_the_post_thumbnail($post->ID, 'image-size-4');
$excerpt = get_the_excerpt();

if (!empty($excerpt)) {
    if (mb_strlen($excerpt) > 400) {
        $excerpt = mb_substr($excerpt, 0, 400) . "...";
    }
}
?>
<div class="data-item <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
        <div class="data-item-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <div class="data-item-b1">
            <h3 class="data-item-title">
                <?php echo get_the_title(); ?>
            </h3>

            <?php if (!empty($excerpt)) : ?>
                <div class="data-item-desc">
                    <div class="data-item-desc-inner">
                        <?php echo $excerpt; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="data-item-b2">
                <div class="data-item-b2-col">
                    <?php if (!is_wp_error($terms) && !empty($terms)) : ?>
                        <div class="data-item-cat">
                            <?php echo $terms[0]->name; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-item-b2-col">
                    <div class="data-item-arrow">
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-right.svg', false); ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>