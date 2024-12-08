<?php


$last_posts_id = get_query_var('wcl_last_post');
$second_last_posts_id = get_query_var('wcl_second_last_post');

$args = array(
    'post_type'           => 'post',
    'posts_per_page'      => 1,
    'offset'              => 2,
    'ignore_sticky_posts' => 5,
    'post_status'         => ['publish'],
    'orderby'             => 'date',
);

$query_obj   = new WP_Query($args);
?>
<?php if ($query_obj->have_posts()) : ?>
    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
        <?php
        $sc_1_text = get_the_excerpt();
        $last_posts_id[] = $post->ID;
        set_query_var('wcl_last_post', $last_posts_id);
        ?>
        <div class="wcl-section-3">
            <div class="data-container wcl-container">

                <div class="data-inner">
                    <h2 class="data-title">
                        <?php echo get_the_title(); ?>
                    </h2>

                    <?php if (!empty($sc_1_text)) : ?>
                        <div class="data-desc">
                            <?php echo wpautop($sc_1_text); ?>
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