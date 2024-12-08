<?php

/**
 * Template Name: Contact Page
 */


get_header();

$form           = get_field('form');
$title          = $form['title'];
$form_shortcode = $form['form_shortcode'];
?>
<div class="wcl-contact">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <div class="data-inner">
            <?php if (!empty($title)) : ?>
                <div class="data-title-b">
                    <?php echo $title; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($form_shortcode)) : ?>
                <div class="data-form">
                    <?php echo do_shortcode($form_shortcode); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/mailchimp'); ?>

<?php
get_footer();
?>