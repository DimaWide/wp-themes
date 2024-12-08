<?php

$cat = get_queried_object();

if (in_array($cat->term_id, CATS_EXCLUSIVE) && wcl_is_subscriber()) {
    get_template_part('template-parts/category/exclusive-page');
} else {
    wp_redirect(home_url());
    exit();
}
?>
