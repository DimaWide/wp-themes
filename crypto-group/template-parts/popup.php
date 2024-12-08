<?php


$mailerlite_form = get_field('mailerlite_form', 'option');
$shortcode       = $mailerlite_form['shortcode'];
?>
<div class="wcl-popup">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-inner">
            <div class="data-close">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/menu-btn-close.svg'; ?>" alt="img">
            </div>

            <div class="data-info">
                <?php if (!empty($shortcode)) : ?>
                    <?php echo do_shortcode($shortcode); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>