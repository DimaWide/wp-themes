<?php

$video_id = get_field('video');
?>
<?php if (!empty($video_id)) : ?>
    <?php
    $preview_thumbnail = get_field('preview_thumbnail');
    $preview_thumbnail = wp_get_attachment_image_url($preview_thumbnail);

    $attachment_metadata = wp_get_attachment_metadata($video_id);

    $video_title         = get_the_title($video_id);
    $video_thumbnail_url = get_the_post_thumbnail_url($video_id);
    $upload_timestamp    = filemtime(get_attached_file($video_id));
    $upload_date         = date('Y-m-d H:i:s', $upload_timestamp);
    ?>
    <!-- Acf Block #10 – Video -->
    <div class="wcl-acf-block-10" itemscope itemtype="https://schema.org/VideoObject">
        <?php if (!empty($video_title)) : ?>
            <meta itemprop="headline" content="<?php echo $video_title; ?>">
        <?php endif; ?>

        <?php if (!empty($preview_thumbnail)) : ?>
            <meta itemprop="thumbnailUrl" content="<?php echo $preview_thumbnail; ?>">
        <?php endif; ?>

        <?php if (!empty($upload_date)) : ?>
            <meta itemprop="uploadDate" content="<?php echo $upload_date; ?>">
        <?php endif; ?>

        <div class="data-container wcl-container">
            <div class="data-video mod-pause">
                <?php
                $video = wp_get_attachment_url($video_id);
                ?>
                <video playsinline>
                    <source src="<?php echo $video; ?>" type="video/mp4" itemprop="contentUrl">
                </video>

                <div class="data-video-play-btn">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-video.svg'; ?>" alt="img">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>