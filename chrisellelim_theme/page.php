<?php

get_header();
?>


<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">

    <?php

    if (have_rows('page_content')) {
        while (have_rows('page_content')) {
            the_row();

            if (get_row_layout() == 'home_banner') {
                get_template_part('template-parts/banner');
            } elseif (get_row_layout() == 'section_1') {
                get_template_part('template-parts/section-1');
            } elseif (get_row_layout() == 'section_2') {
                get_template_part('template-parts/section-2');
            }elseif (get_row_layout() == 'section_3') {
                get_template_part('template-parts/section-3');
            }elseif (get_row_layout() == 'section_4') {
                get_template_part('template-parts/section-4');
            }elseif (get_row_layout() == 'section_5') {
                get_template_part('template-parts/section-5');
            }elseif (get_row_layout() == 'section_6') {
                get_template_part('template-parts/section-6');
            }elseif (get_row_layout() == 'section_7') {
                get_template_part('template-parts/section-7');
            }elseif (get_row_layout() == 'section_8') {
                get_template_part('template-parts/section-8');
            }elseif (get_row_layout() == 'section_9') {
                get_template_part('template-parts/section-9');
            }elseif (get_row_layout() == 'section_10') {
                get_template_part('template-parts/section-10');
            }elseif (get_row_layout() == 'section_11') {
                get_template_part('template-parts/section-11');
            } elseif (get_row_layout() == 'section_22') {
                get_template_part('template-parts/bumo/section-22');
            } elseif (get_row_layout() == 'section_23') {
                get_template_part('template-parts/bumo/section-23');
            } elseif (get_row_layout() == 'section_24') {
                get_template_part('template-parts/bumo/section-24');
            } elseif (get_row_layout() == 'section_25') {
                get_template_part('template-parts/bumo/section-25');
            } elseif (get_row_layout() == 'section_26') {
                get_template_part('template-parts/bumo/section-26');
            } elseif (get_row_layout() == 'section_27') {
                get_template_part('template-parts/bumo/section-27');
            } elseif (get_row_layout() == 'section_28') {
                get_template_part('template-parts/bumo/section-28');
            } elseif (get_row_layout() == 'section_29') {
                get_template_part('template-parts/bumo/section-29');
            } elseif (get_row_layout() == 'section_30') {
                get_template_part('template-parts/bumo/section-30');
            } elseif (get_row_layout() == 'section_31') {
                get_template_part('template-parts/bumo/section-31');
            } elseif (get_row_layout() == 'section_32') {
                get_template_part('template-parts/bumo/section-32');
            } elseif (get_row_layout() == 'section_33') {
                get_template_part('template-parts/bumo/section-33');
            }
        }
    } else {
        get_template_part('template-parts/page/item');
    }
    ?>

</main> <!-- #wcl-page-content -->



<?php

get_footer();

?>