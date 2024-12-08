<?php


$form_messages = handle_reset_password_action();

if (isset($form_messages['success_message']) && !empty($form_messages['success_message'])) {
    wp_safe_redirect(site_url('/lost-password') . '?reset-password=active&complete=true');
    exit;
}

$user_login = isset($_GET['login']) ? $_GET['login'] : '';
$key        = isset($_GET['key']) ? $_GET['key'] : '';

get_header();

?>
<div class="wcl-lost-password mod-reset-password cmp-3-form">
    <div class="data-container wcl-container">
        <div class="data-title">
            <h2><?php _e('Iš naujo nustatyti slaptažodį', 'crypto-group'); ?></h2>
        </div>

        <?php if (isset($_GET['complete'])) : ?>
            <div class="data-note-2">
                <div class="data-note-2-elem-1 mod-success">
                    Slaptažodis pakeistas sėkmingai.
                </div>

                <div class="data-note-2-text">
                    Galite prisijungti naudodami naują slaptažodį per
                    <a href="#" class="js-popup-2-open mod-login-popup">
                        šią formą
                    </a>
                </div>
            </div>
        <?php elseif (empty($user_login) || empty($key)) : ?>
            <div class="data-info">
                <div class="data-note-02 mod-error">
                    Neteisingas vartotojo prisijungimo arba slaptažodžio nustatymo iš naujo raktas.
                </div>
            </div>
        <?php else : ?>
            <form method="post" class="cmp3-form data-form">
                <div class="cmp3-field mod-password">
                    <div class="cmp3-label">Žemiau įveskite naują slaptažodį.</div>

                    <div class="cmp3-field-item">
                        <input type="password" placeholder="Naujas slaptažodis" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" name="password" id="password">

                        <div class="cmp3-toggle-password">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-show.svg'; ?>" class="mod-show" alt="img">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-hide.svg'; ?>" class="mod-hide" alt="img">
                        </div>
                    </div>
                </div>

                <div class="cmp3-field mod-password">
                    <div class="cmp3-field-item">
                        <input type="password" placeholder="Patvirtinkite naują slaptažodį" value="<?php echo isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>" name="confirm_password" id="confirm_password">

                        <div class="cmp3-toggle-password">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-show.svg'; ?>" class="mod-show" alt="img">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/password-hide.svg'; ?>" class="mod-hide" alt="img">
                        </div>
                    </div>
                </div>

                <div class="cmp3-submit">
                    <input type="hidden" name="user_login" value="<?php echo esc_attr($user_login); ?>">
                    <input type="hidden" name="key" value="<?php echo esc_attr($_GET['key']); ?>">

                    <button type="submit" name="reset_password" class="wcl-cmp-button">
                        Iš naujo nustatyti slaptažodį
                        <i class="fa-fw fas fa-angle-double-right"></i>
                    </button>
                </div>

                <?php if (!empty($form_messages)) : ?>
                    <div class="data-note">
                        <?php
                        if (!empty($form_messages['success_message'])) {
                            echo '<p class="success">' . esc_html($form_messages['success_message']) . '</p>';
                        } elseif (!empty($form_messages['error_message'])) {
                            echo '<p class="error">' . esc_html($form_messages['error_message']) . '</p>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>