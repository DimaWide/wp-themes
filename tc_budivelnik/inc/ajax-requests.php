<?php



// Обработчик AJAX запроса для обновления метода доставки
add_action('wp_ajax_update_shipping_method', 'update_shipping_method');
add_action('wp_ajax_nopriv_update_shipping_method', 'update_shipping_method'); // Для неавторизованных пользователей

function update_shipping_method() {
    if (isset($_POST['shipping_method'])) {
        $shipping_method = sanitize_text_field($_POST['shipping_method']);

        // Обновляем метод доставки в текущем заказе
        WC()->session->set('chosen_shipping_methods', array($shipping_method));

        // Если требуется обновление заказа, например, при изменении статуса или сохранении
        // Можно добавить дополнительные действия здесь

        // Возвращаем успешный ответ
        wp_send_json_success($_POST['shipping_method']);
    } else {
        // Возвращаем ошибку, если данные не были переданы
        wp_send_json_error('Данные метода доставки не переданы');
    }

    // Важно завершить выполнение скрипта
    wp_die();
}





/* 
order_coupone_apply
*/
function order_coupone_apply() {
    // Получаем код промокода
    $coupon_code = $_POST['coupon_code']; // Предположим, что промокод передается методом POST

    // Применяем промокод к корзине
    if (!empty($coupon_code)) {
        WC()->cart->apply_coupon(sanitize_text_field($coupon_code));

        // Сохраняем изменения в корзине
        WC()->cart->calculate_totals();

        // Проверяем, был ли промокод успешно применен
        $applied_coupons = WC()->cart->get_applied_coupons();
        $coupon_applied = in_array($coupon_code, $applied_coupons);

        // Получаем информацию о сумме скидки
        $discount_amount = WC()->cart->get_discount_total(); // Получаем общую сумму скидки

        // Формируем HTML для новой строки в таблице заказа
        $new_row_html = '
        <tr class="cart-discount-2 coupon-discount">
            <th>Скидка (' . $coupon_code . ')</th>
            <td><span class="woocommerce-Price-amount amount"><bdi>' . wc_price(-$discount_amount) . '</bdi></span></td>
        </tr>
    ';

        // Отправляем JSON ответ
        $response = array(
            'success'         => $coupon_applied,
            'applied_coupons' => $applied_coupons,
            'message'         => $coupon_applied ? 'Промокод застосовано.' : 'Поромокод не існує.',
            'new_row_html'    => $new_row_html,
            'discount_amount' => $discount_amount,
        );

        if (wc_notice_count() > 1) {
            wc_clear_notices();
        }
    } else {
        $response = array(
            'message'         => 'Введіть промокод',
        );
    }

    if (wc_notice_count() > 1) {
        wc_clear_notices();
    }
    
    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_order_coupone_apply', 'order_coupone_apply');
add_action('wp_ajax_nopriv_order_coupone_apply', 'order_coupone_apply');


/* 
review_upload
 */
function review_upload() {
    if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['rating'])) {
        echo json_encode(['success' => false, 'message' => 'Неповні дані.']);
        exit;
    }

    $name        = sanitize_text_field($_POST['name']);
    $description = sanitize_textarea_field($_POST['description']);
    $rating      = intval($_POST['rating']);

    $avatar_url = '';

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        // Check file size
        $maxSizeInBytes = 2 * 1024 * 1024; // 2MB
        if ($_FILES['avatar']['size'] > $maxSizeInBytes) {
            echo json_encode(['success' => false, 'message' => 'Розмір файлу перевищує 2 Мб.']);
            exit;
        }

        // Check file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['avatar']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Недійсний тип файлу.']);
            exit;
        }

        $uploadDir  = wp_upload_dir();
        $uploadPath = $uploadDir['basedir'] . '/review-avatars/';

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $originalFileName = sanitize_file_name($_FILES['avatar']['name']);
        $originalFileName = str_replace(' ', '-', $originalFileName);
        $extension        = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uploadFile       = $uploadPath . $originalFileName;

        $counter = 1;
        while (file_exists($uploadFile)) {
            $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '-' . $counter . '.' . $extension;
            $uploadFile  = $uploadPath . $newFileName;
            $counter++;
        }

        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
            echo json_encode(['success' => false, 'message' => 'Не вдалося завантажити аватарr.']);
            exit;
        }

        $avatar_url = $uploadDir['baseurl'] . '/review-avatars/' . basename($uploadFile);
    }

    // Insert the review as a custom post type
    $post_title = $name . ' - ' . $description;
    $post_title = substr($post_title, 0, 50);

    $review_post = array(
        'post_title'   => $post_title,
        'post_status'  => 'publish',
        'post_type'    => 'wcl-review',
        'meta_input' => [
            'name'        => $name,
            'description' => $description,
            'rating'      => $rating,
            'avatar_url'  => $avatar_url,
            'status'      => 'pending',
        ],
    );

    $post_id = wp_insert_post($review_post);

    if ($post_id) {
        echo json_encode(['success' => true, 'message' => 'Ваш відгук успішно надіслано.']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Під час надсилання відгуку сталася помилка.']);
        exit;
    }
}
add_action('wp_ajax_review_upload', 'review_upload');
add_action('wp_ajax_nopriv_review_upload', 'review_upload');






/* 
user_change_password
 */
function user_change_password() {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $user = wp_get_current_user();

    if (wp_check_password($current_password, $user->user_pass, $user->ID)) {
        if ($new_password !== $confirm_password) {
            echo json_encode(array('success' => false, 'message' => 'Новий пароль і пароль підтвердження не збігаються.'));
        } else {
            if (strlen($new_password) < 8) {
                echo json_encode(array('success' => false, 'message' => 'Пароль занадто короткий, повинен містити щонайменше 8 символів.'));
                wp_die();
            }

            wp_set_password($new_password, $user->ID);
            wp_send_json_success();
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Ваш поточний пароль невірний.'));
    }

    wp_die();
}
add_action('wp_ajax_user_change_password', 'user_change_password');
add_action('wp_ajax_nopriv_user_change_password', 'user_change_password');





/* 
wishlist_add_product
 */
function wishlist_add_product() {
    $user_id = get_current_user_id();
    $product_id = $_POST['product_id'];

    $wishlist = get_user_meta($user_id, 'wishlist', true);
    $state = 'added';

    if (empty($wishlist)) {
        $wishlist = [$product_id];
        update_user_meta($user_id, 'wishlist', $wishlist);
    } else {
        if (!in_array($product_id, $wishlist)) {
            $wishlist[] = $product_id;
        } else {
            $index = array_search($product_id, $wishlist);

            if ($index !== false) {
                unset($wishlist[$index]);
                $state = 'removed';
            }
        }

        update_user_meta($user_id, 'wishlist', $wishlist);
    }

    echo json_encode(array('success' => true, 'state' => $state, 'count' => count($wishlist)));
    wp_die();
}
add_action('wp_ajax_wishlist_add_product', 'wishlist_add_product');
add_action('wp_ajax_nopriv_wishlist_add_product', 'wishlist_add_product');





/**
 * wishlist_load_product
 */
function wishlist_load_product() {
    $page_items = isset($_POST['page_items']) ? $_POST['page_items'] : 12;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;

    $user_id        = get_current_user_id();
    $wishlist_items = get_user_meta($user_id, 'wishlist', true);

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $page_items,
        'paged'          => $page,
        'post__in'       => $wishlist_items,
        'orderby'        => 'post__in'
    );

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/shop/product-item'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    ob_start();
    ?>
    <?php if ($has_more) : ?>
        <button class="data-load-more-btn mod-hover-2 cmp-button" data-page="<?php echo $page; ?>">
            <span>Показати ще</span>
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-shop.svg'; ?>" alt="img">
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button" data-page="<?php echo $page; ?>" disabled="true">
            Все переглянуто
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_wishlist_load_product', 'wishlist_load_product');
add_action('wp_ajax_nopriv_wishlist_load_product', 'wishlist_load_product');





/**
 * user_edit_contact_info
 */
function user_edit_contact_info() {
    // Process form data
    $user_id            = get_current_user_id();
    $first_name         = sanitize_text_field($_POST["first_name"]);
    $last_name          = sanitize_text_field($_POST["last_name"]);
    $email              = sanitize_email($_POST["email"]);
    $phone              = sanitize_text_field($_POST["phone"]);
    $date_of_birth      = sanitize_text_field($_POST["date_of_birth"]);
    $phone_code_country = sanitize_text_field($_POST["phone_code_country"]);
    $phone_valid        = sanitize_text_field($_POST["phone_valid"]);

    if (!empty($phone_code_country)) {
        $phone = $phone_code_country . ' ' . $phone;
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    }

    if ($phone_valid !== 'true') {
        $errors['phone'] = 'Введіть вірний номер телефону';
    }

    if (!empty($errors)) {
        echo json_encode(array('errors' => $errors));
        wp_die();
    }

    // If validation passes, register the user
    $user_id = wp_update_user(array(
        'ID'         => $user_id,
        'user_email' => $email,
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'meta_input' => array(
            'billing_first_name' => $first_name,
            'billing_last_name'  => $last_name,
            'billing_email'      => $email,
            'billing_phone'      => $phone,
            'date_of_birth'      => $date_of_birth,
            'phone_code_country' => $phone_code_country,
        ),
    ));

    if (is_wp_error($user_id)) {
        echo json_encode(array('errors_form' => $user_id->get_error_message()));
    } else {
        echo json_encode(array('message' => 'Контактну інформацію оновлено.', 'success' => true));
    }

    // Always die in functions echoing AJAX content
    wp_die();
}
add_action('wp_ajax_user_edit_contact_info', 'user_edit_contact_info');
add_action('wp_ajax_nopriv_user_edit_contact_info', 'user_edit_contact_info');





/**
 * registration_user
 */
function registration_user() {
    $first_name         = sanitize_text_field($_POST["first_name"]);
    $last_name          = sanitize_text_field($_POST["last_name"]);
    $email              = sanitize_email($_POST["email"]);
    $phone              = sanitize_text_field($_POST["phone"]);
    $password           = sanitize_text_field($_POST["password"]);
    $date_of_birth      = sanitize_text_field($_POST["date_of_birth"]);
    $accept_terms       = !empty($_POST["accept_terms"]) ? true : false;
    $phone_code_country = sanitize_text_field($_POST["phone_code_country"]);
    $phone_valid        = sanitize_text_field($_POST["phone_valid"]);

    if (!empty($phone_code_country)) {
        $phone = $phone_code_country . ' ' . $phone;
    }

    if (empty($email)) {
        $errors['email'] = 'Необхідно вказати адресу електронної пошти';
    } elseif (email_exists($email)) {
        $errors['email'] = 'Цей імейл вже зареєстрований';
    }

    if (empty($password)) {
        $errors['password'] = 'Необхідно ввести пароль';
    } else {
        if (strlen($password) < 8) {
            $errors['password'] = 'Пароль занадто короткий, повинен містити щонайменше 8 символів';
        }
    }

    if ($phone_valid !== 'true') {
        $errors['phone'] = 'Введіть вірний номер телефону';
    }

    if (empty($accept_terms)) {
        $errors['accept_terms'] = 'Необхідно прийняти умови політики конфіденційності';
    }

    // If there are errors, return errors
    if (!empty($errors)) {
        echo json_encode(array('errors' => $errors));
        wp_die();
    }

    // If validation passes, register the user
    $user_id = wp_insert_user(array(
        'user_login' => $email,
        'user_email' => $email,
        'user_pass'  => $password,
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'role'       => 'customer',
        'meta_input' => array(
            'billing_first_name' => $first_name,
            'billing_last_name'  => $last_name,
            'billing_email'      => $email,
            'billing_phone'      => $phone,
            'date_of_birth'      => $date_of_birth,
            'phone_code_country' => $phone_code_country,
        ),
    ));

    if (is_wp_error($user_id)) {
        echo json_encode(array('errors_form' => $user_id->get_error_message()));
    } else {
        // Prepare email content
        $subject = 'Ласкаво просимо на наш сайт';
        $message = 'Привіт ' . $first_name . '' . $last_name . "\n\n";
        $message .= "Ваші облікові дані:\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Пароль: " . $password . "\n";
        $message .= "З повагою,\nКоманда сайту";
        $headers = array('Content-Type: text/plain; charset=UTF-8');

        // Send email
        wp_mail($email, $subject, $message, $headers);

        $user = wp_signon(array(
            'user_login'    => $email,
            'user_password' => $password,
            'remember'      => true //
        ));

        echo json_encode(array('message' => 'Користувач успішно зареєстрований!', 'success' => true));
    }

    // Always die in functions echoing AJAX content
    wp_die();
}
add_action('wp_ajax_registration_user', 'registration_user');
add_action('wp_ajax_nopriv_registration_user', 'registration_user');





/**
 * blog_page_load_post
 */
function blog_page_load_post() {
    $page_items = get_option('posts_per_page');
    $page_items = isset($_POST['page_items']) ? $_POST['page_items'] : 9;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;
    $offset     = ($page - 1) * $page_items;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'paged'          => $page,
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $total_pages = $query_obj->max_num_pages;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/components/post-item'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No found
        </div>
    <?php endif; ?>

    <?php
    $output['posts'] = ob_get_clean();

    // Get pagination
    ob_start();
    shop_pagination($query_obj, $page);
    ?>
<?php
    $output['pagination'] = ob_get_clean();
    $output['has_more'] = ($page < $total_pages) ? true : false;
    $output['count_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_blog_page_load_post', 'blog_page_load_post');
add_action('wp_ajax_nopriv_blog_page_load_post', 'blog_page_load_post');







/**
 * filter_products_by_category
 */
function filter_products_by_category() {
    $page_items   = 16;
    $paged        = $_POST['page'] ?? 1;
    $search_query = $_POST['search_query'] ?? '';
    $offset       = ($paged - 1) * $page_items;

    $filter_fields = [
        'sort_by'             => '',
        'min_price'           => '',
        'max_price'           => '',
        'brand'               => '',
        'marka'               => '',
        'priznachennya'       => '',
        'rozmir_v_mm'         => '',
        'dovzhina'            => '',
        'tovshchina'          => '',
        'kraina_virobnik'     => '',
        'category_slug'       => '',
        'discounted_products' => '',
    ];

    foreach ($filter_fields as $field => &$default) {
        $default = $_POST[$field] ?? $default;
    }

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => $page_items,
        'paged'          => $paged,
        's'              => $search_query,
    ];

    $args = get_sorting_args($args, $filter_fields['sort_by']);

    $args['meta_query'] = ['relation' => 'AND'];
    $args['tax_query']  = ['relation' => 'AND'];


    if (!empty($filter_fields['min_price']) && !empty($filter_fields['max_price'])) {
        add_meta_query($args, '_price', [$filter_fields['min_price'], $filter_fields['max_price']], 'BETWEEN', 'NUMERIC');
    }

    if (!empty($filter_fields['discounted_products'])) {
        $args['meta_query'][] = array(
            'key'     => '_sale_price',
            'value'   => 0,
            'compare' => '>',
            'type'    => 'NUMERIC'
        );
    }

    $taxonomies = [
        'pa_brand'           => 'brand',
        'pa_marka'           => 'marka',
        'pa_priznachennya'   => 'priznachennya',
        'pa_rozmir-v-mm'     => 'rozmir_v_mm',
        'pa_dovzhina'        => 'dovzhina',
        'pa_tovshchina'      => 'tovshchina',
        'pa_kraina-virobnik' => 'kraina_virobnik',
    ];

    foreach ($taxonomies as $taxonomy => $field) {
        add_tax_query_attr($args, $taxonomy, $filter_fields[$field], $field);
    }

    if (!empty($filter_fields['category_slug'])) {
        add_tax_query($args, 'product_cat', $filter_fields['category_slug']);
    }

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($paged < $total_pages) ? true : false;

    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $GLOBALS['wcl_counter'] = 0;
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $GLOBALS['wcl_counter']++;
            ?>
            <?php get_template_part('template-parts/shop/product-item'); ?>
        <?php endwhile;
        $GLOBALS['wcl_counter'] = 0;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            <?php if (!empty($search_query)) : ?>
                На сайті "<?php echo $search_query; ?>" не знайдено. Спробуйте змінити запит, або перейдіть у каталог...
            <?php else : ?>
                Жодного товару не знайдено
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($has_more) : ?>
        <button class="data-load-more-btn cmp-button mod-hover-load-more" data-page="<?php echo $paged; ?>">
            <span>Показати ще</span>
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-shop.svg'; ?>" alt="img">
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button mod-disable" data-page="<?php echo $paged; ?>" disabled="true">
            Все переглянуто
        </button>
    <?php endif; ?>
    <?php
    $output['button'] = ob_get_clean();
    $output['has_more'] = $total_pages;


    // Get pagination
    ob_start();
    shop_pagination($query_obj, $paged);
    ?>
<?php
    $output['pagination'] = ob_get_clean();

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_filter_products_by_category', 'filter_products_by_category');
add_action('wp_ajax_nopriv_filter_products_by_category', 'filter_products_by_category');






/* 
update_total_cart
 */
function update_total_cart() {
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

    wp_die();
}
add_action('wp_ajax_update_total_cart', 'update_total_cart');
add_action('wp_ajax_nopriv_update_total_cart', 'update_total_cart');




/* 
add_to_cart
 */
function add_to_cart() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if ($product_id > 0) {
        $quantity = 1; // You can adjust the quantity as needed

        $result = WC()->cart->add_to_cart($product_id, $quantity);

        if ($result) {
            $cart_count = WC()->cart->get_cart_contents_count();

            $pluralized = pluralize($cart_count);
            $pluralized = "У вас $cart_count $pluralized.";

            echo json_encode(array('success' => true, 'cart_count'  => $cart_count, 'pluralized' => $pluralized));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    wp_die();
}
add_action('wp_ajax_add_to_cart', 'add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');



/* 
add_to_cart_2
 */
// function add_to_cart_2() {
//     $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

//     if ($product_id > 0) {
//         $quantity = 1; // You can adjust the quantity as needed

//         $result = WC()->cart->add_to_cart($product_id, $quantity);

//         $message = get_the_title($product_id) . ' <strong>додано до кошика!</strong>';

//         if ($result) {
//             echo json_encode(array('success' => true, 'message' => $message));
//         } else {
//             echo json_encode(array('success' => false));
//         }
//     }


//     $cart_count = WC()->cart->get_cart_contents_count();

//     if ($cart_count) {
//         $pluralized = pluralize($cart_count);
//         $pluralized = "$cart_count $pluralized.";

//         // Total
//         $cart_total = WC()->cart->get_total('raw');
//         $formatted_cart_total = number_format($cart_total, 2, '.', ' ');
//         $cart_total = $formatted_cart_total . ' грн';


//         echo json_encode(array('success' => true, 'cart_count'  => $cart_count, 'pluralized' => $pluralized, 'cart_total' => $cart_total));
//     } else {
//         echo json_encode(array('success' => false));
//     }

//     wp_die();
// }


function add_to_cart_2() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    $response = array('success' => false); // Инициализация ответа

    if ($product_id > 0) {
        $quantity = 1; // Вы можете настроить количество по необходимости

        $result = WC()->cart->add_to_cart($product_id, $quantity);

        if ($result) {
            $message = get_the_title($product_id) . ' <strong>додано до кошика!</strong>';
            $response['success'] = true;
            $response['message'] = $message;
        } else {
            $response['message'] = 'Не вдалося додати товар до кошика.';
        }
    } else {
        $response['message'] = 'Некоректний ID товару.';
    }

    $cart_count = WC()->cart->get_cart_contents_count();

    if ($cart_count) {
        $pluralized = pluralize($cart_count);
        $pluralized = "$cart_count $pluralized.";

        // Общая стоимость
        $cart_total = WC()->cart->get_total('raw');
        $formatted_cart_total = number_format($cart_total, 2, '.', ' ');
        $cart_total = $formatted_cart_total . ' грн';

        $response['cart_count'] = $cart_count;
        $response['pluralized'] = $pluralized;
        $response['cart_total'] = $cart_total;
    } else {
        $response['cart_count'] = 0;
        $response['pluralized'] = '0 товарів.';
        $response['cart_total'] = '0 грн';
    }

    echo json_encode($response);

    wp_die();
}
add_action('wp_ajax_add_to_cart_2', 'add_to_cart_2');
add_action('wp_ajax_nopriv_add_to_cart_2', 'add_to_cart_2');
add_action('wp_ajax_add_to_cart_2', 'add_to_cart_2');
add_action('wp_ajax_nopriv_add_to_cart_2', 'add_to_cart_2');




/**
 * get_call
 */
function get_call() {
    $name        = sanitize_text_field($_POST["name"]);
    $phone       = sanitize_text_field($_POST["phone"]);
    $phone_valid = sanitize_text_field($_POST["phone_valid"]);
    
    $errors = array();

    if ($phone_valid !== 'true') {
        $errors['phone'] = 'Введіть вірний номер телефону';
    }

    $phone = '+38 ' . $phone;

    if (!empty($errors)) {
        echo json_encode(array('errors' => $errors));
        wp_die();
    }

    // Send email notification to admin
    $admin_email = get_field('admin_email', 'option');
    $admin_email = ! empty($admin_email) ? $admin_email : get_option('admin_email');
    
    $subject = 'Нове замовлення дзвінка';
    $body = "Ім'я: $name\nТелефон: $phone";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    $email_sent = wp_mail($admin_email, $subject, $body, $headers);

    if ($email_sent) {
        echo json_encode(array('message' => 'Дзвінок замовлено успішно', 'success' => true));
    } 

    // Always die in functions echoing AJAX content
    wp_die();
}
add_action('wp_ajax_get_call', 'get_call');
add_action('wp_ajax_nopriv_get_call', 'get_call');



// Add a filter to modify the email headers
// add_filter('wp_mail', 'set_custom_email_avatar');

// function set_custom_email_avatar($email_data) {
//     // URL of the custom avatar image
//     $avatar_url = 'https://web.dev/images/authors/jlwagner-v2.jpg';

//     // Create a custom header for the avatar
//     $avatar_header = 'X-Avatar: ' . $avatar_url;

//     // Add the custom header to the email headers
//     if (!isset($email_data['headers'])) {
//         $email_data['headers'] = [];
//     } elseif (!is_array($email_data['headers'])) {
//         $email_data['headers'] = [$email_data['headers']];
//     }

//     $email_data['headers'][] = $avatar_header;

//     return $email_data;
// }