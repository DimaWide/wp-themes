<?php

get_header();
?>
<div class="wcl-404">
    <div class="data-container wcl-container">
        <div class="data-subhead">
            <?php esc_html_e('This page doesn\'t seem to exist.', 'theme'); ?>
        </div>

        <h1 class="data-title">
            <?php esc_html_e('404', 'theme'); ?>
        </h1>

        <div class="data-link">
            <a href="<?php echo site_url('/'); ?>" class="wcl-link mod-black-to-white mod-center">
                <?php _e('Home'); ?>
            </a>
        </div>
    </div>
</div>
<?php get_footer(); ?>