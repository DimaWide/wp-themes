<?php


$align     = $args['align'];
$term_list = get_the_terms($post->ID, 'category');
$image     = get_the_post_thumbnail($post->ID, 'image-g');
$title     = get_the_title();
$desc      = get_the_excerpt();
?>
<div class="data-item <?php echo 'post-' . $post->ID . ' mod-' . $align; ?>">
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

        <div class="data-item-cat">
            <?php if (!empty($term_list)) : ?>
                <?php foreach ($term_list as $key => $value) : ?>
                    <a href="<?php echo get_term_link($value->term_id); ?>" class="data-item-cat-link">
                        <?php if (count($term_list) - 1 !=  $key) : ?>
                            <?php echo strtolower($value->name) . ','; ?>
                        <?php else : ?>
                            <?php echo strtolower($value->name); ?>
                        <?php endif; ?>
                    </a>
                <?php endforeach ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($desc)) : ?>
            <div class="data-item-desc">
                <?php echo wpautop($desc); ?>
            </div>
        <?php endif; ?>
    </div>
</div>