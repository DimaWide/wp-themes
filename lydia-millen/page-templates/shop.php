<?php

/**
 * Template Name: Shop Page
 */

get_header();

$text        = get_field('text', 'option');
$logo_second = get_field('logo_second', 'option');
$logo_second = wp_get_attachment_image($logo_second, 'full');
?>
<div class="wcl-shop js-shop">
    <div class="data-container wcl-container">
        <div class="data-info">
            <?php if (!empty($logo_second)) : ?>
                <div class="data-logo">
                    <?php echo $logo_second; ?>
                </div>
            <?php endif; ?>

            <h1 class="data-title">
                <?php echo get_the_title(); ?>
            </h1>

            <div class="data-text">
                Ad - Contains affiliate links and previous paid partnerships
            </div>
        </div>

        <?php
        $taxs = [
            [
                'title' => 'Categories',
                'slug'  => 'cd-product-category',
            ],
        ];

        $terms = get_terms([
            'taxonomy'   => $taxs[0]['slug'],
            'hide_empty' => true,
            'parent'     => 0,
        ]);

        $category = 'style';
        ?>
        <div class="data-nav">
            <?php foreach ($taxs as $key => $tax_item) : ?>
                <?php
                $terms = get_terms([
                    'taxonomy'   => $tax_item['slug'],
                    'hide_empty' => true,
                    'parent'     => 0,
                ]);
                ?>
                <?php if (!empty($terms)) : ?>
                    <div class="data-nav-item">
                        <div class="data-nav-item-a">
                            <div class="data-nav-item-title">
                                <?php echo $tax_item['title']; ?>
                            </div>

                            <div class="data-nav-item-icon">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-11-plus.svg'; ?>" class="data-plus" alt="img">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-11-minus.svg'; ?>" class="data-minus" alt="img">
                            </div>
                        </div>

                        <div class="data-nav-item-b">
                            <?php foreach ($terms as $key_2 => $term) : ?>
                                <?php
                                $slug    = str_replace("cd-product_", '', $tax_item['slug']);
                                $type    = 'radio';
                                $checked = '';
                                if ($category == $term->slug) {
                                    $checked = 'checked';
                                }
                                ?>
                                <label class="data-nav-item-field wcl-field-checkbox">
                                    <span class="d3-name"><?php echo $term->name; ?></span>
                                    <input type="<?php echo $type; ?>" name="<?php echo $slug; ?>" id="<?php echo $term->slug . '_' . $key; ?>" value="<?php echo $term->slug; ?>" <?php echo $checked; ?>>
                                    <span class="d3-mark"></span>
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <?php
        $paged      = 1;
        $page_items = 12;
        $offset     = ($paged - 1) * $page_items;

        $args = array(
            'post_type'           => 'cd-product',
            'posts_per_page'      => $page_items,
            'paged'               => $paged,
            'offset'              => $offset,
            'ignore_sticky_posts' => 1,
            'post_status'         => ['publish'],
        );

        if (!empty($category)) {
            $tax_query = array(
                array(
                    'taxonomy' => 'cd-product-category',
                    'field'    => 'slug',
                    'terms'    => $category,
                )
            );
            $args['tax_query'] = $tax_query;
        }

        $query_obj   = new WP_Query($args);
        $total_count = $query_obj->found_posts;
        $pages_el    = ceil(($total_count - $offset) / $page_items);
        ?>
        <div class="data-list">
            <?php if ($query_obj->have_posts()) : ?>
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php get_template_part('template-parts/shop/item'); ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="data-list-empty wcl-label-empty">
                    Nothing found
                </div>
            <?php endif; ?>
        </div>

        <div class="wcl-load-more">
            <div class="d2-container">
                <?php if ($pages_el > 1) : ?>
                    <button class="d2-btn" data-page="<?php echo $paged; ?>">
                        View More
                    </button>
                <?php else : ?>
                    <button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
                        All Viewed
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="wcl-shop-posts">
    <div class="data-close">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd-menu-btn-close.svg'; ?>" alt="img">
    </div>
    <div class="data-overlay"></div>
    <div class="data-container wcl-container">
    </div>
</div>
<?php
get_footer();
