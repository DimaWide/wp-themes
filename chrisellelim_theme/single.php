<?php

get_header();

?>


<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">
    <?php

    if (have_rows('sections')) {
        while (have_rows('sections')) {
            the_row();
            if (get_row_layout() == 'section_12') {
                get_template_part('template-parts/single-post/section-12');
            } elseif (get_row_layout() == 'section_13') {
                get_template_part('template-parts/single-post/section-13');
            } elseif (get_row_layout() == 'section_14') {
                get_template_part('template-parts/single-post/section-14');
            } elseif (get_row_layout() == 'section_15') {
                get_template_part('template-parts/single-post/section-15');
            } elseif (get_row_layout() == 'section_16') {
                get_template_part('template-parts/single-post/section-16');
            } elseif (get_row_layout() == 'section_17') {
                get_template_part('template-parts/single-post/section-17');
            } elseif (get_row_layout() == 'section_18') {
                get_template_part('template-parts/single-post/section-18');
            } elseif (get_row_layout() == 'section_19') {
                get_template_part('template-parts/single-post/section-19');
            }
        }
    } else {
        get_template_part('template-parts/single-post/content-new');
    }

    if (comments_open()) {
        get_template_part('template-parts/comments');
    }

    get_template_part('template-parts/single-post/section-20');
    ?>
</main> <!-- #wcl-page-content -->

<?php
get_footer();
