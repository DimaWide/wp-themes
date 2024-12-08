<?php

$pages      = get_field('pages', 'option');
$login_page = isset($pages['login']) ? $pages['login'] : wc_get_page_id('myaccount');
?>
<div class="wcl-registration cmp-6-form">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="cmp-title mod-small data-title">
                Реєстрація облікового запису
            </div>

            <div class="data-link">
                Вже є аккаунт?
                <a href="<?php echo get_permalink($login_page); ?>">
                    Авторизуйтесь
                </a>
            </div>

            <form class="cmp6-form">
                <div class="cmp6-form-field">
                    <input type="text" placeholder="Ім'я *" name="first_name" required>
                </div>

                <div class="cmp6-form-field">
                    <input type="text" placeholder="Прізвище" name="last_name">
                </div>

                <div class="cmp6-form-field">
                    <input type="email" placeholder="Електронна пошта *" name="email" required>
                </div>

                <div class="cmp6-form-field">
                    <?php
                    $valid = !empty($billing_phone) ? 'valid' : 'not-valid';
                    ?>
                    <div class="cmp-7-phone data-phone <?php echo $valid; ?>">
                        <div class="cmp7-container">
                            <div class="cmp7-country-code">+38</div>

                            <div class="cmp7-input-wrapper">
                                <input type="tel" class="cmp7-phone" name="phone" maxlength="14" placeholder="" required>
                                <div class="cmp7-mask-text"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cmp6-form-field">
                    <input type="password" placeholder="Пароль *" name="password" required>
                </div>

                <div class="cmp6-form-field">
                    <input type="text" placeholder="Дата народження" name="date_of_birth" max="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="cmp6-form-field">
                    <div class="cmp6-checkbox">
                        <input type="checkbox" id="accept_terms" name="accept_terms" required>

                        <label for="accept_terms">
                            <span>Я приймаю умови та <a href="<?php echo site_url('privacy-policy'); ?>" target="_blank">політику конфіденційності</a></span>
                        </label>
                    </div>
                </div>

                <div class="cmp6-form-submit">
                    <input type="submit" value="Створити обліковий запис" class="cmp-button mod-big mod-btn mod-hover-2">
                </div>
            </form>
        </div>
    </div>
</div>