<?php


$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'full');
$style       = get_field('style');
$style_class = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style_class;
?>
<!-- wcl-acf-block-5 - Image -->
<?php if (!empty($image)) : ?>
    <div class="wcl-acf-block-5 <?php echo $style_class; ?>">
        <div class="data-container">
            <div class="data-img">
                <?php echo $image; ?>
            </div>
        </div>
    </div>
<?php endif; ?>