<?php

get_header();

$blog_id = get_option('page_for_posts');
$title   = get_field('title', $blog_id);
$title   = !empty($title) ? $title : 'Наші новини';
?>
<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-page mod-default">
        <div class="data-container wcl-container">
            <?php woocommerce_breadcrumb(); ?>

            <h1 class="cmp-title data-title">
                <?php echo $title; ?>
            </h1>

            <div class="data-content">
                <?php get_template_part('template-parts/sections/blog'); ?>
            </div>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>