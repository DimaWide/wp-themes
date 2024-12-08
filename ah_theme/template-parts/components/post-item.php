<?php


$image = get_the_post_thumbnail($post->ID, 'image-size-3');
$terms = ordered_categories();
?>
<div class="wcl-post-item data-item js-post-item <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="m3-inner">
        <div class="m3-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <div class="m3-content">
            <?php if (!empty($terms)) : ?>
                <div class="m3-cats js-cats-post">
                    <?php foreach ($terms as $term_id => $count) : ?>
                        <?php
                        $term = get_category($term_id);
                        ?>
                        <div class="m3-cats-item">
                            <?php echo $term->name; ?>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <h3 class="m3-title js-post-item-title">
                <?php echo get_the_title(); ?>
            </h3>

            <?php
            $excerpt = get_the_excerpt();
            ?>
            <?php if (!empty($excerpt)) : ?>
                <?php
                $excerpt = mb_strimwidth($excerpt, 0, 150, '...');
                ?>
                <div class="m3-desc js-post-item-desc">
                    <?php echo $excerpt; ?>
                </div>
            <?php endif; ?>

            <div class="m3-meta">
                <div class="m3-date">
                    <?php echo get_the_date('j M Y'); ?>
                </div>

                <div class="m3-time-read">
                    <?php echo reading_time($post->ID) . ' Read'; ?>
                </div>
            </div>
        </div>
    </a>
</div>