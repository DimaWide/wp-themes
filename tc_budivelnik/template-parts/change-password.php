<?php


?>
<div class="wcl-popup mod-change-password js-change-password" data-id="change-password">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-close js-close">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-popup.svg'; ?>" alt="img">
        </div>

        <div class="wcl-change-password cmp-6-form data-inner">
            <div class="data-title">
                Зміна пароля
            </div>

            <form class="cmp6-form mod-not-wc">
                <div class="cmp6-form-field">
                    <input type="password" name="current_password" placeholder="Поточний пароль" required>

                    <span class="data-toggle-password">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/eye-1.svg'; ?>" alt="img">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/eye-2-hide.svg'; ?>" alt="img">
                    </span>
                </div>

                <div class="cmp6-form-field">
                    <input type="password" name="new_password" placeholder="Новий пароль" required>

                    <span class="data-toggle-password">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/eye-1.svg'; ?>" alt="img">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/eye-2-hide.svg'; ?>" alt="img">
                    </span>
                </div>

                <div class="cmp6-form-field">
                    <input type="password" name="confirm_password" placeholder="Новий пароль ще раз" required>
                    
                    <span class="data-toggle-password">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/eye-1.svg'; ?>" alt="img">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/eye-2-hide.svg'; ?>" alt="img">
                    </span>
                </div>

                <div class="cmp6-form-btns">
                    <div class="cmp6-form-submit">
                        <input type="submit" value="Зберегти новий пароль" class="cmp-button mod-big mod-btn">
                    </div>

                    <div class="cmp6-form-reset js-close">
                        <button type="reset" name="reset">
                            <span>Скасувати зміну паролю</span>
                            <span>Закрити</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>