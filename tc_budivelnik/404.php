<?php
get_header();
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page-404">
        <div class="data-container wcl-container">
            <div class="data-img">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/404.png'; ?>" alt="img" width="568" height="424">
            </div>

            <h1 class="data-title">
                Сторінка, яку ви шукаєте, не знайдена...
            </h1>

            <div class="data-btn">
                <a href="<?php echo site_url(); ?>" class="cmp-button mod-big mod-hover-2">Повернутись на головну</a>
            </div>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>