<?php


$title = get_sub_field('title');
$style = get_sub_field('style');
?>
<div class="wcl-section-16">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $title = get_sub_field('title');
                        $desc  = get_sub_field('desc');
                        ?>
                        <div class="data-item swiper-slide">
                            <div class="data-item-inner">
                                <?php if (!empty($title)) : ?>
                                    <h2 class="data-item-title">
                                        <?php echo $title; ?>
                                    </h2>
                                <?php endif; ?>

                                <?php if (!empty($desc)) : ?>
                                    <div class="data-item-desc">
                                        <div class="data-item-desc-inner">
                                            <?php echo $desc; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>