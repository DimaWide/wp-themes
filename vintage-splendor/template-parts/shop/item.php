<?php

$cycle   = $args['cycle'];
$counter = $cycle['counter'];

$link  = get_field('link');
$brand = get_field('brand');
$image = get_the_post_thumbnail($post->ID, 'image-size-4');

$item_class = '';
?>
<div class="data-item <?php echo 'post-' . $post->ID; ?>">
    <div class="data-obj1 <?php echo $item_class; ?>">
        <a href="<?php echo $link; ?>" class="data-obj1-inner" target="_blank">
            <div class="data-obj1-a">
                <?php if (!empty($image)) : ?>
                    <div class="data-obj1-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-obj1-b">
                <div class="data-obj1-b-col">
                    <?php if (!empty($brand)) : ?>
                        <div class="data-obj1-brand">
                            <?php echo $brand; ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="data-obj1-title">
                        <?php echo get_the_title(); ?>
                    </h3>
                </div>

                <div class="data-obj1-b-col">
                    <div class="data-obj1-link">
                        <div class="wcl-link mod-black-to-white">
                            Shop now
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </div>
                    </div>
                </div>

                <div class="data-obj1-logo">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo_private_black.svg'; ?>" alt="img">
                </div>
            </div>
        </a>
    </div>
</div>