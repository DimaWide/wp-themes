<?php

$search_query = get_search_query();

// Product Cat
$category_slug = '';
$is_cat        = false;
$product_cat   = get_queried_object();

if (is_a($product_cat, 'WP_Term') && 'product_cat' === $product_cat->taxonomy) {
    $category_slug = urldecode($product_cat->slug);
    $is_cat        = true;
}

// Query 
$page_items = 16;
$paged       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$offset     = ($paged - 1) * $page_items;

$filter_fields = [
    'sort_by'             => '',
    'min_price'           => '',
    'max_price'           => '',
    'brand'               => '',
    'marka'               => '',
    'priznachennya'       => '',
    'rozmir_v_mm'         => '',
    'dovzhina'            => '',
    'tovshchina'          => '',
    'kraina_virobnik'     => '',
    'category_slug'       => '',
    'discounted_products' => '',
];

foreach ($filter_fields as $field => &$default) {
    $default = $_GET[$field] ?? $default;
}

$args = [
    'post_type'      => 'product',
    'posts_per_page' => $page_items,
    'paged'          => $paged,
    's'              => $search_query,
];

$args = get_sorting_args($args, $filter_fields['sort_by']);

$args['meta_query'] = ['relation' => 'AND'];
$args['tax_query']  = ['relation' => 'AND'];


if (!empty($filter_fields['min_price']) && !empty($filter_fields['max_price'])) {
    add_meta_query($args, '_price', [$filter_fields['min_price'], $filter_fields['max_price']], 'BETWEEN', 'NUMERIC');
}

if (!empty($filter_fields['discounted_products'])) {
    $args['meta_query'][] = array(
        'key'     => '_sale_price',
        'value'   => 0,
        'compare' => '>',
        'type'    => 'NUMERIC'
    );
}

$taxonomies = [
    'pa_brand'           => 'brand',
    'pa_marka'           => 'marka',
    'pa_priznachennya'   => 'priznachennya',
    'pa_rozmir-v-mm'     => 'rozmir_v_mm',
    'pa_dovzhina'        => 'dovzhina',
    'pa_tovshchina'      => 'tovshchina',
    'pa_kraina-virobnik' => 'kraina_virobnik',
];

foreach ($taxonomies as $taxonomy => $field) {
    add_tax_query_attr($args, $taxonomy, $filter_fields[$field]);
}

if ($is_cat) {
    if (!empty($category_slug)) {
        add_tax_query($args, 'product_cat', $category_slug);
    }
} else {
    if (!empty($filter_fields['category_slug'])) {
        add_tax_query($args, 'product_cat', $filter_fields['category_slug']);
    }
}

$query_obj   = new WP_Query($args);
$post_count  = $query_obj->post_count;
$total_pages = $query_obj->max_num_pages;
$has_more    = ($paged < $total_pages);

$notices = wc_get_notices();
?>
<main id="wcl-page-content " class="wcl-page-content">
    <div class="wcl-shop" data-search-query="<?php echo $search_query; ?>">
        <div class="data-container wcl-container">
            <?php if (!empty($notices)) : ?>
                <div class="wcl-wc-notice data-notice">
                    <?php
                    if (!empty($notices)) {
                        foreach ($notices as $type => $type_notices) {
                            foreach ($type_notices as $notice_data) {
                                echo '<div class="woocommerce-message ' . esc_attr($type) . '" role="alert">';
                                echo wp_kses_post($notice_data['notice']);
                                echo '</div>';
                            }
                        }
                        wc_clear_notices();
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php woocommerce_breadcrumb(); ?>

            <h1 class="cmp-title data-title">
                <?php if (is_shop()) : ?>
                    Каталог
                <?php elseif ($is_cat) : ?>
                    <?php echo $product_cat->name; ?>
                <?php else : ?>
                    <?php echo get_the_title(); ?>
                <?php endif; ?>
            </h1>

            <div class="data-b1">
                <div class="data-b1-col">
                    <div class="data-filter-btn cmp-button">
                        <span>Фільтрувати</span>
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/filtering.svg'; ?>" alt="img">
                    </div>
                </div>

                <div class="data-b1-col">
                    <!-- Orderby -->
                    <div class="data-orderby">
                        <select class="orderby" name="orderby">
                            <option value="date">Спочатку нові</option>
                            <option value="popularity">За популярністю</option>
                            <option value="rating">За середнім рейтингом</option>
                            <option value="price">За ціною: від низької до високої</option>
                            <option value="price-desc">За ціною: від високої до низької</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="data-main">
                <div class="data-row">
                    <div class="data-col">
                        <!-- Sidebar -->
                        <div class="data-sidebar">
                            <div class="data-filter-out">
                                <div class="data-filter-close js-close">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-filter.svg'; ?>" alt="img">
                                </div>

                                <div class="data-filter-nav">
                                    <div class="data-filter-nav-inner">
                                        <div class="data-filter-nav-btn cmp-button mod-transparency js-close">
                                            Закрити
                                        </div>

                                        <div class="data-filter-nav-btn cmp-button mod-white js-apply">
                                            Застосувати
                                        </div>
                                    </div>
                                </div>

                                <div class="data-filter">
                                    <?php
                                    $active = '';

                                    if (!empty($_GET) || $paged != 1 || !empty($search_query) || !empty($category_slug)) {
                                        $class = 'active';
                                    }
                                    ?>
                                    <div class="data-reset-btn cmp-button mod-transparency mod-hover-easy <?php echo $class; ?>">
                                        Скинути всі фільтри
                                    </div>

                                    <!-- Ціна -->
                                    <div class="data-filter-item active mod-price">
                                        <div class="data-filter-item-title">
                                            Ціна
                                        </div>

                                        <div class="data-filter-item-body">
                                            <?php echo get_template_part('template-parts/components/price-range'); ?>
                                        </div>
                                    </div>

                                    <!-- Акції -->
                                    <div class="data-filter-item active">
                                        <div class="data-filter-item-title">
                                            Акції
                                        </div>

                                        <div class="data-filter-item-body">
                                            <div class="data-checkbox">
                                                <input type="checkbox" id="discounted_products" name="discounted_products" value="1" <?php echo ($filter_fields['discounted_products'] == 'yes') ? 'checked' : ''; ?>>
                                                <label for="discounted_products">Товари зі знижкою</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Бренд -->
                                    <?php shop_render_filter_items('pa_brand', 'brand', 'Бренд'); ?>

                                    <!-- Марка -->
                                    <?php shop_render_filter_items('pa_marka', 'marka', 'Марка'); ?>

                                    <!-- priznachennya -->
                                    <?php shop_render_filter_items('pa_priznachennya', 'priznachennya', 'Призначення'); ?>

                                    <!-- Розмір в мм. -->
                                    <?php shop_render_filter_items('pa_rozmir-v-mm', 'rozmir_v_mm', 'Розмір в мм'); ?>

                                    <!-- Довжина -->
                                    <?php shop_render_filter_items('pa_dovzhina', 'dovzhina', 'Довжина'); ?>

                                    <!-- Товщина -->
                                    <?php shop_render_filter_items('pa_tovshchina', 'tovshchina', 'Товщина'); ?>

                                    <!-- Країна виробник -->
                                    <?php shop_render_filter_items('pa_kraina-virobnik', 'kraina_virobnik', 'Країна виробник'); ?>

                                    <!-- Категорія -->
                                    <?php shop_render_categories_filter('product_cat', 'categories', 'Категорія'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="data-col">
                        <!-- List Products -->
                        <div class="data-list-out">
                            <div class="data-list">
                                <?php if ($query_obj->have_posts()) : ?>
                                    <?php
                                    $GLOBALS['wcl_counter'] = 0;
                                    ?>
                                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                        <?php
                                        $GLOBALS['wcl_counter']++;
                                        ?>
                                        <?php get_template_part('template-parts/shop/product-item'); ?>
                                    <?php endwhile;
                                    $GLOBALS['wcl_counter'] = 0;
                                    wp_reset_postdata(); ?>
                                <?php else : ?>
                                    <div class="data-list-empty">
                                        <?php if (!empty($search_query)) : ?>
                                            На сайті "<?php echo $search_query; ?>" не знайдено. Спробуйте змінити запит, або перейдіть у каталог...
                                        <?php else : ?>
                                            Жодного товару не знайдено
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <?php
                        $class_pagination = 'active';

                        if ($total_pages  > 1) {
                            $class_pagination = 'active';
                        }
                        ?>
                        <div class="data-nav <?php echo $class_pagination; ?>">
                            <!-- Load More -->
                            <div class="data-load-more">
                                <div class="data-load-more-container">
                                    <?php if ($has_more) : ?>
                                        <button class="data-load-more-btn cmp-button mod-hover-load-more" data-page="<?php echo $paged; ?>">
                                            <span>Показати ще</span>
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-shop.svg'; ?>" alt="img">
                                        </button>
                                    <?php else : ?>
                                        <button class="data-load-more-btn cmp-button mod-disable" data-page="<?php echo $paged; ?>" disabled="true">
                                            Все переглянуто
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="data-pagination">
                                <div class="data-pagination-inner">
                                    <?php
                                    shop_pagination($query_obj, $paged);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $args =  array(
        'type_layout' => 'recently-viewed-products',
    );
    get_template_part('template-parts/other-poduct-cat', '', $args);
    ?>
</main>

<?php
get_footer();
?>