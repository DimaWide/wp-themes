<?php

get_header();

?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page">
        <h1 class="page-title">
            <div class="page-container wcl-container">
                Blog
            </div>
        </h1>

        <div class="page-content">
            <?php get_template_part('template-parts/acf-blocks/acf-12-blog'); ?>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php

get_footer();

?>