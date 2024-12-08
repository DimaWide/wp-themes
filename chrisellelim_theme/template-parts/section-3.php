<?php

$image = get_sub_field('background_image');
$image = wp_get_attachment_image_src($image, 'image-c')[0];
$list = get_sub_field('list');
$args = array(
    'post_type'   => 'outfit',
    'post__in'    => $list,
    'orderby'     => 'post__in',
    'post_status' => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$shop_list = get_field('shop', $list[0]);
?>
<div class="wcl-section-3" style="background-image: url(<?php echo $image; ?>);">
    <div class="data-container wcl-container">
        <div class="data-row">
            <?php
            $args = array(
                'post_type' => 'shop',
                'posts_per_page' => 3,
                'post__in'  => $shop_list,
                'orderby' => 'post__in'
            );
            $shops = get_posts($args);
            $data_shop = [];
            ?>
            <div class="data-a">
                <div class="data-a-inner">
                    <h2 class="data-a-title">
                        Outfits
                    </h2>
                    <?php if (!empty($shops)) : ?>
                        <div class="data-a-a wcl-slider">
                            <div class="d3-list-out">
                                <div class="swiper d3-list">
                                    <div class="swiper-wrapper d3-list-inner">
                                        <?php foreach ($shops as $item) : ?>
                                            <?php
                                            $image = get_the_post_thumbnail($item->ID, 'image-f');
                                            $data['title'] = get_the_title($item->ID);
                                            $data['permalink'] = get_the_permalink($item->ID);
                                            if (empty($data_shop)) {
                                                $data_shop[] = $data;
                                            }
                                            ?>
                                            <div class="d3-item swiper-slide" data-title="<?php echo $data['title']; ?>" data-link="<?php echo $data['permalink']; ?>">
                                                <a href="<?php echo $data['permalink']; ?>" class="d3-item-inner">
                                                    <?php if (!empty($image)) : ?>
                                                        <div class="d3-item-img">
                                                            <?php echo $image; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="d3-list-nav">
                                    <div class="d3-list-nav-btn mod-prev">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-3.svg'; ?>" alt="img">
                                    </div>
                                    <div class="d3-list-nav-btn mod-next">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-3.svg'; ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="data-a-info wcl-block-2">
                            <?php if (!empty($data_shop)) : ?>
                                <p>
                                    <?php echo $data_shop[0]['title']; ?>
                                </p>
                                <p>
                                    <span>Khaite</span>
                                    <a href="<?php echo $data_shop[0]['permalink']; ?>">Shop now</a>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-b">
                <h2 class="data-a-title">
                    Outfits
                </h2>

                <?php if ($query_obj->have_posts()) : ?>
                    <?php
                    $count = 0;
                    ?>
                    <div class="data-b-list">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $count++;
                            $thumbnail = get_the_post_thumbnail($post->ID, 'image-e');
                            $shop_list = get_field('shop');
                            if (empty($shop_list)) {
                                $shop_list = [''];
                            }
                            $args = array(
                                'post_type' => 'shop',
                                'post__in'  => $shop_list,
                                'orderby' => 'post__in',
                            );
                            $shops = get_posts($args);
                            $data_shop = [];
                            ?>
                            <?php if (!empty($shops)) : ?>
                                <?php foreach ($shops as $item) : ?>
                                    <?php
                                    $data = [];
                                    $image = get_the_post_thumbnail($item->ID, 'image-f');
                                    $title = get_the_title($item->ID);
                                    $link = get_the_permalink($item->ID);
                                    ob_start();
                                    ?>
                                    <div class="d3-item swiper-slide" data-title="<?php echo $title; ?>" data-link="<?php echo $link; ?>">
                                        <?php if (!empty($image)) : ?>
                                            <div class="d3-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    $data['slide'] = ob_get_clean();
                                    $data_shop[] = $data;
                                    ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="data-b-item  <?php echo $post->ID; ?>" data-shop="<?php echo esc_attr(json_encode($data_shop)); ?>">
                                <div class="data-b-item-inner">
                                    <?php if (!empty($thumbnail)) : ?>
                                        <div class="data-b-item-img">
                                            <?php echo $thumbnail; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="data-b-item-info">
                                        <div class="data-b-item-title">
                                            Shop the <br> look
                                        </div>

                                        <div class="data-b-item-index">
                                            <?php echo '0' . $count; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>