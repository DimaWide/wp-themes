<?php

$post_type = $args['post_type'];
$image     = get_the_post_thumbnail($post->ID, 'image-size-2');
$link      = '';
$target    = '';
$text_view = 'View Post';

if ($post_type == 'cd-product') {
    $text_view = 'Shop Now';
    $link   = get_field('link');
    $target = '_blank';
} elseif ($post_type == 'cd-video') {
    $text_view = 'View Video';
    $videos_ids = $args['videos_ids'];
    $index_video = array_search(get_the_ID(), $videos_ids);
    $page_num    = ceil(($index_video + 1) / 9);
    if ($page_num > 1) {
        $page_num = '/page/' . $page_num;
    } else {
        $page_num = '';
    }
    $link = site_url('/') . 'video' . $page_num  . '#video-' . get_the_ID();
} else {
    $link = get_permalink();
}
?>
<div class="data-item <?php echo 'post-' . $post->ID . ' mod-post-type-' . $post_type; ?>">
    <a href="<?php echo $link; ?>" class="data-item-inner" target="<?php echo $target; ?>">
        <?php if (!empty($image)) : ?>
            <div class="data-item-img">
                <?php echo $image; ?>

                <div class="wcl-post-view">
                    <?php echo $text_view; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="data-item-date">
            <?php echo get_the_date('d\t\h\ F Y'); ?>
        </div>

        <h3 class="data-item-title wcl-title">
            <?php echo get_the_title(); ?>
        </h3>
    </a>
</div>