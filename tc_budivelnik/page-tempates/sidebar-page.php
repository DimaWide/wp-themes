<?php

/**
 * Template Name: Page With Sidebar
 */

get_header();
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page mod-default mod-sidebar cmp-5-grid">
        <div class="data-container wcl-container">
            <div class="cmp5-row data-row">
                <div class="cmp5-col data-col">
                    <?php get_template_part('template-parts/sidebar'); ?>
                </div>

                <div class="cmp5-col data-col">
                    <?php woocommerce_breadcrumb(); ?>

                    <div class="data-head">
                        <h1 class="cmp-title data-title">
                            <?php the_title(); ?>
                        </h1>
                    </div>

                    <div class="data-content page-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>