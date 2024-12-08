<?php


$user_id        = get_current_user_id();
$wishlist_items = get_user_meta($user_id, 'wishlist', true);
$wishlist_items = !empty($wishlist_items) ? $wishlist_items : [''];

$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = 12;

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $page_items,
    'post__in'       => $wishlist_items,
    'orderby'        => 'post__in'
);

$query_obj   = new WP_Query($args);
$total_pages = $query_obj->max_num_pages;
$has_more    = ($page < $total_pages) ? true : false;
$post_count = $query_obj->post_count;
?>
<div class="wcl-wish-list">
    <div class="data-container">
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php get_template_part('template-parts/shop/product-item'); ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div class="data-b1">
                <div class="data-b1-title">
                    Ви не обрали жодного товару
                </div>

                <div class="data-b1-link">
                    <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>" class="cmp-button">
                        Повернутись в магазин
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php
    $class_nav = '';

    if ($total_pages  > 1) {
        $class_nav = 'active';
    }
    ?>
    <!-- Load More -->
    <div class="data-load-more <?php echo $class_nav; ?>">
        <div class="data-load-more-container">
            <?php if ($has_more) : ?>
                <button class="data-load-more-btn cmp-button mod-hover-2 mod-btn" data-page="<?php echo $page; ?>">
                    <span>Показати ще</span>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-shop.svg'; ?>" alt="img">
                </button>
            <?php else : ?>
                <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $paged; ?>" disabled="true">
                    Все переглянуто
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>