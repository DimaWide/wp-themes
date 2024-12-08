<?php


$title    = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$link     = get_sub_field('link');
$banner   = get_sub_field('banner');
$logo     = get_field('logo_private_black', 'option');
$logo     = wp_get_attachment_image_url($logo, 'full');

$args = array(
    'post_type'      => 'wcl-product',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-section-8">
    <div class="data-container wcl-container">
        <div class="data-a">
            <div class="data-a-a">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($subtitle)) : ?>
                    <div class="data-subtitle">
                        <?php echo $subtitle; ?>
                    </div>
                <?php endif; ?>
            </div>

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

        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $brand = get_field('brand');
                        $link  = get_field('link');
                        $image = get_the_post_thumbnail($post->ID, 'image-size-4');
                        ?>
                        <div class="data-item swiper-slide">
                            <div class="data-item-inner">
                                <div class="data-item-a">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="data-item-b">
                                    <div class="data-item-b-col">
                                        <?php if (!empty($brand)) : ?>
                                            <div class="data-item-brand">
                                                <?php echo $brand; ?>
                                            </div>
                                        <?php endif; ?>

                                        <h3 class="data-item-title">
                                            <?php echo get_the_title(); ?>
                                        </h3>
                                    </div>

                                    <div class="data-item-b-col">
                                        <div class="data-item-link">
                                            <a href="<?php echo $link; ?>" class="wcl-link" target="_blank">
                                                Shop now
                                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>


                    <?php if (!empty($banner)) : ?>
                        <?php
                        $banner_image   = $banner['image'];
                        $banner_image   = wp_get_attachment_image($banner_image, 'image-size-5');
                        $banner_title   = $banner['title'];
                        $banner_title_2 = $banner['title_2'];
                        $banner_desc    = $banner['desc'];
                        $banner_link    = $banner['link'];

                        $tag_start    = '<div class="data-item-2-inner">';
                        $tag_end      = '</div>';
                        $access_state = 'mod-not-have-access';

                        if (wcl_is_subscriber()) {
                            $tag_start    = '<a href="' . $banner_link['url'] . '" class="data-item-2-inner">';
                            $tag_end      = '</a>';
                            $access_state = 'mod-have-access';
                        }
                        ?>
                        <div class="data-item data-item-2 <?php echo $access_state; ?> swiper-slide">
                            <?php echo $tag_start; ?>

                            <div class="data-item-2-a">
                                <?php if (!empty($banner_title)) : ?>
                                    <h3 class="data-item-2-title">
                                        <?php echo $banner_title; ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($banner_image)) : ?>
                                    <div class="data-item-2-img">
                                        <?php echo $banner_image; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!wcl_is_subscriber()) : ?>
                                <div class="data-item-2-b">
                                    <div class="data-item-2-b-col">
                                        <?php if (!empty($banner_title_2)) : ?>
                                            <h3 class="data-item-2-title-b">
                                                <?php echo $banner_title_2; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($banner_desc)) : ?>
                                            <div class="data-item-2-desc">
                                                <?php echo $banner_desc; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="data-item-2-b-col">
                                        <?php if (!empty($banner_link)) : ?>
                                            <?php
                                            $link_url    = $banner_link['url'];
                                            $link_title  = $banner_link['title'];
                                            $link_target = $banner_link['target'] ?: '_self';
                                            ?>
                                            <div class="data-item-2-link">
                                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                                    <?php echo $link_title; ?>
                                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($logo)) : ?>
                                        <div class="data-item-2-logo">
                                            <?php echo file_get_contents($logo, false); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php echo $tag_end; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>