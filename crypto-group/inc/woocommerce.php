<?php

// user_is_active_subscriber







/* 
check_membership_and_redirect_to_checkout
 */
function check_membership_and_redirect_to_checkout() {
    if (is_singular('video') || is_page('listing-video')) {
        if (!user_is_active_subscriber()) {
            $products = get_field('products', 'option');
            $product_id  = $products['product_1'];

            WC()->cart->empty_cart();
            WC()->cart->add_to_cart($product_id);

            wp_safe_redirect(wc_get_checkout_url());
            exit;
        }
    }
}
add_action('template_redirect', 'check_membership_and_redirect_to_checkout');






/* 
get_membership_product_level
 */
function get_membership_product_level() {
    // Replace with your WooCommerce product ID
    $products = get_field('products', 'option');
    $product_id  = $products['product_1'];

    // Ensure the product ID is valid
    if (!$product_id) {
        return false;
    }

    // Get the product
    $product = wc_get_product($product_id);

    // Ensure it's a subscription product
    if ($product && $product->is_type('subscription')) {
        // Get the _membership_product_level meta value
        $membership_product_level = get_post_meta($product_id, '_membership_product_level', true);
        return $membership_product_level;
    } else {
        return false;
    }
}






/* 
handle_subscription_cancellation_event
 */
function handle_subscription_cancellation_event($subscription) {
    $products = get_field('products', 'option');
    $product_id  = $products['product_1'];

    $items = $subscription->get_items();
    $product_ids = array();

    foreach ($items as $item) {
        $product_ids[] = $item->get_product_id();
    }

    $contains_product = in_array($product_id, $product_ids) ? true : false;

    if ($contains_product) {
        handle_subscription_change($subscription);
    }
}

add_action('woocommerce_subscription_status_cancelled', 'handle_subscription_cancellation_event', 10, 1);
add_action('woocommerce_subscription_status_expired', 'handle_subscription_cancellation_event', 10, 1);
add_action('woocommerce_subscription_status_on-hold', 'handle_subscription_cancellation_event', 10, 1);





/* 
handle_subscription_change
 */
function handle_subscription_change($subscription) {
    $user_id = $subscription->get_user_id();
    $discord_user_id = get_user_meta($user_id, '_ets_pmpro_discord_user_id', true);

    if ($discord_user_id) {
        $discord_guild_id = get_option('ets_pmpro_discord_guild_id');
        $discord_bot_token = get_option('ets_pmpro_discord_bot_token');

        remove_user_from_discord($discord_user_id, $discord_guild_id, $discord_bot_token);
    }
}




/* 
remove_user_from_discord
 */
function remove_user_from_discord($discord_user_id, $guild_id, $bot_token) {
    $url = "https://discord.com/api/guilds/{$guild_id}/members/{$discord_user_id}";

    $args = array(
        'method'    => 'DELETE',
        'headers'   => array(
            'Authorization' => 'Bot ' . $bot_token
        ),
        'timeout'   => 30
    );

    $response = wp_remote_request($url, $args);
}





/* 
remove_add_to_cart_param_on_checkout
 */
function remove_add_to_cart_param_on_checkout() {
    if (is_checkout() && isset($_GET['add-to-cart'])) {
        unset($_GET['add-to-cart']);

        wc_clear_notices();

        wp_redirect(wc_get_checkout_url());
        exit;
    }
}
add_action('template_redirect', 'remove_add_to_cart_param_on_checkout');






/* 
disable_woocommerce_styles
 */
function disable_woocommerce_styles($enqueue_styles) {
    $data = (is_checkout() || is_account_page()) && false;

    if ($data) {
        unset($enqueue_styles['woocommerce-general']);
        unset($enqueue_styles['woocommerce-layout']);
        unset($enqueue_styles['woocommerce-smallscreen']);
        unset($enqueue_styles['woocommerce_frontend_styles']);
    }

    return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'disable_woocommerce_styles');






/* 
custom_override_checkout_fields_2
 */
function custom_override_checkout_fields_2($fields) {
    $fields['billing'] = custom_override_billing_fields_2($fields['billing']);
    $fields['shipping'] = custom_override_shipping_fields_2($fields['shipping']);
    $fields['order']['order_comments']['placeholder'] = 'Pastabos apie jūsų užsakymą, pvz., specialios pastabos dėl pristatymo.';

    return $fields;
}

function custom_override_billing_fields_2($fields) {
    $fields['billing_first_name']['placeholder'] = 'Vardas';
    $fields['billing_last_name']['placeholder'] = 'Pavardė';
    $fields['billing_company']['placeholder'] = 'Įmonės pavadinimas';
    $fields['billing_address_1']['placeholder'] = 'Gatvės adresas';
    $fields['billing_address_2']['placeholder'] = 'Butas, apartamentai, kambarys ir pan. (nebūtina)';
    $fields['billing_city']['placeholder'] = 'Miestas';
    $fields['billing_state']['placeholder'] = 'Apskritis';
    $fields['billing_postcode']['placeholder'] = 'Pašto kodas';
    $fields['billing_country']['placeholder'] = 'Šalis';
    $fields['billing_phone']['placeholder'] = 'Telefonas';
    $fields['billing_email']['placeholder'] = 'El. pašto adresas';
    return $fields;
}

function custom_override_shipping_fields_2($fields) {
    $fields['shipping_first_name']['placeholder'] = 'Vardas';
    $fields['shipping_last_name']['placeholder'] = 'Pavardė';
    $fields['shipping_company']['placeholder'] = 'Įmonės pavadinimas';
    $fields['shipping_address_1']['placeholder'] = 'Gatvės adresas';
    $fields['shipping_address_2']['placeholder'] = 'Butas, apartamentai, kambarys ir pan. (nebūtina)';
    $fields['shipping_city']['placeholder'] = 'Miestas';
    $fields['shipping_state']['placeholder'] = 'Apskritis';
    $fields['shipping_postcode']['placeholder'] = 'Pašto kodas';
    $fields['shipping_country']['placeholder'] = 'Šalis';
    return $fields;
}

// Pridėkite vietos rezervacijas į numatytuosius WooCommerce adreso laukus
add_filter('woocommerce_default_address_fields', 'custom_override_default_address_fields');
function custom_override_default_address_fields($fields) {
    $fields['first_name']['placeholder'] = 'Vardas';
    $fields['last_name']['placeholder'] = 'Pavardė';
    $fields['company']['placeholder'] = 'Įmonės pavadinimas';
    $fields['address_1']['placeholder'] = 'Gatvės adresas';
    $fields['address_2']['placeholder'] = 'Butas, apartamentai, kambarys ir pan. (nebūtina)';
    $fields['city']['placeholder'] = 'Miestas';
    $fields['postcode']['placeholder'] = 'Pašto kodas';
    $fields['country']['placeholder'] = 'Šalis';
    $fields['state']['placeholder'] = 'Apskritis';

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields_2');
add_filter('woocommerce_billing_fields', 'custom_override_billing_fields_2', 20, 1);
add_filter('woocommerce_shipping_fields', 'custom_override_shipping_fields_2', 20, 1);





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
custom_checkout_block
 */
function custom_checkout_block() {
    if (is_wc_endpoint_url('order-received')) {
        return;
    }

    $order_id = wc_get_order_id_by_order_key(WC()->session->get('order_awaiting_payment'));
    $order = wc_get_order($order_id);

    if ($order) {
        ob_start();
?>
        <div class="custom-checkout-block">
            <h2>Jūsų užsakymas</h2>
            <table class="shop_table">
                <?php foreach ($order->get_items() as $item_id => $item) : ?>
                    <tr>
                        <th>Jūsų užsakymas:</th>
                        <td><?php echo $item->get_name(); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th>Užsakymo numeris:</th>
                    <td><?php echo $order->get_order_number(); ?></td>
                </tr>
                <tr>
                    <th>Kuponas:</th>
                    <td><?php echo implode(', ', $order->get_coupon_codes()); ?></td>
                </tr>
                <tr>
                    <th>Užsakymo data:</th>
                    <td><?php echo wc_format_datetime($order->get_date_created()); ?></td>
                </tr>
                <tr>
                    <th>Bendra kaina:</th>
                    <td><?php echo wc_price($order->get_total()); ?></td>
                </tr>
            </table>
        </div>
    <?php
        echo ob_get_clean();
    }
}




/* 
Hook to modify the checkout fields
*/
function custom_override_checkout_fields($fields) {
    $fields['billing'] = array(
        'billing_first_name' => array(
            'label'     => __('Vardas', 'woocommerce'),
            'placeholder' => _x('Įveskite vardą', 'placeholder', 'woocommerce'),
            'required'  => true,
            'class'     => array('form-row-first'),
            'clear'     => true
        ),
        'billing_last_name' => array(
            'label'     => __('Pavardė', 'woocommerce'),
            'placeholder' => _x('Įveskite pavardę', 'placeholder', 'woocommerce'),
            'required'  => true,
            'class'     => array('form-row-last'),
            'clear'     => true
        ),
        'billing_email' => array(
            'label'     => __('El. paštas', 'woocommerce'),
            'placeholder' => _x('Įveskite savo el. pašto adresą', 'placeholder', 'woocommerce'),
            'required'  => true,
            'class'     => array('form-row-wide'),
            'clear'     => true
        )
    );

    if (isset($fields['shipping'])) {
        unset($fields['shipping']);
    }

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');




/* 
Add total price block
 */
add_action('woocommerce_checkout_order_review', function () {
    ?>
    <div class="data-b2-total">
        <span class="data-b2-total-label">
            Bendra kaina:
        </span>

        <span class="data-b2-total-value">
            <?php echo wc_price(WC()->cart->total); ?>
        </span>
    </div>
<?php
}, 20);

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20);




/* 
wc_page_redirect
 */
function wc_page_redirect() {
    if (strpos($_SERVER['REQUEST_URI'], '/checkout/order-received/') !== false && !isset($_GET['key'])) {

        wp_redirect(site_url('/'));
        exit();
    }
}
add_action('init', 'wc_page_redirect');



/* 
wc_page_redirect_2
 */
function wc_page_redirect_2() {
    if (isset($_GET['nsl_bypass_cache'])) {

        wp_redirect(site_url('/my-account/'));
        exit();
    }
}
add_action('init', 'wc_page_redirect_2');





/* 
auto_create_user_account_login_after_purchase
 */
function auto_create_user_account_login_after_purchase($order_id) {
    if (!$order_id) {
        return;
    }

    $order      = wc_get_order($order_id);
    $email      = $order->get_billing_email();
    $first_name = $order->get_billing_first_name();
    $last_name  = $order->get_billing_last_name();

    $user = get_user_by('email', $email);

    if (!$user) {
        $password = wp_generate_password();

        $user_id = wp_create_user($email, $password, $email);

        if (!is_wp_error($user_id)) {
            wp_update_user([
                'ID' => $user_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'role' => 'customer'
            ]);

            $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
            $subject = sprintf(__('Jūsų nauja paskyra svetainėje %s'), $blogname);
            $message = sprintf(__('Labas %s,'), $first_name) . "\r\n\r\n";
            $message .= sprintf(__('Ačiū už jūsų pirkimą. Paskyra buvo sukurta jums svetainėje %s.'), $blogname) . "\r\n\r\n";
            $message .= __('Štai jūsų prisijungimo duomenys:') . "\r\n";
            $message .= sprintf(__('Vartotojo vardas: %s'), $email) . "\r\n";
            $message .= sprintf(__('Slaptažodis: %s'), $password) . "\r\n\r\n";
            $message .= wp_login_url() . "\r\n";

            wp_mail($email, $subject, $message);
        }
    } else {
        $user_id = $user->ID;
    }

    wp_set_current_user($user_id, $email);
    wp_set_auth_cookie($user_id);
    do_action('wp_login', $email, get_user_by('ID', $user_id));
}
add_action('woocommerce_thankyou', 'auto_create_user_account_login_after_purchase', 10, 1);




/* 
wc_custom_login_remember_me
 */
function wc_custom_login_remember_me($login) {
    if (!isset($_POST['rememberme'])) {
        $_POST['rememberme'] = 'forever';
    }
}
add_action('woocommerce_login_form_start', 'wc_custom_login_remember_me');




/* 
wc_custom_auto_login
 */
function wc_custom_auto_login($user_login, $user) {
    $secure_cookie = is_ssl();
    wp_set_auth_cookie($user->ID, true, $secure_cookie);
}
add_action('wp_login', 'wc_custom_auto_login', 10, 2);





/* 
wc_page_redirect_3
 */
function wc_page_redirect_3() {
    if (strpos($_SERVER['REQUEST_URI'], '/my-account/discord/') !== false  && !user_is_active_subscriber()) {
        wp_redirect(site_url('/my-account/'), 301);
        exit;
    }
}
add_action('template_redirect', 'wc_page_redirect_3');






/* 
add_login_placeholders
 */
function add_login_placeholders($fields) {
    $fields['username']['placeholder'] = __('El. paštas arba Vartotojo vardas', 'woocommerce');
    $fields['password']['placeholder'] = __('Slaptažodis', 'woocommerce');

    return $fields;
}
add_filter('woocommerce_login_form_fields', 'add_login_placeholders');




/* 
user_is_active_subscribe
 */
function user_is_active_subscriber() {
    $user_id = get_current_user_id();
    $access  = false;

    $products   = get_field('products', 'option');
    $product_id = $products['product_1'];

    $membership_level_id = get_membership_product_level();

    $products   = get_field('products', 'option');
    $product_id = $products['product_1'];

    $membership_level_free_id = '2';
    $level = pmpro_getLevel($membership_level_free_id);

    if ($level) {
        $membership_level_name = $level->name;
        if ($membership_level_name == 'Free' && pmpro_hasMembershipLevel($membership_level_free_id, $user_id)) {
            $access = true;
        }
    }

    if (user_has_active_subscription_to_product($user_id, $product_id) && pmpro_hasMembershipLevel($membership_level_id, $user_id)) {
        $access = true;
    }

    return  $access;
}





/* 
Function to check if a user has an active subscription to a specific product
 */
function user_has_active_subscription_to_product($user_id, $product_id) {
    $subscriptions = wcs_get_users_subscriptions($user_id);
    foreach ($subscriptions as $subscription) {
        if ($subscription->has_status('active')) {
            foreach ($subscription->get_items() as $item) {
                if ($item->get_product_id() == $product_id) {
                    return true;
                }
            }
        }
    }
    return false;
}




/* 
Удалить вкладку "Downloads" из меню "Мой аккаунт"
 */
function remove_downloads_my_account($items) {
    if (isset($items['downloads'])) {
        unset($items['downloads']);
    }
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_downloads_my_account', 999);





/* 
redirect_downloads_to_my_account
 */
function redirect_downloads_to_my_account() {
    if (is_wc_endpoint_url('downloads')) {
        $my_account_url = wc_get_page_permalink('myaccount');

        wp_redirect($my_account_url);
        exit;
    }
}
add_action('template_redirect', 'redirect_downloads_to_my_account');







/* 
 replace_product_links_in_content
 */
function replace_product_links_in_content($content) {
    // Get the site URL dynamically
    $site_url = home_url();

    // Escape the site URL for use in a regex pattern
    $escaped_site_url = preg_quote($site_url, '/');

    // Define the pattern with the site URL
    $pattern = '/<a\s+href=["\']' . $escaped_site_url . '\/product\/standart\/["\'][^>]*>(.*?)<\/a>/i';

    // Define the replacement
    $replacement = '<span>$1</span>';

    // Perform the replacement
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}
add_filter('the_content', 'replace_product_links_in_content');

function apply_replace_to_woocommerce_account() {
    ob_start('replace_product_links_in_content');
}

function end_replace_to_woocommerce_account() {
    ob_end_flush();
}

add_action('woocommerce_account_content', 'apply_replace_to_woocommerce_account', 1);
add_action('woocommerce_account_content', 'end_replace_to_woocommerce_account', 100);





/* 
user_has_active_subscription
 */
function user_has_active_subscription($user_id) {
    if (class_exists('WC_Subscriptions')) {
        $subscriptions = wcs_get_users_subscriptions($user_id);
        foreach ($subscriptions as $subscription) {
            if ($subscription->has_status(array('active', 'on-hold'))) {
                return true;
            }
        }
    }
    return false;
}




/* 
unset_add_renew_now_action
 */
function unset_add_renew_now_action($actions, $subscription) {
    if (wcs_can_user_renew_early($subscription) && $subscription->payment_method_supports('subscription_date_changes') && $subscription->has_status('active')) {

        $actions['subscription_renewal_early'] = array(
            'url'  => '',
            'name' => __('Atnaujinkite dabar', 'woocommerce-subscriptions'),
        );

        unset($actions['subscription_renewal_early']);
    }

    return $actions;
}

add_filter('wcs_view_subscription_actions', 'unset_add_renew_now_action', 10, 2);





// Check coupon usage and restrict if already used by the customer
// add_filter('woocommerce_coupon_is_valid', 'restrict_coupon_usage', 10, 2);
function restrict_coupon_usage($is_valid, $coupon) {
    if (!$is_valid || is_admin()) {
        return $is_valid;
    }

    $user_id = get_current_user_id();
    $coupon_code = $coupon->get_code();

    // Check if the user has already used this coupon
    if (user_has_used_coupon($user_id, $coupon_code)) {
        wc_add_notice(__('Šis kuponas jau panaudotas.', 'your-crypto-group'), 'error');
        return false;
    }

    return $is_valid;
}



// Function to check if the user has already used the coupon
function user_has_used_coupon($user_id, $coupon_code) {
    // Example: Check if the coupon has been used by this user
    $used_coupons = get_user_meta($user_id, 'used_coupons', true);

    if (!$used_coupons) {
        $used_coupons = array();
    }

    if (in_array($coupon_code, $used_coupons)) {
        return true;
    }

    return false;
}






/* 
set_pmpro_membership_enddate_from_woocommerce
 */
function set_pmpro_membership_enddate_from_woocommerce($order_id) {
    // Получаем объект заказа
    $order = wc_get_order($order_id);

    // Получаем ID пользователя из заказа
    $user_id = $order->get_user_id();

    // Проверяем наличие подписок у пользователя
    $subscriptions = wcs_get_users_subscriptions($user_id);

    // Если подписка существует, обновляем дату окончания в PMPro
    foreach ($subscriptions as $subscription) {
        $end_date = $subscription->get_date('next_payment');
        if ($end_date) {
            // Преобразуем дату в формат, используемый PMPro
            $formatted_end_date = date('Y-m-d', strtotime($end_date));

            // Получаем ID уровня членства PMPro для пользователя
            $membership_level = pmpro_getMembershipLevelForUser($user_id);

            global $wpdb;
            $wpdb->update(
                $wpdb->pmpro_memberships_users,
                array('enddate' => $formatted_end_date),
                array('user_id' => $user_id, 'membership_id' => $membership_level->id),
                array('%s'),
                array('%d', '%d')
            );
        }
    }
}

add_action('woocommerce_order_status_completed', 'set_pmpro_membership_enddate_from_woocommerce');




/* 
my_pmpro_email_filter
 */
function my_pmpro_email_filter($message, $email) {
    // Получаем ID пользователя
    $user_id = get_current_user_id();

    // Получаем объект членства
    $membership = pmpro_getMembershipLevelForUser($user_id);

    // Если есть членство
    if ($membership) {
        // Получаем дату окончания членства
        $end_date = $membership->enddate;

        if ($end_date) {
            // Форматируем дату в формате yyyy-mm-dd
            $formatted_end_date = date('Y-m-d', strtotime($end_date));
        } else {
            $formatted_end_date = 'Дата окончания членства не установлена.';
        }
    } else {
        $formatted_end_date = 'Членство не найдено.';
    }

    // Заменяем [MEMBERSHIP_ENDDATE] на отформатированную дату
    $message = str_replace('[MEMBERSHIP_ENDDATE]', $formatted_end_date, $message);

    // Возвращаем измененное содержимое сообщения
    return $message;
}
add_filter("pmpro_email_filter", "my_pmpro_email_filter", 10, 2);




/* 
remove_for_one_item
 */
function remove_for_one_item($price, $product) {
    // Modify or remove text as needed
    return str_replace('for 1 item', '', $price);
}
add_filter('woocommerce_get_price_html', 'remove_for_one_item', 10, 2);


add_filter('woocommerce_subscriptions_get_price_html', 'remove_for_one_item_subscription', 10, 2);

function remove_for_one_item_subscription($price, $subscription) {
    // Modify or remove text as needed
    return str_replace('for 1 item', '', $price);
}

add_filter('woocommerce_get_order_total_html', 'custom_remove_for_one_item_from_order_total', 10, 2);

function custom_remove_for_one_item_from_order_total($total_html, $order) {
    return str_replace('for 1 item', '', $total_html);
}