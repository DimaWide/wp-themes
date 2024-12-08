<?php

$col_1         = get_sub_field('col_1');
$col_2         = get_sub_field('col_2');
$title         = $col_2['title'];
$subtitle      = $col_2['subtitle'];
$video_image   = $col_1['video_image'];
$video_image   = wp_get_attachment_image($video_image, 'image-b');
$link          = $col_2['link'];
$product_image = $col_2['product_image'];
$product_image = wp_get_attachment_image($product_image);
$bg_image      = $col_1['background_image'];
$bg_image      = wp_get_attachment_image_src($bg_image, 'image-c');
$youtube_link  = $col_1['youtube_link'];
$iframe       = '';
if (!empty($youtube_link)) {
    parse_str(parse_url($youtube_link, PHP_URL_QUERY), $my_array_of_vars);
    $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] .
        '?autoplay=1&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
?>
<div class="wcl-section-1" style="background-image: url(<?php echo $bg_image[0]; ?>);">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-a">
                <div class="data-a-view">
                    <div class="data-a-view-inner">
                        <div class="data-a-view-note">
                            Latest launch
                        </div>

                        <?php if (!empty($video_image)) : ?>
                            <div class="data-a-view-img">
                                <?php echo $video_image; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($iframe)) : ?>
                            <div class="data-a-view-iframe" data-video="<?php echo htmlspecialchars($iframe); ?>"></div>
                        <?php endif; ?>

                        <div class="data-a-view-play">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-b">
                <?php if (!empty($subtitle)) : ?>
                    <div class="data-b-subhead">
                        <?php echo wpautop($subtitle); ?>
                    </div>
                <?php endif; ?>

                <h2 class="data-b-title">
                    <?php if (!empty($title)) : ?>
                        <?php echo wpautop($title); ?>
                    <?php endif; ?>

                    <?php if (!empty($product_image)) : ?>
                        <div class="data-b-img">
                            <?php echo $product_image; ?>
                        </div>
                    <?php endif; ?>
                </h2>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>" class="data-b-link wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-el">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/section-1-img.svg'; ?>" alt="img">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/section-1-img.svg'; ?>" alt="img">
        </div>
    </div>
</div>