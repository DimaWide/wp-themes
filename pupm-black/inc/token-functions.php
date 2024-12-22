<?php








/* 
token_upcoming_launch_date_html
*/
function token_upcoming_launch_date_html($future_date) {
    $timestamp = strtotime($future_date) * 1000;
    // Sample timestamp in milliseconds (future event timestamp)
    $created_timestamp = $timestamp;

    // Convert milliseconds to seconds
    $event_time = $created_timestamp / 1000;

    // Get the current time
    $current_time = time();

    // Calculate the difference (event time - current time)
    $diff = $event_time - $current_time;

    // If the event has already passed, set to 0
    if ($diff < 0) {
        $diff = 0;
    }

    // Calculate days, hours, minutes from the difference
    $days = floor($diff / (60 * 60 * 24));
    $hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($diff % (60 * 60)) / 60);
?>
    <div class="data-b2-item-launch-date data-launch-date">
        <div class="data-launch-date-item">
            <div class="data-launch-date-item-value days">
                <?php echo $days; ?>
            </div>
            <div class="data-launch-date-item-label">
                Days
            </div>
        </div>

        <div class="data-launch-date-item-separate">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/dots.svg'; ?>" alt="img">
        </div>

        <div class="data-launch-date-item">
            <div class="data-launch-date-item-value hours">
                <?php echo $hours; ?>
            </div>
            <div class="data-launch-date-item-label">
                Hrs
            </div>
        </div>

        <div class="data-launch-date-item-separate">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/dots.svg'; ?>" alt="img">
        </div>

        <div class="data-launch-date-item">
            <div class="data-launch-date-item-value minutes">
                <?php echo $minutes; ?>
            </div>
            <div class="data-launch-date-item-label">
                Mins
            </div>
        </div>
    </div>

<?php
}




/* 
getSolPrice
 */
global $current_sol_price;

function getSolPrice() {

    $url = "https://frontend-api.pump.fun/sol-price";

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'accept: */*'
    ]);

    // Execute the request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch) . "\n";
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if the response contains the price
    if (isset($data['solPrice'])) {
        return $data['solPrice'];
    } else {
        return null; // Handle error case
    }
}

$current_sol_price = getSolPrice();





// Step 1: Add a custom column for token status
function add_featured_fields_featured_status_column($columns) {
    // Create a new array for the reordered columns
    $new_columns = [];

    // Loop through the existing columns and add them to the new array
    foreach ($columns as $key => $value) {
        // Add the token status column before the date column
        if ($key === 'date') {
            $new_columns['featured_status'] = 'Status'; // Add token status column
        }
        $new_columns[$key] = $value; // Add the existing column
    }

    return $new_columns;
}
add_filter('manage_featured_field_posts_columns', 'add_featured_fields_featured_status_column');

// Step 2: Populate the custom column with token status
function display_featured_fields_featured_status_column($column, $post_id) {
    if ($column === 'featured_status') {
        // Get the token status from post meta
        $featured_status = get_post_meta($post_id, 'featured_status', true);

        // Display the status or a default message if not set
        echo !empty($featured_status) ? esc_html($featured_status) : 'N/A';
    }
}
add_action('manage_featured_field_posts_custom_column', 'display_featured_fields_featured_status_column', 10, 2);


// Make the token status column sortable
function make_featured_fields_featured_status_column_sortable($columns) {
    $columns['featured_status'] = 'featured_status';
    return $columns;
}
add_filter('manage_edit-featured_field_sortable_columns', 'make_featured_fields_featured_status_column_sortable');


// Step 3: Add custom CSS for the column width
function custom_featured_fields_featured_status_column_style() {
    echo '<style>
        .column-featured_status {
            width: 200px; /* Set the width of the token status column */
        }
    </style>';
}
add_action('admin_head', 'custom_featured_fields_featured_status_column_style');









// Function to get token data by order ID
function get_token_data_by_order_id($order_id) {
    global $wpdb;  // Declare the global variable
    $table_name = $wpdb->prefix . 'featured_fields_token'; // Custom table name

    // Query to get the token data for the specified order ID
    $token_data = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT token_mint_value, token_details, dex_paid_status 
             FROM $table_name 
             WHERE order_id = %s",
            $order_id
        ),
        ARRAY_A // Return as an associative array
    );

    // Check if data was found
    if ($token_data) {
        // You can return or process the data as needed
        return $token_data; // This will be an associative array with the values
    }

    return null; // Return null if no data was found
}









/* 
token_launch_date_html
 */
function token_launch_date_html($timestamp) {
    // Sample timestamp in milliseconds
    $created_timestamp = $timestamp;

    // Convert milliseconds to seconds
    $timestamp = $created_timestamp / 1000;

    // Get the current time
    $current_time = time();

    // Calculate the difference
    $diff = $current_time - $timestamp;

    // Make sure we have a positive difference
    if ($diff < 0) {
        $diff = 0; // If the time has already passed, set to 0
    }

    // Calculate days, hours, minutes from the difference
    $days = floor($diff / (60 * 60 * 24));
    $hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($diff % (60 * 60)) / 60);
?>
    <div class="data-b2-item-launch-date data-launch-date">
        <div class="data-launch-date-item">
            <div class="data-launch-date-item-value days">
                <?php echo $days; ?>
            </div>

            <div class="data-launch-date-item-label">
                Days
            </div>
        </div>

        <div class="data-launch-date-item-separate">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/dots.svg'; ?>" alt="img">
        </div>

        <div class="data-launch-date-item">
            <div class="data-launch-date-item-value hours">
                <?php echo $hours; ?>
            </div>

            <div class="data-launch-date-item-label">
                Hrs
            </div>
        </div>

        <div class="data-launch-date-item-separate">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/dots.svg'; ?>" alt="img">
        </div>

        <div class="data-launch-date-item">
            <div class="data-launch-date-item-value minutes">
                <?php echo $minutes; ?>
            </div>

            <div class="data-launch-date-item-label">
                Mins
            </div>
        </div>
    </div>

<?php
}












/* 
handle_order_token_and_featured_post
 */
function handle_order_token_and_featured_post($order_id, $token_mint_value, $package) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'featured_fields_token'; 

    if ($token_mint_value) {
        $is_paid = checkDexPaid($token_mint_value);
        $dex_paid_status = $is_paid ? 1 : 0;  

        $token_details = getTokenDetails($token_mint_value);

        if ($token_details) {
            $token_name    = $token_details['name'] ?? 'Token Name';
            $current_user  = wp_get_current_user();
            $customer_name = $current_user->user_login;

            $wpdb->insert(
                $table_name,
                array(
                    'order_id' => $order_id,
                    'token_mint_value' => $token_mint_value,
                    'token_details' => maybe_serialize($token_details), 
                    'dex_paid_status' => $dex_paid_status,
                ),
                array(
                    '%s', 
                    '%s', 
                    '%s', 
                    '%d', 
                )
            );
        }

        $new_post = array(
            'post_title'    => $customer_name . ' of Product - ' . $token_name,
            'post_status'   => 'draft', 
            'post_author'   => get_current_user_id(), 
            'post_type'     => 'featured_field', 
        );

        $post_id = wp_insert_post($new_post);
       
        if (!is_wp_error($post_id)) {
            update_post_meta($post_id, 'token_mint', $token_mint_value);
            update_post_meta($post_id, 'featured_status', 'pending');

            update_field('order_id', $order_id, $post_id);      
        }
    }
}






/* 
handle_dexscreener_add_token_to_table
 */
function handle_dexscreener_add_token_to_table($mint, $isDexPaid, $token) {
    if ($mint && $isDexPaid && $token) {

        $db_host     = getenv('DB2_HOST');
        $db_name     = getenv('DB2_NAME');
        $db_user     = getenv('DB2_USER');
        $db_password = getenv('DB2_PASSWORD');
        $db_port     = getenv('DB2_PORT');
        $db_charset  = getenv('DB2_CHARSET');

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

        if ($mysqli->connect_error) {
            die('Ошибка подключения (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        $mysqli->set_charset($db_charset);

        $query = $mysqli->prepare("SELECT * FROM dex_paid WHERE mint = ?");
        $query->bind_param('s', $mint);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 0) {
            $insert_query = $mysqli->prepare(
                "INSERT INTO dex_paid (
                    mint, 
                    name, 
                    symbol, 
                    description, 
                    image_uri, 
                    metadata_uri, 
                    twitter, 
                    telegram, 
                    bonding_curve, 
                    associated_bonding_curve, 
                    creator, 
                    created_timestamp, 
                    raydium_pool, 
                    complete, 
                    virtual_sol_reserves, 
                    virtual_token_reserves, 
                    hidden, 
                    total_supply, 
                    website, 
                    show_name, 
                    last_trade_timestamp, 
                    king_of_the_hill_timestamp, 
                    market_cap_solana, 
                    market_cap_usd, 
                    nsfw, 
                    market_id, 
                    inverted, 
                    real_sol_reserves, 
                    real_token_reserves, 
                    livestream_ban_expiry, 
                    last_reply, 
                    reply_count, 
                    is_banned, 
                    is_currently_live, 
                    last_time_checked, 
                    status
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $insert_query->bind_param(
                'ssssssssssssssssisssssssssssssssssss',
                $mint,
                $token['name'],
                $token['symbol'],
                $token['description'],
                $token['image_uri'],
                $token['metadata_uri'],
                $token['twitter'],
                $token['telegram'],
                $token['bonding_curve'],
                $token['associated_bonding_curve'],
                $token['creator'],
                $token['created_timestamp'],
                $token['raydium_pool'],
                $token['complete'],
                $token['virtual_sol_reserves'],
                $token['virtual_token_reserves'],
                $token['hidden'],
                $token['total_supply'],
                $token['website'],
                $token['show_name'],
                $token['last_trade_timestamp'],
                $token['king_of_the_hill_timestamp'],
                $token['market_cap_solana'],
                $token['usd_market_cap'],
                $token['nsfw'],
                $token['market_id'],
                $token['inverted'],
                $token['real_sol_reserves'],
                $token['real_token_reserves'],
                $token['livestream_ban_expiry'],
                $token['last_reply'],
                $token['reply_count'],
                $token['is_banned'],
                $token['is_currently_live'],
                $token['last_time_checked'],
                $token['status']
            );

            $insert_query->execute();
            $insert_query->close();
        }

        $query->close();
        $mysqli->close();
    }
}







/* 
np_get_orders_by_order_id
 */
function np_get_orders_by_order_id($order_id) {
    global $wpdb;

    // Sanitize the input to prevent SQL injection
    $order_id = sanitize_text_field($order_id);

    // Define the table name
    $table_name = $wpdb->prefix . 'np_orders';

    // Prepare and execute the SQL query
    $query = $wpdb->prepare(
        "SELECT * FROM $table_name WHERE order_id = %s LIMIT 1",
        $order_id
    );

    // Fetch one result for the given order_id
    $result = $wpdb->get_row($query, ARRAY_A);

    return $result;
}
