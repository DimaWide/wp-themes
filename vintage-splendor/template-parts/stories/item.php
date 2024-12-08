<?php

$current_tag_nav = $args['tag'];

$tags  = get_the_tags($post->ID, 'post_tag');
$image = get_the_post_thumbnail($post->ID, 'image-size-5');

$tag_start = '<a href="' . get_permalink() . '" class="t5-inner">';
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
    $tag_start      = '<div class="t5-inner">';
    $tag_end        = '</div>';
    $popup_class    = 'js-popup-1';
    $logo           = get_field('logo_private', 'option');
} else {
    $access_to_read = 'mod-have-access';
    $logo           = get_field('logo', 'option');
}

$logo = wp_get_attachment_image_url($logo, 'full');

$stories_tag = get_query_var('stories_tag');

if (!empty($current_tag_nav) && $current_tag_nav != 'all') {
    $stories_tag = $current_tag_nav;
}
?>
<div class="wcl-t5-storie data-item <?php echo $access_to_read . ' ' . $is_exclusive_class . ' ' . $popup_class . '  post-' . $post->ID; ?>">
    <?php echo $tag_start; ?>

    <?php if (!empty($image)) : ?>

        <div class="t5-a">
            <div class="t5-img">
                <?php if (!empty($image)) : ?>
                    <?php echo $image; ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($logo)) : ?>
                <div class="t5-logo">
                    <?php echo file_get_contents($logo, false); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="t5-b">
        <?php if ($is_exclusive) : ?>
            <div class="t5-cat wcl-link-cat mod-gradient">
                <span>
                    Splendor Collective
                </span>
            </div>
        <?php else : ?>
            <?php if (!empty($tags)) : ?>
                <?php if (!empty($stories_tag)) : ?>
                    <?php
                    $tag_name = '';
                    foreach ($tags as $tags_item) {
                        if ($tags_item->slug == $stories_tag) {
                            $tag_name = $tags_item->name;
                        }
                    }
                    ?>
                    <div class="t5-cat wcl-link-cat">
                        <span>
                            <?php echo $tag_name; ?>
                        </span>
                    </div>
                <?php else : ?>
                    <div class="t5-cat wcl-link-cat">
                        <span>
                            <?php echo $tags[0]->name; ?>
                        </span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <h3 class="t5-title">
            <?php echo get_the_title(); ?>
        </h3>

        <div class="t5-link wcl-link-underline">
            Read
        </div>
    </div>

    <?php echo $tag_end; ?>
</div>