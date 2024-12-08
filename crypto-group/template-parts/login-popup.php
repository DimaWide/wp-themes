<?php


?>
<div class="cmp-4-popup mod-login-popup" data-id="login-popup">
    <div class="cmp4-overlay"></div>
    <div class="cmp4-inner-out">
        <div class="wcl-login-popup cmp-3-form cmp4-inner" id="login-popup">
            <div class="cmp3-inner data-inner">
                <div class="cmp4-close js-close">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-popup.svg'; ?>" alt="img">
                </div>

                <h2 class="cmp3-title mod-small data-title">
                    Sveiki sugrįžę!
                </h2>

                <div class="cmp3-subtitle">
                    Sveiki, kaip sekasi šiandien?
                </div>

                <form class="cmp3-form">
                    <div class="cmp3-fields">
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
                            </div>
                        </div>
                    </div>

                    <div class="cmp3-forgot-password">
                        <a href="<?php echo site_url('/lost-password'); ?>">
                            Pamiršote slaptažodį?
                        </a>
                    </div>

                    <div class="cmp3-submit">
                        <button type="submit" name="submit" class="wcl-cmp-button">

                            Prisijunkite
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
                            <span>Prisijunkite naudodami Google</span>
                        </a>
                    </div>
                </div>

                <div class="cmp3-link">
                    Neturite paskyros?
                    <a href="<?php echo get_permalink('/my-account/'); ?>" class="js-popup-2-open mod-registration-popup">
                        Užsiregistruoti
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>