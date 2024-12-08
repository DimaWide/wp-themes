<?php

if (display_preview_image($block)) {
    return;
}

$group = get_field('group_2');
?>
<!-- Acf Block #5 – Projects Listing Page Hero -->
<div class="wcl-acf-block-5 mod-section-animate">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-info">
                    <?php if (!empty($group)) : ?>
                        <?php
                        $title       = $group['title'];
                        $description = $group['description'];
                        ?>
                        <?php if (!empty($title)) : ?>
                            <h1 class="data-title">
                                <?php echo $title; ?>
                            </h1>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="data-desc">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php if (have_rows('group_1')) : ?>
                    <div class="data-video mod-pause">
                        <?php while (have_rows('group_1')) : the_row(); ?>
                            <?php
                            $video_id = get_sub_field('video');
                            ?>
                            <?php if (!empty($video_id)) : ?>
                                <?php
                                $video_url = wp_get_attachment_url($video_id);
                                ?>
                                <?php if (!empty($video_url)) : ?>
                                    <video loop playsinline>
                                        <source src="<?php echo $video_url; ?>" type="video/mp4">
                                    </video>

                                    <div class="data-video-play-btn">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-btn.svg'; ?>" alt="img">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>