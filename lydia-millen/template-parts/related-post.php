<?php

$category = get_the_category();
$page_items = 3;

$args = array(
    'post_type'           => 'post',
    'posts_per_page'      => $page_items,
    'post__not_in'        => [get_the_ID()],
    'ignore_sticky_posts' => 1,
    'post_status'         => ['publish'],
);

if (!empty($category)) {
    $tax_query = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'id',
            'terms'    => $category[0]->term_id,
        )
    );
    $args['tax_query'] = $tax_query;
}

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-related-post">
    <h2 class="data-title">
        Related posts
    </h2>

    <div class="data-a">
        <div class="data-container wcl-container">
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php if ($query_obj->have_posts()) : ?>
                        <?php
                        $count = 0;
                        ?>
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $count++;
                            $image  = get_the_post_thumbnail($post->ID, 'image-size-11');
                            $active = '';

                            if ($count == 1) {
                                $active = 'active';
                            }
                            ?>
                            <div class="data-item swiper-slide <?php echo $active; ?>">
                                <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="data-item-a">
                                        <h3 class="data-item-title">
                                            <?php echo get_the_title(); ?>
                                        </h3>

                                        <div class="data-item-desc">
                                            <?php //echo get_the_excerpt(); 
                                            ?>
                                            <p>So I'm a little premature this year but with the 8th Birthday of my blog…</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>