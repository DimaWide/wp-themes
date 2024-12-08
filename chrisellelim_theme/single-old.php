<?php

get_header();
?>


<?php
if (have_rows('sections')) {
    get_template_part('template-parts/single-post/content');
} else {
    get_template_part('template-parts/single-post/content-new');
}
?>


<?php
get_footer();
