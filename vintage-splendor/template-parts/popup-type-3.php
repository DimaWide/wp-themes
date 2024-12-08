<?php

$mailchimp_form_shortcode = get_field('mailchimp_form_shortcode', 'option');
?>
<div class="wcl-popup wcl-popup-type-3 js-popup">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-inner">
            <div class="data-close">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/popup_close.svg'; ?>" alt="img">
            </div>

            <div class="data-text">
                Sign up to get my top 100 vintage and thrifting search terms delivered to your inbox!
            </div>

            <?php if (!empty($mailchimp_form_shortcode)) : ?>
                <div class="data-form">
                    <?php echo do_shortcode($mailchimp_form_shortcode); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>