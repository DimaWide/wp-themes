<?php

$text       = get_field('text', 'option');
$bg_image   = get_field('bg_image');
$bg_image   = wp_get_attachment_image($bg_image, 'image-size-16');
$logo       = get_field('logo_second', 'option');
$logo       = wp_get_attachment_image($logo, 'full');
$collection = get_field('collection');
$term       = get_term_by('id', $collection, 'cd-product-collection');
?>
<div class="wcl-acf-block-4 wcl-section-7 wcl-block-clear">
    <div class="data-inner-2">
        <div class="data-container wcl-container">
            <div class="data-inner">
                <?php if (!empty($bg_image)) : ?>
                    <div class="data-img">
                        <?php echo $bg_image; ?>
                    </div>
                <?php endif; ?>

                <div class="data-a">
                    <?php if (!empty($logo)) : ?>
                        <div class="data-logo">
                            <?php echo $logo; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($term)) : ?>
                        <h3 class="data-title">
                            <?php echo $term->name; ?>
                        </h3>
                    <?php endif; ?>

                    <?php if (!empty($text)) : ?>
                        <div class="data-desc">
                            <?php echo wpautop($text); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($term)) : ?>
                        <div class="data-link">
                            <a href="<?php echo get_term_link($collection); ?>" class="wcl-link">
                                Shop The Edit
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>