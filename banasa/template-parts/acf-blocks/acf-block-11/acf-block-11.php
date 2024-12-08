<?php

if (display_preview_image($block)) {
    return;
}

$title   = get_field('title');
$image   = get_field('image');
$image   = wp_get_attachment_image($image, 'image-size-1');
$note    = get_field('note');
$title_2 = get_field('title_2');
$list    = get_field('list');
?>
<!-- Acf Block #11 – The trust of our clients -->
<div class="wcl-acf-block-11">
    <div class="data-b1">
        <div class="data-b1-container wcl-container">
            <div class="data-b1-row">
                <div class="data-b1-col">
                    <?php if (!empty($title)) : ?>
                        <div class="data-title">
                            <?php echo $title; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-b1-col">
                    <div class="data-img-el">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-11-img.svg'; ?>" alt="img">
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($image)) : ?>
            <div class="data-bg-image">
                <?php echo $image; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($note)) : ?>
        <div class="data-note">
            <div class="data-note-inner">
                <?php echo $note; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="data-b2">
        <div class="data-b2-container wcl-container">
            <?php if (!empty($title_2)) : ?>
                <h2 class="data-title-2">
                    <?php echo $title_2; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($list)) : ?>
                <?php
                $list = str_replace('   •   ', '<span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>•<span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>', $list);
                ?>
                <div class="data-list">
                    <?php echo $list; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>