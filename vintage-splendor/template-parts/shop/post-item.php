<?php


$link     = get_permalink();
$category = get_the_terms($post->ID, 'category');

$image = get_the_post_thumbnail($post->ID, 'image-size-4');

$tag_start = '<a href="' . get_permalink() . '" class="data-obj1-inner">';
$tag_end   = '</a>';

$access_to_read = 'mod-have-access';

$is_exclusive       = wcl_is_exclusive_storie();
$is_exclusive_class = '';
$popup_class        = '';

if ($is_exclusive) {
    $is_exclusive_class = 'mod-is-exclusive';
}

if (!wcl_is_subscriber() && $is_exclusive) {
    $access_to_read = 'mod-not-have-access';
    $tag_start      = '<div class="data-obj1-inner">';
    $tag_end        = '</div>';
    $popup_class    = 'js-popup-1';
} else {
    $access_to_read = 'mod-have-access';
}

$splendor_collective_subscription = get_field('splendor_collective_subscription', 'option');
?>
<div class="data-item <?php echo 'post-' . $post->ID; ?>">
    <div class="data-obj1 mod-v2 <?php echo $access_to_read . ' ' . $is_exclusive_class . ' ' . $popup_class . '  post-' . $post->ID; ?>">
        <?php echo $tag_start; ?>

        <div class="data-obj1-a">
            <?php if (!empty($image)) : ?>
                <div class="data-obj1-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-obj1-b">
            <div class="data-obj1-b-col">
                <?php if (!empty($category)) : ?>
                    <div class="data-obj1-brand">
                        <?php echo $category[0]->name; ?>
                    </div>
                <?php endif; ?>

                <h3 class="data-obj1-title">
                    <?php echo get_the_title(); ?>
                </h3>
            </div>

            <div class="data-obj1-b-col">
                <div class="data-obj1-link">
                    <?php if (!wcl_is_subscriber()) : ?>
                        <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link mod-black-to-white">
                            Join now
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </a>
                    <?php else : ?>
                        <div class="wcl-link mod-black-to-white">
                            Read more
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-obj1-logo">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo_private_black.svg'; ?>" alt="img">
            </div>
        </div>

        <?php echo $tag_end; ?>
    </div>
</div>