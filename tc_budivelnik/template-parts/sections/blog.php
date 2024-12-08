<?php

$blog_slug  = get_blog_page_slug();

$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = get_option('posts_per_page');
$page_items = 9;
$offset     = ($page - 1) * $page_items;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'paged'          => $page,
);


$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$total_pages = $query_obj->max_num_pages;
?>
<div class="wcl-blog mod-desktop" data-blog-slug="<?php echo urldecode($blog_slug); ?>" data-page-items="9">
    <div class="data-container">
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list-out">
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/components/post-item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php else : ?>
            <p><?php esc_html_e('No posts found'); ?></p>
        <?php endif; ?>

        <?php
        $class_pagination = '';
        $load_more_disabled = '';

        if ($total_pages  > 1) {
            $class_pagination = 'active';
        }

        if ($page == $total_pages) {
            $load_more_disabled = 'disabled="disabled"';
        }
        ?>
        <div class="data-nav <?php echo $class_pagination; ?>">
            <div class="data-load-more">
                <button class="data-load-btn cmp-button mod-hover-2" data-page="<?php echo $page; ?>" <?php echo $load_more_disabled; ?>>Завантажити ще</button>
            </div>

            <div class="data-pagination">
                <div class="data-pagination-inner">
                    <?php
                    blog_pagination($query_obj, $page);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Mobile  -->

<?php
$blog_slug  = get_blog_page_slug();

$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = 4;
$offset     = ($page - 1) * $page_items;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'paged'          => $page,
    //'offset'         => $offset,
);


$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$total_pages = $query_obj->max_num_pages;
?>
<div class="wcl-blog mod-mobile" data-blog-slug="<?php echo urldecode($blog_slug); ?>" data-page-items="4">
    <div class="data-container">
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list-out">
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/components/post-item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php else : ?>
            <p><?php esc_html_e('No posts found'); ?></p>
        <?php endif; ?>

        <?php
        $class_pagination = '';
        $load_more_disabled = '';

        if ($total_pages  > 1) {
            $class_pagination = 'active';
        }

        if ($page == $total_pages) {
            $load_more_disabled = 'disabled="disabled"';
        }
        ?>
        <div class="data-nav <?php echo $class_pagination; ?>">
            <div class="data-load-more">
                <button class="data-load-btn cmp-button mod-hover-2" data-page="<?php echo $page; ?>" <?php echo $load_more_disabled; ?>>Завантажити ще</button>
            </div>

            <div class="data-pagination">
                <div class="data-pagination-inner">
                    <?php
                    blog_pagination($query_obj, $page);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>