<?php


$col_1 = get_sub_field('col_1');
$col_2 = get_sub_field('col_2');
$image = $col_1['image'];
$image = wp_get_attachment_image($image, 'image-h');
$title = $col_2['title'];
$list  = $col_2['list'];

$args = array(
    'post_type'   => 'shop',
    'post__in'    => $list,
    'orderby'     => 'post__in',
    'post_status' => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-section-5">
    <div class="data-container">
        <div class="data-row">
            <div class="data-a">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-b">
                <div class="data-head">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-2.svg'; ?>" alt="img">
                        </div>

                        <div class="data-list-nav-btn mod-next">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-2.svg'; ?>" alt="img">
                        </div>
                    </div>
                </div>

                <?php if ($query_obj->have_posts()) : ?>
                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                <?php
                                $image = get_the_post_thumbnail($post->ID, 'image-i');
                                $brand = get_field('brand');
                                $brand = !empty($brand) ? $brand : 'Brand';
                                $link  = get_field('link');
                                ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="data-item-info">
                                            <div class="data-item-title">
                                                <?php echo get_the_title(); ?>
                                            </div>

                                            <?php if (!empty($brand)) : ?>
                                                <div class="data-item-brand">
                                                    <?php echo $brand; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>