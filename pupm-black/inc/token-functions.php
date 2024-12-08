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
	
	// Debugging: Output the raw response
	//echo "API Response: $response\n";

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







/* 
get_tokens_by_post_id
 */
function get_tokens_by_post_id($post_id) {
    global $wpdb;

    // Define your table name
    $table_name = $wpdb->prefix . 'upcoming_field_token';

    // Query to get the token for the specified post ID
    $token = $wpdb->get_var($wpdb->prepare("SELECT token FROM $table_name WHERE post_id = %d", $post_id));

    return $token;
}








// /* 
//  * Save token and timestamp to the database
//  */
// function save_token_to_upcoming_database($post_id, $token) {
//     global $wpdb;

//     // Define your table name (make sure it's prefixed properly)
//     $table_name = $wpdb->prefix . 'upcoming_field_token';

//     // Prepare data for insertion
//     $data = [
//         'post_id' => $post_id,
//         'token' => maybe_serialize($token),
//         'created_at' => current_time('mysql'), // Timestamp for when the token was saved
//     ];

//     // Data format for the values
//     $format = [
//         '%d',   // post_id is an integer
//         '%s',   // token is a string
//         '%s',   // created_at is a string (MySQL datetime)
//     ];

//     // Insert or update the token in the custom table
//     return $wpdb->replace($table_name, $data, $format);
// }






// /* 
// save_token_on_upcoming_field_save
//  */
// function save_token_on_upcoming_field_save($post_id, $post, $update) {
//     // Check if it's an autosave and if the user has permissions
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
//     if (!current_user_can('edit_post', $post_id)) return;

//     // Get the 'mint' field value
//     $mint = get_post_meta($post_id, 'mint', true);

//     // Check if mint value is not empty
//     if (!empty($mint)) {
//         // Call your function to get token details
//         $token = getTokenDetails($mint);

//         // Save the token to the database and check if it was successful
//         if (! empty($token)) {
//             $saved = save_token_to_upcoming_database($post_id, $token);
//         }

//         // If the token was not saved successfully, set the post status
//         if (empty($token)) {
//             // Update post meta to indicate token is not active
//             update_post_meta($post_id, 'upcoming_token_status', 'Not Active');
//         } else {
//             update_post_meta($post_id, 'upcoming_token_status', 'Active');
//         }
//     } else {
//         // If mint is empty, you can set the token status as inactive as well
//         update_post_meta($post_id, 'upcoming_token_status', 'Not Active');
//     }
// }

// // Hook into the save_post action
// add_action('save_post_upcoming_field', 'save_token_on_upcoming_field_save', 10, 3);









// // Step 1: Add a custom column for token status
// function add_token_status_column($columns) {
//     // Create a new array for the reordered columns
//     $new_columns = [];

//     // Loop through the existing columns and add them to the new array
//     foreach ($columns as $key => $value) {
//         // Add the token status column before the date column
//         if ($key === 'date') {
//             $new_columns['token_status'] = 'Token Status'; // Add token status column
//         }
//         $new_columns[$key] = $value; // Add the existing column
//     }

//     return $new_columns;
// }
// add_filter('manage_upcoming_field_posts_columns', 'add_token_status_column');

// // Step 2: Populate the custom column with token status
// function display_token_status_column($column, $post_id) {
//     if ($column === 'token_status') {
//         // Get the token status from post meta
//         $token_status = get_post_meta($post_id, 'upcoming_token_status', true);

//         // Display the status or a default message if not set
//         echo !empty($token_status) ? esc_html($token_status) : 'N/A';
//     }
// }
// add_action('manage_upcoming_field_posts_custom_column', 'display_token_status_column', 10, 2);


// // Make the token status column sortable
// function make_token_status_column_sortable($columns) {
//     $columns['token_status'] = 'token_status';
//     return $columns;
// }
// add_filter('manage_edit-upcoming_field_sortable_columns', 'make_token_status_column_sortable');


// // Step 3: Add custom CSS for the column width
// function custom_token_status_column_style() {
//     echo '<style>
//         .column-token_status {
//             width: 200px; /* Set the width of the token status column */
//         }
//     </style>';
// }
// add_action('admin_head', 'custom_token_status_column_style');








// // Step 1: Add meta box to display token status and button
// function add_token_status_meta_box() {
//     add_meta_box(
//         'token_status_meta_box', // ID of the meta box
//         'Token Status', // Title of the meta box
//         'display_token_status_meta_box', // Callback function to display content
//         'upcoming_field', // Post type where it will appear
//         'normal', // Context (side means in the sidebar)
//         'high' // Priority
//     );
// }
// add_action('add_meta_boxes', 'add_token_status_meta_box');

// // Step 2: Display the token status and button in the meta box
// function display_token_status_meta_box($post) {
//     // Get the current token status from post meta
//     $token_status = get_post_meta($post->ID, 'upcoming_token_status', true);

//     // Display the current token status
//     echo '<p><strong>Current Token Status:</strong> ' . (!empty($token_status) ? esc_html($token_status) : 'N/A') . '</p>';

//     // Display a button to request a new token
//     echo '<button type="button" class="button" id="request_new_token">Request Token Update</button>';

//     // Add a nonce for security
//     wp_nonce_field('request_token_update_nonce', 'token_update_nonce');
// }







// // Step 3: Handle the AJAX request to update the token
// function request_token_update() {
//     // Check nonce for security
//     check_ajax_referer('request_token_update_nonce', 'security');

//     // Get the post ID from the AJAX request
//     $post_id = intval($_POST['post_id']);

//     // Get the mint value
//     $mint = get_post_meta($post_id, 'mint', true);

//     if (!empty($mint)) {
//         // Call your function to get token details
//         $token = getTokenDetails($mint);

//         // Save the token to the database
//         $saved = save_token_to_upcoming_database($post_id, $token);

//         // If token is not saved, set status to "Token Not Active"
//         if (!$saved || empty($token)) {
//             update_post_meta($post_id, 'upcoming_token_status', 'Not Active');
//             wp_send_json_error('Token Not Active');
//         } else {
//             // Successfully updated the token
//             update_post_meta($post_id, 'upcoming_token_status', 'Active');
//             wp_send_json_success('Token Active');
//         }
//     } else {
//         // No mint value found
//         update_post_meta($post_id, 'upcoming_token_status', 'Not Active');
//         wp_send_json_error('No mint value provided');
//     }

//     // Always end the script
//     wp_die();
// }
// add_action('wp_ajax_request_token_update', 'request_token_update');









// // Step 4: Add the necessary JavaScript to handle the button click and AJAX request
// function enqueue_token_status_script($hook) {
//     // Only load the script on the post edit page for your custom post type
//     if ($hook !== 'post.php' && $hook !== 'post-new.php') {
//         return;
//     }

//     // Enqueue a custom script to handle the button click
//     wp_enqueue_script(
//         'token-status-js',
//         get_template_directory_uri() . '/js/token-status.js',
//         ['jquery'],
//         null,
//         true
//     );

//     // Pass data to the script, including the AJAX URL and nonce
//     wp_localize_script('token-status-js', 'TokenStatusData', [
//         'ajax_url' => admin_url('admin-ajax.php'),
//         'nonce' => wp_create_nonce('request_token_update_nonce'),
//     ]);
// }
// add_action('admin_enqueue_scripts', 'enqueue_token_status_script');






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
    $table_name = $wpdb->prefix . 'featured_fields_token'; // Custom table name

    // Проверка, если есть значение для $token_mint_value
    if ($token_mint_value) {
        // Проверяем, была ли произведена оплата
        $is_paid = checkDexPaid($token_mint_value);
        $dex_paid_status = $is_paid ? 1 : 0;  // Преобразование в 1 или 0 для базы данных

        // Получаем данные токена
        $token_details = getTokenDetails($token_mint_value);

        // Если данные токена успешно получены
        if ($token_details) {
            $token_name    = $token_details['name'] ?? 'Token Name';
            $current_user  = wp_get_current_user();
            $customer_name = $current_user->user_login;

            $wpdb->insert(
                $table_name,
                array(
                    'order_id' => $order_id,
                    'token_mint_value' => $token_mint_value,
                    'token_details' => maybe_serialize($token_details), // Сериализация данных
                    'dex_paid_status' => $dex_paid_status, // Статус оплаты
                ),
                array(
                    '%s',   // order_id — целое число
                    '%s',   // token_mint_value — строка
                    '%s',   // token_details — сериализованная строка
                    '%d',   // dex_paid_status — целое число (0 или 1)
                )
            );
        }

        // Настройки нового поста
        $new_post = array(
            'post_title'    => $customer_name . ' of Product - ' . $token_name, // Заголовок поста
            //   'post_content'  => 'This is an automatically generated featured field post for product ID ' . $token_name, // Контент поста
            'post_status'   => 'draft',  // Статус поста (опубликован)
            'post_author'   => get_current_user_id(),  // Текущий автор
            'post_type'     => 'featured_field',  // Кастомный тип поста
        );

        // Вставляем новый пост в базу данных
        $post_id = wp_insert_post($new_post);

        // Проверяем, нет ли ошибок при создании поста
        if (!is_wp_error($post_id)) {
            // Обновляем мета данные поста
            update_post_meta($post_id, 'token_mint', $token_mint_value);
            update_post_meta($post_id, 'featured_status', 'pending');

            // Обновляем ACF поля
            // update_field('package_id', $package, $post_id);   // Поле ACF для ID продукта
            update_field('order_id', $order_id, $post_id);       // Поле ACF для ID заказа
        }
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
