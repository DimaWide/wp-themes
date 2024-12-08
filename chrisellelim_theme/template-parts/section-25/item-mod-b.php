<?php


$title    = get_sub_field('title');
$image    = get_sub_field('image');
$image    = wp_get_attachment_image($image, 'image-n');
$category = get_sub_field('category');
$url      = get_sub_field('url');
?>
<div class="data-item">
    <a href="<?php echo $url; ?>" class="data-item-inner">
        <div class="data-item-img">
            <?php if (!empty($image)) : ?>
                <?php echo $image; ?>

                <div class="data-item-img-play">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                </div>

                <div class="data-item-label">
                    LISTEN NOW
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($title)) : ?>
            <h3 class="data-item-title">
                <?php echo $title; ?>
            </h3>
        <?php endif; ?>

        <div class="data-item-cat">
            <?php if (!empty($category)) : ?>
                <div class="data-item-cat-link">
                    <?php echo $category; ?>
                </div>
            <?php endif; ?>
        </div>
    </a>
</div>