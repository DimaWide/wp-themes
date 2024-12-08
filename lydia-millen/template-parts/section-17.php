<?php

$title      = get_sub_field('title');
$subtitle   = get_sub_field('subtitle');
$link = get_sub_field('link');
?>

<div class="wcl-section-4 wcl-section-17">
    <div class="data-container wcl-container">

        <h2 class="data-title">
            <?php if (!empty($title)) : ?>
                <?php echo $title; ?>
            <?php endif; ?>
        </h2>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>

        <?php
        $page_items = 5;

        $args = array(
            'post_type'           => 'cd-product',
            'posts_per_page'      => $page_items,
            'ignore_sticky_posts' => 1,
            'post_status'         => ['publish'],
        );

        $query_obj   = new WP_Query($args);
        $total_count = $query_obj->found_posts;
        ?>
        <div class="data-list swiper">
            <div class="data-list-inner swiper-wrapper">
                <?php if ($query_obj->have_posts()) : ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $image = get_the_post_thumbnail($post->ID, 'image-size-5');
                        $url   = get_field('link');
                        ?>
                        <div class="data-item swiper-slide">
                            <a href="<?php echo $url; ?>" target="_blank" class="data-item-inner" onclick="gtag('event', '<?php echo $url; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($post->ID); ?>' })">
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <?php echo $image; ?>

                                        <div class="wcl-post-view mod-two">
                                            Shop Now
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="data-list-empty wcl-label-empty">
                        Nothing found
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-logo">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-4-logo.png'; ?>" alt="img">
        </div>

        <?php 
            if( $link ) {

                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>

                <div class="data-link">
                    <a href="<?php echo esc_url( $link_url ); ?>" class="wcl-link mod-light" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                </div>

                <?php 
            }
        ?>
        
    </div>
</div>