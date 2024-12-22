<?php





// get_active_banners_with_html
function get_active_banners_with_html() {
    $banners = get_field('banner', 'option');
    $active_banners = [];
    $has_active_banners = false;

    if ($banners) {
        $current_time = current_time('timestamp');

        foreach ($banners as $banner) {
            $start_date = $banner['start_date'];
            $time = $banner['time'];
            $content_type = isset($banner['content_type']) ? $banner['content_type'] : 'image'; // По умолчанию - html_banner
            $banner_content = $banner[$content_type];

            $banner_days = !empty($time['days']) ? $time['days'] : 0;
            $banner_hours = !empty($time['hours']) ? $time['hours'] : 0;
            $banner_minutes = !empty($time['minutes']) ? $time['minutes'] : 0;

            if ($start_date) {
                $start_timestamp = strtotime($start_date);

                $expiration_time = strtotime("+{$banner_days} days +{$banner_hours} hours +{$banner_minutes} minutes", $start_timestamp);

                if ($current_time <= $expiration_time) {
                    $time_left = $expiration_time - $start_timestamp;
                    $days_left = floor($time_left / (60 * 60 * 24));
                    $hours_left = floor(($time_left % (60 * 60 * 24)) / (60 * 60));
                    $minutes_left = floor(($time_left % (60 * 60)) / 60);

                    $time_left_server = $expiration_time - $current_time;
                    $server_days_left = floor($time_left_server / (60 * 60 * 24));
                    $server_hours_left = floor(($time_left_server % (60 * 60 * 24)) / (60 * 60));
                    $server_minutes_left = floor(($time_left_server % (60 * 60)) / 60);

                    $has_active_banners = true;

                    $banner_html = '<div class="data-item">';
                    if (!empty($banner_content)) {
                        switch ($content_type) {
                            case 'html':
                                $banner_html .= '<div class="data-image" data-time-duration="' . esc_attr("Time left: {$days_left} days, {$hours_left} hours, {$minutes_left} minutes") .  '"  data-left-server-time="' . esc_attr("Time left: {$server_days_left} days, {$server_hours_left} hours, {$server_minutes_left} minutes") . '">';
                                $banner_html .= $banner_content;
                                $banner_html .= '</div>';
                                break;

                            case 'image':
                                $banner_content = wp_get_attachment_image($banner_content, 'image-size-2');
                                $banner_html .= '<div class="data-image" data-time-duration="' . esc_attr("Time left: {$days_left} days, {$hours_left} hours, {$minutes_left} minutes") .  '"  data-left-server-time="' . esc_attr("Time left: {$server_days_left} days, {$server_hours_left} hours, {$server_minutes_left} minutes") . '">';
                                $banner_html .= $banner_content;
                                $banner_html .= '</div>';
                                break;

                            case 'video':
                                $banner_content = wp_get_attachment_url($banner_content, 'full');
                                $banner_html .= '<div class="data-video" data-time-duration="' . esc_attr("Time left: {$days_left} days, {$hours_left} hours, {$minutes_left} minutes") .  '"  data-left-server-time="' . esc_attr("Time left: {$server_days_left} days, {$server_hours_left} hours, {$server_minutes_left} minutes") . '">';
                                $banner_html .= '<video muted autoplay loop>';
                                $banner_html .= '<source src="' . esc_url($banner_content) . '" type="video/mp4">';
                                $banner_html .= 'Your browser does not support the video tag.';
                                $banner_html .= '</video>';
                                $banner_html .= '</div>';
                                break;

                            default:
                                // Неизвестный тип контента, пропустить
                                continue 2;
                        }
                    }
                    $banner_html .= '</div>';

                    $active_banners[] = $banner_html;
                }
            }
        }
    }

    return [
        'active_banners' => $active_banners,
        'has_active_banners' => $has_active_banners
    ];
}




/* 
np_add_admin_page
 */
function np_add_admin_page() {
    add_menu_page(
        'Orders',                      
        'Orders',                      
        'manage_options',              
        'np-orders',                   
        'np_display_orders_page',      
        'dashicons-list-view',         
        33                             
    );
}
add_action('admin_menu', 'np_add_admin_page');





/* 
np_display_orders_page
 */
function np_display_orders_page() {
    global $wpdb;

    $per_page = 10;

    $current_page = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
    $offset = ($current_page - 1) * $per_page;


    $orders = $wpdb->get_results("
       SELECT o.*, t.token_mint_value 
       FROM {$wpdb->prefix}np_orders o 
       LEFT JOIN {$wpdb->prefix}featured_fields_token t ON o.order_id = t.order_id 
       ORDER BY o.created_at DESC 
       LIMIT $offset, $per_page
   ");
    $total_orders = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}np_orders");

    $total_pages = ceil($total_orders / $per_page);
?>
    <div class="wrap">
        <h1 class="np-orders-title">Orders Management</h1>
        <style>
            .wrap .np-orders-title {
                font-size: 24px;
                margin-bottom: 12px;
                color: #333;
            }

            .pagination-links {
                display: flex;
            }

            .pagination {
                margin: 20px 0;
                text-align: center;
            }

            .pagination a {
                display: inline-block;
                margin: 0 5px;
                padding: 8px 12px;
                border: 1px solid #0073aa;
                color: #0073aa;
                text-decoration: none;
                border-radius: 4px;
            }

            .pagination a:hover {
                background-color: #0073aa;
                color: white;
            }

            .pagination .current {
                display: inline-block;
                margin: 0 5px;
                padding: 8px 12px;
                border: 1px solid #0073aa;
                color: #0073aa;
                text-decoration: none;
                border-radius: 4px;

                background-color: #0073aa;
                color: white;
                border: 1px solid #0073aa;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            .wrap th {
                background-color: #f1f1f1;
                font-weight: bold;
            }

            .wrap .status-finished {
                color: green;
                font-weight: bold;
            }

            .wrap .status-other {
                color: orange;
                font-weight: bold;
            }

            .token-mint-value span {
                white-space: nowrap;
                overflow: hidden;
                max-width: 200px;
                display: block;
                overflow-x: auto;
                text-overflow: clip;
            }

            .token-mint-value span::-webkit-scrollbar {
                height: 6px;
            }

            .token-mint-value span::-webkit-scrollbar-thumb {
                background: #8b8b8b;
            }

            .token-mint-value span::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .token-mint-value span::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
        </style>

        <table class="widefat fixed">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Emulate Payment(Admin)</th>
                    <th>Mint Token</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($orders) {
                    foreach ($orders as $order) {
                        echo '<tr>';
                        echo '<td>' . esc_html($order->order_id) . '</td>';
                        echo '<td>' . esc_html($order->user_id) . '</td>';
                        echo '<td>' . esc_html($order->package) . '</td>';
                        echo '<td>' . esc_html($order->amount) . '</td>';

                        // Conditional styling for status
                        $status_class = ($order->status === 'finished') ? 'status-finished' : 'status-other';
                        echo '<td class="' . esc_attr($status_class) . '">' . esc_html($order->status) . '</td>';

                        echo '<td>' . esc_html($order->created_at) . '</td>';
                        $emulate_status = ($order->admin_payment_emulate == 1) ? 'Emulated' : 'Not Emulated';
                        echo '<td>' . esc_html($emulate_status) . '</td>';
                        echo '<td class="token-mint-value"><span>' . esc_html($order->token_mint_value ? $order->token_mint_value : 'N/A') . '</span></td>'; // Display mint token
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No orders found.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <?php
        $big = 999999999; 
        $links = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_admin_url() . 'admin.php?page=np-orders&paged=' . $big)),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
            'type' => 'array', 
        ));

        // Check if $links is an array and output each link
        if (is_array($links)) {
            echo '<div class="pagination"><ul class="pagination-links">';
            foreach ($links as $link) {
                echo '<li>' . $link . '</li>'; // Output each link inside an <li>
            }
            echo '</ul></div>';
        } else {
            // If there's only one page or no pages, just output the links directly
            echo '<div class="pagination">' . $links . '</div>'; // In case $links is a string (like when there's only one page)
        }
        ?>
    </div>
<?php
}







/* 
payment_options_page
 */
// Добавляем страницу настроек
add_action('admin_menu', function () {
    add_menu_page('Payment Options', 'Payment Options', 'manage_options', 'payment-options', 'payment_options_page');
});

// Создаем страницу настроек
function payment_options_page() {
?>
    <div class="wrap">
        <h1>Payment Options</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('payment_options_group');
            do_settings_sections('payment-options');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Simulate Payment for Admins</th>
                    <td>
                        <input type="checkbox" name="simulate_payment" value="1" <?php checked(1, get_option('simulate_payment'), true); ?> />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Регистрируем настройку
add_action('admin_init', function () {
    register_setting('payment_options_group', 'simulate_payment');
});







/* 
remove_comments_menu
 */
function remove_comments_menu() {
    remove_menu_page('edit-comments.php'); // Удаляет вкладку комментариев
}
add_action('admin_menu', 'remove_comments_menu');







/* 
get_plan_prices_time_per_seconds
 */
function get_plan_prices_time_per_seconds($time) {
    $days = (int)$time['days'];
    $hours = (int)$time['hours'];
    $minutes = (int)$time['minutes'];
    $seconds = (int)$time['seconds'];

    // Преобразуем всё в секунды для точного сравнения
    $total_seconds = ($days * 86400) + ($hours * 3600) + ($minutes * 60) + $seconds;

    return $total_seconds;
}




/* 
get_plan_prices
 */
function get_plan_prices() {
    $plan_prices = [];

    if (have_rows('payment_plans', 'option')) {
        while (have_rows('payment_plans', 'option')) {
            the_row();

            // Получаем все необходимые поля
            $id = get_sub_field('id');
            $name = get_sub_field('name');
            $price = get_sub_field('price');
            $time = get_sub_field('time');
            $is_on_sale = get_sub_field('is_on_sale');
            $sale_price = get_sub_field('sale_price');

            // Формируем массив данных для плана
            $plan = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'time' => $time,
                'is_on_sale' => $is_on_sale,
                'sale_price' => $sale_price,
            ];

            // Если есть скидка, заменяем цену на скидочную
            if (!empty($is_on_sale) && !empty($sale_price)) {
                $plan['price'] = $sale_price;
            }

            // Добавляем план в общий массив с ключом id
            $plan_prices[$id] = $plan;
        }
    }

    return $plan_prices; // Возвращаем массив планов с ключом по id
}




/* 
get_plan_price_by_id
 */
function get_plan_price_by_id($plan_id) {
    if (have_rows('payment_plans', 'option')) {
        while (have_rows('payment_plans', 'option')) {
            the_row();

            // Получаем ID текущего плана
            $id = get_sub_field('id');

            // Если ID совпадает с переданным
            if ($id == $plan_id) {
                $price = get_sub_field('price');
                $is_on_sale = get_sub_field('is_on_sale');
                $sale_price = get_sub_field('sale_price');

                // Если есть скидка, возвращаем цену со скидкой, иначе обычную цену
                if (!empty($is_on_sale) && !empty($sale_price)) {
                    return $sale_price;
                } else {
                    return $price;
                }
            }
        }
    }

    // Если план с переданным ID не найден
    return null;
}









/* 
process_ca_mint
 */
function process_ca_mint() {
    if (isset($_POST['ca_mint'])) {
        // var_dump($_POST['ca_mint']);
        $ca_mint_value = sanitize_text_field($_POST['ca_mint']);

        // Сохранение значения в сессию или передача через URL
        // session_start();
        $_SESSION['ca_mint'] = $ca_mint_value;

        // Перенаправление на страницу dex_paid
        wp_redirect(home_url('/dex-paid'));
        exit;
    }
}
add_action('admin_post_process_ca_mint', 'process_ca_mint');
add_action('admin_post_nopriv_process_ca_mint', 'process_ca_mint');





/*
* Plug for vs
*/
if (false) {
    function get_field() {
    }
    function acf_add_options_page() {
    }
    function get_sub_field() {
    }
    function have_rows() {
    }
    function the_row() {
    }
    function get_row_layout() {
    }
    function get_field_object() {
    }
    function update_field() {
    }
    function acf_register_block_type() {
    }
}






/* 
display_preview_image
 */
function display_preview_image($block) {
    if (isset($block['data']['preview_image_help'])) {
        echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto;">';
        return true;
    }
}





/* 
add_page_slug_to_body_class
 */
function add_page_slug_to_body_class($classes) {
    global $post;

    $pages = get_field('pages', 'option');

    $page_slugs = ['the_company'];
    $state = false;

    if (!empty($pages)) {
        foreach ($page_slugs as $page_slug) {
            if (isset($pages[$page_slug]) && $pages[$page_slug] == get_the_ID()) {
                $classes[] = 'page-' . $page_slug;
                $state = true;
                break;
            }
        }
    }

    if ($state == false && is_page()) {
        $classes[] = 'page-' . $post->post_name;
    }

    return $classes;
}
add_filter('body_class', 'add_page_slug_to_body_class');





/* 
create_featured_field_post_type
 */
function create_featured_field_post_type() {
    $labels = array(
        'name'               => _x('Featured Projects', 'post type general name'),
        'singular_name'      => _x('Featured project', 'post type singular name'),
        'menu_name'          => _x('Featured Projects', 'admin menu'),
        'name_admin_bar'     => _x('Featured project', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'featured project'),
        'add_new_item'       => __('Add New Featured project'),
        'new_item'           => __('New Featured project'),
        'edit_item'          => __('Edit Featured project'),
        'view_item'          => __('View Featured project'),
        'all_items'          => __('All Featured Projects'),
        'search_items'       => __('Search Featured Projects'),
        'not_found'          => __('No featured projects found.'),
        'not_found_in_trash' => __('No featured projects found in Trash.')
    );

    $args = array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'featured-project'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-star-filled',
    );

    register_post_type('featured_field', $args);
}
add_action('init', 'create_featured_field_post_type');





/* 
create_upcoming_field_post_type
 */
function create_upcoming_field_post_type() {
    $labels = array(
        'name'               => _x('Upcoming Launches', 'post type general name'),
        'singular_name'      => _x('Upcoming Launch', 'post type singular name'),
        'menu_name'          => _x('Upcoming Launches', 'admin menu'),
        'name_admin_bar'     => _x('Upcoming Launch', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'upcoming launche'),
        'add_new_item'       => __('Add New Upcoming launche'),
        'new_item'           => __('New Upcoming launche'),
        'edit_item'          => __('Edit Upcoming launche'),
        'view_item'          => __('View Upcoming launche'),
        'all_items'          => __('All Upcoming Launches'),
        'search_items'       => __('Search Upcoming Launches'),
        'not_found'          => __('No upcoming launches found.'),
        'not_found_in_trash' => __('No upcoming launches found in Trash.')
    );

    $args = array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'upcoming-field'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-calendar-alt',
    );

    register_post_type('upcoming_field', $args);
}
add_action('init', 'create_upcoming_field_post_type');










/* 
check_post_status
 */
function check_post_status($post_id) {
    $activation_date = get_post_meta($post_id, 'featured_activation_date', true);
    $current_status = get_post_meta($post_id, 'featured_status', true);

    $order_id = get_field('order_id', $post_id);
    $order = np_get_orders_by_order_id($order_id);

    $plan_prices = get_plan_prices();
    $time = $plan_prices[$order['package']]['time'];

    $days    = (int)$time['days'];
    $hours   = (int)$time['hours'];
    $minutes = (int)$time['minutes'];
    $seconds = (int)$time['seconds'];

    $total_seconds = ($days * 86400) + ($hours * 3600) + ($minutes * 60) + $seconds;

    if ($order['status'] != 'finished') {
        update_post_meta($post_id, 'featured_status', 'inactive'); 
    } else {
        if ($activation_date && $total_seconds) {
            $current_date = new DateTime(current_time('mysql'));
            $activation_date = new DateTime($activation_date);

            $interval = $current_date->getTimestamp() - $activation_date->getTimestamp();

            if ($interval > $total_seconds) {
                update_post_meta($post_id, 'featured_status', 'inactive'); 
            } else {
                update_post_meta($post_id, 'featured_status', 'active'); 
            }
        }
    }
}







/* 
check_all_featured_field_posts_status
 */
function check_all_featured_field_posts_status() {
    $args = array(
        'post_type'      => 'featured_field',
        'post_status'    => ['publish', 'draft'],
        'posts_per_page' => -1
    );

    $posts = get_posts($args);

    foreach ($posts as $post) {
        check_post_status($post->ID);
    }
}




/* 
getDatabaseConnection
 */
function getDatabaseConnection() {
    static $mysqli = null;

    if ($mysqli !== null) {
        return $mysqli;
    }

    $db_host     = getenv('DB2_HOST');
    $db_name     = getenv('DB2_NAME');
    $db_user     = getenv('DB2_USER');
    $db_password = getenv('DB2_PASSWORD');
    $db_port     = getenv('DB2_PORT');
    $db_charset  = getenv('DB2_CHARSET');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

    if ($mysqli->connect_error) {
        error_log('Connection Error (' . $mysqli->connect_errno . '): ' . $mysqli->connect_error);
        die('Database connection failed.');
    }

    if (!$mysqli->set_charset($db_charset)) {
        error_log('Error loading character set utf8mb4: ' . $mysqli->error);
        die('Error setting character set.');
    }

    return $mysqli;
}










/* 
getTableData
 */
function getTableData($table_name, $limit = null) {
    $mysqli = getDatabaseConnection();

    $query = "SELECT * FROM $table_name";

    if ($table_name === 'live_stream') {
        $query .= " WHERE usd_market_cap >= 6000";
    }

    $query .= " ORDER BY id DESC";

    if ($limit !== null) {
        $query .= " LIMIT $limit";
    }

    $result = $mysqli->query($query);
    if (!$result) {
        die('Error executing query: ' . $mysqli->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $result->free();
    return $data;
}





// getAllTableNames
function getAllTableNames() {
    $mysqli = getDatabaseConnection();

    $query = "SHOW TABLES";

    $result = $mysqli->query($query);

    if (!$result) {
        die('Error executing query: ' . $mysqli->error);
    }

    $tables = [];
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0]; 
    }

    $result->free();
    return $tables;
}







/* 
getLimitedTablesData
 */
function getLimitedTablesData($limit = 10) {
    $mysqli = getDatabaseConnection();

    $tables_query = "SHOW TABLES";
    $tables_result = $mysqli->query($tables_query);

    if (!$tables_result) {
        die('Error retrieving tables: ' . $mysqli->error);
    }

    $all_data = [];

    while ($table_row = $tables_result->fetch_array()) {
        $table_name = $table_row[0];

        $data_query = "SELECT * FROM $table_name LIMIT $limit";
        $data_result = $mysqli->query($data_query);

        if (!$data_result) {
            die("Error retrieving data from $table_name: " . $mysqli->error);
        }

        $table_data = [];
        while ($row = $data_result->fetch_assoc()) {
            $table_data[] = $row;
        }

        $all_data[$table_name] = $table_data;

        $data_result->free();
    }

    $tables_result->free();
    $mysqli->close();

    return $all_data;
}










/* 
formatTimeAgo
 */
function formatTimeAgo($timestamp) {

    $timestampInSeconds = $timestamp / 1000;

    $currentTime = time();

    $differenceInSeconds = $currentTime - $timestampInSeconds;

    if ($differenceInSeconds < 60) {
        return '<1 min ago';
    }

    $hours = floor($differenceInSeconds / 3600);
    $minutes = floor(($differenceInSeconds % 3600) / 60);

    $formatted = '';
    if ($hours > 0) {
        $formatted .= $hours . ' h ';
    }
    if ($minutes > 0) {
        $formatted .= $minutes . ' min';
    }

    return $formatted . ' ago';
}



/* 
checkImageUrl
 */
function checkImageUrl($url) {
    return true;
}






/* 
get_sound_status
 */
function get_sound_status($table_type) {
    $default_values = [
        'dex_paid' => 'true',
        'live_stream' => 'true',
        'big_buys' => 'false'
    ];

    $cookie_name = $table_type . '_sound';

    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name] === 'true' ? 'mod-enable' : 'mod-disable';
    }

    if (isset($default_values[$table_type])) {
        return $default_values[$table_type] === 'true' ? 'mod-enable' : 'mod-disable';
    }

    return 'mod-disable';
}





/* 
Check if the HTTP host is a common local domain
 */
function is_local_dev_site() {

    if (
        strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
        strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false ||
        strpos($_SERVER['HTTP_HOST'], 'loc.pump.black') !== false ||
        strpos($_SERVER['HTTP_HOST'], 'local') !== false
    ) {
        return true;
    }

    return false;
}






/* 
format_mint_string
 */
function format_mint_string($input, $start_length = 15, $end_length = 4) {
    $input_length = strlen($input);

    if ($input_length <= $start_length + $end_length) {
        return $input;
    }

    $start = substr($input, 0, $start_length);
    $end = substr($input, -$end_length);

    return $start . '...' . $end;
}







/* 
wp_schedule_my_cron_event
 */

// Add a custom interval of 1 minute
function wp_custom_cron_intervals($schedules) {
    $schedules['one_minute'] = array(
        'interval' => 60, // 60 seconds = 1 minute
        'display'  => esc_html__('Every minute'),
    );
    return $schedules;
}
add_filter('cron_schedules', 'wp_custom_cron_intervals');


// Schedule the cron event if it's not already scheduled
function wp_schedule_my_cron_event() {
    if (!wp_next_scheduled('check_featured_fields_status')) {
        wp_schedule_event(time(), 'one_minute', 'check_featured_fields_status');
    }
}
add_action('wp', 'wp_schedule_my_cron_event');


// Add the function to the cron hook
add_action('check_featured_fields_status', 'check_all_featured_field_posts_status');



// Clear the cron event on theme/plugin deactivation
function wp_clear_my_cron_event() {
    $timestamp = wp_next_scheduled('check_featured_fields_status');
    if ($timestamp) {
        wp_unschedule_event($timestamp, 'check_featured_fields_status');
    }
}
register_deactivation_hook(__FILE__, 'wp_clear_my_cron_event');

// Function to reset and recreate the cron event for testing
function reset_cron_tasks() {
    $timestamp = wp_next_scheduled('check_featured_fields_status');
    if ($timestamp) {
        wp_unschedule_event($timestamp, 'check_featured_fields_status');
    }
    wp_schedule_event(time(), 'one_minute', 'check_featured_fields_status');
}
if (isset($_GET['cron_test'])) {
    add_action('init', 'reset_cron_tasks');
}
