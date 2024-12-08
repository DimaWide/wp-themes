<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<?php if (isset($_GET['edit-contact-info'])) : ?>
    <?php get_template_part('template-parts/woocommerce/contact-info-edit'); ?>
<?php else : ?>
    <?php get_template_part('template-parts/woocommerce/contact-info'); ?>
<?php endif; ?>

<?php do_action('woocommerce_after_edit_account_form'); ?>
