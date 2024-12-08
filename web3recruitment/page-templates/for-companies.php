<?php

/**
 * Template Name: For Companies Page
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

<div class="wcl-form mod-b">
    <div class="data-container wcl-container">
        <form class="data-form">
            <div class="data-group">
                <div class="data-field">
                    <div class="data-field-title">
                        Name
                    </div>

                    <div class="data-field-body">
                        <input type="text" name="name" required placeholder="Type your name">
                    </div>
                </div>

                <div class="data-field">
                    <div class="data-field-title">
                        Company URL
                    </div>

                    <div class="data-field-body">
                        <input type="text" name="company_url" required placeholder="e.g https://your-company/website-URL">
                    </div>
                </div>
            </div>

            <div class="data-field mod-checkbox">
                <div class="data-field-title">
                    Best way to contact you?
                </div>

                <div class="data-field-body">
                    <label class="data-checkbox" data-slug="mod-phone">
                        <span class="data-checkbox-name">Phone</span>
                        <input type="checkbox" name="way_contact" value="Phone">
                        <span class="data-checkbox-mark"></span>
                    </label>

                    <label class="data-checkbox" data-slug="mod-telegram">
                        <span class="data-checkbox-name">Telegram</span>
                        <input type="checkbox" name="way_contact" value="Telegram">
                        <span class="data-checkbox-mark"></span>
                    </label>

                    <label class="data-checkbox" data-slug="mod-email">
                        <span class="data-checkbox-name">Email</span>
                        <input type="checkbox" name="way_contact" value="Email">
                        <span class="data-checkbox-mark"></span>
                    </label>
                </div>
            </div>

            <div class="data-field mod-phone hidden">
                <div class="data-field-title">
                    Phone
                </div>

                <div class="data-field-body">
                    <input type="tel" name="phone" placeholder="+(37) - 00 - 000 - 00">
                </div>
            </div>

            <div class="data-field mod-telegram hidden">
                <div class="data-field-title">
                    Telegram username
                </div>

                <div class="data-field-body">
                    <input type="text" name="telegram_name" placeholder="e.g @Telegram Username">
                </div>
            </div>

            <div class="data-field mod-email hidden">
                <div class="data-field-title">
                    Email
                </div>

                <div class="data-field-body">
                    <input type="email" name="email" placeholder="e.g example.com">
                </div>
            </div>

            <div class="data-field">
                <div class="data-field-title">
                    Your Message
                </div>

                <div class="data-field-body">
                    <textarea name="message" required placeholder="e.g Your text"></textarea>
                </div>
            </div>

            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <input type="hidden" name="site_key" value="<?php echo $recaptcha['site_key']; ?>">

            <div class="data-submit">
                <button type="submit" class="wcl-link mod-b">
                    Let`s start
                    <img width="25" height="16" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-black.svg'; ?>" alt="img">
                </button>
            </div>
        </form>
    </div>
</div>

<?php
get_footer();
