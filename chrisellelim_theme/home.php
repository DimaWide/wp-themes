<?php

get_header();

$paged      = 1;
$page_items = get_option( 'posts_per_page' );
$offset     = ($paged - 1) * $page_items;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'offset'         => $offset,
    'paged'          => $paged,
    'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
$count       = 0;
?>
<div class="wcl-blog wcl-section-4">
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
                    <?php get_template_part('template-parts/blog/item', null, $args); ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div class="data-list-empty">No Found</div>
        <?php endif; ?>

        <div class="wcl-load-more">
            <div class="data-container">
                <?php if ($pages_el > 1) : ?>
                    <button class="data-btn" data-page="<?php echo $paged; ?>">
                        Load more
                    </button>
                <?php else : ?>
                    <button class="data-btn" data-page="<?php echo $paged; ?>" disabled="true">
                        All Viewed
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
