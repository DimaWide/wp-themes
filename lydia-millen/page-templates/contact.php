<?php

/**
 * Template Name: Contact Page
 */

get_header();

$name           = get_field('name', 'option');
$subtitle       = get_field('subtitle');
$form_shortcode = get_field('form_shortcode');
$logo_second    = get_field('logo_second', 'option');
$logo_second    = wp_get_attachment_image($logo_second, 'full');
?>
<div class="wcl-contact">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <?php if (!empty($name)) : ?>
            <div class="data-name">
                <?php echo $name; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($logo_second)) : ?>
            <div class="data-logo">
                <?php echo $logo_second; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo wpautop($subtitle); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($form_shortcode)) : ?>
            <div class="data-form">
                <?php echo do_shortcode($form_shortcode); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
