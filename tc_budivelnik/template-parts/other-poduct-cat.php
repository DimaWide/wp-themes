<?php

$type_layout = $args['type_layout']
?>
<?php if ($type_layout == 'sale-propos') : ?>
    <?php
    //$category_id = get_field('category');

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => '_sale_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ),
        ),
    );

    // if (!empty($category_id)) {
    //     $args['tax_query'] = [
    //         array(
    //             'taxonomy' => 'product_cat',
    //             'field'    => 'id',
    //             'terms'    => $category_id,
    //         ),
    //     ];
    // }

    $query_obj   = new WP_Query($args);
    $post_count = $query_obj->post_count;
    ?>
    <?php if ($query_obj->have_posts()) : ?>
        <div class="wcl-other-poduct-cat mod-sale-propos">
            <div class="data-container wcl-container">
                <div class="cmp-1-heading">
                    <h2 class="cmp1-title">
                        Акційні пропозиції
                    </h2>

                    <div class="cmp1-link">
                        <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>?discounted_products=yes" class="cmp-button mod-hover-2">Відкрити категорію</a>
                    </div>
                </div>

                <?php
                $GLOBALS['wcl_counter'] = 0;
                ?>
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $GLOBALS['wcl_counter']++;
                        ?>
                        <?php get_template_part('template-parts/shop/product-item'); ?>
                    <?php endwhile;
                    $GLOBALS['wcl_counter'] = 0;
                    wp_reset_postdata(); ?>
                </div>

                <div class="data-link">
                    <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>?discounted_products=yes" class="cmp-button mod-hover-2">Відкрити категорію</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif ($type_layout == 'recently-viewed-products') : ?>
    <?php
    $viewed_products = (array) explode('|', $_COOKIE['viewed_products']);
    $viewed_products = !empty($viewed_products) ? $viewed_products : [''];

    $args = array(
        'post_type'      => 'product',
        'post__in'       => $viewed_products,
        'posts_per_page' => 5,
        'orderby'        => 'post__in',
    );

    $query_obj   = new WP_Query($args);
    $post_count = $query_obj->post_count;
    ?>
    <?php if ($query_obj->have_posts()) : ?>
        <div class="wcl-other-poduct-cat mod-recently-viewed-products">
            <div class="data-container wcl-container">
                <div class="cmp-1-heading">
                    <h2 class="cmp1-title">
                        Останні переглянуті товари
                    </h2>
                </div>

                <?php
                $GLOBALS['wcl_counter'] = 0;
                ?>
                <div class="data-slider-out-2">
                    <div class="data-slider-out">
                        <div class="data-slider swiper">
                            <div class="data-slider-inner swiper-wrapper">
                                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                    <?php
                                    $GLOBALS['wcl_counter']++;
                                    ?>
                                    <div class="data-slider-item swiper-slide">
                                        <?php get_template_part('template-parts/shop/product-item'); ?>
                                    </div>
                                <?php endwhile;
                                $GLOBALS['wcl_counter'] = 0;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="data-slider-nav">
                        <div class="data-slider-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                        </div>

                        <div class="data-slider-nav-btn mod-next">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else : ?>
    <?php
    $terms = get_product_categories_excluding_uncategorized($post->ID);

    if (empty($terms)) {
        return;
    }

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 5,
        'post__not_in'   => array(get_the_ID()),
    );

    if (!empty($terms)) {
        $args['tax_query'] = [
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $terms[0]->slug,
            ),
        ];
    }

    $query_obj   = new WP_Query($args);
    $post_count = $query_obj->post_count;
    ?>
    <?php if ($query_obj->have_posts()) : ?>
        <div class="wcl-other-poduct-cat mod-other-product">
            <div class="data-container wcl-container">
                <div class="cmp-1-heading">
                    <h2 class="cmp1-title">
                        Інші товари з цієї категорії
                    </h2>

                    <?php if (!empty($terms)) : ?>
                        <div class="cmp1-link">
                            <a href="<?php echo get_term_link($terms[0]); ?>" class="cmp-button mod-hover-2">Відкрити категорію</a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php
                $GLOBALS['wcl_counter'] = 0;
                ?>
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $GLOBALS['wcl_counter']++;
                        ?>
                        <?php get_template_part('template-parts/shop/product-item'); ?>
                    <?php endwhile;
                    $GLOBALS['wcl_counter'] = 0;
                    wp_reset_postdata(); ?>
                </div>

                <?php if (!empty($terms)) : ?>
                    <div class="data-link">
                        <a href="<?php echo get_term_link($terms[0]); ?>" class="cmp-button">Відкрити категорію</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>