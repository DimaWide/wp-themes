<?php

get_header();
?>
<div class="wcl-404">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            404
        </h1>

        <div class="data-subtitle">
            Page Not Found
        </div>

        <div class="data-img">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/404-img.png'; ?>" alt="img">
        </div>

        <div class="data-desc">
            The page you are looking for doesn`t exist or an other error occurred, <a href="<?php echo site_url('/'); ?>"> Go Back</a>, or head ever to <a href="https://bestofbali.com"> bestofbali.com </a> to choose a new direction.
        </div>
    </div>
</div>
<?php get_footer(); ?>