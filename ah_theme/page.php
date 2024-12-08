<?php

get_header();

?>


<!-- MAIN CONTENT -->
<main id="wcl-page-content" class="wcl-page-content">

    <?php

    if (have_rows('page_content')) {
        while (have_rows('page_content')) {
            the_row();

            if (get_row_layout() == 'banner_section') {
                get_template_part('template-parts/banner-section');
            } elseif (get_row_layout() == 'our_partners_section') {
                get_template_part('template-parts/our-partners-section');
            }
        }
    } else {
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>

                <div class="wcl-page">
                    <div class="m5-container wcl-container">
                        <div class="m5-content">
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