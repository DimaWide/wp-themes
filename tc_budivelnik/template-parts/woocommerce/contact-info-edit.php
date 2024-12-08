<?php


$user_id   = get_current_user_id();
$user_info = get_userdata($user_id);

$billing_first_name = get_user_meta($user_id, 'billing_first_name', true);
$billing_last_name  = get_user_meta($user_id, 'billing_last_name', true);
$billing_phone      = get_user_meta($user_id, 'billing_phone', true);

$date_of_birth      = get_user_meta($user_id, 'date_of_birth', true);
$user_email         = $user_info->user_email;
$phone_code_country = get_user_meta($user_id, 'phone_code_country', true) ?? '+38';

if (!empty($billing_phone)) {
    $billing_phone = remove_prefix_phone($billing_phone, $phone_code_country);
}
?>
<div class="wcl-contact-info-edit cmp-6-form">
    <div class="data-container">
        <h2 class="data-title">
            Контактна інформація
        </h2>

        <div class="data-inner">
            <form class="cmp6-form mod-not-wc">
                <div class="cmp6-form-field">
                    <input type="text" placeholder="Ім'я" name="first_name" value="<?php echo $billing_first_name; ?>" required>
                </div>

                <div class="cmp6-form-field">
                    <input type="text" placeholder="Прізвище" name="last_name" value="<?php echo $billing_last_name; ?>">
                </div>

                <div class="cmp6-form-field">
                    <input type="date" placeholder="Дата народження" name="date_of_birth" value="<?php echo $date_of_birth; ?>" max="<?php echo date('Y-m-d'); ?>" class="<?php echo !(empty($date_of_birth)) ? 'active' : ''; ?>">
                </div>

                <div class="cmp6-form-field">
                    <?php
                    $valid = !empty($billing_phone) ? 'valid' : 'not-valid';
                    ?>
                    <div class="cmp-7-phone data-phone <?php echo $valid; ?>">
                        <div class="cmp7-container">
                            <div class="cmp7-country-code">+38</div>

                            <div class="cmp7-input-wrapper">
                                <input type="tel" class="cmp7-phone" name="phone" value="<?php echo $billing_phone; ?>" maxlength="14" placeholder="">
                                <div class="cmp7-mask-text"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cmp6-form-field">
                    <input type="email" placeholder="Електронна пошта" name="email" value="<?php echo $user_email; ?>" required>
                </div>

                <div class="cmp6-form-btns">
                    <div class="cmp6-form-submit">
                        <input type="submit" value="Зберегти зміни" class="cmp-button mod-big mod-btn mod-hover-2">
                    </div>

                    <div class="cmp6-form-reset">
                        <a href="<?php echo wc_get_account_endpoint_url('edit-account'); ?>">Скасувати зміни</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>