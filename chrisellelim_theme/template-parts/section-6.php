<?php

$title = get_sub_field('title');
$note  = get_sub_field('note');
$list  = get_sub_field('list');
$args = array(
    'post_type'   => 'video',
    'post__in'    => $list,
    'orderby'     => 'post__in',
    'post_status' => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$count = 0;
?>
<div class="wcl-section-6">
    <div class="data-container wcl-container">
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $count++;
                        $image        = get_the_post_thumbnail($post->ID, 'image-j');
                        $type = get_field('type');
                        $type = !empty($type) ? $type : 'youtube';
                        $youtube_link = get_field('youtube_link');
                        $iframe       = '';

                        if ($type == 'youtube') {
                            if (!empty($youtube_link)) {
                                parse_str(parse_url($youtube_link, PHP_URL_QUERY), $my_array_of_vars);
                                $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] .
                                    '?autoplay=1&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                            }
                        }
                        ?>
                        <?php if ($count == 1) : ?>
                            <?php if ($type == 'youtube') : ?>
                                <div class="data-item swiper-slide">
                                    <div class="data-icon">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/section-6-icon.png'; ?>" alt="img">
                                    </div>
                                    
                                    <div class="data-item-inner">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($iframe)) : ?>
                                            <div class="data-item-iframe" data-video="<?php echo htmlspecialchars($iframe); ?>"></div>
                                        <?php endif; ?>

                                        <div class="data-item-play">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-item-note">
                                            Watch the video
                                        </div>

                                        <div class="data-item-a">
                                            <?php if (!empty($title)) : ?>
                                                <h2 class="data-item-a-title">
                                                    <?php echo $title; ?>
                                                </h2>
                                            <?php endif; ?>

                                            <?php if (!empty($note)) : ?>
                                                <div class="data-item-a-note">
                                                    <span>Recent</span>
                                                    <span> <?php echo $note; ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo $youtube_link; ?>" class="data-item-inner" target="_blank">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="data-item-play">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-item-note">
                                            Watch the video
                                        </div>

                                        <div class="data-item-a">
                                            <?php if (!empty($title)) : ?>
                                                <h2 class="data-item-a-title">
                                                    <?php echo $title; ?>
                                                </h2>
                                            <?php endif; ?>

                                            <?php if (!empty($note)) : ?>
                                                <div class="data-item-a-note">
                                                    <span>Recent</span>
                                                    <span> <?php echo $note; ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if ($type == 'youtube') : ?>
                                <div class="data-item swiper-slide">
                                    <div class="data-item-inner">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($iframe)) : ?>
                                            <div class="data-item-iframe" data-video="<?php echo htmlspecialchars($iframe); ?>"></div>
                                        <?php endif; ?>

                                        <div class="data-item-play">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-item-note">
                                            Watch the video
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo $youtube_link; ?>" class="data-item-inner" target="_blank">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="data-item-play">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-item-note">
                                            Watch the video
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>

            <div class="data-a">
                <div class="data-a-title">
                    Recent
                </div>

                <?php if (!empty($note)) : ?>
                    <div class="data-a-desc">
                        <?php echo $note; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>