<?php




/* 
Custom Walker Class
 */
class Custom_Walker_Nav_Menu extends Walker_Nav_menu {
    // Start the element output
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li class="data-cats-item"' . $class_names .'>';

        $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '<img src="' . get_stylesheet_directory_uri() . '/img/arrow-right.svg" alt="img">';
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}





/* 
custom_woocommerce_breadcrumbs
 */
function custom_woocommerce_breadcrumbs($crumbs) {
    foreach ($crumbs as $key => $crumb) {
        if (strpos($crumb[0], 'Сторінка') !== false) {
            unset($crumbs[$key]);
        }
    }
    return $crumbs;
}

add_filter('woocommerce_get_breadcrumb', 'custom_woocommerce_breadcrumbs');




/* 
is_product_in_wishlist
 */
function is_product_in_wishlist($product_id) {
    if (isset($_COOKIE['wishlist'])) {
        $wishlist = json_decode(stripslashes($_COOKIE['wishlist']), true);
        return in_array($product_id, $wishlist);
    }
    return false;
}



/* 
transfer_wishlist_from_cookie_to_user_meta
 */
function transfer_wishlist_from_cookie_to_user_meta($user_id) {
    if (isset($_COOKIE['wishlist'])) {
        $wishlist = json_decode(stripslashes($_COOKIE['wishlist']), true);
        
        if (is_array($wishlist)) {
            // Получаем текущий список желаемого пользователя или создаем новый, если он пуст
            $user_wishlist = get_user_meta($user_id, 'wishlist', true);
            if (!is_array($user_wishlist)) {
                $user_wishlist = array();
            }

            // Объединяем списки и удаляем дубликаты
            $user_wishlist = array_unique(array_merge($user_wishlist, $wishlist));

            // Сохраняем обновленный список желаемого
            update_user_meta($user_id, 'wishlist', $user_wishlist);

            // Очищаем куки после переноса данных
            setcookie('wishlist', '', time() - 3600, '/'); // Устанавливаем истекший срок действия для куков
        }
    }
}




// Обработчик для переноса данных после регистрации
function handle_user_register($user_id) {
    transfer_wishlist_from_cookie_to_user_meta($user_id);
}
add_action('user_register', 'handle_user_register');

// Обработчик для переноса данных после входа
function handle_user_login($user_login, $user) {
    transfer_wishlist_from_cookie_to_user_meta($user->ID);
}
add_action('wp_login', 'handle_user_login', 10, 2);




/* 
/**
 * custom_woocommerce_get_breadcrumb
 */
function custom_woocommerce_get_breadcrumb($crumbs) {
    if (is_product_category()) {
        // Получаем ID страницы "Всі товари" WooCommerce
        $shop_page_id = wc_get_page_id('shop');

        // Формируем ссылку на страницу "Всі товари"
        $shop_page_link = get_permalink($shop_page_id);

        // Создаем новый элемент массива хлебных крошек для "Всі товари"
        $shop_crumb = array(
            'Всі товари',
            $shop_page_link
        );

        // Вставляем созданный элемент в массив хлебных крошек после первого элемента
        array_splice($crumbs, 1, 0, array($shop_crumb));
    }

    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'custom_woocommerce_get_breadcrumb');




/* 
redirect_unwanted_pages
 */
function redirect_unwanted_pages() {
    $unwanted_pages = array(
        is_category(),
        is_tag(),
        (is_search() && !is_woocommerce_page()),
        is_tax('product_tag'),
        is_author()
    );

    if (in_array(true, $unwanted_pages)) {
        wp_redirect(home_url(), 301);
        exit();
    }
}
add_action('template_redirect', 'redirect_unwanted_pages');




/* 
remove_prefix_phone
 */
function remove_prefix_phone($billing_phone, $phone_code_country) {
    if (strpos($billing_phone, $phone_code_country) === 0) {
        $data = substr($billing_phone, strlen($phone_code_country));
        $data = trim($data);

        return $data;
    }

    return $billing_phone;
}



/* 
Ensure sessions are correctly started
 */
function custom_session_start() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'custom_session_start', 1);




/* 
facebook_login_callback
 */
function facebook_login_callback() {
    if (isset($_GET['code']) && isset($_GET['login-social']) && $_GET['login-social'] == 'facebook') {

        $fb = new Facebook\Facebook([
            'app_id' => 'test',
            'app_secret' => 'test',
            'default_graph_version' => 'v12.0', // Update to the latest version
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken(site_url('/login/') . '?login-social=facebook');
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            wp_die('Graph returned an error: ' . $e->getMessage());
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            wp_die('Facebook SDK returned an error: ' . $e->getMessage());
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                wp_die('Error: ' . $helper->getError() . "\n" . 'Error Code: ' . $helper->getErrorCode() . "\n" . 'Error Reason: ' . $helper->getErrorReason() . "\n" . 'Error Description: ' . $helper->getErrorDescription());
            } else {
                wp_die('Bad request');
            }
        }

        // Logged in
        try {
            $response = $fb->get('/me?fields=id,email,first_name,last_name,birthday', $accessToken);
            $user = $response->getGraphUser();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            wp_die('Graph returned an error: ' . $e->getMessage());
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            wp_die('Facebook SDK returned an error: ' . $e->getMessage());
        }

        // Check if the user with this email exists in WordPress
        $user_email = $user['email'];
        $first_name = $user['first_name'];
        $last_name  = $user['last_name'];
        $birthday   = $user['birthday'];

        // Check if the user already exists
        $user = get_user_by('email', $user_email);

        if (!$user) {
            $password = wp_generate_password();

            // Create a new user
            $user_id = wp_insert_user(array(
                'user_login'   => $user_email,
                'user_pass'    => $password,
                'user_email'   => $user_email,
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'display_name' => $first_name . ' ' . $last_name,
                'role'         => 'customer',
                'meta_input' => array(
                    'billing_first_name' => $first_name,
                    'billing_last_name'  => $last_name,
                    'billing_email'      => $user_email,
                    'date_of_birth'      => $birthday,
                ),
            ));

            if (!is_wp_error($user_id)) {
                // Get the created user
                $user = get_user_by('ID', $user_id);

                // Отправка пароля по электронной почте
                $to = $user_email;
                $subject = 'Ваш новий акаунт';
                $message = "Привіт $first_name,\n\nВаш акаунт було створено. Ось ваші дані для входу:\n\n";
                $message .= "Ім'я користувача: $user_email\n";
                $message .= "Пароль: $password\n\n";
                $message .= "Ви можете увійти тут: " . site_url('/') . 'login/' . "\n\n";
                $message .= "Дякуємо!";
                $headers = array('Content-Type: text/plain; charset=UTF-8');

                wp_mail($to, $subject, $message, $headers);
            }
        }

        // Log in the user
        if ($user) {
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            wp_redirect(get_permalink(wc_get_page_id('myaccount')));
            exit;
        }
    }
}
add_action('init', 'facebook_login_callback');





/* 
facebook_login_redirect
 */
function facebook_login_redirect() {
    if (strpos($_SERVER['REQUEST_URI'], '/login/') !== false && isset($_GET['login-social']) && $_GET['login-social'] === 'facebook') {

        $fb = new Facebook\Facebook([
            'app_id'                => 'test',
            'app_secret'            => 'test',
            'default_graph_version' => 'v12.0',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email'];

        $loginUrl = $helper->getLoginUrl(site_url('/login/') . '?login-social=facebook', $permissions);

        wp_redirect($loginUrl);
        exit();
    }
}
add_action('init', 'facebook_login_redirect');




/* 
google_login_callback
 */
function google_login_callback() {
    if (isset($_GET['code']) && isset($_GET['login-social']) && $_GET['login-social'] === 'google') {
        $clientID     = 'test';
        $clientSecret = 'test';
        $redirectUri  = site_url('/login/') . '?login-social=google';

        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        $oauth2 = new Google_Service_Oauth2($client);
        $google_account_info = $oauth2->userinfo->get();

        $email = $google_account_info->email;
        $name = $google_account_info->name;

        // Check if the user already exists
        $user = get_user_by('email', $email);

        if (!$user) {
            $password = wp_generate_password();

            // Create a new user
            $user_id = wp_insert_user(array(
                'user_login'   => $email,
                'user_pass'    => $password,
                'user_email'   => $email,
                'display_name' => $name,
                'first_name'   => $name,
                'role'         => 'customer',
                'meta_input' => array(
                    'billing_first_name' => $name,
                    'billing_email'      => $email,
                ),
            ));

            if (!is_wp_error($user_id)) {
                // Get the created user
                $user = get_user_by('ID', $user_id);

                // Отправка пароля по электронной почте
                $to = $email;
                $subject = 'Ваш новий акаунт';
                $message = "Привіт $name,\n\nВаш акаунт було створено. Ось ваші дані для входу:\n\n";
                $message .= "Ім'я користувача: $email\n";
                $message .= "Пароль: $password\n\n";
                $message .= "Ви можете увійти тут: " . site_url('/') . 'login/' . "\n\n";
                $message .= "Дякуємо!";
                $headers = array('Content-Type: text/plain; charset=UTF-8');

                wp_mail($to, $subject, $message, $headers);
            }
        }

        // Log in the user
        if ($user) {
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            wp_redirect(get_permalink(wc_get_page_id('myaccount')));
            exit;
        }
    }
}
add_action('init', 'google_login_callback');




/* 
google_login_redirect
 */
function google_login_redirect() {
    if (strpos($_SERVER['REQUEST_URI'], '/login/') !== false && isset($_GET['login-social']) && $_GET['login-social'] === 'google') {

        $clientID     = 'test';
        $clientSecret = 'test';
        $redirectUri  = site_url('/login/') . '?login-social=google';

        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        $authUrl = $client->createAuthUrl();

        wp_redirect($authUrl);
        exit();
    }
}
add_action('init', 'google_login_redirect');





/* 
Функция для добавления просмотренного продукта
 */
function track_viewed_products() {
    if (!is_admin() && is_singular('product')) { // Проверяем, что мы не находимся в админке и на странице продукта
        $product_id = get_the_ID();
        // Проверяем, что $product_id является действительным числом и больше нуля
        if (is_numeric($product_id) && $product_id > 0) {
            $viewed_products = isset($_COOKIE['viewed_products']) ? (array) explode('|', $_COOKIE['viewed_products']) : array();
            // Если продукт уже есть в массиве, удаляем его
            if (($key = array_search($product_id, $viewed_products)) !== false) {
                unset($viewed_products[$key]);
            }
            // Добавляем продукт в начало массива
            array_unshift($viewed_products, $product_id);
            // Ограничиваем размер массива до 50 элементов
            if (count($viewed_products) > 50) {
                $viewed_products = array_slice($viewed_products, 0, 50);
            }
            // Сохраняем список просмотренных продуктов в куки
            setcookie('viewed_products', implode('|', $viewed_products), strtotime('+10 years'), '/'); // Устанавливаем куки на 10 лет вперед
        }
    }
}

add_action('template_redirect', 'track_viewed_products');



/* 
get_price_range
 */
function get_price_range() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts';
    $query = "SELECT MIN(meta_value + 0) AS min_price, MAX(meta_value + 0) AS max_price
              FROM {$table_name} AS p
              INNER JOIN {$wpdb->prefix}postmeta AS pm ON p.ID = pm.post_id
              WHERE p.post_type = 'product'
              AND p.post_status = 'publish'
              AND pm.meta_key = '_price'";
    $result = $wpdb->get_results($query);
    return $result ? $result[0] : null;
}



/* 
get_sorting_args
 */
function get_sorting_args($args, $sort_by) {
    if ($sort_by) {
        $orderby = sanitize_text_field($sort_by);

        switch ($orderby) {
            case 'popularity':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'total_sales'; // WooCommerce tracks product popularity by total sales
                $args['order'] = 'DESC'; // Most popular first
                break;
            case 'rating':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = '_wc_average_rating'; // WooCommerce tracks product rating
                $args['order'] = 'DESC'; // Highest rating first
                break;
            case 'date':
                $args['orderby'] = 'date';
                $args['order'] = 'DESC'; // Latest first
                break;
            case 'price':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = '_price'; // WooCommerce tracks product price
                $args['order'] = 'ASC'; // Low to high price
                break;
            case 'price-desc':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = '_price'; // WooCommerce tracks product price
                $args['order'] = 'DESC'; // High to low price
                break;
            default:
                $args['orderby'] = 'menu_order'; // Default sorting
        }
    }
    return $args;
}



/* 
removePrefix
 */
function removePrefix($string) {
    $prefix = "pa_";
    if (substr($string, 0, strlen($prefix)) == $prefix) {
        return substr($string, strlen($prefix));
    }
    return $string;
}




/* 
add_meta_query
 */
function add_meta_query(&$args, $key, $value, $compare, $type = 'CHAR') {
    if (!empty($value)) {
        $args['meta_query'][] = [
            'key'     => $key,
            'value'   => $value,
            'compare' => $compare,
            'type'    => $type,
        ];
    }
}



/* 
add_tax_query_attr
 */
function add_tax_query_attr(&$args, $taxonomy, $term, $field_js = '') {
    if (!empty($term)) {
        if (!empty($field_js)) {
            $terms = stripslashes($term);
            $terms = json_decode($terms, true)[$field_js];
        } else {
            $terms = explode(',', $term);
        }

        $args['tax_query'][] = [
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $terms,
            'operator' => 'IN',
        ];
    }
}



/* 
add_tax_query
 */
function add_tax_query(&$args, $taxonomy, $term, $field = 'slug') {
    if (!empty($term)) {
        $args['tax_query'][] = [
            'taxonomy' => $taxonomy,
            'field'    => $field,
            'terms'    => $term,
        ];
    }
}



/**
 * Функция для отображения элементов фильтра с установкой активных элементов
 */
function shop_render_filter_items($taxonomy, $input_name, $title) {
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    $mod_hiding = '';
    $taxonomies = ['pa_dovzhina', 'pa_tovshchina', 'pa_kraina-virobnik'];

    // Получаем активные элементы из параметров запроса
    $active_terms = isset($_GET[$input_name]) ? explode(',', $_GET[$input_name]) : [];

    if (empty($active_terms)) {
        if (in_array($taxonomy, $taxonomies)) {
            $mod_hiding = 'mod-hiding';
        } else {
            $mod_hiding = 'active';
        }
    }

    if (!empty($terms) && !is_wp_error($terms)) : ?>
        <div class="data-filter-item <?php echo $mod_hiding; ?> <?php echo 'mod-' . $taxonomy; ?>">
            <div class="data-filter-item-title">
                <?php echo $title; ?>
            </div>

            <div class="data-filter-item-body">
                <ul class="data-fields">
                    <?php foreach ($terms as $term) : ?>
                        <?php $term_slug = urldecode($term->slug); ?>
                        <li class="data-fields-item data-checkbox">
                            <div class="data-checkbox">
                                <input type="checkbox" name="<?php echo $input_name; ?>" id="<?php echo $term_slug; ?>" value="<?php echo $term_slug; ?>" <?php echo in_array($term_slug, $active_terms) ? 'checked' : ''; ?>>
                                <label for="<?php echo $term_slug; ?>"><?php echo $term->name; ?></label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif;
}





/**
 * Функция для отображения категорий с установкой активных элементов
 */
function shop_render_categories_filter($taxonomy, $input_name, $title) {
    // Product cat
    $category_active = '';
    $is_cat = false;
    $product_cat = get_queried_object();

    if (is_a($product_cat, 'WP_Term') && 'product_cat' === $product_cat->taxonomy) {
        $category_active = urldecode($product_cat->slug);
        $is_cat = true;
    }

    $terms = get_terms([
        'taxonomy'   => $taxonomy,
        //'number'     => 15,
        //'hide_empty' => true,
        'parent'     => 0,
        'exclude'    => 15,
    ]);

    ?>
    <!-- Категорія -->
    <div class="data-filter-item active">
        <div class="data-filter-item-title">
            <?php echo $title; ?>
        </div>

        <div class="data-filter-item-body">
            <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                <ul class="data-fields-categories">
                    <?php foreach ($terms as $term) : ?>
                        <?php
                        $term_slug = urldecode($term->slug);
                        $active = '';

                        if ($term_slug == $category_active ) {
                            $active = 'active';
                        }
                        ?>
                        <li class="data-fields-categories-item">
                            <a href="<?php echo get_term_link((int)$term->term_id); ?>" data-slug="<?php echo $term_slug; ?>" class="<?php echo $active; ?>">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
<?php
}




function create_review_post_type() {
    $labels = array(
        'name'                  => _x('Відгуки', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Відгук', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Відгуки', 'text_domain'),
        'name_admin_bar'        => __('Відгук', 'text_domain'),
        'archives'              => __('Архів відгуків', 'text_domain'),
        'attributes'            => __('Атрибути відгуків', 'text_domain'),
        'all_items'             => __('Усі відгуки', 'text_domain'),
        'add_new_item'          => __('Додати новий відгук', 'text_domain'),
        'edit_item'             => __('Редагувати відгук', 'text_domain'),
        'new_item'              => __('Новий відгук', 'text_domain'),
        'view_item'             => __('Переглянути відгук', 'text_domain'),
        'search_items'          => __('Шукати відгук', 'text_domain'),
        'not_found'             => __('Відгуків не знайдено', 'text_domain'),
        'not_found_in_trash'    => __('Відгуків не знайдено в кошику', 'text_domain'),
        'filter_items_list'     => __('Фільтрувати список відгуків', 'text_domain'),
    );
    $args = array(
        'label'               => __('Відгук', 'text_domain'),
        'description'         => __('Відгуки для вашого сайту', 'text_domain'),
        'labels'              => $labels,
        'supports'            => array('title'),
        'public'              => false,
        'show_ui'             => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-star-filled',                         // Ви можете вибрати іконку з Dashicons
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'review'),
        // 'show_in_nav_menus'   => true,
        // 'show_in_menu'        => false,                                           // Не показувати в меню адміністрування
        // 'exclude_from_search' => false,
        // 'capability_type'     => 'post',
    );
    register_post_type('wcl-review', $args);
}
add_action('init', 'create_review_post_type');



// Add custom column to the WCL Review post type
function custom_wcl_review_columns($columns) {
    $new_columns = array();

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['status'] = __('Status', 'text-domain');
            $new_columns['rating'] = __('Rating', 'text-domain');
        }
    }

    return $new_columns;
}
add_filter('manage_edit-wcl-review_columns', 'custom_wcl_review_columns');





/* 
Populate custom column with data
 */
function custom_wcl_review_column_data($column, $post_id) {
    if ($column === 'status') {
        $status = get_post_meta($post_id, 'status', true);

        $status = isset($status) ? $status : 'Pending';
        $status = ($status == 'approved') ? 'Approved' : 'Pending';

        echo $status;
    }

    if ($column === 'rating') {
        $rating = get_post_meta($post_id, 'rating', true);
        echo !empty($rating) ? $rating : '-';
    }
}
add_action('manage_wcl-review_posts_custom_column', 'custom_wcl_review_column_data', 10, 2);




/* 
time_ago_in_ukrainian
 */
function time_ago_in_ukrainian($time) {
    $time_difference = current_time('timestamp') - $time;

    if ($time_difference < 1) {
        return 'щойно';
    }

    $time_units = array(
        12 * 30 * 24 * 60 * 60 => array('рік', 'роки', 'років'),
        30 * 24 * 60 * 60      => array('місяць', 'місяці', 'місяців'),
        7 * 24 * 60 * 60       => array('тиждень', 'тижні', 'тижнів'),
        24 * 60 * 60           => array('день', 'дні', 'днів'),
        60 * 60                => array('годину', 'години', 'годин'),
        60                     => array('хвилину', 'хвилини', 'хвилин'),
        1                      => array('секунду', 'секунди', 'секунд')
    );

    foreach ($time_units as $secs => $unit) {
        $div = $time_difference / $secs;
        if ($div >= 1) {
            $time_ago = round($div);
            $remainder = $time_ago % 10;
            if ($remainder == 1 && $time_ago != 11) {
                return $time_ago . ' ' . $unit[0] . ' тому';
            } elseif ($remainder >= 2 && $remainder <= 4 && ($time_ago < 10 || $time_ago > 20)) {
                return $time_ago . ' ' . $unit[1] . ' тому';
            } else {
                return $time_ago . ' ' . $unit[2] . ' тому';
            }
        }
    }
}



/*
* Plug for VS Code
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
register_custom_sidebar
 */
function register_custom_sidebar() {
    register_sidebar(array(
        'name'          => __('Custom Sidebar', 'text_domain'),
        'id'            => 'custom-sidebar',
        'description'   => __('Add widgets here to appear in your custom sidebar.', 'text_domain'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'register_custom_sidebar');





/* 
Проверка, является ли товар акционным
 */
function is_product_on_sale($product_id) {
    return get_post_meta($product_id, '_sale_price', true) !== '';
}





/* 
Проверка, является ли товар новинкой
 */
function is_product_new($product_id) {
    $product               = get_field('product', 'option');
    $number_days_new_label = isset($product['number_days_new_label']) ? $product['number_days_new_label'] : 1;

    // Предположим, что вы используете дату публикации товара как критерий для определения новинки
    $published_time = get_post_time('U', false, $product_id);
    $time_diff = time() - $published_time;
    // Предположим, что вы считаете товар новинкой, если он был добавлен менее 30 дней назад
    $new_threshold = $number_days_new_label * 24 * 60 * 60; // 30 дней в секундах
    return $time_diff < $new_threshold;
}




/* 
Проверка, является ли товар лидером продаж (пример)
 */
function is_product_best_seller($product_id) {
    $product         = get_field('product', 'option');
    $number_of_sales = isset($product['number_of_sales']) ? $product['number_of_sales'] : 10;

    $sales_count     = get_post_meta($product_id, 'total_sales', true);

    return $sales_count > $number_of_sales;
}




/* 
Method 1: Filter.
 */
function my_acf_google_map_api($api) {
    $google_api_key = get_field('google_api_key', 'option');

    $api['key'] = $google_api_key;
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



/* 
add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
 */
add_filter('woocommerce_price_trim_zeros', '__return_true');




/* 
pluralize
 */
function pluralize($number, $one = 'продукт', $two = 'продукти', $five = 'продуктів') {
    if ($number % 10 == 1 && $number % 100 != 11) {
        return $one;
    } elseif ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20)) {
        return $two;
    } else {
        return $five;
    }
}




/* 
custom_home_name_in_breadcrumbs
 */
function custom_home_name_in_breadcrumbs($defaults) {
    // Change the name of the "Home" link in the breadcrumbs
    $defaults['home'] = 'Головна'; // Replace 'New Name' with your desired name
    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'custom_home_name_in_breadcrumbs');





/* 
Выводим описание с кнопкой "Розгорнути опис"
 */
function wcl_get_description($post_id,  $length = 146) {
    $description_full = '';

    $product     = wc_get_product(get_the_ID());
    $description = $product->get_description();

    if (empty($description)) {
        $product = wc_get_product($post_id);
        if ($product) {
            $description = $product->get_short_description();
        }
    }

    $description_full = $description;

    if (strlen($description) > $length) {
        $description = mb_substr($description, 0, $length, 'UTF-8');
        $description .= '...';
    }

    return ['short' => $description, 'full' => $description_full];
}






/* 
Get the product categories of a WooCommerce product excluding "uncategorized"
 */
function get_product_categories_excluding_uncategorized($product_id) {
    // Get the product categories
    $terms = get_the_terms($product_id, 'product_cat');

    // Check if terms exist and if it's not a WP_Error object
    if ($terms && !is_wp_error($terms)) {
        $categories = array();

        // Loop through terms
        foreach ($terms as $term) {
            // Exclude uncategorized term
            if ($term->slug !== 'uncategorized') {
                $categories[] = $term;
            }
        }

        return $categories;
    }

    return false;
}





/* 
blog_pagination
 */
function blog_pagination($custom_query, $ajax_page) {
    // Получаем текущую страницу
    $current_page = max(1, get_query_var('paged'));

    if (!empty($ajax_page)) {
        $current_page = $ajax_page;
    }

    // Получаем общее количество страниц
    $total_pages = $custom_query->max_num_pages;

    // Определяем, когда показывать кнопку "1"
    $show_first_page = $current_page > 3;

    // Выводим кнопку "1", если нужно
    if ($show_first_page && $total_pages > 5) {
        echo '<a href="' . esc_url(get_blog_pagenum_link(1)) . '" class="data-pagination-item" data-page="1">1</a>';
    }

    // Выводим точки перед первой страницей, если нужно
    if ($show_first_page && $current_page > 3 && $total_pages > 5) {
        echo '<span class="data-pagination-item data-pagination-dots">...</span>';
    }

    // Выводим кнопку "Назад", если это не первая страница
    if ($current_page > 1) {
        // echo '<a href="' . esc_url(get_blog_pagenum_link($current_page - 1)) . '" class="data-pagination-item" data-page="' . ($current_page - 1) . '"><</a>';
    }

    // Определяем номера страниц, которые будем выводить
    $start_page = max(1, $current_page - 2);
    $end_page = min($total_pages, $start_page + 4);

    // Если $end_page меньше 5, сдвигаем $start_page назад
    if ($end_page < 5) {
        $start_page = max(1, $end_page - 4);
    }

    if ($total_pages >= 5 && $total_pages - $start_page < 5) {
        $start_page = $total_pages - 4;
    }

    // Выводим номера страниц
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($current_page == $i) {
            echo '<a href="' . esc_url(get_blog_pagenum_link($i)) . '" class="data-pagination-item mod-current" data-page="' . $i . '">' . $i . '</a>';
        } else {
            echo '<a href="' . esc_url(get_blog_pagenum_link($i)) . '" class="data-pagination-item" data-page="' . $i . '">' . $i . '</a>';
        }
    }

    // Выводим точки после последней страницы, если нужно
    if ($current_page < $total_pages - 2 && $total_pages > 5) {
        echo '<span class="data-pagination-item data-pagination-dots">...</span>';
    }

    // Выводим кнопку "Вперед", если это не последняя страница
    if ($current_page < $total_pages) {
        // echo '<a href="' . esc_url(get_blog_pagenum_link($current_page + 1)) . '" class="data-pagination-item" data-page="' . ($current_page + 1) . '">></a>';
    }
    // Выводим последнюю страницу
    if ($current_page < $total_pages - 2 && $total_pages > 5) {
        echo '<a href="' . esc_url(get_blog_pagenum_link($total_pages)) . '" class="data-pagination-item" data-page="' . $total_pages . '">' . $total_pages . '</a>';
    }
}




/* 
shop_pagination
 */
function shop_pagination($custom_query, $ajax_page) {
    // Получаем текущую страницу
    $current_page = max(1, get_query_var('paged'));

    if (!empty($ajax_page)) {
        $current_page = $ajax_page;
    }

    // Получаем общее количество страниц
    $total_pages = $custom_query->max_num_pages;

    // Определяем, когда показывать кнопку "1"
    $show_first_page = $current_page > 3;

    // Выводим кнопку "1", если нужно
    if ($show_first_page && $total_pages > 5) {
        echo '<a href="' . esc_url(get_shop_pagenum_link(1)) . '" class="data-pagination-item" data-page="1">1</a>';
    }

    // Выводим точки перед первой страницей, если нужно
    if ($show_first_page && $current_page > 3 && $total_pages > 5) {
        echo '<span class="data-pagination-item data-pagination-dots">...</span>';
    }

    // Выводим кнопку "Назад", если это не первая страница
    if ($current_page > 1) {
        // echo '<a href="' . esc_url(get_shop_pagenum_link($current_page - 1)) . '" class="data-pagination-item" data-page="' . ($current_page - 1) . '"><</a>';
    }

    // Определяем номера страниц, которые будем выводить
    $start_page = max(1, $current_page - 2);
    $end_page = min($total_pages, $start_page + 4);

    // Если $end_page меньше 5, сдвигаем $start_page назад
    if ($end_page < 5) {
        $start_page = max(1, $end_page - 4);
    }

    if ($total_pages >= 5 && $total_pages - $start_page < 5) {
        $start_page = $total_pages - 4;
    }

    // Выводим номера страниц
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($current_page == $i) {
            echo '<a href="' . esc_url(get_shop_pagenum_link($i)) . '" class="data-pagination-item mod-current" data-page="' . $i . '">' . $i . '</a>';
        } else {
            echo '<a href="' . esc_url(get_shop_pagenum_link($i)) . '" class="data-pagination-item" data-page="' . $i . '">' . $i . '</a>';
        }
    }

    // Выводим точки после последней страницы, если нужно
    if ($current_page < $total_pages - 2 && $total_pages > 5) {
        echo '<span class="data-pagination-item data-pagination-dots">...</span>';
    }

    // Выводим кнопку "Вперед", если это не последняя страница
    if ($current_page < $total_pages) {
        // echo '<a href="' . esc_url(get_shop_pagenum_link($current_page + 1)) . '" class="data-pagination-item" data-page="' . ($current_page + 1) . '">></a>';
    }
    // Выводим последнюю страницу
    if ($current_page < $total_pages - 2 && $total_pages > 5) {
        echo '<a href="' . esc_url(get_shop_pagenum_link($total_pages)) . '" class="data-pagination-item" data-page="' . $total_pages . '">' . $total_pages . '</a>';
    }
}




/* 
get_blog_page_slug
 */
function get_blog_page_slug() {
    // Get the page ID set as the posts page
    $blog_page_id = get_option('page_for_posts');

    // If a blog page is set
    if ($blog_page_id) {
        // Get the slug of the blog page
        $blog_page_slug = get_post_field('post_name', $blog_page_id);

        // Return the slug
        return $blog_page_slug;
    }

    // If no blog page is set or if there's an error, return false or handle it accordingly
    return false;
}




/* 
get_blog_pagenum_link
 */
function get_blog_pagenum_link($page_num = 1) {
    $page_num = (int)$page_num;

    $blog_slug = get_blog_page_slug();

    if (empty($blog_slug)) {
        $blog_slug = 'blog';
    }

    $link = site_url() . '/' . $blog_slug;

    if ($page_num != 1) {
        $link .= '/page/' . $page_num . '/';
    }

    return $link;
}





/* 
get_shop_pagenum_link
 */
function get_shop_pagenum_link($page_num = 1) {
    $page_num = (int)$page_num;

    $blog_slug = 'shop';

    if (empty($blog_slug)) {
        $blog_slug = 'shop';
    }

    $link = site_url() . '/' . $blog_slug;

    if ($page_num != 1) {
        $link .= '/page/' . $page_num . '/';
    }

    return $link;
}




/* 
replace_uncategorized_breadcrumb
 */
function replace_uncategorized_breadcrumb($crumbs) {
    global $post;

    // Check if the product is in the "uncategorized" category
    if (is_product() && has_term('uncategorized', 'product_cat', $post->ID)) {
        // Get the product categories excluding "uncategorized"
        $categories = wp_get_post_terms($post->ID, 'product_cat', array('exclude' => array(get_option('default_product_cat'))));

        // If there are categories other than "uncategorized"
        if (!empty($categories)) {
            // Get the first category
            $new_category = $categories[0];
            // Replace the "uncategorized" category with the first available category
            $crumbs[1] = array($new_category->name, get_term_link($new_category));
        }
    }

    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'replace_uncategorized_breadcrumb');