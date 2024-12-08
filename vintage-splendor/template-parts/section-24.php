<?php

$group     = get_sub_field('group');
$title     = $group['title'];
$subtitle  = $group['subtitle'];
?>
<div class="wcl-section-24">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-a">
                    <?php if (!empty($subtitle)) : ?>
                        <div class="data-subtitle">
                            <?php echo $subtitle; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php if (have_rows('list')) : ?>
                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php while (have_rows('list')) : the_row(); ?>
                                <?php
                                $image = get_sub_field('image');
                                $image = wp_get_attachment_image($image, 'full');
                                $title = get_sub_field('title');
                                $link  = get_sub_field('link');
                                $shortcode = get_sub_field('shortcode');
                                ?>
                                <div class="data-item swiper-slide">
                                    <?php
                                    echo do_shortcode($shortcode);
                                    ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>