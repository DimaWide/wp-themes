<?php


$title           = get_sub_field('title');
$banner          = get_sub_field('banner');
$banner_title    = $banner['title'];
$banner_subtitle = $banner['subtitle'];
$banner_link     = $banner['link'];

$args = array(
    'post_type'      => 'wcl-product',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-section-10">
    <div class="data-container wcl-container">
        <div class="data-c">
            <?php if (!empty($banner_subtitle)) : ?>
                <div class="data-c-subtitle">
                    <?php echo $banner_subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($banner_title)) : ?>
                <h3 class="data-c-title">
                    <?php echo $banner_title; ?>
                </h3>
            <?php endif; ?>
        </div>

        <div class="data-row">
            <div class="data-col">
                <div class="data-a">
                    <?php if ($query_obj->have_posts()) : ?>
                        <div class="data-list swiper">
                            <div class="data-list-inner swiper-wrapper">
                                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                    <?php
                                    $image = get_the_post_thumbnail($post->ID, 'image-size-6');
                                    $link  = get_field('link');
                                    ?>
                                    <div class="data-item swiper-slide">
                                        <a href="<?php echo $link; ?>" class="data-item-inner" target="_blank">
                                            <?php if (!empty($image)) : ?>
                                                <div class="data-item-img">
                                                    <?php echo $image; ?>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php if (!empty($banner)) : ?>
                    <div class="data-b">
                        <div class="data-b-subtitle">
                            <?php echo $banner_subtitle; ?>
                        </div>

                        <h3 class="data-b-title">
                            <?php echo $banner_title; ?>
                        </h3>

                        <?php if (!empty($banner_link)) : ?>
                            <?php
                            $link_url    = $banner_link['url'];
                            $link_title  = $banner_link['title'];
                            $link_target = $banner_link['target'] ?: '_self';
                            ?>
                            <div class="data-b-link">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-c">
            <?php if (!empty($banner_link)) : ?>
                <?php
                $link_url    = $banner_link['url'];
                $link_title  = $banner_link['title'];
                $link_target = $banner_link['target'] ?: '_self';
                ?>
                <div class="data-c-link">
                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>