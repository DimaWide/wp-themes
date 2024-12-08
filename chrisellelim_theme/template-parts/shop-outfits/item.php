<?php

$counter      = get_query_var('shop_counter');
$cycle        = $args['cycle'];
$phlur        = $args['phlur'];
$style        = $args['style'];
$image        = get_the_post_thumbnail($post->ID, 'image-r');
$display_type = get_field('display_type');
$shop_list    = get_field('shop');
$class_shop   = 'has-shop';
if (empty($shop_list)) {
    $shop_list = [''];
    $class_shop = '';
}
$args = array(
    'post_type' => 'shop',
    'post__in'  => $shop_list,
    'orderby' => 'post__in'
);
$shops = get_posts($args);
?>
<?php if ($counter == (2 + ($cycle['multi'] * 15)) || $counter == (10 + ($cycle['multi'] * 15))) : ?>
    <?php
    $image = get_the_post_thumbnail($post->ID, 'image-r-2v');
    ?>
    <?php if ($display_type == 'circle') : ?>
        <?php
        $color_bg = get_field('color_background');
        $color_bg = !empty($color_bg) ? $color_bg : '#a99d8a';
        ?>
        <div class="d2-item-b item-<?php echo $counter - 1 ?> p-<?php echo $post->ID . ' ' . $class_shop; ?>">
            <div class="d2-item-b-inner">
                <div class="d2-item-b-a" style="background-color: <?php echo $color_bg; ?>;">
                    <div class="d2-item-b-a-view">
                        <div class="d2-item-b-a-img">
                            <?php echo $image; ?>
                            <?php echo $image; ?>
                        </div>

                        <div class="d2-item-b-a-title">
                            <div>Shop my</div>
                            <div>outfit</div>
                        </div>
                    </div>
                </div>

                <div class="d2-item-b-b">
                    <div class="d2-item-b-b-img">
                        <?php echo $image; ?>
                    </div>

                    <?php if (!empty($shops)) : ?>
                        <?php
                        $args =  array(
                            'shops' => $shops,
                        );
                        get_template_part('template-parts/shop-outfits/slider', null, $args);
                        ?>
                    <?php endif; ?>

                    <div class="d2-item-b-b-title">
                        Shop now
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="d2-item mod-a item-<?php echo $counter - 1; ?> p-<?php echo $post->ID . ' ' . $class_shop; ?>">
            <?php
            $image = get_the_post_thumbnail($post->ID, 'image-r-2v');
            ?>
            <div class="d2-item-inner">
                <div class="d2-item-img">
                    <?php echo $image; ?>
                </div>

                <div class="d2-item-a">
                    <?php if (!empty($shops)) : ?>
                        <?php
                        $args =  array(
                            'shops' => $shops,
                        );
                        get_template_part('template-parts/shop-outfits/slider', null, $args);
                        ?>
                    <?php endif; ?>

                    <div class="d2-item-a-title">
                        Shop now
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif ($counter == (4 + ($cycle['multi'] * 15))) : ?>
    <?php
    $phlur_images = $phlur['images'];
    $phlur_logo   = $phlur['logo'];
    $phlur_link   = $phlur['link'];
    $loop_gallery = $phlur['loop_gallery'];
    $phlur_logo   = wp_get_attachment_image($phlur_logo);
    $phlur_count = 0;
    ?>
    <div class="data-item item-<?php echo $counter - 1  . ' mod-phlur disable'; ?>">
        <a href="<?php echo $phlur_link['url']; ?>" class="data-item-inner" target="<?php echo $phlur_link['target']; ?>">
            <?php if (!empty($phlur_images)) : ?>
                <?php if ($loop_gallery) : ?>
                    <div class="data-item-imgs">
                        <?php foreach ($phlur_images as $item_id) : ?>
                            <?php
                            $phlur_count++;
                            $phlur_active = '';
                            $phlur_img = wp_get_attachment_image_url($item_id, 'image-r');
                            if ($phlur_count == 1) {
                                $phlur_active = 'active';
                            }
                            ?>
                            <?php if (!empty($phlur_img)) : ?>
                                <img src="<?php echo $phlur_img; ?>" class="<?php echo $phlur_active; ?>" alt="img">
                            <?php endif; ?>
                        <?php endforeach ?>
                    </div>
                <?php else : ?>
                    <?php
                    $phlur_img = wp_get_attachment_image_url($phlur_images[0], 'image-r');
                    ?>
                    <div class="data-item-imgs">
                        <?php echo $phlur_img; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($phlur_logo)) : ?>
                <div class="data-item-logo">
                    <?php echo $phlur_logo; ?>
                </div>
            <?php endif; ?>
        </a>
    </div>
    <?php
    $counter++;
    ?>
    <div class="d2-item item-<?php echo $counter - 1; ?> p-<?php echo $post->ID . ' ' . $class_shop; ?>">
        <div class="d2-item-inner">
            <div class="d2-item-img">
                <?php echo $image; ?>
            </div>

            <?php if (!empty($shops)) : ?>
                <?php
                $args =  array(
                    'shops' => $shops,
                );
                get_template_part('template-parts/shop-outfits/slider', null, $args);
                ?>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>
    <div class="d2-item item-<?php echo $counter - 1; ?> p-<?php echo $post->ID . ' ' . $class_shop; ?>">
        <?php
        echo $style;
        ?>
        <div class="d2-item-inner">
            <div class="d2-item-img">
                <?php echo $image; ?>
            </div>

            <?php if (!empty($shops)) : ?>
                <?php
                $args = array(
                    'shops' => $shops,
                );
                get_template_part('template-parts/shop-outfits/slider', null, $args);
                ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php
set_query_var('shop_counter', $counter);
?>