<?php



$title       = get_field('title');
$subtitle    = get_field('subtitle');
$products    = get_field('list');
$logo        = get_field('logo_private_black', 'option');
$logo        = wp_get_attachment_image_url($logo, 'full');
$style       = get_field('style');
$style_class = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style_class;

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
<!-- wcl-acf-block-3 - Latest Favorites -->
<div class="wcl-acf-block-3 wcl-section-8 <?php echo $style_class; ?>">
    <div class="data-container">
        <?php if (!empty($title) || !empty($subtitle)) : ?>
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
            </div>
        <?php endif; ?>

        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        global $post;
                        $brand = get_field('brand', $post->ID);
                        $link  = get_field('link', $post->ID);
                        $image = get_the_post_thumbnail($post->ID, 'image-size-4');
                        ?>
                        <div class="data-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
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
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>