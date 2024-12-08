<?php

$products = get_field('products', 'option');
$product  = $products['product_1'];

$woocommerce     = get_field('woocommerce', 'option');
$cta_button_text = $woocommerce['cta_button_text'];

$custom_class = $args['custom-class'] ?? '';

$cta    = get_field('cta', 'option');
$button = $cta['button'];
$note   = $cta['note'];
?>
<?php if (!empty($cta)) : ?>
    <div class="wcl-cmp-1-cta data-cmp-1-cta <?php echo $custom_class; ?>">
        <?php if (!empty($button)) : ?>
            <?php
            $link_url    = $button['url'];
            $link_title  = $button['title'];
            $link_target = $button['target'] ?: '_self';
            ?>
            <div class="cmp1-button">
                <?php if (!empty($product)) : ?>
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>?add-to-cart=<?php echo $product; ?>" class="wcl-cmp-button">
                        <?php echo $cta_button_text; ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo $link_url; ?>" class="wcl-cmp-button js-popup-open" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                        <i class="fa-fw fas fa-angle-double-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($note)) : ?>
            <div class="cmp1-note">
                <?php echo $note; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>