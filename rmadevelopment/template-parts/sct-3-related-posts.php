<?php



$args = array(
    'post_type'      => get_post_type(),
    'posts_per_page' => 5,
    'post__not_in'   => array(get_the_ID()),
);

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<?php if (! empty($post_count)): ?>
    <!-- sct-3-related-posts -->
    <div class="sct-3-related-posts">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                Related posts
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <?php
                $counter = 0;
                ?>
                <div class="data-list-out">
                    <div class="data-list">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $counter++;
                            $image = get_the_post_thumbnail($post->ID, 'image-size-4');

                            $link = get_permalink();
                            $target = '';

                            if (get_post_type() == 'wcl-news' || get_post_type() == 'project') {
                                $link   = get_field('external_link', $post->ID);
                                $link   = ! empty($link) ?  $link : '#';
                                $target = 'target="_blank"';
                            }
                            ?>
                            <div class="data-item <?php echo 'post-' . $post->ID; ?>">
                                <a href="<?php echo $link; ?>" <?php echo $target; ?> class="data-item-inner">
                                    <div class="data-item-meta">
                                        <div class="data-item-author">
                                            <?php the_author(); ?>
                                        </div>

                                        <div class="data-item-date">
                                            <?php echo get_the_date('j M Y'); ?>
                                        </div>
                                    </div>

                                    <h3 class="data-item-title">
                                        <?php echo get_the_title(); ?>
                                    </h3>

                                    <div class="data-item-link">
                                        <div class="cmp-link">
                                            Learn More
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-2.svg'; ?>" alt="img">
                                        </div>
                                    </div>

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
<?php endif; ?>