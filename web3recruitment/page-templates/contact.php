<?php

/**
 * Template Name: Contact Page
 */

get_header();

$title     = get_field('title');
$title_2   = get_the_title();
$subtitle  = get_field('subtitle');
$nav_title = get_field('nav_title');
$recaptcha = get_field('recaptcha', 'option');
if (!empty($nav_title)) {
    $title_2 = $nav_title;
}
?>
<div class="wcl-section-6">
    <div class="data-container wcl-container">
        <div class="data-a">
            <div class="data-a-item">
                <a href="<?php echo site_url('/'); ?>">
                    Home
                </a>
            </div>

            <div class="data-a-icon">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.svg'; ?>" alt="img">
            </div>

            <div class="data-a-item">
                <?php echo $title_2; ?>
            </div>
        </div>

        <h1 class="data-title">
            <?php echo $title; ?>
        </h1>

        <div class="data-subtitle">
            <?php echo wpautop($subtitle); ?>
        </div>
    </div>
</div>

<div class="wcl-form mod-c">
    <div class="data-container wcl-container">
        <form class="data-form">
            <div class="data-field">
                <div class="data-field-title">
                    Email
                </div>

                <div class="data-field-body">
                    <input type="email" name="email" required placeholder="e.g example.com">
                </div>
            </div>

            <div class="data-field">
                <div class="data-field-title">
                    Your Text
                </div>

                <div class="data-field-body">
                    <textarea name="message" required placeholder="e.g Your text"></textarea>
                </div>
            </div>

            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <input type="hidden" name="site_key" value="<?php echo $recaptcha['site_key']; ?>">

            <div class="data-submit">
                <button type="submit" class="wcl-link mod-b">
                    Send
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-black.svg'; ?>" alt="img">
                </button>
            </div>
        </form>
    </div>
</div>

<?php
get_footer();
