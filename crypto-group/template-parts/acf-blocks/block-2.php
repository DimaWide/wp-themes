<?php

$title    = get_field('title');
$video_id = get_field('video');

?>
<?php if (!empty($video_id)) : ?>
    <?php
    $video = wp_get_attachment_url($video_id);
    ?>
    <!-- Acf Block #2 – Video -->
    <div class="wcl-acf-block-2" id="video">
        <div class="data-container wcl-container">
            <div class="data-block">
                <i class="fa-fw far fa-play-circle"></i>

                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <div class="data-title mod-mobile">
                        Žemiau esančiame vaizdo įraše sužinokite, kaip tai padaryti
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($video)) : ?>
                <div class="data-video mod-pause">
                    <video playsinline preload="metadata">
                        <source src="<?php echo $video . '#t=0.1'; ?>" type="video/mp4">
                    </video>

                    <div class="data-video-play-btn">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-btn-video.svg'; ?>" alt="img">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>