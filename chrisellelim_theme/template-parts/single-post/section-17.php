<?php

$product       = get_sub_field('product');
$product_title = get_the_title($product);
$product_link  = get_field('link', $product);
$image_1       = get_sub_field('image_1');
$image_1       = wp_get_attachment_image($image_1, 'image-v');
$image_2       = get_sub_field('image_2');
$image_2       = wp_get_attachment_image($image_2, 'image-v');
?>
<div class="wcl-section-17">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-a">
                <?php if (!empty($image_1)) : ?>
                    <div class="data-img">
                        <?php echo $image_1; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($product_title)) : ?>
                <div class="data-b wcl-block-2">
                    <p>
                        <?php echo $product_title; ?>
                    </p>
                    <p>
                        <span>Khaite</span>
                        <a href="<?php echo $product_link; ?>" target="_blank">
                            Shop now
                        </a>
                    </p>
                </div>
            <?php endif; ?>

            <div class="data-c">
                <?php if (!empty($image_2)) : ?>
                    <div class="data-img">
                        <?php echo $image_2; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>