<?php


$title = get_sub_field('title');
?>
<div class="wcl-section-26">
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
                        $image = get_sub_field('image');
                        $image = wp_get_attachment_image($image, 'image-x');
                        $url   = get_sub_field('url');
                        ?>
                        <div class="data-item swiper-slide">
                            <?php if (!empty($url)) : ?>
                                <a href="<?php echo $url; ?>" class="data-item-link" target="_blank">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            <?php else : ?>
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>