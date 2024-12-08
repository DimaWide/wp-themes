<?php

$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'image-size-2');
$group = get_sub_field('group');
$title = $group['title'];
$desc  = $group['desc'];
$link  = $group['link'];
?>
<div class="wcl-section-5">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="data-a">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-a-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <div class="data-a-inner">
                        <?php if (!empty($desc)) : ?>
                            <div class="data-a-desc">
                                <?php echo $desc; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                            <?php
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-a-link">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>