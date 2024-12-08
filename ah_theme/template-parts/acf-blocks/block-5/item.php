<?php


$image = get_the_post_thumbnail($post->ID, 'image-size-4');
$terms = ordered_categories();
?>
<div class="data-item js-post-item <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
        <div class="data-item-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <div class="data-item-content">
            <?php if (!empty($terms)) : ?>
                <div class="data-item-cats js-cats-post">
                    <?php foreach ($terms as $term_id => $count) : ?>
                        <?php
                        $term = get_category($term_id);
                        ?>
                        <div class="data-item-cats-item">
                            <?php echo $term->name; ?>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <h3 class="data-item-title">
                <span class="js-post-item-title">
                    <?php echo get_the_title(); ?>
                </span>

                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-up-right-white.svg'; ?>" alt="img">
            </h3>

            <?php
            $excerpt = get_the_excerpt();
            ?>
            <?php if (!empty($excerpt)) : ?>
                <?php
                $excerpt = mb_strimwidth($excerpt, 0, 300, '...');
                ?>
                <div class="data-item-desc js-post-item-desc">
                    <?php echo $excerpt; ?>
                </div>
            <?php endif; ?>

            <div class="data-item-meta">
                <div class="data-item-meta-label">
                    Published on
                </div>

                <div class="data-item-meta-values">
                    <span class="data-item-date">
                        <?php echo get_the_date('j M Y'); ?>
                    </span>

                    <span class="data-item-time-read">
                        <?php echo ' <span class="data-item-meta-dot">&nbsp;&#183;&nbsp;</span> ' . reading_time($post->ID) . ' Read'; ?>
                    </span>
                </div>
            </div>
        </div>
    </a>
</div>