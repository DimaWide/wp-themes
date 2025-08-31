<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

// if (!empty($_POST)) {
//     unset($_POST);  // or unset($_POST); to remove the entire array
// }
// Example to unset specific fields in $_POST

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="sct-single-product-info">
        <div class="data-container">
            <?php
            $sku        = $product->get_sku();
            $categories = wc_get_product_category_list($product->get_id(), ', ');
            $tags       = wc_get_product_tag_list($product->get_id(), ', ');
            ?>
            <div class="data-b1">
                <div class="data-b1-col">
                    <div class="data-b1-a">
                        <div class="data-b1-a-item">
                            <span>SKU:</span> <?php echo esc_html($sku ? $sku : 'N/A'); ?>
                        </div>

                        <div class="data-b1-a-item">
                            <span>Categories:</span> <?php echo wp_kses_post($categories); ?>
                        </div>
                    </div>
                </div>

                <div class="data-b1-col">
                    <div class="data-b1-tags">
                        <span>Tags:</span> <?php echo wp_kses_post($tags ? $tags : 'No tags assigned'); ?>
                    </div>
                </div>
            </div>

            <div class="data-b2">
                <div class="data-b2-row">
                    <div class="data-b2-col">
                        <div class="data-b2-inner">
                            <div class="summary entry-summary">
                                <?php
                                /**
                                 * Hook: woocommerce_single_product_summary.
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 20
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_meta - 40
                                 * @hooked woocommerce_template_single_sharing - 50
                                 * @hooked WC_Structured_Data::generate_product_data() - 60
                                 */
                                do_action('woocommerce_single_product_summary');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="data-b2-col">
                        <div class="data-b2-inner">

                            <?php
                            global $product;
                            $main_image_id = $product->get_image_id();
                            $main_image_url = wp_get_attachment_image_url($main_image_id, 'full');
                            $main_thumb_url = wp_get_attachment_image_url($main_image_id, 'thumbnail');

                            $gallery_image_ids = $product->get_gallery_image_ids();

                            $variations = $product->get_children();
                            $variation_images = [];
                            foreach ($variations as $variation_id) {
                                $variation = wc_get_product($variation_id);
                                if ($variation && $variation->is_type('variation')) {
                                    $variation_image_id = $variation->get_image_id();
                                    if ($variation_image_id) {
                                        $variation_images[$variation_id] = [
                                            'full' => wp_get_attachment_image_url($variation_image_id, 'full'),
                                            'thumb' => wp_get_attachment_image_url($variation_image_id, 'thumbnail'),
                                        ];
                                    }
                                }
                            }

                            $image_count = 0;

                            if ($main_thumb_url) {
                                $image_count++;
                            }

                            if (!empty($gallery_image_ids)) {
                                $image_count += count($gallery_image_ids);
                            }

                            if (!empty($variation_images)) {
                                $image_count += count($variation_images);
                            }
                            ?>
                            <div class="data-main-slider swiper main-slider mod-one <?php echo $image_count < 2 ? 'mod-less-two' : ''; ?>">
                                <div class="data-main-slider-inner swiper-wrapper">
                                    <?php if ($main_image_url): ?>
                                        <div class="data-main-slider-item swiper-slide" data-variation-id="0">
                                            <div class="data-main-slider-item-inner">
                                                <div class="data-item-img" itemprop="image">
                                                    <a href="<?php echo esc_url($main_image_url); ?>" data-fancybox="gallery-main" data-caption="<?php echo esc_attr($product->get_name()); ?>">
                                                        <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($gallery_image_ids)): ?>
                                        <?php foreach ($gallery_image_ids as $gallery_image_id): ?>
                                            <div class="data-main-slider-item swiper-slide" data-variation-id="0">
                                                <div class="data-main-slider-item-inner">
                                                    <div class="data-item-img" itemprop="image">
                                                        <a href="<?php echo esc_url(wp_get_attachment_image_url($gallery_image_id, 'full')); ?>" data-fancybox="gallery-main" data-caption="<?php echo esc_attr($product->get_name()); ?>">
                                                            <img src="<?php echo esc_url(wp_get_attachment_image_url($gallery_image_id, 'full')); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php foreach ($variation_images as $variation_id => $urls): ?>
                                        <div class="data-main-slider-item swiper-slide" data-variation-id="<?php echo esc_attr($variation_id); ?>">
                                            <div class="data-main-slider-item-inner">
                                                <div class="data-item-img" itemprop="image">
                                                    <a href="<?php echo esc_url($urls['full']); ?>" data-fancybox="gallery-main" data-caption="<?php echo esc_attr($product->get_name() . ' - Variation'); ?>">
                                                        <img src="<?php echo esc_url($urls['full']); ?>" alt="<?php echo esc_attr($product->get_name() . ' - Variation'); ?>">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="data-main-slider-nav">
                                    <div class="data-main-slider-nav-btn mod-prev">
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/chevron-left.svg', false); ?>
                                    </div>

                                    <div class="data-main-slider-nav-btn mod-next">
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/chevron-right.svg', false); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Слайдер миниатюр -->
                            <div class="data-thumb-slider-out <?php echo $image_count < 6 ? 'mod-less-six' : ''; ?> <?php echo $image_count < 2 ? 'mod-less-two' : ''; ?>">
                                <div class="data-thumb-slider swiper thumb-slider">
                                    <div class="data-thumb-slider-inner swiper-wrapper">
                                        <?php if ($main_thumb_url): ?>
                                            <div class="data-thumb-slider-item swiper-slide" data-variation-id="0">
                                                <div class="data-thumb-slider-item-inner">
                                                    <img src="<?php echo esc_url($main_thumb_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($gallery_image_ids)): ?>
                                            <?php foreach ($gallery_image_ids as $gallery_image_id): ?>
                                                <div class="data-thumb-slider-item swiper-slide" data-variation-id="0">
                                                    <div class="data-thumb-slider-item-inner">
                                                        <img src="<?php echo esc_url(wp_get_attachment_image_url($gallery_image_id, 'thumbnail')); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php foreach ($variation_images as $variation_id => $urls): ?>
                                            <div class="data-thumb-slider-item swiper-slide " data-variation-id="<?php echo esc_attr($variation_id); ?>">
                                                <div class="data-thumb-slider-item-inner">
                                                    <img src="<?php echo esc_url($urls['thumb']); ?>" alt="<?php echo esc_attr($product->get_name() . ' - Variation'); ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                            /**
                             * Hook: woocommerce_before_single_product_summary.
                             *
                             * @hooked woocommerce_show_product_sale_flash - 10
                             * @hooked woocommerce_show_product_images - 20
                             */
                            // do_action('woocommerce_before_single_product_summary');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>