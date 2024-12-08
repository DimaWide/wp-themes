<?php

$align     = $args['align'];
$term_list = get_the_terms($post->ID, 'category');
$post_type = get_post_type($post->ID);
$image     = get_the_post_thumbnail($post->ID, 'image-g');
$section_4 = get_field('section_4');
$title     = get_the_title();
$desc      = get_the_excerpt();
?>
<div class="data-item <?php echo 'mod-' . $align; ?>">
    <div class="data-item-a">
        <?php if (!empty($image)) : ?>
            <div class="data-item-img">
                <a href="<?php echo get_permalink(); ?>">
                    <?php echo $image; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="data-item-b">
        <?php if (!empty($title)) : ?>
            <h2 class="data-item-title">
                <a href="<?php echo get_permalink(); ?>">
                    <?php echo wpautop($title); ?>
                </a>
            </h2>
        <?php endif; ?>

        <?php if (!empty($term_list)) : ?>
            <div class="data-item-cat">
                <?php foreach ($term_list as $key => $value) : ?>
                    <a href="<?php echo get_term_link($value->term_id); ?>" class="data-item-cat-link">
                        <?php if (count($term_list) - 1 !=  $key) : ?>
                            <?php echo strtolower($value->name) . ','; ?>
                        <?php else : ?>
                            <?php echo strtolower($value->name); ?>
                        <?php endif; ?>
                    </a>
                <?php endforeach ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($desc)) : ?>
            <div class="data-item-desc">
                <?php echo wpautop($desc); ?>
            </div>
        <?php endif; ?>
    </div>
</div>