<?php

/**
 * Template Name: Default Page
 */

get_header();
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page mod-default">
        <div class="data-container wcl-container">
            <h1 class="data-title">
                <?php the_title(); ?>
            </h1>

            <div class="data-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>