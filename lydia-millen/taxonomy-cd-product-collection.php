<?php

get_header();

$image      = get_field('image');
$image      = wp_get_attachment_image($image, 'image-size-14');
$subtitle   = get_field('subtitle');
$logo_third = get_field('logo_third', 'option');
$logo_third = wp_get_attachment_image($logo_third, 'full');
$term       = get_queried_object();
?>
<div class="wcl-collection-sc-1">
    <div class="data-container">
        <div class="data-row">
            <div class="data-img">
                <?php echo $image; ?>
            </div>

            <div class="data-info">
                <div class="data-info-inner">
                    <div class="data-subtitle">
                        <?php echo $subtitle; ?>
                    </div>

                    <h1 class="data-title">
                        <?php echo $term->name; ?>
                    </h1>

                    <div class="data-logo">
                        <?php echo $logo_third; ?>
                    </div>

                    <div class="data-desc">
                        <?php echo $term->description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$gallery = get_field('gallery');
?>
<?php if (!empty($gallery)) : ?>
    <div class="wcl-collection-sc-2">
        <div class="data-container wcl-container">
            <div class="data-list">
                <?php foreach ((array)$gallery as $img) : ?>
                    <?php
                    $img = wp_get_attachment_image($img, 'image-size-2');
                    ?>
                    <div class="data-item">
                        <div class="data-item-img">
                            <?php echo $img; ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$logo_second = get_field('logo_second', 'option');
$logo_second = wp_get_attachment_image($logo_second, 'full');
$collection = $term->slug;
?>
<div class="wcl-collection-sc-3 js-shop" data-collection="<?php echo $collection; ?>">
    <div class="data-container wcl-container">
        <div class="data-logo">
            <?php echo $logo_second; ?>
        </div>

        <h2 class="data-title">
            Shop the collection
        </h2>

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

        if (!empty($collection)) {
            $tax_query = array(
                array(
                    'taxonomy' => 'cd-product-collection',
                    'field'    => 'slug',
                    'terms'    => $collection,
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
?>