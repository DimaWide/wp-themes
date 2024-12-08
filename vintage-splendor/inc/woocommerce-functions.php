<?php



/* 
wcl_woocommerce_action
 */
function wcl_woocommerce_action() {
    remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

    //     add_action('woocommerce_after_my_account', 'get_link_go_back');
    //     add_action('woocommerce_after_account_orders', 'get_link_go_back');
    //     add_action('woocommerce_view_order', 'get_link_go_back');
    //    add_action('woocommerce_subscription_details_after_subscription_table', 'get_link_go_back');
}
add_action('init', 'wcl_woocommerce_action');




/* 
redirect_after_login
 */
function redirect_after_login($redirect, $user) {
    $portal = get_field('pages', 'option');
    $portal = $portal['sc_portal'];

    if (in_array('subscriber', $user->roles)) {
        $redirect = get_permalink($portal);
    }

    return $redirect;
}
add_filter('woocommerce_login_redirect', 'redirect_after_login', 10, 2);



/* 
wc_custom_order_button_text
 */
function wc_custom_order_button_text() {
    return __('Sign up', 'woocommerce');
}
add_filter('woocommerce_order_button_text', 'wc_custom_order_button_text');




/* 
wcl_style_product
 */
function wcl_style_product() {
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
}
add_action('wp', 'wcl_style_product');





/* 
remove_downloads_tab
 */
function remove_downloads_tab($items) {
    unset($items['downloads']);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_downloads_tab');



/* 
custom_attribute_label
 */
function custom_attribute_label($label, $name, $product) {
    if ($name == 'Subscription' && is_product()) {
        $label = __('The Subscription.', 'woocommerce');
    }
    return $label;
}
add_filter('woocommerce_attribute_label', 'custom_attribute_label', 10, 3);




/* 
custom_woocommerce_dropdown_variation_attribute_options_args
 */
function custom_woocommerce_dropdown_variation_attribute_options_args($args) {
    $args['show_option_none'] = 'Choose yours';
    return $args;
}
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'custom_woocommerce_dropdown_variation_attribute_options_args');




/**
 * Prevent purchasing the subscription product if the customer already has an active subscription.
 */
// function prevent_duplicate_subscription_purchase( $purchasable, $product ) {
//     if ( $product->is_type( 'subscription' ) && wcs_user_has_subscription( get_current_user_id(), '', 'active' ) ) {
//         $purchasable = false;
//     }
//     return $purchasable;
// }
// add_filter( 'woocommerce_is_purchasable', 'prevent_duplicate_subscription_purchase', 10, 2 );
