<?php

/**
 * Template Name: Sample Page
 */

get_header();
?>
<div class="wcl-page wcl-content">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <div class="data-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>