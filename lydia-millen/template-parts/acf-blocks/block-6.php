<?php

$title = get_field('title');
$copy  = get_field('copy');
$image = get_field('image_1');
$image = wp_get_attachment_image($image, 'image-size-2');
$link  = get_field('cta');
?>
<div class="wcl-acf-block-6 wcl-block-clear">
    <div class="data-inner-2">
        <div class="data-container wcl-container">
            <div class="data-row">
                <div class="data-col data-a">
                    <?php if (!empty($copy)) : ?>
                        <div class="data-text">
                            <?php echo wpautop($copy); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-col data-b">
                    <div class="data-inner">
                        <?php if (!empty($image)) : ?>
                            <div class="data-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($title)) : ?>
                            <h3 class="data-title">
                                <?php echo $title; ?>
                            </h3>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                            <?php
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-link">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>