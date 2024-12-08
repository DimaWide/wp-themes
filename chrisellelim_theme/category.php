<?php

get_header();

$terms = get_terms([
    'taxonomy'   => 'category',
    'hide_empty' => true,
]);

$term_all       = new stdClass();
$term_all->slug = 'all';
$term_all->name = 'All';
$term_active    = $term_all;
$paged          = 1;
$page_items     = 6;
$offset         = ($paged - 1) * $page_items;

array_unshift($terms, $term_all);

// if (is_tax('category')) {
//       $term_active = get_queried_object();
// }

if (!empty(get_queried_object())) {
    $term_active = get_queried_object();
}

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'paged'          => $paged,
    'offset'         => $offset,
    'post_status'    => 'publish',
);

if (!empty($term_active) && $term_active->slug != 'all') {
    $tax_query = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $term_active->slug,
        )
    );
    $args['tax_query'] = $tax_query;
}

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);

$count_post  = $page_items;
$count_post  = ceil(($count_post * $paged) / 3);
$count_post_2  =  $query_obj->post_count;
$count_post_2  = ceil($count_post_2 / 3);
if ($count_post_2  < 2) {
    $count_post =   $count_post - $count_post_2;
}
$height = $count_post * 635;
$heights = ['635', '500'];
?>
<style>
    @media (min-width: 768px) {
        .wcl-category .data-list .col-2 {
            transform: translateY(calc(<?php echo '-' . (($count_post - 1) * 635) . 'px'; ?>));
        }

        .wcl-category .data-list-out {
            height: <?php echo ($count_post *  635) + 10 . 'px'; ?>;
        }

        @media (max-width: 991px) {
            .wcl-category .data-list .col-2 {
                transform: translateY(calc(<?php echo '-' . (($count_post - 1) * 500) . 'px'; ?>));
            }

            .wcl-category .data-list-out {
                height: <?php echo ($count_post *  500) + 10 . 'px'; ?>;
            }
        }
    }
</style>
<div class="wcl-category">
    <div class="data-container wcl-container">
        <?php
        $length = strlen($term_active->name);
        $class = '';
        if ($length > 11) {
            $class = 'mod-less';
        }
        ?>
        <h2 class="data-title <?php echo $class; ?>">
            <?php
            echo $term_active->name;
            ?>
        </h2>

        <?php if ($query_obj->have_posts()) : ?>
            <?php
            $count = 0;
            $col_1 = [];
            $col_2 = [];
            $col_3 = [];
            $cols = [];
            ?>
            <div class="data-list-out">
                <div class="data-list" data-heights="<?php echo esc_attr(json_encode($heights)); ?>">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $count++;
                        if ($count == 1) {
                            ob_start();
                            get_template_part('template-parts/category/item');
                            $col_1[] = ob_get_clean();
                        } elseif ($count == 2) {
                            ob_start();
                            get_template_part('template-parts/category/item');
                            $col_2[] = ob_get_clean();
                        } elseif ($count == 3) {
                            $count = 0;
                            ob_start();
                            get_template_part('template-parts/category/item');
                            $col_3[] = ob_get_clean();
                        }
                        // $count++;
                        // $align = 'left';
                        // if ($count % 2 == 0) {
                        //     $align = 'rigth';
                        // }
                        // $args =  array(
                        //     'align' => $align,
                        // );
                        ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                    <?php
                    $cols[] = $col_1;
                    $cols[] = $col_2;
                    $cols[] = $col_3;
                    ?>
                    <?php foreach ($cols as $key => $col) : ?>
                        <div class="data-list-col col-<?php echo $key + 1; ?>">
                            <?php foreach ($col as $key => $value) : ?>
                                <?php echo $value; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="data-list-empty">Nothing found</div>
        <?php endif; ?>
    </div>

    <div class="wcl-load-more" data-cat="<?php echo $term_active->slug; ?>">
        <div class="data-container">
            <?php if ($pages_el > 1) : ?>
                <button class="data-btn wcl-link" data-page="<?php echo $paged; ?>">
                    Load more
                </button>
            <?php else : ?>
                <button class="data-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
                    All Viewed
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
