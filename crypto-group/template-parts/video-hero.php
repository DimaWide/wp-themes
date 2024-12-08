<?php


$image     = get_the_post_thumbnail($post->ID, 'full');
$video_url = get_field('video_url');

if (!empty($video_url)) {
    // Разделение URL на базовую часть и имя файла
    $parsed_url = parse_url($video_url);
    $path_parts = pathinfo($parsed_url['path']);
    $cloudinary_base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $path_parts['dirname'] . '/';
    $filename = $path_parts['basename'];

    $current_user = wp_get_current_user();
    $user_email = $current_user->user_email;

    if ($user_email) {
        // Формируем динамический URL
        $cloudinary_url = $cloudinary_base_url;
        $cloudinary_url .= "co_rgb:fff,";
        $cloudinary_url .= "l_text:open%20sans_125_bold_normal_left:" . urlencode($user_email) . ",";
        $cloudinary_url .= "o_30,"; // Set opacity to 50 (adjust as needed)
        $cloudinary_url .= "g_south_east,"; // Position at bottom right
        $cloudinary_url .= "fl_layer_apply,x_70,y_70/"; // Optional offsets from the bottom right corner
        $cloudinary_url .= $filename;
        // Выводим или используем сформированный URL
        $video_url = $cloudinary_url;
    }
}
?>
<div class="wcl-video-hero">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($video_url)) : ?>
                    <div class="data-video mod-pause ">
                        <div class="data-video-preview">
                            <?php if (!empty($image)) : ?>
                                <?php echo $image; ?>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($video_url)) : ?>
                            <video loop playsinline>
                                <source src="<?php echo $video_url; ?>" type="video/mp4">
                            </video>

                            <div class="data-video-play-btn">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-btn-video-3.svg'; ?>" alt="img">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (have_rows('video_timecode')) : ?>
                    <div class="data-timecodes">
                        <?php while (have_rows('video_timecode')) : the_row(); ?>
                            <?php
                            $time  = get_sub_field('time');
                            $title = get_sub_field('title');
                            ?>
                            <div class="data-timecodes-item" data-timecode="<?php echo $time; ?>">
                                <?php if (!empty($time)) : ?>
                                    <div class="data-timecodes-item-time">
                                        <?php echo $time; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($title)) : ?>
                                    <div class="data-timecodes-item-title">
                                        <?php echo $title; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>