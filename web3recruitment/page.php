<?php

get_header();

?>


<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">


    <?php
    if (have_rows('page_content')) {
        while (have_rows('page_content')) {
            the_row();
            if (get_row_layout() == 'section_1') {
                get_template_part('template-parts/section-1');
            } elseif (get_row_layout() == 'section_1') {
                get_template_part('template-parts/section_1');
            } elseif (get_row_layout() == 'section_2') {
                get_template_part('template-parts/section-2');
            } elseif (get_row_layout() == 'section_3') {
                get_template_part('template-parts/section-3');
            } elseif (get_row_layout() == 'section_4') {
                get_template_part('template-parts/section-4');
            } elseif (get_row_layout() == 'section_5') {
                get_template_part('template-parts/section-5');
            } elseif (get_row_layout() == 'section_6') {
                get_template_part('template-parts/section-6');
            }
        }
    } else {
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <div class="wcl-page">
                    <div class="data-container wcl-container">
                        <h1 class="data-title">
                            <?php echo get_the_title(); ?>
                        </h1>

                        <div class="data-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>

</main> <!-- #wcl-page-content -->



<?php

get_footer();

?>