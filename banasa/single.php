<?php

get_header();

$image = get_the_post_thumbnail($post->ID, 'image-size-4');
?>

<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <div class="wcl-single mod-section-animate">
        <div class="data-container wcl-container">
            <div class="data-b1">
                <div class="data-b1-row">
                    <div class="data-b1-col">
                        <h1 class="data-title">
                            <?php the_title(); ?>
                        </h1>
                    </div>

                    <div class="data-b1-col">
                        <?php if (!empty($image)) : ?>
                            <div class="data-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="data-row">
                <div class="data-col">
                    <div class="data-content cmp-content">
                        <?php the_content(); ?>

                        <?php get_template_part('template-parts/single/share'); ?>
                    </div>
                </div>

                <div class="data-col">
                    <?php get_template_part('template-parts/components/cmp-3-sidebar'); ?>
                </div>
            </div>

            <?php get_template_part('template-parts/single/nav'); ?>
        </div>
    </div>
</main> <!-- #wcl-page-content -->

<?php

get_footer();

?>