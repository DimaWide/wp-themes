<?php


$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$count = 0;
?>
<div class="wcl-section-4">
    <div class="data-container wcl-container">
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $count++;
                    $align = 'left';
                    if ($count % 2 == 0) {
                        $align = 'right';
                    }
                    $args =  array(
                        'align' => $align,
                    );
                    ?>
                    <?php get_template_part('template-parts/section-4/item', null, $args); ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>