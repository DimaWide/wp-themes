<?php

$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'image-b');

$right_column = get_sub_field('right_column');
$desc = $right_column['desc'];
$title = $right_column['title'];

?>
<div class="wcl-section-23">
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
                <?php if (!empty($desc)) : ?>
                    <div class="data-desc">
                        <?php echo wpautop($desc); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>