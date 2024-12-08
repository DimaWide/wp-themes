<?php

get_header();


?>

<div class="wcl-single">
    <div class="data-container wcl-container">
        <div class="data-content wcl-single-content">
            <?php get_template_part('template-parts/single/banner'); ?>

            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/single/end'); ?>

<?php if (comments_open()) : ?>
    <?php get_template_part('template-parts/single/comments'); ?>
<?php endif; ?>

<?php get_template_part('template-parts/single/related-posts'); ?>

<?php get_template_part('template-parts/mailchimp'); ?>

<?php
get_footer();
?>