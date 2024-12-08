<?php


?>
<div class="cmp-4-popup mod-registration-popup js-registration-popup " data-id="registration-popup">
    <div class="cmp4-overlay"></div>
    <div class="cmp4-inner-out">
        <div class="wcl-registration-popup cmp-3-form cmp4-inner" id="registration-popup">
            <div class="cmp3-inner data-inner">
                <div class="cmp4-close js-close">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-popup.svg'; ?>" alt="img">
                </div>

                <h2 class="cmp3-title mod-small data-title">
                    Pradėkite!
                </h2>

                <div class="cmp3-subtitle">
                    Norėdami pradėti, greitai užbaikite registraciją
                </div>

                <form class="cmp3-form">
                    <div class="cmp3-group">
                        <div class="cmp3-field">
                            <label class="cmp3-label" for="first_name">
                                Vardas<span>*</span>
                            </label>

                            <input type="text" placeholder="Įveskite vardą" name="first_name" id="first_name">
                        </div>

                        <div class="cmp3-field">
                            <label class="cmp3-label" for="last_name">
                                Pavardė<span>*</span>
                            </label>

                            <input type="text" placeholder="Įveskite pavardę" name="last_name" id="last_name">
                        </div>
                    </div>

                    <div class="cmp3-field">
                        <label class="cmp3-label" for="email">
                            El. paštas<span>*</span>
                        </label>

                        <input type="email" placeholder="Įveskite savo el. pašto adresą" name="email" id="email">
                    </div>

                    <div class="cmp3-field mod-password">
                        <label class="cmp3-label" for="password">
                            Slaptažodis<span>*</span>
                        </label>

                        <div class="cmp3-field-item">
                            <input type="password" placeholder="Sukurkite slaptažodį" name="password" id="password">

                            <div class="cmp3-toggle-password">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-show.svg'; ?>" class="mod-show" alt="img">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-hide.svg'; ?>" class="mod-hide" alt="img">
                            </div>
                        </div>
                    </div>

                    <div class="cmp3-field mod-password">
                        <label class="cmp3-label" for="confirm_password">
                            Patvirtinkite slaptažodį<span>*</span>
                        </label>

                        <div class="cmp3-field-item">
                            <input type="password" placeholder="Dar kartą įveskite slaptažodį" name="confirm_password" id="confirm_password">

                            <div class="cmp3-toggle-password">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-show.svg'; ?>" class="mod-show" alt="img">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-hide.svg'; ?>" class="mod-hide" alt="img">
                            </div>
                        </div>
                    </div>

                    <div class="cmp3-submit">
                        <button type="submit" name="submit" class="wcl-cmp-button">
                            Sukurti paskyrą
                            <i class="fa-fw fas fa-angle-double-right"></i>
                        </button>
                    </div>
                </form>

                <div class="cmp3-or">
                    ARBA
                </div>

                <div class="cmp3-btns">
                    <?php
                    $url = site_url('/') . 'wp-login.php?loginSocial=google';
                    ?>
                    <div class="cmp3-btns-item">
                        <a href="<?php echo $url; ?>" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/login-google.svg'; ?>" alt="img">
                            <span>  Prisijunkite naudodami Google.</span>
                        </a>
                    </div>
                </div>

                <div class="cmp3-link">
                    Jau turite paskyrą?
                    <a href="<?php echo get_permalink($login_page); ?>" class="js-popup-2-open mod-login-popup">
                        Prisijunkite
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>