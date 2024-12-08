<?php

$title       = get_field('title');
$category_id = get_field('category');

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 10,
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<!-- Acf Block #2 – Акційні пропозиції -->
<div class="wcl-acf-block-2">
    <div class="data-container wcl-container">
        <div class="cmp-1-heading">
            <?php if (!empty($title)) : ?>
                <h2 class="cmp1-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($category_id)) : ?>
                <?php
                $category_link = get_term_link($category_id, 'product_cat');
                ?>
                <div class="cmp1-link">
                    <a href="<?php echo $category_link; ?>" class="cmp-button mod-hover-2">Відкрити категорію</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($query_obj->have_posts()) : ?>
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
        <?php endif; ?>

        <?php if (!empty($category_id)) : ?>
            <?php
            $category_link = get_term_link($category_id, 'product_cat');
            ?>
            <div class="data-link">
                <a href="<?php echo $category_link; ?>" class="cmp-button">Відкрити категорію</a>
            </div>
        <?php endif; ?>
    </div>
</div>