<?php


$args = array(
    'post_type'      => 'wcl-news',
    'posts_per_page' => 5,
);

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<!-- cmp-3-sidebar -->
<div class="cmp-3-sidebar">
    <div class="cmp3-inner">
        <div class="cmp3-widget">
            <h2 class="cmp3-title">
                Recent News
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <div class="cmp3-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $image = get_the_post_thumbnail($post->ID, 'image-size-6');
                        ?>
                        <div class="cmp3-item <?php echo 'post-' . $post->ID; ?>">
                            <a href="<?php echo get_permalink(); ?>" class="cmp3-item-inner">
                                <?php if (!empty($image)) : ?>
                                    <div class="cmp3-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="cmp3-item-info">
                                    <div class="cmp3-item-date">
                                        Monday, November 5, 2018 | 9:37pm
                                    </div>

                                    <h3 class="cmp3-item-title">
                                        <?php echo get_the_title(); ?>
                                    </h3>
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