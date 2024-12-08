<?php


$title = get_sub_field('title');
?>
<div class="wcl-section-15">
    <div class="data-container wcl-container">
        <div class="data-inner">
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
                        <div class="data-list swiper">
                            <div class="data-list-inner swiper-wrapper">
                                <?php while (have_rows('list')) : the_row(); ?>
                                    <?php
                                    $image = get_sub_field('image');
                                    $image = wp_get_attachment_image($image, 'full');
                                    $link  = get_sub_field('link');
                                    ?>
                                    <div class="data-item swiper-slide">
                                        <?php if (!empty($link) && filter_var($link['url'], FILTER_VALIDATE_URL) !== false) : ?>
                                            <?php
                                            $link_url    = $link['url'];
                                            $link_target = $link['target'] ?: '_self';
                                            ?>
                                            <a href="<?php echo $link_url; ?>" class="data-link" target="<?php echo $link_target; ?>">
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
        </div>
    </div>
</div>