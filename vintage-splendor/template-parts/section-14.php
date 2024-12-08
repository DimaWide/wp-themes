<?php


$group_1 = get_sub_field('group_1');
$group_2 = get_sub_field('group_2');
?>
<div class="wcl-section-14">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($group_1)) : ?>
                    <?php
                    $type_media = $group_1['type_media'];
                    $type_media = !empty($type_media) ? $type_media : 'image';

                    if ($type_media == 'image') {
                        $image = $group_1['image'];
                        $image = wp_get_attachment_image($image, 'image-size-7');
                    } elseif ($type_media == 'video') {
                        $video         = $group_1['video'];
                        $video         = wp_get_attachment_url($video, 'image-size-7');
                        $video_preview = $group_1['video_preview'];
                        $video_preview = wp_get_attachment_image($video_preview, 'image-size-7');
                    }
                    ?>
                    <?php if ($type_media == 'video') : ?>
                        <div class="data-a mod-video">
                            <?php if (!empty($video_preview && false)) : ?>
                                <div class="data-a-img">
                                    <?php echo $video_preview; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($video)) : ?>
                                <div class="data-a-video">
                                    <video loop playsinline>
                                        <source src="<?php echo $video; ?>" type="video/mp4">
                                    </video>
                                </div>
                            <?php endif; ?>

                            <div class="data-a-play">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/video_play.svg'; ?>" alt="img">
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if (!empty($image)) : ?>
                            <div class="data-a mod-img">
                                <div class="data-a-img">
                                    <?php echo $image; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($group_2)) : ?>
                    <?php
                    $title = $group_2['title'];
                    $desc  = $group_2['desc'];
                    ?>
                    <div class="data-c">
                        <div class="data-c-inner">
                            <div class="data-c-inner-b">
                                <?php if (!empty($title)) : ?>
                                    <h2 class="data-c-title">
                                        <?php echo $title; ?>
                                    </h2>
                                <?php endif; ?>

                                <?php if (!empty($desc)) : ?>
                                    <div class="data-c-desc">
                                        <?php echo wpautop($desc); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>