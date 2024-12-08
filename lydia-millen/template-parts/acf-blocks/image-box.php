<?php

$title              = get_field('title');
$copy               = get_field('copy');
$image              = get_field('image');
$image              = wp_get_attachment_image($image, 'image-size-9');
$align              = 'mod-image-right';
$type_content_class = 'mod-plain_text';
$corner_type_class  = 'mod-corner-default';
?>
<div class="wcl-acf-block-2 wcl-block-clear <?php echo $align . ' ' . $corner_type_class . ' ' . $type_content_class; ?>">
    <div class="data-inner-2">
        <div class="data-container wcl-container">
            <div class="data-inner">
                <div class="data-img">
                    <?php if (!empty($image)) : ?>
                        <?php echo $image; ?>
                    <?php endif; ?>
                </div>

                <div class="data-a">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($copy)) : ?>
                        <div class="data-text">
                            <?php echo $copy; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>