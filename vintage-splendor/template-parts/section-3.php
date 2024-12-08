<?php

$style  = get_sub_field('style');
$style  = !empty($style) ? $style : 'default';
$image  = get_sub_field('image');
$group  = get_sub_field('group');
$title  = $group['title'];
$desc   = $group['desc'];
$link   = $group['link'];
$link_2 = $group['link_2'];

if ($style == 'two') {
    $image  = wp_get_attachment_image($image, 'image-size-8');
} else {
    $image  = wp_get_attachment_image($image, 'image-size-2');
}

$splendor_collective_subscription = get_field('splendor_collective_subscription', 'option');
$price                            = '';

$product    = wc_get_product($splendor_collective_subscription);
$variations = $product->get_available_variations();

foreach ($variations as $variation) {
    $variation_obj = wc_get_product($variation['variation_id']);

    if ($variation_obj->get_variation_attributes()['attribute_subscription'] == 'Per Month') {
        $price = '$' . $variation_obj->get_price() . ' / per month';
        break;
    }
}
?>
<?php if ($style == 'two') : ?>
    <?php
    $image_mobile = get_sub_field('image_mobile');
    $image_mobile = wp_get_attachment_image($image_mobile, 'image-size-2');
    ?>
    <div class="wcl-section-3-e2">
        <div class="data-container wcl-container">
            <?php if (!empty($image)) : ?>
                <div class="data-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($image_mobile)) : ?>
                <div class="data-img mod-mobile">
                    <?php echo $image_mobile; ?>
                </div>
            <?php endif; ?>

            <div class="data-row">
                <div class="data-col">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                </div>

                <div class="data-col">
                    <div class="data-a">
                        <div class="data-desc">
                            <?php if (!empty($desc)) : ?>
                                <?php echo $desc; ?>
                            <?php endif; ?>

                            <?php if (!empty($price)) : ?>
                                <p>
                                    <strong>The Subscription.</strong>
                                    <span><?php echo $price; ?></span>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="data-links">
                            <?php if (!empty($link)) : ?>
                                <?php
                                $link_url    = $link['url'];
                                $link_title  = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link_2)) : ?>
                                <?php
                                $link_url    = $link_2['url'];
                                $link_title  = $link_2['title'];
                                $link_target = $link_2['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link mod-gradient" target="<?php echo $link_target; ?>">
                                        <span> <?php echo $link_title; ?></span>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="wcl-section-3">
        <div class="data-container wcl-container">
            <div class="data-row">
                <div class="data-col">
                    <?php if (!empty($image)) : ?>
                        <div class="data-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-col">
                    <div class="data-a">
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <div class="data-desc">
                            <?php if (!empty($desc)) : ?>
                                <?php echo $desc; ?>
                            <?php endif; ?>

                            <?php if (!empty($price)) : ?>
                                <p>
                                    <strong>The Subscription.</strong>
                                    <span><?php echo $price; ?></span>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="data-links">
                            <?php if (!empty($link)) : ?>
                                <?php
                                $link_url    = $link['url'];
                                $link_title  = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link_2)) : ?>
                                <?php
                                $link_url    = $link_2['url'];
                                $link_title  = $link_2['title'];
                                $link_target = $link_2['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link mod-gradient" target="<?php echo $link_target; ?>">
                                        <span> <?php echo $link_title; ?></span>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>