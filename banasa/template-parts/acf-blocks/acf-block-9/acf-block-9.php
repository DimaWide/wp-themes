<?php

if (display_preview_image($block)) {
    return;
}


$logo = get_field('logo', 'option');
$logo = wp_get_attachment_image_url($logo, 'full');

$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-4');
$text  = get_field('text');
?>
<!-- Acf Block #9 – High degree of specialization -->
<div class="wcl-acf-block-9">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-image">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="data-info">
                    <?php if (!empty($logo)) : ?>
                        <div class="data-logo">
                        <?php echo file_get_contents($logo, false); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($text)) : ?>
                        <div class="data-text">
                            <?php echo $text; ?>
                        </div>
                    <?php endif; ?>

                    <div class="data-img-el">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-9-img.svg'; ?>" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>