<?php


$image = get_the_post_thumbnail($post->ID, 'image-size-2');
$terms = ordered_categories();
?>
<div class="m1-item js-post-item <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="m1-item-inner">
        <div class="m1-item-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </div>

        <div class="m1-item-content">
            <?php if (!empty($terms)) : ?>
                <div class="m1-item-cats">
                    <?php foreach ($terms as $term_id => $count) : ?>
                        <?php
                        $term = get_category($term_id);
                        ?>
                        <div class="m1-item-cats-item">
                            <?php echo $term->name; ?>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <h3 class="m1-item-title js-post-item-title">
                <?php echo get_the_title(); ?>
            </h3>
        </div>
    </a>
</div>