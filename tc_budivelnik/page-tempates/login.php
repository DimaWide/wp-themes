<?php

/**
 * Template Name: Login Page
 */

if (is_user_logged_in()) {
    wp_redirect(get_permalink(wc_get_page_id('myaccount')));
    exit;
}

get_header();
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page mod-login">
        <div class="data-container wcl-container">
            <div class="woocommerce">
                <?php
                wc_get_template('myaccount/form-login.php');
                ?>
            </div>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>