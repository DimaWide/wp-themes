<?php




remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);

add_action('woocommerce_checkout_process', 'cr_customer_consent_validation');
// cr_customer_consent_validation
function cr_customer_consent_validation() {
    if (!isset($_POST['cr_customer_consent'])) {
        wc_add_notice(__('You must agree to the terms and conditions.'), 'error');
    }
}







add_filter('loop_shop_per_page', 'custom_woocommerce_products_per_page', 20);
// custom_woocommerce_products_per_page
function custom_woocommerce_products_per_page($cols) {
    $cols = get_option('posts_per_page');
    return $cols;
}








remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_product_thumbnail', 10);
// custom_woocommerce_product_thumbnail
function custom_woocommerce_product_thumbnail() {
    echo woocommerce_get_product_thumbnail('image-size-1');
}






add_action('woocommerce_add_to_cart', 'merge_cart_items_on_add', 10, 6);
// merge_cart_items_on_add
function merge_cart_items_on_add($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {
    $cart = WC()->cart->get_cart();

    foreach ($cart as $key => $cart_item) {
        if ($cart_item['product_id'] === $product_id && $cart_item['variation_id'] === $variation_id) {
            if ($key !== $cart_item_key) {
                WC()->cart->set_quantity($key, $cart_item['quantity'] + $quantity);
                WC()->cart->remove_cart_item($cart_item_key);
            }
        }
    }
}




add_filter('woocommerce_product_tabs', 'customize_additional_information_tab', 25);
// customize_additional_information_tab
function customize_additional_information_tab($tabs) {
    if (isset($tabs['additional_information'])) {
        $tabs['additional_information']['title'] = __('Installation', 'woocommerce');
        $tabs['additional_information']['callback'] = 'custom_additional_information_content';
    }

    return $tabs;
}



// custom_additional_information_content
function custom_additional_information_content(): void {
    global $product;
    $Installation = get_field('installation');
?>
    <h2>Installation</h2>

    <div class="data-tab-content">
        <?php echo $Installation; ?>
    </div>

<?php

}






// additional_information_table_shortcode
function additional_information_table_shortcode() {
    if (!is_product()) {
        return 'This shortcode works only on single product pages.';
    }

    global $product;

    ob_start();

    echo '<table class="additional-information-table" style="width:100%; border-collapse:collapse;">';
    echo '<tbody>';

    if ($product->has_weight()) {
        echo '<tr>';
        echo '<td>Weight</td>';
        echo '<td>' . esc_html($product->get_weight()) . ' ' . esc_html(get_option('woocommerce_weight_unit')) . '</td>';
        echo '</tr>';
    }

    if ($product->has_dimensions()) {
        echo '<tr>';
        echo '<td>Dimensions</td>';
        echo '<td>' . esc_html(wc_format_dimensions($product->get_dimensions(false))) . '</td>';
        echo '</tr>';
    }

    $attributes = $product->get_attributes();

    foreach ($attributes as $attribute) {
        if ($attribute->get_visible()) {
            $name = wc_attribute_label($attribute->get_name());
            $value = $attribute->is_taxonomy()
                ? implode(', ', wc_get_product_terms($product->get_id(), $attribute->get_name(), ['fields' => 'names']))
                : implode(', ', $attribute->get_options());

            echo '<tr>';
            echo '<td>' . esc_html($name) . '</td>';
            echo '<td>' . esc_html($value) . '</td>';
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';

    return ob_get_clean();
}
add_shortcode('additional_information_table', 'additional_information_table_shortcode');






add_filter('woocommerce_get_product_attributes', 'hide_invisible_attributes_on_product_page', 10, 2);
// hide_invisible_attributes_on_product_page
function hide_invisible_attributes_on_product_page($attributes, $product) {
    if (is_product()) {
        foreach ($attributes as $key => $attribute) {
            if (isset($attribute['is_visible']) && !$attribute['is_visible']) {
                unset($attributes[$key]);
            }
        }
    }

    return $attributes;
}






add_filter('woocommerce_add_cart_item_data', 'add_selected_model_to_cart_item', 10, 2);
add_action('woocommerce_checkout_create_order_line_item', 'add_meta_to_order_item', 10, 4);
// add_selected_model_to_cart_item
function add_selected_model_to_cart_item($cart_item_data, $product_id) {
    if (isset($_COOKIE['selectedModel'])) {
        $selected_model = sanitize_text_field($_COOKIE['selectedModel']);
        $cart_item_data['selected_model'] = $selected_model;
        $cart_item_data['unique_key'] = md5(microtime() . rand());
    }

    return $cart_item_data;
}




// add_meta_to_order_item
function add_meta_to_order_item($item, $cart_item_key, $values, $order) {
    if (isset($values['selected_model'])) {
        $item->add_meta_data('Model Car', $values['selected_model'], true);
    }
}




add_action('woocommerce_review_order_before_payment', 'add_custom_coupon_block');
// add_custom_coupon_block
function add_custom_coupon_block() {
?>
    <div class="data-coupone coupone_block">
        <div class="data-coupone-inner">
            <label class="data-coupone-label woocommerce-form__label-for-checkbox">
                <input class="promo-checkbox" type="checkbox" name="coupon_state"> <span>Have A Promotional Code?</span>
            </label>

            <div class="data-coupone-form mod-not-wc">
                <div class="data-coupone-field">
                    <input type="text" name="coupon_code" placeholder="Coupon code">
                </div>

                <div class="data-coupone-submit">
                    <button type="button" name="apply_coupon" class="cmp-button mod-red wcl-cmp-button-2">Apply coupon</button>
                </div>
            </div>
        </div>
    </div>

<?php
}






// add_dynamic_classes_to_checkout_fields
function add_dynamic_classes_to_checkout_fields($fields) {
    foreach ($fields as $section_key => $section) {
        foreach ($section as $field_key => $field) {
            if (isset($field_key)) {
                $class_name = str_replace('_', '-', $field_key); //
                if (isset($fields[$section_key][$field_key]['class'])) {
                    $fields[$section_key][$field_key]['class'][] = $class_name;
                } else {
                    $fields[$section_key][$field_key]['class'] = [$class_name];
                }
            }
        }
    }
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'add_dynamic_classes_to_checkout_fields');









add_action('init', 'move_woocommerce_shipping_calculator');
// Move the shipping calculator to a new location
function move_woocommerce_shipping_calculator() {
    remove_action('woocommerce_after_cart_totals', 'woocommerce_shipping_calculator', 10);
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


add_action('woocommerce_product_query', 'filter_products_by_model_car_cookie');

function filter_products_by_model_car_cookie($query) {
    if (!is_admin() && $query->is_main_query()) {

        if (is_product_category() || is_product_tag()) {
            return;
        }

        if (isset($_COOKIE['selectedModel']) && !empty($_COOKIE['selectedModel'])) {
            $selectedModel = sanitize_text_field($_COOKIE['selectedModel']);

            $tax_query = (array) $query->get('tax_query');

            $tax_query[] = array(
                'taxonomy' => 'pa_model',
                'field'    => 'slug',
                'terms'    => $selectedModel,
                'operator' => 'IN',
            );

            $query->set('tax_query', array_merge(array('relation' => 'AND'), $tax_query));


            if (isset($_COOKIE['selectedYear']) && !empty($_COOKIE['selectedYear'])) {
                $selectedYear = sanitize_text_field($_COOKIE['selectedYear']);

                $tax_query = (array) $query->get('tax_query');

                $tax_query[] = array(
                    'taxonomy' => 'pa_model-year',
                    'field'    => 'slug',
                    'terms'    => $selectedYear,
                    'operator' => 'IN',
                );

                $query->set('tax_query', array_merge(array('relation' => 'AND'), $tax_query));
            }
        }
    }
}




add_action('pre_get_posts', 'set_default_product_sorting_by_date');
// set_default_product_sorting_by_date
function set_default_product_sorting_by_date($query) {
    if ($query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
        $query->set('orderby', 'date'); //
        $query->set('order', 'DESC');
    }
}




/* 
is_woocommerce_page
 */
function is_woocommerce_page() {
    if (class_exists('WooCommerce')) {
        if (is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_product() || is_product_category() || is_product_tag()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}







add_filter('woocommerce_product_additional_information_tab_title', function ($title) {
    return __('Installation', 'your-text-domain');
});

// Remove price
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

// Remove product meta
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Remove product sharing
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

// woocommerce_single_product_summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);


// Remove product rating
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);


// Remove product excerpt
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// Add excerpt
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40);


// Add custom rating
add_action('woocommerce_single_product_summary', 'custom_product_rating', 10);
function custom_product_rating() {
    global $product;

    $average_rating = $product->get_average_rating();
    $review_count = $product->get_review_count();
?>
    <?php if (true || !empty($average_rating) || !empty($review_count)) : ?>
        <div class="data-b3">

            <div class="data-b2-ratings">
                <div class="data-rating">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i > 5) {
                            break;
                        }
                    ?>
                        <?php if ($average_rating >= $i) : ?>
                            <span>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/star.svg', false); ?>
                            </span>
                        <?php else: ?>
                            <span class="mod-disable">
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/star.svg', false); ?>
                            </span>
                        <?php endif; ?>
                    <?php
                    }
                    ?>
                </div>

                <?php if (true || !empty($review_count)) : ?>
                    <div class="data-review">
                        <a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                            (<span class="count"><?php echo esc_html($review_count); ?></span> customer <?php echo _n('review', 'reviews', $review_count, 'woocommerce'); ?>)
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-note mod-one">
                FREE HATS to all orders above $100!
                <span class="data-note-sign">?
                    <span class="data-note-tooltip">
                        Add any hat to your cart. At checkout, enter <br> coupon code:  HAT4FREE  for a 100% OFF the hat!
                    </span>
                </span>
            </div>
        </div>
    <?php endif; ?>
    <?php
}






add_action('woocommerce_single_product_summary', 'custom_display_product_variations', 25);
// custom_display_product_variations
function custom_display_product_variations() {
    global $product;

    if ($product && ! has_term('merchandise', 'product_cat', $product->get_id())) {
    ?>

        <?php
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
        <div class="data-main-slider swiper main-slider mod-two <?php echo $image_count < 2 ? 'mod-less-two' : ''; ?>">
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





        <div class="data-b2-variation">
            <?php
            if ($product->is_type('variable')) {
                $available_variations = $product->get_available_variations();

                if (!empty($available_variations)) {
                    echo '<div class="data-variation">';

                    foreach ($available_variations as $variation) {
                        $price = wc_price($variation['display_price']);
                        $variation_name = implode(' ', $variation['attributes']);
                        $variation_id = $variation['variation_id'];
                        $is_available = $variation['is_in_stock'] ? 'available' : 'unavailable';

                        // Get the product object for the variation
                        $variation_product = wc_get_product($variation_id);
                        // Get the image URL for the variation
                        $variation_image_url = wp_get_attachment_url($variation_product->get_image_id());
            ?>
                        <div class="data-variation-item <?php echo esc_attr($is_available); ?>"
                            data-variation-id="<?php echo esc_attr($variation_id); ?>"
                            data-variation-name="<?php echo esc_attr($variation_name); ?>">
                            <div class="data-variation-item-inner cmp-button">
                                <div class="data-variation-item-image">
                                    <?php if ($variation_image_url): ?>
                                        <img src="<?php echo esc_url($variation_image_url); ?>" alt="<?php echo esc_attr($variation_name); ?>" />
                                    <?php else: ?>
                                        <p>No image available</p>
                                    <?php endif; ?>
                                </div>

                                <div class="data-variation-item-info">
                                    <div class="data-variation-item-price">
                                        <?php echo $price; ?>
                                    </div>
                                    <div class="data-variation-item-name">
                                        <?php echo esc_html($variation_name); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }


                    echo '</div>';
                    ?>
                    <div class="data-variation-reset">
                        <button id="custom-reset-button" class="cmp-button">Reset Variations</button>
                    </div>
            <?php
                }
            }
            ?>
        </div>

    <?php
    }
}






add_action('woocommerce_single_product_summary', 'custom_display_add_product', 30);
// custom_display_add_product
function custom_display_add_product() {
    global $product; ?>
    <div class="data-b2-add-product">
        <div class="data-quantity">
            <div class="data-quantity-btn minus-btn">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/minus.svg'; ?>" alt="minus">
            </div>

            <div class="data-quantity-value" id="quantity-value">
                1
            </div>

            <div class="data-quantity-btn plus-btn">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/plus.svg'; ?>" alt="plus">
            </div>
        </div>

        <div class="data-add-to-cart">
            <button class="cmp-button mod-red">Add to cart</button>
        </div>
    </div>

    <div class="data-note mod-two">
        <span class="data-note-sign">?
            <span class="data-note-tooltip">
                Add any hat to your cart. At checkout, enter <br> coupon code:  HAT4FREE  for a 100% OFF the hat!
            </span>
        </span>
        FREE HATS to all orders above $100!
    </div>
<?php
}






add_action('add_to_cart_redirect', 'cipher_add_to_cart_redirect');
// cipher_add_to_cart_redirect
function cipher_add_to_cart_redirect($url = false) {

    if (!empty($url)) {
        return $url;
    }

    return get_bloginfo('wpurl') . add_query_arg(array(), remove_query_arg('add-to-cart'));
}




add_action('wp', function () {
    if (is_product() || is_shop()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
});




add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');
// update_cart_quantity
function update_cart_quantity() {
    if (isset($_POST['cart_key'], $_POST['quantity'])) {
        $cart_key = sanitize_text_field($_POST['cart_key']);
        $quantity = intval($_POST['quantity']);

        WC()->cart->set_quantity($cart_key, $quantity);

        wp_send_json_success(['message' => 'Cart updated successfully.']);
    } else {
        wp_send_json_error(['message' => 'Invalid request.']);
    }
}
