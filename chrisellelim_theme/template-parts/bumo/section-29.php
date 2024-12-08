<?php


$title = get_sub_field('title');
?>
<div class="wcl-section-29">
    <div class="data-container wcl-container">
        <div class="data-row">
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
                                $subtitle  = get_sub_field('subtitle');
                                $link  = ( get_sub_field('link') ? get_sub_field('link') : '!#' );
                            ?>
                            <a href="<?php echo $link; ?>" class="data-item swiper-slide" target="_blank">

                                <div class="data-item-ico">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/play-2.svg'; ?>" alt="img">
                                </div>

                                <div class="data-item-b">
                                    <?php if (!empty($title)) : ?>
                                        <h3 class="data-item-title">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if (!empty($subtitle)) : ?>
                                        <div class="data-item-subtitle">
                                            <?php echo $subtitle; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>