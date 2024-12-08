<?php


$products       = get_field('list');
$group          = get_field('group');
$group_title    = $group['title'];
$group_subtitle = $group['subtitle'];
$group_link     = $group['link'];

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
<!-- wcl-acf-block-4 - Annette\'s picks -->
<div class="wcl-acf-block-4 wcl-section-10">
    <div class="data-container">
        <div class="data-c">
            <?php if (!empty($group_title)) : ?>
                <h3 class="data-c-title">
                    <?php echo $group_title; ?>
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
                                    $link  = get_field('link', $post->ID);
                                    $image = get_the_post_thumbnail($post->ID, 'image-size-6');
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
                <?php if (!empty($group)) : ?>
                    <div class="data-b">
                        <div class="data-b-subtitle">
                            <?php echo $group_subtitle; ?>
                        </div>

                        <h3 class="data-b-title">
                            <?php echo $group_title; ?>
                        </h3>

                        <?php if (!empty($group_link)) : ?>
                            <?php
                            $link_url    = $group_link['url'];
                            $link_title  = $group_link['title'];
                            $link_target = $group_link['target'] ?: '_self';
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
    </div>
</div>