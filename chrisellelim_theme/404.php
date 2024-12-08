<?php

get_header(); 
?>
<div class="wcl-404">
    <div class="data-container wcl-container">
        <div class="data-a">
            <div class="data-subhead">
                <?php esc_html_e('This page doesn\'t seem to exist .', 'theme'); ?>
            </div>

            <h1 class="data-title">
                <?php esc_html_e('404', 'theme'); ?>
            </h1>

            <div class="data-link wcl-link-outer">
                <a href="<?php echo site_url('/'); ?>" class="wcl-link">
                    <?php _e('Go home'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>