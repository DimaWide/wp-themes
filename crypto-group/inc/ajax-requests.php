<?php




/**
 * videos_listing_load_posts
 */
function videos_listing_load_posts() {
    $page_items = isset($_POST['page_items']) ? $_POST['page_items'] : 9;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;
    $category   = !empty($_POST['category']) ? $_POST['category'] : 'all';

    $args = array(
        'post_type'      => ['video'],
        'posts_per_page' => $page_items,
        'paged'          => $page,
    );

    if (!empty($category) && $category !== 'all') {
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'video_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/video-item'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            Nerasta
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    ob_start();
    ?>
    <?php if ($has_more) : ?>
        <button class="data-load-more-btn wcl-cmp-button mod-btn" data-page="<?php echo $page; ?>">
            Įkelti daugiau
        </button>
    <?php else : ?>
        <button class="data-load-more-btn wcl-cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
            Visi peržiūrėti
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_videos_listing_load_posts', 'videos_listing_load_posts');
add_action('wp_ajax_nopriv_videos_listing_load_posts', 'videos_listing_load_posts');



/* 
check_empty_field
 */
function check_empty_field($field, $field_name, &$errors) {
    if (empty($field)) {
        $errors[$field_name] = 'Užpildykite šį lauką.';
        return true;
    }
    return false;
}




/**
 * Check email and password
 */
function check_email($email) {
    $error = '';

    if (empty($email)) {
        $error = 'Būtinas el';
    } elseif (!is_email($email)) {
        $error = 'Neteisingas el. pašto adresas';
    } elseif (email_exists($email) === false) {
        $error = 'Šis el. paštas neregistruotas';
    }

    return $error;
}




/**
 * login_user
 */
function login_user() {
    $email    = sanitize_email($_POST["email"]);
    $password = sanitize_text_field($_POST["password"]);
    $errors = array();

    if (!check_empty_field($email, 'email', $errors)) {
        if (!empty(check_email($email))) {
            $errors['email'] = check_email($email);
        }
    }

    check_empty_field($password, 'password', $errors);


    // If there are errors, return errors
    if (!empty($errors)) {
        echo json_encode(array('errors' => $errors, 'errors_form' => 'Viename ar keliuose laukuose yra klaida. <br> Patikrinkite ir bandykite dar kartą.'));
        wp_die();
    }

    $user = get_user_by('email', $email);

    if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
        // Credentials array
        $creds = array(
            'user_login'    => $user->user_login,
            'user_password' => $password,
            'remember'      => true,
        );

        $user_signon = wp_signon($creds, false);

        if (is_wp_error($user_signon)) {
            echo json_encode(array('status' => 'error', 'note_form' => true,  'message' => $user_signon->get_error_message()));
        } else {
            echo json_encode(array('status' => 'success', 'note_form' => true,  'message' => 'Prisijungimas sėkmingas'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'note_form' => true,  'message' => 'Neteisingas el. pašto adresas arba slaptažodis'));
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}
add_action('wp_ajax_login_user', 'login_user');
add_action('wp_ajax_nopriv_login_user', 'login_user');




/**
 * registration_user
 */
function registration_user() {
    $first_name       = sanitize_text_field($_POST["first_name"]);
    $last_name        = sanitize_text_field($_POST["last_name"]);
    $email            = sanitize_email($_POST["email"]);
    $password         = sanitize_text_field($_POST["password"]);
    $confirm_password = sanitize_text_field($_POST["confirm_password"]);

    $errors = array();

    check_empty_field($first_name, 'first_name', $errors);
    check_empty_field($last_name, 'last_name', $errors);
    check_empty_field($confirm_password, 'confirm_password', $errors);

    if (!check_empty_field($email, 'email', $errors)) {
        if (email_exists($email)) {
            $errors['email'] = 'Šis el. paštas jau užregistruotas';
        }
    }

    if (!check_empty_field($password, 'password', $errors)) {
        if (strlen($password) < 8) {
            $errors['password'] = 'Slaptažodį turi sudaryti daugiau nei 8 simboliai';
        }

        if ($password !== $confirm_password) {
            $errors['confirm_password'] = 'Naujas slaptažodis ir patvirtinimo slaptažodis nesutampa';
        }
    }

    // If there are errors, return errors
    if (!empty($errors)) {
        echo json_encode(array('errors' => $errors, 'errors_form' => 'Viename ar keliuose laukuose yra klaida. <br> Patikrinkite ir bandykite dar kartą.'));
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
        ),
    ));

    if (is_wp_error($user_id)) {
        echo json_encode(array('errors_form' => $user_id->get_error_message()));
    } else {
        // Paruoškite el. laiško turinį
        $subject  = 'Sveiki atvykę į mūsų svetainę';
        $message  = 'Sveiki ' . $first_name . ' ' . $last_name . "\n\n";
        $message .= "Jūsų paskyros informacija:\n";
        $message .= "El. paštas: " . $email . "\n";
        $message .= "Slaptažodis: " . $password . "\n";
        $message .= "Pagarbiai,\nSvetainės komanda";
        $headers  = array('Content-Type: text/plain; charset=UTF-8');

        // Send email
        wp_mail($email, $subject, $message, $headers);

        $user = wp_signon(array(
            'user_login'    => $email,
            'user_password' => $password,
            'remember'      => true
        ));

        echo json_encode(array('success' => true, 'message' => 'Vartotojas sėkmingai užregistruotas!'));
    }

    // Always die in functions echoing AJAX content
    wp_die();
}
add_action('wp_ajax_registration_user', 'registration_user');
add_action('wp_ajax_nopriv_registration_user', 'registration_user');







/* 
order_coupone_apply
*/
function order_coupone_apply() {
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
            'message'         => '',
            'new_row_html'    => $new_row_html,
            'discount_amount' => $discount_amount,
        );

        if (wc_notice_count() > 1) {
            wc_clear_notices();
        }
    } else {
        $response = array(
            'message' => 'Įveskite kuponą',
        );
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_order_coupone_apply', 'order_coupone_apply');
add_action('wp_ajax_nopriv_order_coupone_apply', 'order_coupone_apply');
