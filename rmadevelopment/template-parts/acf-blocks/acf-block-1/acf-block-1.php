<?php

if (display_preview_image($block)) {
    return;
}

$group_1 = get_field('group_1');
$group_2 = get_field('group_2');
?>
<!-- Acf Block #1 – Who we are -->
<div class="wcl-acf-block-1">
    <div class="data-container wcl-container">
        <div class="line-container mod-1" data-length="250" data-orientation="vertical" data-offset="95" data-scroll-coefficient="0.6" data-type="top">
            <div class="line"></div>
        </div>

        <div class="data-row">
            <div class="data-col">
                <?php if (! empty($group_1)): ?>
                    <div class="data-video">
                        <div class="line-container mod-2" data-length="250" data-orientation="vertical" data-offset="0" data-scroll-coefficient="0.3">
                            <div class="line"></div>
                        </div>

                        <?php
                        $video_id = $group_1['video'];
                        ?>
                        <?php if (!empty($video_id)) : ?>
                            <?php
                            $video_url = wp_get_attachment_url($video_id);
                            ?>
                            <?php if (!empty($video_url)) : ?>
                                <video loop playsinline muted>
                                    <source src="<?php echo $video_url; ?>" type="video/mp4">
                                </video>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="data-info">
                    <?php if (! empty($group_2)): ?>
                        <?php
                        $title       = $group_2['title'];
                        $description = $group_2['description'];
                        $link        = $group_2['link'];
                        ?>
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="data-desc">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                            <?php
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-link">
                                <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>