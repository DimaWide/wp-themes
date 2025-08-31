<?php

$group       = get_field('group');
$description = $group['description'];
$link        = $group['link'];

$image = get_field('image');
$image = wp_get_attachment_image($image, 'full');
?>
<!-- acf-7-about -->
<div class="acf-7-about">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-inner">
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
                            <a href="<?php echo $link_url; ?>" class="cmp-button mod-red" target="<?php echo $link_target; ?>">
                                <?php echo $link_title; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <div class="data-inner">
                    <?php if (!empty($image)) : ?>
                        <div class="data-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>