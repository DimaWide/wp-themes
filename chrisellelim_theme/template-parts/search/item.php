<?php


$image = get_the_post_thumbnail($post->ID, 'image-n');
$post_type = get_post_type($post->ID);
?>
<?php if ($post_type == 'video') : ?>
    <?php
    $youtube_link = get_field('youtube_link');
    $iframe       = '';
    if (!empty($youtube_link)) {
        parse_str(parse_url($youtube_link, PHP_URL_QUERY), $my_array_of_vars);
        $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] .
            '?autoplay=1&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
    ?>
    <div class="data-item <?php echo 'post-' . $post->ID; ?>">
        <a href="<?php echo $youtube_link; ?>" class="data-item-inner" target="_blank">
            <div class="data-item-a">
                <?php if (!empty($image)) : ?>
                    <div class="data-item-a-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($iframe)) : ?>
                    <div class="data-item-a-iframe" data-video="<?php echo esc_attr($iframe); ?>"></div>
                <?php endif; ?>

                <div class="data-item-a-play">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                </div>
            </div>

            <h2 class="data-item-title">
                <?php echo get_the_title($post->ID); ?>
            </h2>
        </a>
    </div>
<?php else : ?>
    <div class="data-item <?php echo 'post-' . $post->ID; ?>">
        <a href="<?php echo get_permalink($post->ID); ?>" class="data-item-inner">
            <div class="data-item-img">
                <?php if (!empty($image)) : ?>
                    <?php echo $image; ?>
                <?php endif; ?>
            </div>

            <h2 class="data-item-title">
                <?php echo get_the_title($post->ID); ?>
            </h2>
        </a>
    </div>
<?php endif; ?>