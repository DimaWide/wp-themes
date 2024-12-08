<?php

$post  = $args['item'];
$image = get_the_post_thumbnail($post->ID, 'image-size-2');
?>
<div class="data-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
    <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
        <?php if (!empty($image)) : ?>
            <div class="data-item-img">
                <?php echo $image; ?>

                <div class="wcl-post-view">
                    View Post
                </div>
            </div>
        <?php endif; ?>

        <div class="data-item-date">
            <?php echo get_the_date('d\t\h\ F Y'); ?>
        </div>

        <h2 class="data-item-title wcl-title">
            <?php echo get_the_title(); ?>
        </h2>
    </a>
</div>