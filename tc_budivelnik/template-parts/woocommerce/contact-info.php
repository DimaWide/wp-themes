<?php


$user_id   = get_current_user_id();
$user_info = get_userdata($user_id);

$billing_first_name = get_user_meta($user_id, 'billing_first_name', true);
$billing_last_name  = get_user_meta($user_id, 'billing_last_name', true);
$billing_phone      = get_user_meta($user_id, 'billing_phone', true);

$date_of_birth      = get_user_meta($user_id, 'date_of_birth', true);
$user_email         = $user_info->user_email;
$phone_code_country = get_user_meta($user_id, 'phone_code_country', true) ?? '+38';

if (!empty($date_of_birth)) {
    $date_of_birth = date('d.m.Y', strtotime($date_of_birth));
}

if (!empty($phone_code_country) && !empty($billing_phone)) {
    $billing_phone = remove_prefix_phone($billing_phone, $phone_code_country);
    $billing_phone = $phone_code_country . ' ' . $billing_phone;
}
?>
<div class="wcl-contact-info">
    <div class="data-container">
        <h2 class="data-title">
            Контактна інформація
        </h2>

        <table class="data-table">
            <tr>
                <th>Ім'я</th>
                <td><?php echo $billing_first_name; ?></td>
            </tr>

            <tr>
                <th>Прізвище</th>
                <td><?php echo $billing_last_name; ?></td>
            </tr>

            <?php if (!empty($date_of_birth)) : ?>
                <tr>
                    <th>Дата народження</th>
                    <td><?php echo $date_of_birth; ?></td>
                </tr>
            <?php endif; ?>

            <tr>
                <th>Електронна пошта</th>
                <td><?php echo $user_email; ?></td>
            </tr>

            <tr>
                <th>Телефон</th>
                <td><?php echo $billing_phone; ?></td>
            </tr>
        </table>

        <div class="data-nav">
            <div class="data-nav-item">
                <a href="?edit-contact-info">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/pencil.svg'; ?>" alt="img">
                    <span>Редагувати</span>
                </a>
            </div>

            <div class="data-nav-item">
                <a href="?change-password" class="js-popup-open" data-target="change-password">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/key.svg'; ?>" alt="img">
                    <span>Змінити пароль</span>
                </a>
            </div>
        </div>
    </div>
</div>