<?php

$counter     = get_query_var('shop_counter');
$cycle       = $args['cycle'];
$phlur       = $args['phlur'];
$style       = $args['style'];
$list_static = $args['list_static'];
$image       = get_the_post_thumbnail($post->ID, 'image-i');
$link        = get_field('link');
$brand       = get_field('brand');
$brand       = !empty($brand) ? $brand : 'Brand';
?>
<?php if ($counter == (2 + ($cycle['multi'] * 12))) : ?>
    <?php
    $mod = '';
    if ($counter == (7 + ($cycle['multi'] * 12))) {
        $mod = 'mod-a';
    }
    $image = get_the_post_thumbnail($post->ID, 'image-i-2v');
    ?>
    <div class="data-item item-<?php echo $counter - 1  . ' mod-big ' . $mod; ?> p-<?php echo $post->ID; ?>">
        <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
            <?php if (!empty($image)) : ?>
                <div class="data-item-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="data-item-info">
                <div class="data-item-title">
                    <?php echo get_the_title(); ?>
                </div>

                <?php if (!empty($brand)) : ?>
                    <div class="data-item-brand">
                        <?php echo $brand; ?>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    </div>
<?php elseif ($counter == (7 + ($cycle['multi'] * 12))) : ?>
    <?php
    $mod = '';
    if ($counter == (7 + ($cycle['multi'] * 12))) {
        $mod = 'mod-a';
    }
    $image = get_the_post_thumbnail($post->ID, 'image-i-2v');
    $item = $list_static[$cycle['multi']];
    $item_image = wp_get_attachment_image($item['image'], 'image-i-2v');
    $color_bg = $item['bg_color'];
    $color_bg = !empty($color_bg) ? $color_bg : '#a99d8a';
    ?>
    <?php if (!empty($item)) : ?>
        <div class="data-item item-<?php echo $counter - 1  . ' mod-big ' . $mod; ?> ">
            <a href="<?php echo $item['link']; ?>" class="data-item-inner" target="_blank" style="background-color: <?php echo $color_bg; ?>;">
                <?php if (!empty($item_image)) : ?>
                    <div class="data-item-img">
                        <?php echo $item_image; ?>
                    </div>
                <?php endif; ?>

                <div class="data-item-info">
                    <div class="data-item-title">
                        <?php echo $item['name']; ?>
                    </div>

                    <?php if (!empty($brand)) : ?>
                        <div class="data-item-brand">
                            <?php echo $item['brand']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>
        <?php
        $counter++;
        ?>
        <div class="data-item item-<?php echo $counter - 1; ?> p-<?php echo $post->ID; ?>">
            <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
                <?php if (!empty($image)) : ?>
                    <div class="data-item-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>

                <div class="data-item-info">
                    <div class="data-item-title">
                        <?php echo get_the_title(); ?>
                    </div>

                    <?php if (!empty($brand)) : ?>
                        <div class="data-item-brand">
                            <?php echo $brand; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php else : ?>
        <div class="data-item item-<?php echo $counter - 1  . ' mod-big ' . $mod; ?> p-<?php echo $post->ID; ?>">
            <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
                <?php if (!empty($image)) : ?>
                    <div class="data-item-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>

                <div class="data-item-info">
                    <div class="data-item-title">
                        <?php echo get_the_title(); ?>
                    </div>

                    <?php if (!empty($brand)) : ?>
                        <div class="data-item-brand">
                            <?php echo $brand; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endif; ?>
<?php elseif ($counter == (4 + ($cycle['multi'] * 12))) : ?>
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
    <div class="data-item item-<?php echo $counter - 1; ?> p-<?php echo $post->ID; ?>">
        <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
            <?php if (!empty($image)) : ?>
                <div class="data-item-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="data-item-info">
                <div class="data-item-title">
                    <?php echo get_the_title(); ?>
                </div>

                <?php if (!empty($brand)) : ?>
                    <div class="data-item-brand">
                        <?php echo $brand; ?>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    </div>
<?php else : ?>
    <div class="data-item item-<?php echo $counter - 1; ?> p-<?php echo $post->ID; ?>">
        <?php
        echo $style;
        $style = '';
        ?>
        <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
            <?php if (!empty($image)) : ?>
                <div class="data-item-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="data-item-info">
                <div class="data-item-title">
                    <?php echo get_the_title(); ?>
                </div>

                <?php if (!empty($brand)) : ?>
                    <div class="data-item-brand">
                        <?php echo $brand; ?>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    </div>
<?php endif; ?>
<?php
set_query_var('shop_counter', $counter);
?>