<?php

get_header();



$is_default_page = get_field('is_default_page');
$is_default_page =  isset($is_default_page) ? $is_default_page : true;

?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="wcl-page mod-default">
                <div class="page-container wcl-container">
                    <h1 class="page-title">
                        <?php echo get_the_title(); ?>
                    </h1>

                    <div class="page-content cmp-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</main> <!-- #wcl-page-content -->

<?php

get_footer();

?>