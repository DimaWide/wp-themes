<?php

$thing_1 = get_sub_field('thing_1');
$image   = get_sub_field('image');
$image_a = wp_get_attachment_image($image, 'image-p');
$thing_2 = get_sub_field('thing_2');
?>
<div class="wcl-section-16">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-a wcl-thing data-col">
                <?php
                $title = get_the_title($thing_1);
                $link  = get_field('link', $thing_1);
                $brand = get_field('brand', $thing_1);
                $brand = !empty($brand) ? $brand : 'Brand';
                $image = get_the_post_thumbnail($thing_1, 'image-i');
                ?>
                <a href="<?php echo $link; ?>" class="d6-inner" target="_blank">
                    <?php if (!empty($image)) : ?>
                        <div class="d6-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <div class="d6-info">
                        <?php if (!empty($title)) : ?>
                            <div class="d6-title">
                                <?php echo $title; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($brand)) : ?>
                            <div class="d6-brand">
                                <?php echo $brand; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>

            <div class="data-b data-col">
                <?php if (!empty($image_a)) : ?>
                    <div class="data-b-img">
                        <?php echo $image_a; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-c wcl-thing data-col">
                <?php
                $title = get_the_title($thing_2);
                $link = get_field('link', $thing_2);
                $brand = get_field('brand', $thing_2);
                $image = get_the_post_thumbnail($thing_2);
                ?>
                <a href="<?php echo $link; ?>" class="d6-inner" target="_blank">
                    <?php if (!empty($image)) : ?>
                        <div class="d6-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <div class="d6-info">
                        <?php if (!empty($title)) : ?>
                            <div class="d6-title">
                                <?php echo $title; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($brand)) : ?>
                            <div class="d6-brand">
                                <?php echo $brand; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>