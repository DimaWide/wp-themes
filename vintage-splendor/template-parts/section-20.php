<?php


$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'image-size-11');
$group = get_sub_field('group');
$title = $group['title'];
$desc  = $group['desc'];
$name  = $group['name'];
?>
<div class="wcl-section-20">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="data-a">
                    <div class="data-a-col">
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>
                    </div>

                    <div class="data-a-col">
                        <?php if (!empty($desc)) : ?>
                            <div class="data-desc">
                                <?php echo $desc; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($name)) : ?>
                            <div class="data-name">
                                <?php echo $name; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>