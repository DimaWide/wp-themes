<?php
get_header();
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-single cmp-5-grid wcl-page mod-default">
        <div class="data-container wcl-container">
            <div class="cmp5-row data-row">
                <div class="cmp5-col data-col">
                    <?php get_template_part('template-parts/sidebar'); ?>
                </div>

                <div class="cmp5-col data-col">
                    <?php woocommerce_breadcrumb(); ?>

                    <div class="data-head">
                        <h1 class="data-title">
                            <?php the_title(); ?>
                        </h1>

                        <div class="data-date">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/date.svg'; ?>" alt="img">

                            <span>
                                <?php echo get_the_date('d.m.Y'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="data-content page-content">
                        <?php the_content(); ?>

                        <?php get_template_part('template-parts/share-post'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $args =  array(
        'type_layout' => 'sale-propos',
    );
    get_template_part('template-parts/other-poduct-cat', '', $args);
    ?>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
?>