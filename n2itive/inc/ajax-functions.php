<?php




// update_cart_popup
function update_cart_popup() {
    $cart = WC()->cart;

    ob_start();
?>
    <?php if (! WC()->cart->is_empty()) : ?>
        <div class="data-items cart-items">
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                $product               = $cart_item['data'];
                $product_id            = $product->get_id();
                $product_title         = $product->get_name();
                $product_price         = wc_price($product->get_price());
                $quantity              = $cart_item['quantity'];
                $total_price           = $product->get_price() * $quantity;
                $formatted_total_price = wc_price($total_price);
                $image                 = get_the_post_thumbnail($product_id, 'image-size-4');
            ?>
                <div class="data-item cart-item <?php echo $product_id; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
                    <div class="data-item-img">
                        <?php if (!empty($image)): ?>
                            <?php echo $image; ?>
                        <?php endif; ?>
                    </div>

                    <div class="data-item-info">
                        <div class="data-item-title product-title"><?php echo $product_title; ?></div>
                        <div class="data-item-price product-price">
                            <span> <?php echo $quantity; ?>x</span> <span> <?php echo wc_price($product->get_price()); ?></span>
                        </div>
                    </div>

                    <div class="data-item-remove">
                        <button class="remove-item" data-cart-item-key="<?php echo $cart_item_key; ?>">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close.svg'; ?>" alt="img">
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="data-footer">
            <div class="data-subtotal">
                <div class="data-subtotal-label">
                    Subtotal:
                </div>

                <div class="data-subtotal-value">
                    <?php echo WC()->cart->get_cart_total(); ?>
                </div>
            </div>

            <div class="data-buttons">
                <a href="<?php echo wc_get_cart_url(); ?>" class="cmp-button" id="view-cart-btn">View Cart</a>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="cmp-button" id="checkout-btn">Checkout</a>
            </div>
        </div>
    <?php else : ?>
        <div class="data-footer">
            <div class="data-empty">
                <p>Your cart is empty.</p>
            </div>

            <div class="data-buttons">
                <a href="<?php echo wc_get_cart_url(); ?>" class="cmp-button" id="view-cart-btn">View Cart</a>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="cmp-button" id="checkout-btn">Checkout</a>
            </div>
        </div>
    <?php endif; ?>
<?php

    $cart_html = ob_get_clean();
    $cart_count = WC()->cart->get_cart_contents_count();

    wp_send_json_success(array(
        'cart_html' => $cart_html,
        'cart_count' => $cart_count
    ));
}

add_action('wp_ajax_update_cart_popup', 'update_cart_popup');
add_action('wp_ajax_nopriv_update_cart_popup', 'update_cart_popup');






/**
 * blog_page_load_posts
 */
function blog_page_load_posts() {
    $page_items = isset($_POST['page_items']) ? $_POST['page_items'] : 4;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;
    $category   = isset($_POST['category']) ? $_POST['category'] : '';

    $sticky_posts = get_option('sticky_posts');
    
    $sticky_args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items, 
        'paged'          => $page,
        'post_status'    => 'publish',
        'post__in'       => $sticky_posts, 
        'orderby'        => 'post__in', 
    );

    if (!empty($category) && $category !== 'all') {
        $sticky_args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    }

    $sticky_query = new WP_Query($sticky_args);

    $sticky_count = $sticky_query->post_count;

    $regular_args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items - $sticky_count, 
        'paged'          => $page,
        'post_status'    => 'publish',
        'post__not_in'   => $sticky_posts, 
    );

    if (!empty($category) && $category !== 'all') {
        $regular_args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    }

    $regular_query = new WP_Query($regular_args);

    $combined_posts = array_merge($sticky_query->posts, $regular_query->posts);

    $total_pages = max($sticky_query->max_num_pages, $regular_query->max_num_pages);
    $has_more    = ($page < $total_pages) ? true : false;
    $post_count  = count($combined_posts);

    ob_start();
    ?>
    <?php if ($post_count > 0) : ?>
        <?php 
            global $post;
            ?>
        <?php foreach ($combined_posts as $post) : ?>
            <?php setup_postdata($post); ?>
            <div class="data-item">
                <?php get_template_part('template-parts/components/cmp-5-post'); ?>
            </div>
        <?php endforeach;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No posts found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    ob_start();
    ?>
    <?php if ($has_more) : ?>
        <button class="data-load-more-btn cmp-button" data-page="<?php echo $page; ?>">
            Load more
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button" data-page="<?php echo $page; ?>" disabled="true">
            All viewed
        </button>
    <?php endif; ?>
    <?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_blog_page_load_posts', 'blog_page_load_posts');
add_action('wp_ajax_nopriv_blog_page_load_posts', 'blog_page_load_posts');





/* 
order_coupone_apply
*/
function order_coupone_apply() {
    $coupon_code = $_POST['coupon_code'];

    if (!empty($coupon_code)) {
        $target_product_id = get_field('product_for_coupon', 'option');
        $found_target_product = false;
        $other_products_count = 0;

        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $target_product_id) {
                $found_target_product = true;
            } else {
                $other_products_count++;
            }
        }

        if ($coupon_code === 'HAT4FREE') {
            if (!$found_target_product) {
                $response = array(
                    'message' => 'This coupon is for hats only.',
                );
            } else {
                if ($other_products_count >= 1) {
                    WC()->cart->apply_coupon(sanitize_text_field($coupon_code));
                    WC()->cart->calculate_totals();

                    $applied_coupons = WC()->cart->get_applied_coupons();
                    $coupon_applied = in_array($coupon_code, $applied_coupons);

                    $discount_amount = WC()->cart->get_discount_total();

                    $new_row_html = '
                    <tr class="cart-discount-2 coupon-discount">
                        <th>Скидка (' . $coupon_code . ')</th>
                        <td><span class="woocommerce-Price-amount amount"><bdi>' . wc_price(-$discount_amount) . '</bdi></span></td>
                    </tr>
                    ';

                    $response = array(
                        'success'         => $coupon_applied,
                        'applied_coupons' => $applied_coupons,
                        'message'         => '',
                        'new_row_html'    => $new_row_html,
                        'discount_amount' => $discount_amount,
                    );
                } else {
                    $response = array(
                        'message' => 'Please add at least one more product besides the hat to use this coupon.',
                    );
                }
            }
        } else {
            WC()->cart->apply_coupon(sanitize_text_field($coupon_code));
            WC()->cart->calculate_totals();

            $applied_coupons = WC()->cart->get_applied_coupons();
            $coupon_applied = in_array($coupon_code, $applied_coupons);

            $discount_amount = WC()->cart->get_discount_total();

            $new_row_html = '
            <tr class="cart-discount-2 coupon-discount">
                <th>Скидка (' . $coupon_code . ')</th>
                <td><span class="woocommerce-Price-amount amount"><bdi>' . wc_price(-$discount_amount) . '</bdi></span></td>
            </tr>
        ';

            $response = array(
                'success'         => $coupon_applied,
                'applied_coupons' => $applied_coupons,
                'message'         => '',
                'new_row_html'    => $new_row_html,
                'discount_amount' => $discount_amount,
            );
        }

        if (wc_notice_count() > 1) {
            wc_clear_notices();
        }
    } else {
        $response = array(
            'message' => 'Enter the coupon',
        );
    }

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_order_coupone_apply', 'order_coupone_apply');
add_action('wp_ajax_nopriv_order_coupone_apply', 'order_coupone_apply');





// custom_remove_cart_item
function custom_remove_cart_item() {
    $cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';

    if (empty($cart_item_key)) {
        wp_send_json_error('Cart item key missing');
        exit;
    }

    $cart = WC()->cart;

    if ($cart->remove_cart_item($cart_item_key)) {
        WC()->cart->calculate_totals();

        $new_subtotal = strip_tags(WC()->cart->get_cart_subtotal());

        $cart_item_count = WC()->cart->get_cart_contents_count();

        wp_send_json_success(array(
            'new_subtotal' => $new_subtotal,
            'cart_item_count' => $cart_item_count,
        ));
    } else {
        wp_send_json_error('Failed to remove item from cart');
    }

    exit;
}


add_action('wp_ajax_custom_remove_cart_item', 'custom_remove_cart_item');
add_action('wp_ajax_nopriv_custom_remove_cart_item', 'custom_remove_cart_item');





// filter_car_parts
function filter_car_parts() {
    $model  = sanitize_text_field($_POST['model'] ?? null);
    $option = sanitize_text_field($_POST['option'] ?? null);
    $year   = sanitize_text_field($_POST['year'] ?? null);

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'tax_query'      => array(
            'relation' => 'AND',
        ),
    );

    if (!empty($model)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_model',
            'field'    => 'slug',
            'terms'    => $model,
        );
    }

    if (!empty($option)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_setting-options',
            'field'    => 'slug',
            'terms'    => $option,
        );
    }

    if (!empty($year)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_model-year',
            'field' => 'slug',
            'terms' => $year,
        );
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {

        while ($query->have_posts()) {
            $query->the_post();
            global $post;
            $image = get_the_post_thumbnail($post->ID, 'image-size-4');
            $product_url = get_permalink(get_the_ID());
    ?>
            <li class="data-b5-item part">
                <a href="<?php echo esc_url($product_url); ?>" class="data-b5-item-inner" target="_blank">
                    <div class="data-b5-item-img">
                        <?php if (! empty($image)): ?>
                            <?php echo $image; ?>
                        <?php else: ?>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . 'spare.png'; ?>" alt="img">
                        <?php endif; ?>
                    </div>

                    <div class="data-b5-item-name">
                        <?php echo esc_html(get_the_title()); ?>
                    </div>
                </a>
            </li>
        <?php
        }

        wp_reset_postdata();
    } else {
        ?>
        <li class="data-b5-item mod-no-found">No parts found</li>
<?php
    }

    $html = ob_get_clean();

    wp_send_json_success($html);

    wp_die();
}

add_action('wp_ajax_filter_car_parts', 'filter_car_parts');
add_action('wp_ajax_nopriv_filter_car_parts', 'filter_car_parts');







// get_variation_images
function get_variation_images() {
    if (!isset($_POST['variation_id'])) {
        wp_send_json_error();
    }

    $variation_id = absint($_POST['variation_id']);
    $variation = new WC_Product_Variation($variation_id);
    $attachment_ids = $variation->get_gallery_image_ids();

    $main_images = [];
    $thumbnail_images = [];

    if ($attachment_ids && is_array($attachment_ids)) {
        foreach ($attachment_ids as $attachment_id) {
            $main_images[] = wp_get_attachment_image_url($attachment_id, 'full');
            $thumbnail_images[] = wp_get_attachment_image_url($attachment_id, 'thumbnail');
        }
    }

    wp_send_json_success([
        'main_images' => $main_images,
        'thumbnail_images' => $thumbnail_images,
    ]);
}
add_action('wp_ajax_get_variation_images', 'get_variation_images');
add_action('wp_ajax_nopriv_get_variation_images', 'get_variation_images');
