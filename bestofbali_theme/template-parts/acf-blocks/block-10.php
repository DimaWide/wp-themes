<?php

$shortcode_1 = get_field('shortcode_1');

$shortcode_2 = get_field('shortcode_2');

$class_value = '';
$shortcode_mobile_switch = get_field('shortcode_mobile_switch');

if (!empty($shortcode_mobile_switch)) {
    $class_value = 'mod-shortcode-mobile';
}
?>
<!-- Acf Block #10 – Ads Shortcode -->
<?php if (!empty($shortcode_1) || !empty($shortcode_2)) : ?>
    <div class="wcl-acf-block-10 <?php echo $class_value; ?>">
        <div class="data-container wcl-container">
            <?php if (!empty($shortcode_1)) : ?>
                <div class="data-item">
                    <?php echo do_shortcode($shortcode_1) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($shortcode_mobile_switch) && !empty($shortcode_2)) : ?>
                <div class="data-item data-item-2">
                    <?php echo do_shortcode($shortcode_2) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>