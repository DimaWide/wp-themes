<?php


?>
<div class="wcl-section-19">
    <div class="data-container wcl-container">
        <?php if (have_rows('list')) : ?>
            <div class="data-row">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $item = get_sub_field('item');
                    $title = get_the_title($item);
                    $image = get_the_post_thumbnail($item, 'image-i');
                    $link  = get_field('link', $item);
                    $brand = get_field('brand', $item);
                    $brand = !empty($brand) ? $brand : 'Brand';
                    ?>
                    <div class="data-col wcl-thing">
                        <a href="<?php echo $link; ?>" class="d6-inner">
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
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>