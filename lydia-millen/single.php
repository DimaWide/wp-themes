<?php

get_header();




?>
<div class="wcl-single wcl-content">
    <div class="data-container wcl-container">
        <div class="data-content">
            <?php get_template_part('template-parts/acf-blocks/block-1'); ?>

            <?php echo the_content(); ?>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/related-post'); ?>

<?php
if (comments_open()) {
    get_template_part('template-parts/comments');
}
?>
<?php
get_footer();
?>