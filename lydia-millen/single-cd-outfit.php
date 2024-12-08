<?php

get_header();

$gallery   = get_field('images');
$thumbnail = get_the_post_thumbnail($post->ID, 'image-size-11', array('class' => 'active'));
$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<div class="wcl-shop-posts">
    <div class="data-close">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd-menu-btn-close.svg'; ?>" alt="img">
    </div>
    <div class="data-overlay"></div>
    <div class="data-container wcl-container">
    </div>
</div>

<div class="wcl-outfit-p js-shop">
    <div class="data-nav">
        <div class="data-nav-inner">
            <?php if (!empty($prev_post)) : ?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="data-nav-btn mod-prev">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/outfit-arrow-left.png'; ?>" alt="img">
                    <span>Prev</span>
                </a>
            <?php endif; ?>

            <div class="data-nav-label">
                <a href="<?php echo site_url('/') . 'outfits-landing/'; ?>"> Back to all looks</a>
            </div>

            <?php if (!empty($next_post)) : ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>" class="data-nav-btn mod-next">
                    <span>Next</span>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/outfit-arrow-left.png'; ?>" alt="img">
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col data-a">
                <?php if (!empty($gallery)) : ?>
                    <?php
                    $counter = 0;
                    $images = [];

                    foreach ((array)$gallery as $img_id) {
                        $images[] = wp_get_attachment_image_url($img_id, 'image-size-11');
                    }
                    $gallery_class = '';
                    if (count((array)$gallery) > 1) {
                        $gallery_class = 'mod-more-one';
                    } else {
                        $gallery_class = 'mod-one-item';
                    }
                    ?>
                    <div class="data-a-b <?php echo $gallery_class; ?>">
                        <div class="data-gallery-out">
                            <div class="data-gallery" data-images="<?php echo esc_attr(json_encode($images)); ?>" data-index="1">
                                <?php foreach ((array)$gallery as $img_id) : ?>
                                    <?php
                                    $counter++;
                                    $active = '';
                                    $image = wp_get_attachment_image_url($img_id, 'image-size-11');
                                    ?>
                                    <?php if (!empty($image)) : ?>
                                        <?php if ($counter == 1) : ?>
                                            <img src="<?php echo $image; ?>" class="active" alt="img">
                                        <?php elseif ($counter == 2) : ?>
                                            <img src="<?php echo $image; ?>" class="next" alt="img">
                                        <?php else : ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </div>

                            <div class="data-gallery-nav">
                                <div class="data-gallery-nav-btn mod-prev">
                                    Previous
                                </div>

                                <div class="data-gallery-nav-btn mod-next">
                                    Next
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <?php if (!empty($thumbnail)) : ?>
                        <div class="data-a-b mod-one-item">
                            <div class="data-gallery-out">
                                <div class="data-gallery">
                                    <?php echo $thumbnail; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="data-col data-b">
                <div class="data-b-a">
                    <div class="data-label">
                        Outfit
                    </div>

                    <h1 class="data-title">
                        <?php echo strtolower(get_the_title()); ?>
                    </h1>

                    <div class="data-subtitle">
                        <p>This post contains some PR products (clearly marked) and affiliate links.</p>
                    </div>
                </div>

                <?php
                $product_list = [''];
                $product_list_get = get_field('products');
                if (!empty($product_list_get)) {
                    $product_list = $product_list_get;
                }

                $args = array(
                    'post_type'           => 'cd-product',
                    'posts_per_page'      => -1,
                    'post__in'            => $product_list,
                    'orderby'             => 'post__in',
                    'ignore_sticky_posts' => 1,
                    'post_status'         => ['publish'],
                );
                $query_obj   = new WP_Query($args);
                $total_count = $query_obj->found_posts;
                ?>
                <?php if ($query_obj->have_posts()) : ?>
                    <?php
                    $product_counter = 0;
                    ?>
                    <div class="data-line"></div>

                    <div class="data-list">

                        <div class="data-list-title">
                            Shop the pieces
                        </div>

                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $product_counter++;
                            $link          = get_field('link');
                            $image         = get_the_post_thumbnail($post->ID, 'image-size-2');
                            $related_posts = get_post_meta(get_the_ID(), 'related_posts', true);
                            $related_posts = checkPostsStatus($related_posts);
                            $mod_related   = '';

                            if (!empty($related_posts)) {
                                $mod_related = 'mod-related';
                                $related_posts = 'data-related-posts="' .  esc_attr(json_encode($related_posts)) . '"';
                            } else {
                                $related_posts = '';
                            }
                            ?>
                            <div class="data-item <?php echo $mod_related . ' post-' . $post->ID; ?>" <?php echo $related_posts; ?>>
                                <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank" onclick="gtag('event', '<?php echo $link; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($post->ID); ?>' })">
                                    <?php if (!empty($related_posts)) : ?>
                                        <div class="data-item-binding">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/product-bind-ico.svg'; ?>" alt="img">
                                        </div>
                                    <?php endif; ?>

                                    <div class="data-item-a">
                                        <div class="data-item-num">
                                            <?php echo 'N°' . $product_counter; ?>
                                        </div>

                                        <h2 class="data-item-title">
                                            <?php echo get_the_title(); ?>
                                        </h2>
                                    </div>

                                    <div class="data-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>