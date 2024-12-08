<?php

/**
 * Template Name: Style One Page
 */

get_header();

$title = get_field('title');
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page mod-default">
        <div class="data-container wcl-container">
            <?php woocommerce_breadcrumb(); ?>

            <h1 class="cmp-title data-title">
                <?php if (!empty($title)) : ?>
                    <?php echo $title; ?>
                <?php else : ?>
                    <?php the_title(); ?>
                <?php endif; ?>
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