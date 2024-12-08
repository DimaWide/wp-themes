<?php



add_action('admin_menu', 'np_add_admin_page');

function np_add_admin_page() {
    add_menu_page(
        'Orders',                      // Заголовок страницы
        'Orders',                      // Название меню
        'manage_options',              // Права доступа
        'np-orders',                   // Слаг страницы
        'np_display_orders_page',      // Функция для отображения содержимого страницы
        'dashicons-list-view',         // Иконка меню
        33                               // Позиция
    );
}





/* 
np_display_orders_page
 */
function np_display_orders_page() {
    global $wpdb;

    // Количество заказов на страницу
    $per_page = 10;

    // Получаем текущую страницу
    $current_page = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
    $offset = ($current_page - 1) * $per_page;

    // // Получаем все заказы
    // $orders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}np_orders ORDER BY created_at DESC LIMIT $offset, $per_page");
    // $total_orders = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}np_orders");

    // // Пагинация
    // $total_pages = ceil($total_orders / $per_page);


    // Получаем все заказы вместе с токеном
    $orders = $wpdb->get_results("
       SELECT o.*, t.token_mint_value 
       FROM {$wpdb->prefix}np_orders o 
       LEFT JOIN {$wpdb->prefix}featured_fields_token t ON o.order_id = t.order_id 
       ORDER BY o.created_at DESC 
       LIMIT $offset, $per_page
   ");
    $total_orders = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}np_orders");

    // Пагинация
    $total_pages = ceil($total_orders / $per_page);



    // HTML для отображения заказов
?>
    <div class="wrap">
        <h1 class="np-orders-title">Orders Management</h1>
        <style>
            .wrap .np-orders-title {
                font-size: 24px;
                /* Increased font size for title */
                margin-bottom: 12px;
                /* Space below the title */
                color: #333;
                /* Title color */
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
                /* Bold text for visibility */
            }

            .wrap .status-other {
                color: orange;
                /* Orange color for other statuses */
                font-weight: bold;
                /* Bold text for visibility */
            }

            .token-mint-value span{
                white-space: nowrap;
                /* Prevents text from wrapping to a new line */
                overflow: hidden;
                /* Hides overflow content */
                max-width: 200px;
                /* Sets a maximum width for the cell */
                display: block;
                /* Ensures the overflow behavior works correctly */
                overflow-x: auto;
                /* Adds horizontal scrollbar if needed */
                text-overflow: clip;
            }

            /* WebKit browsers (Chrome, Safari) */
            .token-mint-value span::-webkit-scrollbar {
                height: 6px;
                /* Set the height of the horizontal scrollbar */
            }

            .token-mint-value span::-webkit-scrollbar-thumb {
                background: #8b8b8b;
                /* Color of the scrollbar handle */
                /* Rounding the scrollbar handle */
            }

            .token-mint-value span::-webkit-scrollbar-thumb:hover {
                background: #555;
                /* Color of the scrollbar handle on hover */
            }

            .token-mint-value span::-webkit-scrollbar-track {
                background: #f1f1f1;
                /* Color of the scrollbar track */
                /* Rounding the scrollbar track */
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
        // Пагинация
        $big = 999999999; // уникальное число для замены
        $links = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_admin_url() . 'admin.php?page=np-orders&paged=' . $big)),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
            'type' => 'array', // вернем массив для кастомного HTML
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
wcl_test
 */
function wcl_test() {
    // Функция для чтения содержимого файла и сохранения в опцию
    function save_file_content_to_option() {
        // Путь к вашему файлу
        $file_path = get_template_directory() . '/inc/data/test-fields.txt'; // Adjust the path to your file

        // Проверка, существует ли файл
        if (file_exists($file_path)) {
            // Чтение содержимого файла
            $file_content = file_get_contents($file_path);

            // Десериализация содержимого файла
            $deserialized_data = unserialize($file_content);

            // Сохранение содержимого в опцию WordPress
            update_option('big_buys_data', $deserialized_data);

            echo 'Содержимое файла успешно сохранено в опцию!';
        } else {
            echo 'Файл не найден!';
        }
    }

    // Функция для чтения содержимого файла и сохранения в опцию
    function save_file_content_to_option_2() {
        var_dump(123);
        // Путь к вашему файлу
        $file_path = get_template_directory() . '/inc/data/test-fields-2.txt'; // Adjust the path to your file

        // Проверка, существует ли файл
        if (file_exists($file_path)) {
            // Чтение содержимого файла
            $file_content = file_get_contents($file_path);

            // Десериализация содержимого файла
            $deserialized_data = unserialize($file_content);

            // Сохранение содержимого в опцию WordPress
            update_option('test_token', $deserialized_data);

            echo 'Содержимое файла успешно сохранено в опцию!';
        } else {
            echo 'Файл не найден!';
        }
    }


    function save_json_to_wp_option() {
        $file_path = get_template_directory() . '/inc/data/LOCAT STORAGE-3.json'; // Adjust the path to your file

        if (file_exists($file_path)) {
            // Read the JSON file contents
            $json_data = file_get_contents($file_path);

            // Decode JSON data into PHP array
            $data_array = json_decode($json_data, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Save the data to a WordPress option
                $option_name = 'wcl_token_fields'; // Name of the option
                update_option($option_name, $data_array);
                echo 'Data saved successfully';
            } else {
                echo 'Error decoding JSON data';
            }
        } else {
            echo 'File does not exist';
        }
    }


    if (isset($_GET['test'])) {
        //save_json_to_wp_option();
        //save_file_content_to_option();
        //save_file_content_to_option_2();
    }
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
        'name'               => _x('Featured Fields', 'post type general name'),
        'singular_name'      => _x('Featured Field', 'post type singular name'),
        'menu_name'          => _x('Featured Fields', 'admin menu'),
        'name_admin_bar'     => _x('Featured Field', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'featured field'),
        'add_new_item'       => __('Add New Featured Field'),
        'new_item'           => __('New Featured Field'),
        'edit_item'          => __('Edit Featured Field'),
        'view_item'          => __('View Featured Field'),
        'all_items'          => __('All Featured Fields'),
        'search_items'       => __('Search Featured Fields'),
        'not_found'          => __('No featured fields found.'),
        'not_found_in_trash' => __('No featured fields found in Trash.')
    );

    $args = array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'featured-field'),
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
        'name'               => _x('Upcoming Fields', 'post type general name'),
        'singular_name'      => _x('Upcoming Field', 'post type singular name'),
        'menu_name'          => _x('Upcoming Fields', 'admin menu'),
        'name_admin_bar'     => _x('Upcoming Field', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'upcoming field'),
        'add_new_item'       => __('Add New Upcoming Field'),
        'new_item'           => __('New Upcoming Field'),
        'edit_item'          => __('Edit Upcoming Field'),
        'view_item'          => __('View Upcoming Field'),
        'all_items'          => __('All Upcoming Fields'),
        'search_items'       => __('Search Upcoming Fields'),
        'not_found'          => __('No upcoming fields found.'),
        'not_found_in_trash' => __('No upcoming fields found in Trash.')
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

    // Преобразуем всё в секунды для точного сравнения
    $total_seconds = ($days * 86400) + ($hours * 3600) + ($minutes * 60) + $seconds;

    if ($order['status'] != 'finished') {
        update_post_meta($post_id, 'featured_status', 'inactive'); // Меняем статус на 'inactive'

        // $post_update = array(
        //     'ID'           => $post_id,
        //     'post_status'  => 'draft',
        // );
        // wp_update_post($post_update);
    } else {
        if ($activation_date && $total_seconds) {
            // Текущая дата и время
            $current_date = new DateTime(current_time('mysql'));
            $activation_date = new DateTime($activation_date);

            // Вычисляем разницу между текущей датой и датой активации в секундах
            $interval = $current_date->getTimestamp() - $activation_date->getTimestamp();

            // Если прошло больше указанного количества секунд, меняем статус на 'inactive'
            if ($interval > $total_seconds) {
                update_post_meta($post_id, 'featured_status', 'inactive'); // Меняем статус на 'inactive'

                // $post_update = array(
                //     'ID'           => $post_id,
                //     'post_status'  => 'draft',
                // );
                // wp_update_post($post_update);
            } else {
                update_post_meta($post_id, 'featured_status', 'active'); // Меняем статус на 'inactive'

                // $post_update = array(
                //     'ID'           => $post_id,
                //     'post_status'  => 'publish',
                // );
                // wp_update_post($post_update);
            }
        }
    }
}







/* 
check_all_featured_field_posts_status
 */
function check_all_featured_field_posts_status() {
    // Получаем все активные посты
    $args = array(
        'post_type'      => 'featured_field',
        'post_status'    => ['publish', 'draft'],
        // 'meta_key'       => 'featured_status',
        // 'meta_value'     => 'active',
        'posts_per_page' => -1
    );

    $posts = get_posts($args);

    // Проверяем статус каждого поста
    foreach ($posts as $post) {
        check_post_status($post->ID);
    }
}
// add_action('check_featured_field_posts_status_event', 'check_all_featured_field_posts_status');




/* 
getDatabaseConnection
 */
function getDatabaseConnection() {
    static $mysqli = null; // Используем static для сохранения соединения между вызовами

    // Если соединение уже существует, возвращаем его
    if ($mysqli !== null) {
        return $mysqli;
    }
    
    // Конфигурация подключения
    $db_host     = '192.145.239.202';
    $db_name     = 'web3re5_f84aw48f';
    $db_user     = 'web3re5_f4aw8411cc';
    $db_password = 'Oi-M$;Pff{w4';
    $db_port     = 3306;
    $db_charset  = 'utf8mb4';

    // Создание соединения
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

    // Проверка на ошибки соединения
    if ($mysqli->connect_error) {
        error_log('Connection Error (' . $mysqli->connect_errno . '): ' . $mysqli->connect_error);
        die('Database connection failed.');
    }

    // Установка кодировки
    if (!$mysqli->set_charset($db_charset)) {
        error_log('Error loading character set utf8mb4: ' . $mysqli->error);
        die('Error setting character set.');
    }

    return $mysqli;
}




// Функция для получения данных из таблицы с лимитом, начиная с последних записей
// Функция для получения данных из таблицы с лимитом, начиная с последних записей 
function getTableData($table_name, $limit = null) {
    $mysqli = getDatabaseConnection();

    // Подготовка базового запроса
    $query = "SELECT * FROM $table_name";

    // Если таблица live_stream, добавляем условие по market_cap
    if ($table_name === 'live_stream') {
        $query .= " WHERE usd_market_cap >= 6000";
    }

    // Добавляем сортировку по id в обратном порядке
    $query .= " ORDER BY id DESC";

    // Добавление лимита, если он передан
    if ($limit !== null) {
        $query .= " LIMIT $limit";
    }

    // Выполняем запрос
    $result = $mysqli->query($query);
    if (!$result) {
        die('Error executing query: ' . $mysqli->error);
    }

    // Возвращаем результат как массив данных
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $result->free();
    return $data;
}




// Функция для получения всех имен таблиц из базы данных
function getAllTableNames() {
    $mysqli = getDatabaseConnection();

    // Запрос для получения всех таблиц в текущей базе данных
    $query = "SHOW TABLES";

    // Выполняем запрос
    $result = $mysqli->query($query);

    if (!$result) {
        die('Error executing query: ' . $mysqli->error);
    }

    // Возвращаем имена таблиц как массив
    $tables = [];
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0]; // Таблицы возвращаются как нумерованный массив
    }

    $result->free();
    return $tables;
}






// Функция для получения всех таблиц и всех данных из каждой таблицы
function getLimitedTablesData($limit = 10) {
    $mysqli = getDatabaseConnection();

    // Получаем список всех таблиц в базе данных
    $tables_query = "SHOW TABLES";
    $tables_result = $mysqli->query($tables_query);

    if (!$tables_result) {
        die('Error retrieving tables: ' . $mysqli->error);
    }

    // Массив для хранения данных с лимитом из каждой таблицы
    $all_data = [];

    // Проходим по каждой таблице
    while ($table_row = $tables_result->fetch_array()) {
        $table_name = $table_row[0]; // Имя таблицы

        // Получаем данные с лимитом из текущей таблицы
        $data_query = "SELECT * FROM $table_name LIMIT $limit";
        $data_result = $mysqli->query($data_query);

        if (!$data_result) {
            die("Error retrieving data from $table_name: " . $mysqli->error);
        }

        // Сохраняем данные текущей таблицы
        $table_data = [];
        while ($row = $data_result->fetch_assoc()) {
            $table_data[] = $row;
        }

        // Добавляем данные текущей таблицы в массив всех данных
        $all_data[$table_name] = $table_data;

        // Освобождаем результат
        $data_result->free();
    }

    // Закрываем соединение и освобождаем ресурсы
    $tables_result->free();
    $mysqli->close();

    // Возвращаем данные всех таблиц с лимитом
    return $all_data;
}










/* 
formatTimeAgo
 */
function formatTimeAgo($timestamp) {

    // Преобразуем временную метку из миллисекунд в секунды
    $timestampInSeconds = $timestamp / 1000;

    // Получаем текущее время в секундах
    $currentTime = time();

    // Рассчитываем разницу между текущим временем и временной меткой
    $differenceInSeconds = $currentTime - $timestampInSeconds;

    // Если разница меньше 60 секунд, возвращаем "<1 min ago"
    if ($differenceInSeconds < 60) {
        return '<1 min ago';
    }

    // Вычисляем количество часов и минут
    $hours = floor($differenceInSeconds / 3600);
    $minutes = floor(($differenceInSeconds % 3600) / 60);

    // Форматируем результат
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
    // Get the headers of the URL
    // $headers = @get_headers($url);

    // // Check if the headers are available and if the HTTP status code is 200 (OK)
    // if ($headers && strpos($headers[0], '200') !== false) {
    //     return true; // Image exists and is accessible
    // } else {
    //     return false; // Image doesn't exist or is inaccessible
    // }

    return true;
}






/* 
get_sound_status
 */
function get_sound_status($table_type) {
    // Определяем дефолтные значения для каждой таблицы
    $default_values = [
        'dex_paid' => 'true',        // по умолчанию звук включен
        'live_stream' => 'false',    // по умолчанию звук выключен
        // 'big_buys' => 'true'         // по умолчанию звук включен
    ];

    // Получаем имя куки для таблицы
    $cookie_name = $table_type . '_sound';

    // Если кука установлена, возвращаем её значение ('true' или 'false')
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name] === 'true' ? 'mod-enable' : 'mod-disable';
    }

    // Если куки нет, возвращаем дефолтное значение для данной таблицы
    if (isset($default_values[$table_type])) {
        return $default_values[$table_type] === 'true' ? 'mod-enable' : 'mod-disable';
    }

    // Возвращаем значение по умолчанию, если таблица не найдена
    return 'mod-disable';
}





/* 
Check if the HTTP host is a common local domain
 */
function is_local_dev_site() {
   // return false;

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
    // Получаем длину строки
    $input_length = strlen($input);

    // Если строка короче, чем длина начала и конца вместе, вернем оригинал
    if ($input_length <= $start_length + $end_length) {
        return $input;
    }

    // Извлекаем начало и конец строки
    $start = substr($input, 0, $start_length);
    $end = substr($input, -$end_length);

    // Возвращаем форматированную строку
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
    // Пересоздаем cron задачу для тестирования
    wp_schedule_event(time(), 'one_minute', 'check_featured_fields_status');
}
if (isset($_GET['cron_test'])) {
    add_action('init', 'reset_cron_tasks');
}
