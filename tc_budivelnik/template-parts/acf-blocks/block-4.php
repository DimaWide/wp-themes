<?php

$class_block = '';

if (!empty($args)) {
    $class_block = $args['classNameBlock'];
}

$title = get_field('title');
$group = get_field('group');
$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-1');
?>
<!-- Acf Block #4 – Інформація про компанію -->
<div class="wcl-acf-block-4 <?php echo $class_block; ?>">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="cmp-title data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <div class="data-row">
            <div class="data-col">
                <?php if (have_rows('group')) : ?>
                    <?php while (have_rows('group')) : the_row(); ?>
                        <?php
                        $description = $group['description'];
                        ?>
                        <?php if (!empty($description)) : ?>
                            <div class="cmp-desc data-desc">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($image)) : ?>
                            <div class="data-img mod-v2">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('advantages')) : ?>
                            <div class="data-advg">
                                <?php while (have_rows('advantages')) : the_row(); ?>
                                    <?php
                                    $value = get_sub_field('value');
                                    $name  = get_sub_field('name');
                                    ?>
                                    <div class="data-advg-item">
                                        <div class="data-advg-item-inner">
                                            <?php if (!empty($value)) : ?>
                                                <div class="data-advg-item-value">
                                                    <?php echo $value; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($name)) : ?>
                                                <div class="data-advg-item-name">
                                                    <span><?php echo $name; ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>