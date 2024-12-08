<?php

$group_1     = get_field('group_1');
$subtitle    = $group_1['subtitle'];
$title       = $group_1['title'];
$desc        = $group_1['desc'];
$link        = $group_1['link'];
$group_2     = get_field('group_2');
$image       = $group_2['image'];
$style       = get_field('style');
$style_class = !empty($style) ? $style : 'right-image';
$style_class = 'mod-' . $style_class;

if ($style == 'left-image') {
    $image = wp_get_attachment_image($image, 'image-size-11');
} else {
    $image = wp_get_attachment_image($image, 'image-size-13');
}
?>
<!-- wcl-acf-block-2 - Shop -->
<?php if ($style == 'shop-slider') : ?>
    <?php
    $products = $group_2['list'];

    if (empty($products)) {
        $products = [''];
    }

    $args = array(
        'post_type'   => 'wcl-product',
        'post__in'    => $products,
        'orderby'     => 'post__in',
        'post_status' => 'publish',
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    ?>
    <div class="wcl-acf-block-2-v2 <?php echo $style_class; ?>">
        <div class="data-container">
            <div class="data-row">
                <div class="data-col">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                </div>

                <div class="data-col">
                    <div class="data-b">
                        <?php if (!empty($image)) : ?>
                            <div class="data-b-img">
                                <?php echo $image; ?>

                                <?php if (!empty($total_count)) : ?>
                                    <div class="data-b-btn">
                                        <span>Shop</span>
                                        <span>Leave</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($query_obj->have_posts()) : ?>
                            <div class="data-b-list-out">
                                <div class="data-b-list-text">
                                    Products
                                </div>

                                <div class="data-b-list swiper">
                                    <div class="data-b-list-inner swiper-wrapper">
                                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                            <?php
                                            global $post;
                                            $product_link  = get_field('link', $post->ID);
                                            $product_image = get_the_post_thumbnail($post->ID, 'image-size-4');
                                            ?>
                                            <div class="data-b-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
                                                <a href="<?php echo $product_link; ?>" class="data-b-item-inner" target="_blank">
                                                    <?php if (!empty($product_image)) : ?>
                                                        <div class="data-b-item-img">
                                                            <?php echo $product_image; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_postdata(); ?>
                                    </div>
                                </div>

                                <div class="data-b-list-nav">
                                    <div class="data-b-list-nav-btn mod-prev">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                                    </div>

                                    <div class="data-b-list-nav-btn mod-next">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($desc)) : ?>
                        <div class="data-desc wcl-single-content">
                            <?php echo $desc; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($link)) : ?>
                        <?php
                        $link_url    = $link['url'];
                        $link_title  = $link['title'];
                        $link_target = $link['target'] ?: '_self';
                        ?>
                        <div class="data-link">
                            <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                <?php echo $link_title; ?>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($style == 'shop-slider-content-left') : ?>
    <?php
    $products = $group_2['list'];

    if (empty($products)) {
        $products = [''];
    }

    $args = array(
        'post_type'   => 'wcl-product',
        'post__in'    => $products,
        'orderby'     => 'post__in',
        'post_status' => 'publish',
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    ?>
    <div class="wcl-acf-block-2-v2 <?php echo $style_class; ?>">
        <div class="data-container">
            <div class="data-row">
                <div class="data-col">
                    <div class="data-a">
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($desc)) : ?>
                            <div class="data-desc wcl-single-content">
                                <?php echo $desc; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                            <?php
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-link">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-b">
                        <?php if (!empty($image)) : ?>
                            <div class="data-b-img">
                                <?php echo $image; ?>

                                <?php if (!empty($total_count)) : ?>
                                    <div class="data-b-btn">
                                        <span>Shop</span>
                                        <span>Leave</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($query_obj->have_posts()) : ?>
                            <div class="data-b-list-out">
                                <div class="data-b-list-text">
                                    Products
                                </div>

                                <div class="data-b-list swiper">
                                    <div class="data-b-list-inner swiper-wrapper">
                                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                            <?php
                                            global $post;
                                            $product_link  = get_field('link', $post->ID);
                                            $product_image = get_the_post_thumbnail($post->ID, 'image-size-4');
                                            ?>
                                            <div class="data-b-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
                                                <a href="<?php echo $product_link; ?>" class="data-b-item-inner" target="_blank">
                                                    <?php if (!empty($product_image)) : ?>
                                                        <div class="data-b-item-img">
                                                            <?php echo $product_image; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_postdata(); ?>
                                    </div>
                                </div>

                                <div class="data-b-list-nav">
                                    <div class="data-b-list-nav-btn mod-prev">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                                    </div>

                                    <div class="data-b-list-nav-btn mod-next">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($style == 'shop-slider-two') : ?>
    <?php
    $image_1 = $group_1['image'];
    $image_1 = wp_get_attachment_image($image_1, 'image-size-13');
    $products = $group_2['list'];

    if (empty($products)) {
        $products = [''];
    }

    $args = array(
        'post_type'   => 'wcl-product',
        'post__in'    => $products,
        'orderby'     => 'post__in',
        'post_status' => 'publish',
    );

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    ?>
    <div class="wcl-acf-block-2-v2 <?php echo $style_class; ?>">
        <div class="data-container">
            <div class="data-row">
                <div class="data-col">
                    <div class="data-a">
                        <div class="data-img">
                            <?php echo $image_1; ?>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-b">
                        <?php if (!empty($image)) : ?>
                            <div class="data-b-img">
                                <?php echo $image; ?>

                                <?php if (!empty($total_count)) : ?>
                                    <div class="data-b-btn">
                                        <span>Shop</span>
                                        <span>Leave</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($query_obj->have_posts()) : ?>
                            <div class="data-b-list-out">
                                <div class="data-b-list-text">
                                    Products
                                </div>

                                <div class="data-b-list swiper">
                                    <div class="data-b-list-inner swiper-wrapper">
                                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                            <?php
                                            global $post;
                                            $product_link  = get_field('link', $post->ID);
                                            $product_image = get_the_post_thumbnail($post->ID, 'image-size-4');
                                            ?>
                                            <div class="data-b-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
                                                <a href="<?php echo $product_link; ?>" class="data-b-item-inner" target="_blank">
                                                    <?php if (!empty($product_image)) : ?>
                                                        <div class="data-b-item-img">
                                                            <?php echo $product_image; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_postdata(); ?>
                                    </div>
                                </div>
                                
                                <div class="data-b-list-nav">
                                    <div class="data-b-list-nav-btn mod-prev">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                                    </div>

                                    <div class="data-b-list-nav-btn mod-next">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($desc)) : ?>
                        <div class="data-desc wcl-single-content">
                            <?php echo $desc; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($link)) : ?>
                        <?php
                        $link_url    = $link['url'];
                        $link_title  = $link['title'];
                        $link_target = $link['target'] ?: '_self';
                        ?>
                        <div class="data-link">
                            <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                <?php echo $link_title; ?>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>

    <div class="wcl-acf-block-2 <?php echo $style_class; ?>">
        <div class="data-container">
            <div class="data-row">
                <div class="data-col data-col-v1">
                    <?php if (!empty($image)) : ?>
                        <div class="data-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-col data-col-v2">
                    <div class="data-a">
                        <?php if (!empty($subtitle)) : ?>
                            <div class="data-subtitle">
                                <?php echo $subtitle; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($desc)) : ?>
                            <div class="data-desc wcl-single-content">
                                <?php echo $desc; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                            <?php
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-link">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>