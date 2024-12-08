<?php


get_header();
?>

<?php if (is_wishlist_endpoint()) : ?>
    <?php get_template_part('template-parts/wish-list-2'); ?>
<?php else : ?>
    <?php
    get_template_part('template-parts/catalog-product');
    ?>
<?php endif; ?>

<?php
get_footer();
?>