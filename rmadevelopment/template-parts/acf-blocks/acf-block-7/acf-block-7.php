<?php

if (display_preview_image($block)) {
    return;
}

$group_1 = get_field('group_1');
$group_2 = get_field('group_2');

$type_media  = $group_2['type_media'];
$type_media  = !empty($type_media) ? $type_media : 'image';
$header_type = $group_1['header_type'];

$header_type = !empty($header_type) ? $header_type : 'h2';

$style = get_field('style');
$style = !empty($style) ? $style : 'image-right';
$style = 'mod-' . $style;

$style_1 = 'active';

$style_line   = isset($block['className']) ? $block['className'] : '';
$style_line   = !empty($style_line) ? $style_line : '';
$style_line_1 = 'active';

if (strpos($style_line, 'mod-line-1') !== false || strpos($style_line, 'mod-line-2') !== false) {
    $style_line_1 = 'active';
}
?>
<!-- Acf Block #7 – Development -->
<div class="wcl-acf-block-7 <?php echo $style . ' ' . $style_line; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-info">
                    <?php if (! empty($group_1)): ?>
                        <?php
                        $title       = $group_1['title'];
                        $description = $group_1['description'];
                        $link        = $group_1['link'];
                        ?>
                        <?php if (!empty($title)) : ?>
                            <?php if ($header_type == 'h1'): ?>
                                <h1 class="data-title">
                                    <?php echo $title; ?>
                                </h1>
                            <?php else: ?>
                                <h2 class="data-title">
                                    <?php echo $title; ?>
                                </h2>
                            <?php endif; ?>
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

            <div class="data-col">
                <?php if ($style == 'mod-long-photo'): ?>
                    <div class="line-container mod-long-photo-1" data-length="250" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                <?php endif; ?>

                <?php if (wcl_is_page('the_company')): ?>
                    <div class="line-container mod-the_company-1" data-length="250" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container mod-the_company-2" data-length="357" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                <?php endif; ?>

                <?php if ($style_line == 'mod-line-1'): ?>
                    <div class="line-container mod-1" data-length="250" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                <?php endif; ?>

                <?php if (! empty($group_2)): ?>
                    <?php if ($style_line_1): ?>
                        <div class="data-lines">
                            <div class="line-container" data-length="194" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.2">
                                <div class="line"></div>
                            </div>

                            <div class="line-container" data-length="304" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                                <div class="line"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($type_media == 'image'): ?>
                        <?php
                        if ($style == 'mod-long-photo' && $type_media == 'image') {
                            $image = wp_get_attachment_image($group_2['image'], 'image-size-5');
                        }

                        $image = wp_get_attachment_image($group_2['image'], 'image-size-8');
                        ?>
                        <?php if (! empty($image)): ?>
                            <div class="data-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($type_media == 'video'): ?>
                        <?php
                        $video_id = $group_2['video'];
                        ?>
                        <?php if (!empty($video_id)) : ?>
                            <div class="data-img data-video">
                                <?php
                                $video_url = wp_get_attachment_url($video_id);
                                ?>
                                <?php if (!empty($video_url)) : ?>
                                    <video loop playsinline muted>
                                        <source src="<?php echo $video_url; ?>" type="video/mp4">
                                    </video>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>