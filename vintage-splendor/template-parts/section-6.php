<?php


$logo        = get_field('logo', 'option');
$logo        = wp_get_attachment_image($logo, 'full');
$shortcode   = get_sub_field('form_shortcode');
$title       = get_sub_field('title');
$style       = get_sub_field('style');
$style       = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style;
?>
<div class="wcl-section-6 <?php echo $style_class; ?>">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-inner-b">
                <div class="data-row">
                    <div class="data-col">
                        <?php if (!empty($logo) && $style == 'default') : ?>
                            <div class="data-logo">
                                <?php echo $logo; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-col">
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>
                    </div>

                    <div class="data-col">
                        <?php if (!empty($shortcode)) : ?>
                            <div class="data-form">
                                <?php echo do_shortcode($shortcode); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>