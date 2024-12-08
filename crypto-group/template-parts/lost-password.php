<?php

$form_result = handle_lost_password();

if (isset($form_result['checkemail']) && !empty($form_result['checkemail'])) {
    wp_safe_redirect(site_url('/lost-password') . '?reset-link-sent=true');
    exit;
}

get_header();
?>

<div class="wcl-lost-password cmp-3-form">
    <div class="data-container wcl-container">
        <div class="data-title">
            <h2><?php _e('Pamirštas slaptažodis', 'crypto-group'); ?></h2>
        </div>

        <?php if (isset($_GET['reset-link-sent'])) : ?>
            <div class="data-info">
                <div class="data-note-02 mod-success">
                    Slaptažodžio nustatymo iš naujo el. laiškas išsiųstas.
                </div>

                <div class="data-info-text">
                    El. laiškas su slaptažodžio nustatymo iš naujo nuoroda buvo išsiųstas su jūsų paskyra susietu el. pašto adresu. Gali praeiti kelios minutės, kol pranešimas bus pristatytas.
                </div>
            </div>
        <?php else : ?>
            <?php if (!is_user_logged_in()) : ?>
                <div class="data-subtitle">
                    Įveskite el. pašto adresą, kurį pasirinkote kurdami grąžinimo įrašą. Pasirinkite laiką, reikalingą pavadinimui praleisti.
                </div>

                <form class="cmp3-form data-form" method="post">
                    <div class="cmp3-field">
                        <input type="text" name="user_login" id="user_login" placeholder="Vartotojo vardas arba el" value="<?php echo isset($_POST['user_login']) ? $_POST['user_login'] : ''; ?>">
                    </div>

                    <div class="cmp3-submit">
                        <input type="hidden" name="action" value="handle_lost_password">

                        <button type="submit" name="submit" class="wcl-cmp-button">
                            Gaukite naują slaptažodį
                            <i class="fa-fw fas fa-angle-double-right"></i>
                        </button>
                    </div>

                    <?php if (!empty($form_result)) : ?>
                        <div class="data-note">
                            <?php
                            if (isset($form_result['error_type'])) {
                                $error_type = $form_result['error_type'];
                                switch ($error_type) {
                                    case 'empty_username':
                                        echo '<p class="error">Įveskite vartotojo vardą.</p>';
                                        break;
                                    case 'invalid_username':
                                        echo '<p class="error">Neteisingas vartotojo vardas. Bandykite dar kartą.</p>';
                                        break;
                                    case 'mail_failed':
                                        echo '<p class="error">Nepavyko išsiųsti el. Bandykite dar kartą vėliau.</p>';
                                        break;
                                }
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </form>
            <?php else : ?>
                <div class="data-subtitle">
                    <p><?php _e('Jūs jau esate prisijungę.', 'crypto-group'); ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>