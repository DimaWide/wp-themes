<?php


$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
);

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<!-- cmp-6-sidebar -->
<div class="cmp-6-sidebar data-sidebar">
    <div class="cmp6-inner">
        <div class="cmp6-widget">
            <h2 class="cmp6-title">
                Popular
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <div class="cmp6-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $image  = get_the_post_thumbnail($post->ID, 'image-size-6');
                        $author = get_the_author_meta('display_name', $post_id);
                        $date   = get_the_date('F j, Y', $post_id);
                        ?>
                        <div class="cmp6-item <?php echo 'post-' . $post->ID; ?>">
                            <a href="<?php echo get_permalink(); ?>" class="cmp6-item-inner">
                                <div class="cmp6-item-img">
                                    <?php if (!empty($image)) : ?>
                                        <?php echo $image; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="cmp6-item-info">
                                    <h3 class="cmp6-item-title">
                                        <?php echo get_the_title(); ?>
                                    </h3>

                                    <div class="cmp6-item-meta">
                                        <?php echo 'By ' . esc_html($author) . ' | ' . esc_html($date); ?>
                                    </div>
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