<?php

$title = get_field('title');
?>
<!-- Acf Block #9 – Brands -->
<div class="wcl-acf-block-9" id="brands">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $image = get_sub_field('image');
                    $image = wp_get_attachment_image($image, 'image-size-1');
                    ?>
                    <?php if (!empty($image)) : ?>
                        <div class="data-item">
                            <div class="data-item-img">
                                <?php echo $image; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>