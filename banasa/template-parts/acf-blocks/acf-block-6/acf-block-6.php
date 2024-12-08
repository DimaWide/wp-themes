<?php



if (display_preview_image($block)) {
    return;
}

$pages            = get_field('pages', 'option');
$projects_listing = $pages['projects_listing'];
$page_slug        = get_post_field('post_name', $projects_listing);
$category_slug    = 'categoria-de-proyecto';

if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') {
    $category_slug = 'project-category';
}

$terms = get_terms([
    'taxonomy'   => 'project_category',
    'hide_empty' => true,
]);

$current_category = '';

if (is_tax('project_category')) {
    $current_category = get_queried_object()->slug;
}

// Main Query
$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = 9;

$args = array(
    'post_type'      => 'project',
    'posts_per_page' => $page_items,
    'paged'          => $page,
);

if (!empty($current_category)) {
    $args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $current_category,
        ),
    ];
};

$query_obj   = new WP_Query($args);
$total_pages = $query_obj->max_num_pages;
$has_more    = ($page < $total_pages) ? true : false;
$post_count  = $query_obj->post_count;
?>
<!-- Acf Block #6 – Projects List -->
<div class="wcl-acf-block-6" data-slug-page="<?php echo $page_slug; ?>" data-slug-category="<?php echo $category_slug; ?>">
    <div class="data-container wcl-container">
        <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
            <div class="data-cats">
                <ul class="data-cats-list">
                    <li class="data-cats-item">
                        <a href="<?php echo get_permalink($projects_listing); ?>" class="<?php echo empty($current_category) ? 'active' : ''; ?>" data-slug="all">
                            <?php
                            if (function_exists('icl_t')) {
                                echo icl_t('banasa', 'category_all', 'Todos');
                            } else {
                                echo 'Todos';
                            }
                            ?>
                        </a>
                    </li>

                    <?php foreach ($terms as $term) : ?>
                        <?php
                        $active = '';

                        if ($term->slug == $current_category) {
                            $active = 'active';
                        }
                        ?>
                        <li class="data-cats-item">
                            <a href="<?php echo get_term_link((int)$term->term_id); ?>" class="<?php echo $active; ?>" data-slug="<?php echo $term->slug; ?>">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="data-list-out">
            <div class="data-list">
                <?php if ($query_obj->have_posts()) : ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/project-item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="data-list-empty">
                        No found
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php
        $class_nav = '';

        if ($total_pages  > 1) {
            $class_nav = 'active';
        }
        ?>
        <div class="data-load-more <?php echo $class_nav; ?>">
            <?php if ($has_more) : ?>
                <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>">
                    <?php
                    if (function_exists('icl_t')) {
                        echo icl_t('banasa', 'load_more', 'Carga más');
                    } else {
                        echo 'Carga más';
                    }
                    ?>
                </button>
            <?php else : ?>
                <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
                    <?php
                    if (function_exists('icl_t')) {
                        echo icl_t('banasa', 'all_viewed', 'Todo visto');
                    } else {
                        echo 'Todo visto';
                    }
                    ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>