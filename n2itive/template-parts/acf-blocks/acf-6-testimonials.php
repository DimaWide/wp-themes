<?php

$title = get_field('title');
?>
<!-- acf-6-testimonials – Testimonials -->
<div class="acf-6-testimonials">
    <div class="data-cotainer wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (have_rows('list')) : ?>
                    <div class="data-slider swiper">
                        <div class="data-slider-inner swiper-wrapper">
                            <?php while (have_rows('list')) : the_row(); ?>
                                <?php
                                $photo  = get_sub_field('photo');
                                $photo  = wp_get_attachment_image($photo, 'image-size-4');
                                $name   = get_sub_field('name');
                                $review = get_sub_field('review');
                                $rating = get_sub_field('rating');
                                $rating = round((float)$rating);
                                ?>
                                <div class="data-item swiper-slide">
                                    <div class="data-item-inner">
                                        <div class="data-item-photo">
                                            <?php if (!empty($photo)) : ?>
                                                <?php echo $photo; ?>
                                            <?php endif; ?>
                                        </div>

                                        <div class="data-item-info">
                                            <?php if (!empty($name)) : ?>
                                                <div class="data-item-name">
                                                    <?php echo $name; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($rating)) : ?>
                                                <?php
                                                ?>
                                                <div class="data-item-rating">
                                                    <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i > 5) {
                                                            break;
                                                        }
                                                    ?>
                                                        <?php if ($rating >= $i) : ?>
                                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/star.svg'; ?>" alt="img">
                                                        <?php endif; ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($review)) : ?>
                                                <div class="data-item-review">
                                                    <?php echo $review; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <div class="data-slider-nav">
                            <div class="data-slider-nav-btn mod-prev">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                            </div>

                            <div class="data-slider-pagination swiper-pagination"></div>

                            <div class="data-slider-nav-btn mod-next">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right.svg'; ?>" alt="img">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>