<?php

$counter = 0;
?>
<div class="wcl-section-2">
    <div class="data-container wcl-container">
        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $counter++;
                    $cat      = get_sub_field('cat');
                    $cat      = get_term_by('id', $cat, 'category');
                    $title    = get_sub_field('title');
                    $link     = get_sub_field('link');
                    $products = get_sub_field('products');
                    $image    = get_sub_field('image');
                    $image    = wp_get_attachment_image($image, 'image-size-2');

                    if (empty($products)) {
                        $products = [''];
                    }

                    $args = array(
                        'post_type' => 'cd-product',
                        'post__in'  => $products,
                        'orderby'   => 'post__in'
                    );

                    $products_obj = get_posts($args);
                    $product_class = '';

                    if (!empty($products_obj)) {
                        $product_class = 'mod-have-product';
                    }
                    ?>
                    <div class="data-item <?php echo $product_class; ?>">
                        <div class="data-item-d">
                            <h3 class="data-item-title">
                                <?php if (!empty($title)) : ?>
                                    <?php echo $title; ?>
                                <?php else : ?>
                                    <?php echo $cat->name; ?>
                                <?php endif; ?>
                            </h3>

                            <?php if (!empty($link)) : ?>
                                <?php
                                $link_url    = $link['url'];
                                $link_title  = $link['title'];
                                $link_target = $link['target'] ?: '_self';

                                if (empty($link_url) || $link_url == '#') {
                                    $link_url = get_term_link($cat);
                                }
                                ?>
                                <div class="data-item-link">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="data-item-inner">
                            <div class="data-item-a">
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-a-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($products_obj)) : ?>
                                <div class="data-item-b swiper">
                                    <div class="data-item-b-inner swiper-wrapper">
                                        <?php foreach ($products_obj as $product) : ?>
                                            <?php
                                            $product_link = get_field('link', $product->ID);
                                            $product_link = !empty($product_link) ? $product_link : '#';
                                            ?>
                                            <div class="data-c swiper-slide">
                                                <a href="<?php echo $product_link; ?>" target="_blank" class="data-c-inner" onclick="gtag('event', '<?php echo $product_link; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($product->ID); ?>' })">
                                                    <div class="data-c-img"> 
                                                        <?php echo get_the_post_thumbnail($product->ID, 'image-size-2'); ?>
                                                    </div>

                                                    <div class="data-c-num">
                                                        N°<?php echo $counter; ?>
                                                    </div>

                                                    <h3 class="data-c-title">
                                                        <?php
                                                        echo mb_strimwidth(get_the_title($product->ID), 0, 85, '...');
                                                        ?>
                                                    </h3>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <?php if (count($products_obj) > 1) : ?>
                                        <div class="data-item-b-nav">
                                            <div class="data-item-b-nav-btn mod-prev">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                                            </div>

                                            <div class="data-item-b-nav-btn mod-next">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>