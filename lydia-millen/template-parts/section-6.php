<?php


$page_items = 10;

$args = array(
    'post_type'           => 'cd-video',
    'posts_per_page'      => $page_items,
    'ignore_sticky_posts' => 1,
    'post_status'         => ['publish'],
);

$args['meta_query'] = array(
    array(
        'key'     => 'youtube_video',
        'value'   => '',
        'compare' => '!=',
    ),
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<?php if (!empty($total_count)) : ?>
    <div class="wcl-section-6">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                Recent Videos
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <?php
                $videos = get_posts(array(
                    'post_type'   => 'cd-video',
                    'numberposts' => 20,
                    'fields'      => 'ids',
                    'meta_query'  => array(
                        array(
                            'key'     => 'youtube_video',
                            'value'   => '',
                            'compare' => '!=',
                        ),
                    ),
                ));
                ?>
                <div class="data-list-out">
                    <div class="data-list swiper" data-index="<?php echo $page_items; ?>">
                        <div class="data-list-inner swiper-wrapper">
                            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                <?php
                                $tagline = get_field('tagline');
                                $iframe  = get_field('youtube_video');

                                preg_match('/youtu.be\/([\s\S]+)/i', (string) $iframe, $matches);

                                if (!empty($iframe) && ! empty($matches[1])) {
                                    $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $matches[1] .
                                        '?autoplay=0&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                }

                                preg_match('/\/embed\/([a-zA-Z0-9_-]+)/', $iframe, $matches);
                                $videoId = $matches[1];

                                $image       = get_the_post_thumbnail($post->ID, 'image-size-7');
                                $index_video = array_search(get_the_ID(), $videos);
                                $page_num    = ceil(($index_video + 1) / 9);
                                if ($page_num > 1) {
                                    $page_num = '/page/' . $page_num;
                                } else {
                                    $page_num = '';
                                }
                                ?>
                                <div class="data-item swiper-slide post-<?php echo $post->ID; ?>">
                                    <a href="<?php echo site_url('/') . 'video' . $page_num  . '#video-' . get_the_ID(); ?>" class="data-item-inner" onclick="gtag('event', 'https://youtu.be/<?php echo $videoId; ?>', {'event_category': 'Video','event_label': '<?php echo get_the_title(); ?>' })">
                                        <div class="data-item-view">
                                            <?php if (!empty($image)) : ?>
                                                <div class="data-item-img">
                                                    <?php echo $image; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="data-item-play">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-play.svg'; ?>" alt="img">
                                            </div>
                                        </div>

                                        <div class="data-item-info">
                                            <h3 class="data-item-title">
                                                <?php echo get_the_title(); ?>
                                            </h3>

                                            <?php if (!empty($tagline)) : ?>
                                                <div class="data-item-subtitle">
                                                    <?php echo $tagline; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                            <span>Prev</span>
                        </div>

                        <div class="data-list-nav-btn mod-next">
                            <span>Next</span>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>