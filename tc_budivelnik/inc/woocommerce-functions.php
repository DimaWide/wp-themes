<?php



/* 
redirect_search_to_shop_page
 */
function redirect_search_to_shop_page() {
    if (is_search() && !empty($_GET['s']) && isset($_GET['post_type']) && $_GET['post_type'] == 'product') {
        $search_query = sanitize_text_field($_GET['s']);
        $shop_url = add_query_arg('s', $search_query, get_permalink(wc_get_page_id('shop')));
        wp_redirect($shop_url);
        exit();
    }
}
add_action('template_redirect', 'redirect_search_to_shop_page');





/* 
custom_breadcrumb
 */
function custom_breadcrumb($crumbs) {
    if (is_checkout()) {
        $cart_page_id = wc_get_page_id('cart');
        $cart_page_url = get_permalink($cart_page_id);
        $cart_crumb = array('Кошик', $cart_page_url);

        // Insert the Cart breadcrumb before the last item (Checkout page)
        array_splice($crumbs, 1, 0, array($cart_crumb));
    }
    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'custom_breadcrumb');


/* 
custom_override_checkout_fields_2
 */
// function custom_override_checkout_fields_2( $fields ) {
//     foreach ( $fields as $section => &$field_group ) {
//         foreach ( $field_group as $field_key => &$field ) {
//             if ( isset( $field['required'] ) && $field['required'] ) {
//                 $field['label'] .= ' *';
//             }
//         }
//     }
//     return $fields;
// }
// add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields_2' );



/* 
add_star_to_required_fields_placeholder
 */
// function add_star_to_required_fields_placeholder( $fields ) {
//     foreach ( $fields as $fieldset_key => $fieldset ) {
//         foreach ( $fieldset as $key => $field ) {
//             if ( isset( $field['required'] ) && $field['required'] ) {
//                 $fields[$fieldset_key][$key]['placeholder'] .= ' *';
//             }
//         }
//     }

//     return $fields;
// }
// add_filter( 'woocommerce_checkout_fields' , 'add_star_to_required_fields_placeholder' );




/* 
custom_override_checkout_fields
 */
function custom_override_checkout_fields($fields) {
    $fields['billing']['billing_first_name']['maxlength'] = 70;
    $fields['billing']['billing_last_name']['maxlength'] = 70;

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');





/* 
add_all_products_breadcrumb
 */
function add_all_products_breadcrumb($crumbs, $breadcrumb) {
    if (is_product()) {
        $shop_page_id = wc_get_page_id('shop');
        if ($shop_page_id > 0) {
            $shop_page_url = get_permalink($shop_page_id);
            $shop_crumb = array(__('Всі товари', 'your-text-domain'), $shop_page_url);
            array_splice($crumbs, 1, 0, array($shop_crumb));
        }
    }
    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'add_all_products_breadcrumb', 20, 2);



/* 
add_all_products_breadcrumb_02
 */
function add_all_products_breadcrumb_02($crumbs, $breadcrumb) {
    if (is_shop() && is_wishlist_endpoint()) {
        $wishlist_page_url = '#';
        $wishlist_crumb = array(__('Список бажань', 'your-text-domain'), $wishlist_page_url);
        $crumbs[] = $wishlist_crumb;
    }

    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'add_all_products_breadcrumb_02', 10, 2);





/* 
change_coupon_text_ua
 */
// function change_coupon_text_ua($translated_text, $text, $domain) {
//     if (strpos($text, 'Coupon') !== false) {
//         $translated_text = str_replace('Купон', 'Промокод', $translated_text);
//     }

//     // switch ($text) {
//     //     case 'Coupon':
//     //         $translated_text = 'Промокод';
//     //         break;
//     //     case 'Coupon code':
//     //         $translated_text = 'Промокод';
//     //         break;
//     //     case 'Apply coupon':
//     //         $translated_text = 'Застосувати промокод';
//     //         break;
//     //     case 'Coupon has been removed!':
//     //         $translated_text = 'Промокод був видалений!';
//     //         break;
//     //     case 'Coupon code applied successfully.':
//     //         $translated_text = 'Промокод успішно застосований.';
//     //         break;
//     //         // Додайте більше випадків, якщо потрібно змінити інші тексти, що містять "Coupon"
//     // }

//     return $translated_text;
// }
// add_filter('gettext', 'change_coupon_text_ua', 20, 3);




/* 
change_coupon_error_message_text
 */
function change_coupon_error_message_text($translated_text, $text, $domain) {
    if ('woocommerce' === $domain) {
        // Замінюємо повідомлення "Купон 'as' не існує!"
        if (strpos($translated_text, 'Купон') !== false && strpos($translated_text, 'не існує!') !== false) {
            $translated_text = str_replace('Купон', 'Промокод', $translated_text);
        }
    }
    return $translated_text;
}
add_filter('gettext', 'change_coupon_error_message_text', 20, 3);




/* 
change_coupon_success_message_text
 */
function change_coupon_success_message_text($translated_text, $text, $domain) {
    if ('woocommerce' === $domain) {
        if ($translated_text === 'Код купона успішно застосовано.') {
            $translated_text = 'Код промокоду успішно застосовано.';
        }
    }
    return $translated_text;
}
add_filter('gettext', 'change_coupon_success_message_text', 20, 3);




function change_shipping_method_text($translated_text, $text, $domain) {
    if ('woocommerce' === $domain) {
        // Замінюємо текст "Новая почта:" на "Нова пошта:"
        if (strpos($translated_text, 'Nova Poshta') !== false) {
            $translated_text = str_replace('Nova Poshta', 'Нова пошта', $translated_text);
        }
    }
    return $translated_text;
}
add_filter('gettext', 'change_shipping_method_text', 20, 3);



/* 
disable_woocommerce_ajax_product_remove
 */
function disable_woocommerce_ajax_product_remove() {
    if (is_cart()) {
        wp_dequeue_script('wc-cart');
        wp_deregister_script('wc-cart');

        wp_register_script('wc-cart', get_template_directory_uri() . '/js/wc-cart-no-ajax.js', array('jquery'), '', true);
        wp_enqueue_script('wc-cart');
    }
}
add_action('wp_enqueue_scripts', 'disable_woocommerce_ajax_product_remove', 99);




/* 
handle_remove_cart_item
 */
function handle_remove_cart_item() {
    check_ajax_referer('remove_item_nonce', 'nonce');

    $product_id = intval($_POST['product_id']);
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

    if (WC()->cart->remove_cart_item($cart_item_key)) {
        $cart_count = WC()->cart->get_cart_contents_count();

        if ($cart_count) {
            $pluralized = pluralize($cart_count);
            $pluralized = "$cart_count $pluralized.";

            // Total
            $cart_total = WC()->cart->get_total('raw');
            $formatted_cart_total = number_format($cart_total, 2, '.', ' ');
            $cart_total = $formatted_cart_total . ' грн';


            echo json_encode(array('success' => true, 'cart_count'  => $cart_count, 'pluralized' => $pluralized, 'cart_total' => $cart_total));
        } else {
            echo json_encode(array('success' => false));
        }
    } else {
        wp_send_json_error();
    }

    wp_die(); // Terminate script
}
add_action('wp_ajax_remove_cart_item', 'handle_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'handle_remove_cart_item');






/* 
custom_remove_add_to_cart_param
 */
function custom_remove_add_to_cart_param() {
    if (is_cart() && isset($_GET['add-to-cart'])) {
        wp_safe_redirect(remove_query_arg('add-to-cart'));
        exit;
    }
}
add_action('template_redirect', 'custom_remove_add_to_cart_param');




/* 
update_payment_method
 */
function update_payment_method() {
    if (!isset($_POST['payment_method'])) {
        wp_send_json_error();
    }

    $payment_method = sanitize_text_field($_POST['payment_method']);

    WC()->session->set('chosen_payment_method', $payment_method);
    wp_send_json_success();
}
add_action('wp_ajax_update_payment_method', 'update_payment_method');
add_action('wp_ajax_nopriv_update_payment_method', 'update_payment_method');





/* 
get_available_payment_methods
 */
function get_available_payment_methods() {
    if (!class_exists('WooCommerce')) {
        return [];
    }
    $payment_gateways = WC()->payment_gateways->get_available_payment_gateways();
    $methods = [];
    foreach ($payment_gateways as $gateway) {
        $methods[$gateway->id] = $gateway->get_title();
    }
    return $methods;
}





/* 
add_new_tag_to_price_wc
 */
function add_new_tag_to_price_wc($price) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(wc_price($price));

    // Find all span elements with the class "woocommerce-Price-currencySymbol"
    $currency_symbols = $dom->getElementsByTagName('span');

    foreach ($currency_symbols as $currency_symbol) {
        if ($currency_symbol->getAttribute('class') == 'woocommerce-Price-currencySymbol' && $currency_symbol->nodeValue == '₴') {
            // Create a new span element
            $new_span = $dom->createElement('span', '/од.');
            $new_span->setAttribute('class', 'woocommerce-Price-per-count');

            // Append the new span after the currency symbol span
            $currency_symbol->parentNode->appendChild($new_span);
        }
    }

    return $modified_price = $dom->saveHTML();
}



/* 
Validate custom billing phone field
 */
function custom_validate_billing_phone() {
    if (isset($_POST['billing_phone_valid']) && $_POST['billing_phone_valid'] === 'true') {
        $_POST['billing_phone_valid'] = true;
    } else {
        wc_add_notice(__('Введіть вірний номер телефону'), 'error');
    }
}
add_action('woocommerce_checkout_process', 'custom_validate_billing_phone', 100);




/* 
custom_function_after_checkout_completion
 */
function custom_function_after_checkout_completion($order_id) {
    $billing_phone      = sanitize_text_field($_POST["billing_phone"]);
    $phone_code_country = sanitize_text_field($_POST["phone_code_country"]);

    $user_id = get_current_user_id();

    if (!empty($user_id)) {
        if (!empty($billing_phone)) {
            update_user_meta($user_id, 'billing_phone', $billing_phone);
            update_user_meta($user_id, 'phone_code_country', $phone_code_country);
        }
    }
}
add_action('woocommerce_checkout_order_processed', 'custom_function_after_checkout_completion', 10, 1);





/* 
custom_remove_billing_phone_required_notice
 */
function custom_remove_billing_phone_required_notice($notice) {
    // Check if the notice contains the text related to the billing phone field
    if (is_checkout()) {
        if (strpos($notice, 'Оплата Телефон') !== false) {
            // Remove the notice
            $notice = '';
        }
    }

    return $notice;
}
//add_filter('woocommerce_checkout_required_field_notice', 'custom_remove_billing_phone_required_notice');




/* 
Создание аккаунта пользователя после оформления заказа
 */
function custom_checkout_field_update_order_meta($order_id) {
    if ($_POST['create_account']) {
        $order      = wc_get_order($order_id);
        $email      = $order->get_billing_email();
        $first_name = $order->get_billing_first_name();
        $last_name  = $order->get_billing_last_name();

        if (!email_exists($email)) {
            $password = wp_generate_password();
            $user_id = wc_create_new_customer($email, '', $password);

            if (is_wp_error($user_id)) {
                wc_add_notice(__('Error: Unable to create account. Please try again.', 'woocommerce'), 'error');
            } else {
                // Prepare email content
                $subject = 'Ласкаво просимо на наш сайт';
                $message = 'Привіт ' . $first_name . '' . $last_name . "\n\n";
                $message .= "Ваші облікові дані:\n";
                $message .= "Email: " . $email . "\n";
                $message .= "Пароль: " . $password . "\n";
                $message .= "З повагою, Команда сайту <a href='" . home_url() . "'>" . get_bloginfo('name') . "</a>";
                $headers = array('Content-Type: text/html; charset=UTF-8');

                // Send email
                wp_mail($email, $subject, $message, $headers);

                wp_update_user(array(
                    'ID' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name
                ));

                $order->set_customer_id($user_id);
                $order->save();
                wc_set_customer_auth_cookie($user_id);

                // Отправка письма пользователю с информацией для входа
                //  wp_new_user_notification($user_id, null, 'both');
            }
        }
    }
}
add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');




/* 
Allow log in with email address in WooCommerce
 */
function wc_email_login_authenticate($user, $username, $password) {
    if (is_email($username)) {
        $user = get_user_by('email', $username);
        if ($user) {
            $username = $user->user_login;
        }
    }
    return wp_authenticate_username_password(null, $username, $password);
}
add_filter('authenticate', 'wc_email_login_authenticate', 20, 3);



/* 
Enforce email address login
 */
function wc_email_login_process_login_errors($validation_error, $username, $password) {
    if (!is_email($username)) {
        $validation_error->add('invalid_email', __('Потрібна дійсна електронна адреса.', 'woocommerce'));
    }
    return $validation_error;
}
add_filter('woocommerce_process_login_errors', 'wc_email_login_process_login_errors', 10, 3);





/* 
check_lost_password_page
 */
function check_lost_password_page() {
    if (is_wc_endpoint_url('lost-password')) {
        if (is_user_logged_in()) {
            wp_redirect(get_permalink(wc_get_page_id('myaccount')));
            exit;
        }
    }
}
add_action('template_redirect', 'check_lost_password_page');




/* 
woocommerce_checkout_show_terms
 */
add_filter('woocommerce_checkout_show_terms', '__return_false');




/* 
remove_coupon_form
 */
function remove_coupon_form() {
    remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
}
add_action('init', 'remove_coupon_form');




/**
 * Получить одно изображение для каждого продукта в заказе WooCommerce.
 *
 * @param WC_Order $order Объект заказа WooCommerce.
 * @return array Ассоциативный массив с ID продукта и URL его основного изображения.
 */
function get_images_for_products_in_order($order) {
    $product_images = array();

    $items = $order->get_items();

    foreach ($items as $item_id => $item) {
        $product = $item->get_product();

        if ($product) {
            $product_id = $product->get_id();

            $image = get_the_post_thumbnail($product_id, 'image-size-3', array('class' => 'product-' . $product_id));

            if (!empty($image)) {
                $product_images[$product_id] = $image;
            }
        }
    }

    return $product_images;
}




/* 
Add custom columns to the orders table
 */
function custom_order_columns($columns) {
    // Rearrange columns as needed
    $new_columns = array(
        'order-number'   => '№ замовлення',
        'order-quantity' => __('Кількість', 'woocommerce'),
        'order-total'    => 'Сума замовлення',
        'order-status'    => $columns['order-status'],
        'delivery_method' => __('Спосіб доставки', 'woocommerce'),
        //'order-date'    => $columns['order-date'],
        //'order-actions' => $columns['order-actions'],
    );
    return $new_columns;
}
add_filter('woocommerce_my_account_my_orders_columns', 'custom_order_columns');




/* 
Populate the custom column with order quantity
 */
function custom_order_quantity_column_content($order) {
    // Get the order ID
    $order_id = $order->get_id();

    // Get order items
    $order_items = $order->get_items();

    // Initialize quantity variable
    $total_quantity = 0;

    // Loop through order items to calculate total quantity
    foreach ($order_items as $item_id => $item) {
        $total_quantity += $item->get_quantity();
    }

    // Output the total quantity
    echo $total_quantity . ' од.';
}
add_action('woocommerce_my_account_my_orders_column_order-quantity', 'custom_order_quantity_column_content');




/* 
Populate the custom column with total price
 */
add_action('woocommerce_my_account_my_orders_column_order-total', 'custom_order_total_column_content');
function custom_order_total_column_content($order) {
    // Get the order total
    $order_total = $order->get_total();

    // Output the order total
    echo wc_price($order_total, array('currency' => ''));
}




/* 
Add custom column to the orders table
 */
function custom_delivery_method_column($columns) {
    // Add the new column at the end
    $columns['delivery_method'] = __('Спосіб доставки', 'woocommerce');
    return $columns;
}
add_filter('woocommerce_my_account_my_orders_columns', 'custom_delivery_method_column');





/* 
get_order_shipping_method
 */
// function get_order_shipping_method($order) {
//     if (!$order) {
//         return false;
//     }
//     $shipping_methods = array();
//     foreach ($order->get_shipping_methods() as $shipping_item_id => $shipping_item) {
//         $shipping_method = $shipping_item->get_method_id();
//         $shipping_methods[] = $shipping_method;
//     }
//     return implode(', ', $shipping_methods);
// }




/* 
Populate the custom column with delivery method data
 */
function custom_delivery_method_column_content($order) {
    $order_id = $order->get_id();

    $shipping_method    = $order->get_shipping_method();
    $shipping_address_1 = $order->get_shipping_address_1();

    if ($shipping_method == 'Новая почта') {
        $shipping_method = 'Нова пошта';
    }

    if ($shipping_method == 'Нова пошта') {
        if (mb_stripos($shipping_address_1, 'відділення') !== false) {
            $shipping_method = 'У відділення “Нова Пошта”';
        } elseif (mb_stripos($shipping_address_1, 'поштомат') !== false) {
            $shipping_method = 'До поштомату “Нова Пошта”';
        } else {
            $shipping_method = 'Нова Пошта”';
        }
    }

    echo $shipping_method;
}
add_action('woocommerce_my_account_my_orders_column_delivery_method', 'custom_delivery_method_column_content');





/* 
product_in_wishlist_user
 */
function product_in_wishlist_user($product_id) {
    $user_id  = get_current_user_id();
    $wishlist = get_user_meta($user_id, 'wishlist', true);

    if (!empty($wishlist)) {
        if (in_array($product_id, $wishlist)) {
            return true;
        }
    }
}





/* 
Check if the current request is for the wishlist endpoint
 */
function is_wishlist_endpoint() {
    // Get the requested URL
    $request_uri = $_SERVER['REQUEST_URI'];

    // Define your wishlist endpoint
    $wishlist_endpoint = '/wishlist';

    // Check if the request URI contains the wishlist endpoint
    if (strpos($request_uri, $wishlist_endpoint) !== false) {
        return true;
    } else {
        return false;
    }
}



/* 
change_orders_tab_text
 */
function change_orders_tab_text($tabs) {
    $tabs['orders'] = __('Мої замовлення', 'woocommerce');
    $tabs['edit-account'] = __('Інформація', 'woocommerce');

    return $tabs;
}
add_filter('woocommerce_account_menu_items', 'change_orders_tab_text', 10, 1);




// // Modify WooCommerce breadcrumbs for wishlist endpoint
// add_filter('woocommerce_get_breadcrumb', 'custom_modify_woocommerce_breadcrumbs', 10, 2);

// function custom_modify_woocommerce_breadcrumbs($crumbs, $breadcrumb) {
//     global $wp;

//     // Check if wishlist endpoint is active
//     if (isset($wp->query_vars['wishlist'])) {
//         // Get the shop page URL
//         $shop_url = get_permalink(wc_get_page_id('shop'));

//         // Add breadcrumbs for Home, Shop, and Wishlist
//         $wishlist_crumb = array(
//             __('Home', 'woocommerce') => home_url(),
//             __('Shop', 'woocommerce') => $shop_url,
//             __('Wishlist', 'woocommerce') => '',
//         );

//         // Combine and return breadcrumbs
//         $crumbs = array_merge($crumbs, $wishlist_crumb);
//     }

//     return $crumbs;
// }



/* 
Add custom endpoint for wishlist
 */
function custom_rewrite_endpoint() {
    //  add_rewrite_endpoint('wishlist', EP_PAGES);
    // Check if we are on the shop or my-account page
    add_rewrite_endpoint('wishlist', EP_PAGES);

    // if (is_shop() || is_account_page()) {
    //     add_rewrite_endpoint('wishlist', EP_PAGES);
    // }
}
add_action('init', 'custom_rewrite_endpoint');


// // Check if current page is WooCommerce shop page
// function is_shop_page() {
//     return (is_post_type_archive('product') || (function_exists('is_shop') && is_shop()));
// }

// // Check if current page is WooCommerce my account page
// function is_account_page() {
//     return (is_account_page() || is_page(wc_get_page_id('myaccount')));
// }


/* 
Redirect 'my-account/wishlist/' to custom wishlist page
 */
function custom_wishlist_redirect() {
    if (is_user_logged_in() && is_page('my-account') && isset($_GET['wishlist'])) {
        wp_redirect(home_url('/my-account/wishlist/'));
        exit();
    }
}
add_action('template_redirect', 'custom_wishlist_redirect');



/* 
remove_dashboard_and_downloads_tabs
 */
function remove_dashboard_and_downloads_tabs($items) {
    unset($items['dashboard']);
    unset($items['downloads']);
    unset($items['edit-address']);
    unset($items['customer-logout']);
    $items['wishlist'] = __('Список бажань', 'woocommerce');

    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_dashboard_and_downloads_tabs', 999);


/* 
custom_woocommerce_lost_password_message
 */
function custom_woocommerce_lost_password_message($message) {
    $message = "Введіть адресу електронної пошти, яку ви використовували під час створення облікового запису. Ви отримаєте тимчасове посилання для скидання пароля.";
    return $message;
}
add_filter('woocommerce_lost_password_message', 'custom_woocommerce_lost_password_message', 10, 3);





/* 
custom_redirect_to_custom_login_page
 */
function custom_redirect_to_custom_login_page() {
    // Check if it's a WooCommerce login page
    $current_url = basename($_SERVER['REQUEST_URI']);

    if ($current_url === 'my-account' && !is_user_logged_in()) {
        // Redirect to your custom login page
        wp_redirect(home_url('/login'));
        exit();
    }
}
add_action('template_redirect', 'custom_redirect_to_custom_login_page');





/* 
custom_checkout_fields_placeholders
 */
function custom_checkout_fields_placeholders($fields) {
    // Замінюємо лейбли на плейсхолдери для кожного поля
    $fields['billing']['billing_first_name']['placeholder'] = 'Ім\'я *';
    $fields['billing']['billing_last_name']['placeholder'] = 'Прізвище *';
    $fields['billing']['billing_phone']['placeholder'] = '+38 (099) 000 00 00 *';
    $fields['billing']['billing_email']['placeholder'] = 'Електронна пошта *';
    //   $fields['billing']['billing_company']['placeholder'] = 'Назва компанії';

    // Make billing_phone required
    // $fields['billing']['billing_phone']['required'] = true;

    // Додавайте або змінюйте плейсхолдери для інших полів тут за необхідності
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_checkout_fields_placeholders');




/* 
custom_checkout_required_field_notice
 */
function custom_checkout_required_field_notice($notice, $field_label) {
    $replace = array(
        'Оплата Ім\'я *' => 'Ім\'я',
        'Оплата Прізвище *' => 'Прізвище',
        'Оплата Телефон' => 'Телефон',
        'Оплата Введіть адресу доставки' => 'Адреса доставки'
    );

    if (isset($replace[$field_label])) {
        $field_label = $replace[$field_label];
    }

    return sprintf('%s - обов\'язкове поле.', $field_label);
}
add_filter('woocommerce_checkout_required_field_notice', 'custom_checkout_required_field_notice', 10, 2);




/* 
custom_woocommerce_after_checkout_validation
 */
function custom_woocommerce_after_checkout_validation($data, $errors) {
    // Iterate through each error and customize the message
    foreach ($errors->get_error_codes() as $code) {
        $messages = $errors->get_error_messages($code);
        $errors->remove($code);

        foreach ($messages as $message) {
            // Check if the message contains specific fields and wrap them with <strong> tags
            if (strpos($message, 'Ім\'я') !== false) {
                $message = str_replace('Ім\'я', '<strong>Ім\'я</strong>', $message);
            }
            if (strpos($message, 'Прізвище') !== false) {
                $message = str_replace('Прізвище', '<strong>Прізвище</strong>', $message);
            }
            if (strpos($message, 'Телефон') !== false) {
                $message = str_replace('Телефон', '<strong>Телефон</strong>', $message);
            }
            if (strpos($message, 'Адреса доставки') !== false) {
                $message = str_replace('Адреса доставки', '<strong>Адреса доставки</strong>', $message);
            }

            $errors->add($code, $message);
        }
    }
}
add_action('woocommerce_after_checkout_validation', 'custom_woocommerce_after_checkout_validation', 10, 2);





/* 
custom_override_checkout_fields2
 */
function custom_override_checkout_fields2($fields) {
    // Изменяем метки полей
    $fields['billing']['billing_first_name']['label'] = 'Ім\'я';
    $fields['billing']['billing_last_name']['label'] = 'Прізвище';

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields2');





/* 
custom_override_address_placeholder
 */
function custom_override_address_placeholder($translated, $text, $domain) {
    if ($text === 'House number and street name') {
        $translated = 'Введіть адресу доставки *';
    }
    return $translated;
}
add_filter('gettext', 'custom_override_address_placeholder', 10, 3);





/* 
remove_billing_checkout_field
 */
function remove_billing_checkout_field($fields) {
    //unset($fields['billing']['billing_country']);
    //  unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_city']);

    $fields['billing']['billing_first_name']['label'] = 'Ім\'я *';
    $fields['billing']['billing_last_name']['label'] = 'Прізвище *';
    $fields['billing']['billing_address_1']['label'] = 'Введіть адресу доставки';
    $fields['billing']['billing_address_1']['placeholder'] = 'Введіть адресу доставки';

    unset($fields['billing']['billing_company']);
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'remove_billing_checkout_field', 1000);

function remove_billing_country_validation($posted) {
    if (isset($posted['billing_country'])) {
        unset($posted['billing_country']);
    }
}

add_filter('woocommerce_default_address_fields', 'remove_country_validation',);

function remove_country_validation($address_fields) {
    if (isset($address_fields['country'])) {
        $address_fields['country']['required'] = false;
    }
    return $address_fields;
}





/* 
change_billing_details_text
 */
function change_billing_details_text($translated_text, $text, $domain) {
    if (is_checkout()) {
        if ($text === 'Billing details') {
            $translated_text = 'Ваші контактні дані';
        }

        if ($text === 'Place order') {
            $translated_text = 'Завершити оформлення';
        }

        if ($text === 'Select shipping address') {
            $translated_text = 'Доставка';
        }

        if ($text === 'to warehouse') {
            $translated_text = 'У відділення нової пошти';
        }

        if ($text === 'to doors') {
            $translated_text = 'До дверей';
        }

        if ($text === 'to the poshtomat') {
            $translated_text = 'На поштомат';
        }
    }



    return $translated_text;
}
add_filter('gettext', 'change_billing_details_text', 20, 3);




/* 
disable_woocommerce_styles
 */
function disable_woocommerce_styles($enqueue_styles) {
    // Перевіряємо, чи знаходимось ми на конкретній сторінці за URL-адресою
    //  is_account_page()
    if (is_shop() || is_product() || is_cart() || is_wc_endpoint_url('orders') || is_product_category() || is_wc_endpoint_url('order-received')) {
        // Вимикаємо стилі лише на цій сторінці
        unset($enqueue_styles['woocommerce-general']);
        unset($enqueue_styles['woocommerce-layout']);
        unset($enqueue_styles['woocommerce-smallscreen']);
        unset($enqueue_styles['woocommerce_frontend_styles']);
    }

    return $enqueue_styles;

    // $enqueue_styles = array();
    // return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'disable_woocommerce_styles');





/* 
custom_checkout_button_text
 */
function custom_checkout_button_text($button_text) {
    return 'New Button Text'; // Change 'New Button Text' to your desired text
}
add_filter('woocommerce_proceed_to_checkout', 'custom_checkout_button_text');




/* 
get_quantity_declension_uk
 */
function get_quantity_declension_uk($number, $one, $two, $five) {
    $number = abs($number) % 100;
    $number1 = $number % 10;
    if ($number > 10 && $number < 20) {
        return $five;
    }
    if ($number1 > 1 && $number1 < 5) {
        return $two;
    }
    if ($number1 == 1) {
        return $one;
    }
    return $five;
}




/* 
custom_cart_item_subtotal
 */
function custom_cart_item_subtotal() {
    // Get the cart instance
    $cart = WC()->cart;

    // Get the total quantity of items in the cart
    $total_items = $cart->get_cart_contents_count();

    // Get the total amount in the cart
    $total_amount = $cart->get_cart_total();

    // Customize the message according to your language and preference
    $declension = get_quantity_declension_uk($total_items, 'товар', 'товари', 'товарів');
    $message = sprintf(__('<span>Загалом</span> %d %s на суму', 'your-text-domain'), $total_items, $declension, wc_price($total_amount));
?>
    <div class="data-tovari-na-sumu">
        <?php echo $message; ?>
    </div>
<?php
}
//add_action('woocommerce_cart_totals_before_order_total', 'custom_cart_item_subtotal', 10, 3);





/* 
custom_order_total_html
 */
function custom_order_total_html($order_total_html) {
    // Get the cart total
    $cart_total = WC()->cart->get_cart_contents_total();

    // Convert the cart total to a float
    $cart_total_float = floatval($cart_total);

    // Format the cart total with two decimal places and thousand separator
    $formatted_total = number_format($cart_total_float, 2, '.', ' ');

    // Add the currency symbol
    $formatted_total .= ' ₴';

?>
    <div class="data-cart-total">
        <?php echo $formatted_total; ?>
    </div>
<?php
}
//add_action('woocommerce_cart_totals_before_order_total', 'custom_order_total_html');





/* 
custom_order_total_html_both
 */
function custom_order_total_html_both($order_total_html) {
?>
    <div class="data-cart-b1">
        <?php
        custom_cart_item_subtotal();
        custom_order_total_html($order_total_html);
        ?>
    </div>
<?php
}
add_action('woocommerce_cart_totals_before_order_total', 'custom_order_total_html_both');



/* 
change_signin_text
 */
add_filter('gettext', 'change_signin_text', 20, 3);
function change_signin_text($translated_text, $text, $domain) {
    if ($text === 'Login' && (is_account_page() || is_page_template('page-tempates/login.php'))) {
        $translated_text = 'Увійдіть у свій обліковий запис';
    }
    return $translated_text;
}





/* 
is_woocommerce_page
 */
function is_woocommerce_page() {
    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        // Check if the current page is a WooCommerce page
        if (is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_product() || is_product_category() || is_product_tag()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}




/* 
Функция для вывода общей цены конкретного продукта в корзине без учета скидки
 */
function get_product_total_without_discount($product_id, $quantity, $sign_type = '') {
    // Получаем объект корзины
    $cart = WC()->cart;

    // Получаем общую сумму указанного продукта в корзине без учета скидки
    $total_without_discount = wc_get_product($product_id)->get_regular_price() * $quantity;

    // Возвращаем общую сумму указанного продукта без учета скидки
    if ($sign_type) {
        $formattedNumber = number_format($total_without_discount, 2, '.', ' ');
        $formattedNumber .= ' ' . $sign_type;
        return $formattedNumber;
    }

    return wc_price($total_without_discount);
}


/* 
Функция для вывода общей цены конкретного продукта в корзине с учетом скидки
 */
function get_product_total_with_discount($product_id, $quantity, $sign_type = '') {
    // Получаем объект корзины
    $cart = WC()->cart;

    // Получаем общую сумму указанного продукта в корзине с учетом скидки
    $total_with_discount = wc_get_product($product_id)->get_sale_price() * $quantity;

    //Возвращаем общую сумму указанного продукта с учетом скидки
    if ($sign_type) {
        $formattedNumber = number_format($total_with_discount, 2, '.', ' ');
        $formattedNumber .= ' ' . $sign_type;
        return $formattedNumber;
    }

    return wc_price($total_with_discount);
}





/* 
add_custom_body_class
 */
function add_custom_body_class($classes) {
    if (is_page_template('page-tempates/login.php')) {
        $classes[] = 'woocommerce-account';
        $classes[] = 'woocommerce-page';
    }

    if (!is_user_logged_in()) {
        $classes[] = 'no-login';
    }

    if (is_wishlist_endpoint()) {
        $classes[] = 'is-wishlist';
    }

    return $classes;
}
add_filter('body_class', 'add_custom_body_class');





/* 
remove_products_from_cart
 */
function remove_products_from_cart() {
    // Make sure WooCommerce is active
    if (class_exists('WooCommerce')) {
        // Get WooCommerce cart instance
        $woocommerce = WC();

        // Get current user's ID
        $user_id = get_current_user_id();

        // Check if user is logged in
        if ($user_id) {
            // Get cart instance for the user
            $cart = $woocommerce->cart->get_cart_for_session();

            // Loop through each cart item and remove it
            foreach ($cart as $cart_item_key => $cart_item) {
                $woocommerce->cart->remove_cart_item($cart_item_key);
            }
        } else {
            // If user is not logged in, clear cart session for guests
            $woocommerce->cart->empty_cart();
        }
    }
}




// Exclude Uncategorized category from WooCommerce breadcrumbs
function exclude_uncategorized_from_breadcrumbs($crumbs) {
    foreach ($crumbs as $key => $crumb) {
        
        if (isset($crumb[0]) && $crumb[0] == 'Без категорії') {
            unset($crumbs[$key]);
        }
        if (isset($crumb[0]) && $crumb[0] == 'Uncategorized') {
            unset($crumbs[$key]);
        }
    }
    return array_values($crumbs); // reindex array
}
add_filter('woocommerce_get_breadcrumb', 'exclude_uncategorized_from_breadcrumbs');
