<?php

$description = get_field('description');

$image = get_the_post_thumbnail($post->ID, 'image-size-1');

$post_date      = get_the_date('Y-m-d H:i:s');
$formatted_date = date_i18n('l, F j, Y | g:ia', strtotime($post_date));

$image_empty = '';

if (empty($image)) {
    $image_empty = 'mod-empty';
}
?>
<!-- sct-1-hero -->
<div class="sct-1-hero <?php echo $image_empty; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-info">
                    <?php if (! empty($formatted_date)): ?>
                        <div class="data-date">
                            <?php echo $formatted_date; ?>
                        </div>
                    <?php endif; ?>

                    <h2 class="data-title">
                        <?php echo get_the_title(); ?>
                    </h2>

                    <?php if (!empty($description)) : ?>
                        <div class="data-desc">
                            <?php echo $description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <div class="line-container mod-1" data-length="250" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                    <div class="line"></div>
                </div>

                <div class="data-img">
                    <?php if (!empty($image)) : ?>
                        <?php echo $image; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>