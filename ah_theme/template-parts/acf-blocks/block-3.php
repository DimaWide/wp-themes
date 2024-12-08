<?php



$group       = get_field('group');
$title       = $group['title'];
$subtitle    = $group['subtitle'];
$button_text = $group['button_text'];
?>
<!-- Acf Block #3 – From the Blog -->
<div class="wcl-acf-block-3">
    <div class="data-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-label">
                    B L O G
                </div>

                <?php if (!empty($title)) : ?>
                    <div class="data-title">
                        <?php echo $title; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($subtitle)) : ?>
                    <div class="data-subtitle">
                        <?php echo $subtitle; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($button_text)) : ?>
                    <?php
                    $blog_page = get_field('blog_page', 'option');
                    ?>
                    <div class="data-button">
                        <a href="<?php echo get_permalink($blog_page); ?>" class="wcl-btn">
                            <?php echo $button_text; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php
                $posts_ids = [];

                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 2,
                    'post_status'    => 'publish',
                    'fields'         => 'ids',
                    'meta_query'     => array(
                        array(
                            'key'     => 'featured_post',
                            'value'   => '1',
                            'compare' => '=',
                        )
                    )
                );

                $query_obj = new WP_Query($args);
                $count_posts = $query_obj->post_count;

                if ($count_posts == 2) {
                    $posts_ids = array_merge($posts_ids, $query_obj->posts);
                } elseif ($count_posts === 1) {
                    $posts_ids = array_merge($posts_ids, $query_obj->posts);

                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 1,
                        'post__not_in'   => $posts_ids,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    );

                    $query_obj = new WP_Query($args);
                    $posts_ids = array_merge($posts_ids, $query_obj->posts);
                } else {
                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 2,
                        'post_status'    => 'publish',
                        'fields'         => 'ids',
                    );

                    $query_obj = new WP_Query($args);
                    $posts_ids = array_merge($posts_ids, $query_obj->posts);
                }


                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 2,
                    'post__in'       => $posts_ids,
                    'post_status'    => 'publish',
                    'meta_key'       => 'featured_post',
                    'orderby'        => array(
                        'meta_value' => 'DESC',
                        'date'       => 'DESC',
                    ),
                    'order'          => 'DESC',
                );

                $query_obj = new WP_Query($args);
                $count_posts = $query_obj->post_count;
                ?>

                <?php if ($query_obj->have_posts()) : ?>
                    <div class="data-list">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $image = get_the_post_thumbnail($post->ID, 'image-size-1');
                            $terms = ordered_categories();
                            ?>
                            <div class="data-item js-post-item <?php echo 'post-' . $post->ID; ?>">
                                <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                    <div class="data-item-col">
                                        <div class="data-item-img">
                                            <?php if (!empty($image)) : ?>
                                                <?php echo $image; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="data-item-col">
                                        <div class="data-item-content">
                                            <?php if (!empty($terms)) : ?>
                                                <div class="data-item-cats js-cats-post">
                                                    <?php foreach ($terms as $term_id => $count) : ?>
                                                        <?php
                                                        $term = get_category($term_id);
                                                        ?>
                                                        <div class="data-item-cats-item">
                                                            <?php echo $term->name; ?>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            $title = get_the_title();

                                            if (strlen($title) > 150) {
                                                $title = mb_strimwidth($title, 0, 150, '...');
                                            }
                                            ?>
                                            <h3 class="data-item-title js-post-item-title">
                                                <?php echo $title; ?>
                                            </h3>

                                            <?php
                                            $excerpt = get_the_excerpt();
                                            ?>
                                            <?php if (!empty($excerpt)) : ?>
                                                <?php
                                                $excerpt = mb_strimwidth($excerpt, 0, 150, '...');
                                                ?>
                                                <div class="data-item-desc js-post-item-desc">
                                                    <?php echo $excerpt; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="data-item-meta">
                                                <div class="data-item-date">
                                                    <?php echo get_the_date('j M Y'); ?>
                                                </div>

                                                <div class="data-item-time-read">
                                                    <?php echo reading_time($post->ID) . ' Read'; ?>
                                                </div>
                                            </div>
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
</div>