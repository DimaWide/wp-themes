<?php


$title = get_sub_field('title');
$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'image-t');
$note  = get_sub_field('note');
?>
<div class="wcl-section-22">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h1 class="data-title">
                <?php echo $title; ?>
            </h1>
        <?php endif; ?>

        <?php if (!empty($image)) : ?>
            <div class="data-img">
                <?php echo $image; ?>
                
                <?php if (!empty($note)) : ?>
                    <div class="data-note">
                        <?php echo wpautop($note); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>