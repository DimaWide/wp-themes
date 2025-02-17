<?php

$group = get_field('group');
$title = $group['title'];
$text  = $group['text'];

$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-1');
?>
<!-- Acf Block #4 – Why Funnels -->
<div class="wcl-acf-block-4" id="why-funnels">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($text)) : ?>
                    <div class="data-text">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>