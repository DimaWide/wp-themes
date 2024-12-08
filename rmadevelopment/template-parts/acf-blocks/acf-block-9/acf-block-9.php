<?php

if (display_preview_image($block)) {
    return;
}

$title = get_field('title');
?>
<!-- Acf Block #9 – Our skills -->
<div class="wcl-acf-block-9">
    <div class="data-container wcl-container">
        <div class="data-lines">
            <div class="line-container" data-length="439" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                <div class="line"></div>
            </div>
        </div>

        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list-out">
                <div class="data-list">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $image = get_sub_field('image');
                        $image = wp_get_attachment_image($image, 'image-size-3');
                        $title = get_sub_field('title');
                        $link  = get_sub_field('link');

                        $link_url = isset($link['url']) ? $link['url'] : '#';
                        ?>
                        <div class="data-item">
                            <a href="<?php echo $link_url; ?>" class="data-item-inner">
                                <div class="data-item-img">
                                    <?php if (!empty($image)) : ?>
                                        <?php echo $image; ?>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($title)) : ?>
                                    <h3 class="data-item-title">
                                        <?php echo $title; ?>
                                    </h3>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>