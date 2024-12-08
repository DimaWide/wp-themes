<?php

/**
 * Template Name: For job seekers Page
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

        <div class="data-b">
            <span class="data-b-icon">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow-down.svg'; ?>" alt="img">
            </span>

            <span class="data-b-text">
                Upgrade Your Career
            </span>
        </div>
    </div>
</div>

<div class="wcl-form mod-a">
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
                        Email
                    </div>

                    <div class="data-field-body">
                        <input type="email" name="email" required placeholder="e.g example.com">
                    </div>
                </div>
            </div>

            <div class="data-group">
                <div class="data-field">
                    <div class="data-field-title">
                        Phone
                    </div>

                    <div class="data-field-body">
                        <input type="tel" name="phone" required placeholder="+(37) - 00 - 000 - 00">
                    </div>
                </div>

                <div class="data-field mod-select">
                    <div class="data-field-title">
                        What type of Job are you interested in?
                    </div>

                    <div class="data-field-body">
                        <select name="type_job" required>
                            <option selected disabled>Choose a type of job</option>
                            <option value="type-1">Type 1</option>
                            <option value="type-2">Type 2</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="data-group data-group-2">
                <div class="data-field">
                    <div class="data-field-title">
                        Linkedin profile, Github or personal website/portfolio:
                    </div>

                    <div class="data-field-body">
                        <input type="text" name="link" required placeholder="e.g https://your-account/website">
                    </div>
                </div>

                <div class="data-field data-field-1 mod-file">
                    <div class="data-field-title">
                        Upload your resume
                    </div>

                    <div class="data-field-1-inner">
                        <div class="data-field-body">
                            <label for="file-upload" class="custom-file-upload">
                                Select a file
                            </label>
                            <input type="file" name="file" required id="file-upload" accept="application/pdf">
                        </div>

                        <div class="data-field-1-info">
                            <div class="data-field-1-name">
                                My Resume. PDF
                            </div>
                            <div class="data-field-1-close">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/form-close.svg'; ?>" alt="img">
                            </div>
                        </div>
                    </div>
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
                    Submit
                    <img width="25" height="16" src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-black.svg'; ?>" alt="img">
                </button>
            </div>
        </form>
    </div>
</div>

<?php
get_footer();
