<?php




/* 
move_subscription_user_to_active_list
 */
function move_subscription_user_to_active_list($subscription) {
    $user_id = $subscription->get_user_id();
    $user    = get_userdata($user_id);
    $email   = $user->user_email;

    $mailerlite      = get_field('mailerlite', 'option');
    $apiKey          = $mailerlite['api_key'];
    $activeGroupId   = $mailerlite['group_1'];
    $unactiveGroupId = $mailerlite['group_2'];

    // Remove from unactive group
    $args = [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $apiKey,
        ],
    ];

    // Encode email for URL
    $encoded_email = urlencode($email);

    $remove_response = wp_remote_request("https://api.mailerlite.com/api/v2/groups/$unactiveGroupId/subscribers/$encoded_email", array_merge($args, ['method' => 'DELETE']));

    if (is_wp_error($remove_response)) {
        error_log('MailerLite API error (remove from unactive): ' . $remove_response->get_error_message());
    }

    // Add to active group
    $data = [
        'email' => $email,
        'name' => $user->first_name . ' ' . $user->last_name,
    ];


    $args['body'] = json_encode($data);

    $add_response = wp_remote_post("https://api.mailerlite.com/api/v2/groups/$activeGroupId/subscribers", $args);

    $state_user_subscription = update_user_meta($user_id, 'state_user_subscription', 'active');

    if (is_wp_error($add_response)) {
        error_log('MailerLite API error (add to active): ' . $add_response->get_error_message());
    }
}
// Hook to add user to MailerLite active group when subscription becomes active and remove from unactive group
add_action('woocommerce_subscription_status_active', 'move_subscription_user_to_active_list', 10, 1);






/* 
get_all_subscribers_from_group
 */
function get_all_subscribers_from_group($group_id) {
    // Fetch API key from options
    $mailerlite = get_field('mailerlite', 'option');
    $apiKey = $mailerlite['api_key'];

    // Setup request arguments
    $args = [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $apiKey,
        ],
    ];

    // Make the request to MailerLite API to get group subscribers
    $response = wp_remote_get("https://api.mailerlite.com/api/v2/groups/$group_id/subscribers", $args);

    if (is_wp_error($response)) {
        error_log('MailerLite API error (fetch group subscribers): ' . $response->get_error_message());
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $subscribers = json_decode($body);

    if (empty($subscribers)) {
        echo 'Šioje grupėje prenumeratorių nerasta.';
        return;
    }

    // Display the subscribers
    echo '<ul>';
    foreach ($subscribers as $subscriber) {
        echo '<li>' . esc_html($subscriber->email) . ' (' . esc_html($subscriber->name) . ')</li>';
    }
    echo '</ul>';
}






/* 
move_subscription_user_to_unactive_list
 */
function move_subscription_user_to_unactive_list($subscription) {
    $user_id = $subscription->get_user_id();
    $user    = get_userdata($user_id);
    $email   = $user->user_email;

    $mailerlite = get_field('mailerlite', 'option');

    $apiKey          = $mailerlite['api_key'];
    $activeGroupId   = $mailerlite['group_1'];
    $unactiveGroupId = $mailerlite['group_2'];

    // Remove from active group
    $args = [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $apiKey,
        ],
    ];

    $remove_response = wp_remote_request("https://api.mailerlite.com/api/v2/groups/$activeGroupId/subscribers/$email", array_merge($args, ['method' => 'DELETE']));

    if (is_wp_error($remove_response)) {
        error_log('MailerLite API error: ' . $remove_response->get_error_message());
    }

    // Add to unactive group
    $data = [
        'email' => $email,
        'name' => $user->first_name . ' ' . $user->last_name,
    ];

    $args['body'] = json_encode($data);

    $add_response = wp_remote_post("https://api.mailerlite.com/api/v2/groups/$unactiveGroupId/subscribers", $args);

    $state_user_subscription = update_user_meta($user_id, 'state_user_subscription', 'unactive');

    if (is_wp_error($add_response)) {
        error_log('MailerLite API error: ' . $add_response->get_error_message());
    }
}
// Hook to move user to unactive list when subscription expires or is cancelled
add_action('woocommerce_subscription_status_expired', 'move_subscription_user_to_unactive_list', 10, 1);
add_action('woocommerce_subscription_status_cancelled', 'move_subscription_user_to_unactive_list', 10, 1);
