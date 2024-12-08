<?php

$link_all_posts = get_sub_field('link_all_posts');

$args = array(
    'post_type'           => 'post',
    'posts_per_page'      => 1,
    'ignore_sticky_posts' => 5,
    'post_status'         => ['publish'],
    'orderby'             => 'date'
);

$query_obj   = new WP_Query($args);
?>
<?php if ($query_obj->have_posts()) : ?>
    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
        <?php
        $image   = get_the_post_thumbnail($post->ID, 'image-size-1');
        $excerpt = get_the_excerpt();

        set_query_var('wcl_last_post', [$post->ID]);
        ?>
        <div class="wcl-section-1">
            <div class="data-container wcl-container">
                <div class="data-note">
                    <div class="data-note-item data-note-a">
                        Featured post
                    </div>

                    <div class="data-note-item data-note-b">
                        <?php if (!empty($link_all_posts)) : ?>
                            <?php
                            $link_url    = $link_all_posts['url'];
                            $link_title  = $link_all_posts['title'];
                            $link_target = $link_all_posts['target'] ?: '_self';
                            ?>
                            <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                                <?php echo $link_title; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="data-info">
                    
                    <!-- <div class="data-subtitle">
                        <?php // echo 'Opening chapter nine'; ?>
                    </div> -->

                    <h2 class="data-title">
                        <a href="<?php echo get_permalink(); ?>">
                            <?php echo strtolower(get_the_title()); ?>
                        </a>
                    </h2>

                    <?php if (!empty($excerpt)) : ?>
                        <div class="data-desc">
                            <?php echo wpautop($excerpt); ?>
                        </div>
                    <?php endif; ?>

                    <div class="data-link">
                        <a href="<?php echo get_permalink(); ?>" class="wcl-link">
                            Read On
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata(); ?>
<?php endif; ?>