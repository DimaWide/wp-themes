<?php


?>

<div class="wcl-popup mod-get-call js-get-call" data-id="get-call">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-close js-close">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-popup.svg'; ?>" alt="img">
        </div>

        <div class="wcl-get-call cmp-6-form data-inner" id="get-call">
            <div class="data-container">
                <div class="data-title">
                    Замовити дзвінок
                </div>

                <form class="data-form cmp6-form">
                    <div class="cmp6-form-field">
                        <input type="text" name="name" placeholder="Ваше Ім'я" required>
                    </div>

                    <div class="cmp6-form-field">
                        <?php
                        $valid = !empty($billing_phone) ? 'valid' : 'not-valid';
                        ?>
                        <div class="cmp-7-phone data-phone <?php echo $valid; ?>">
                            <div class="cmp7-container">
                                <div class="cmp7-country-code">+38</div>

                                <div class="cmp7-input-wrapper">
                                    <input type="tel" class="cmp7-phone" name="phone" value="" maxlength="15" placeholder="">
                                    <div class="cmp7-mask-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cmp6-form-btns">
                        <div class="cmp6-form-submit">
                            <input type="submit" value="Надіслати" class="cmp-button mod-big mod-hover-2 mod-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>