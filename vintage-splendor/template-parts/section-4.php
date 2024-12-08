<?php

$title = get_sub_field('title');
$logo  = get_field('logo', 'option');
$logo  = wp_get_attachment_image($logo, 'full');

$splendor_collective_subscription = get_field('splendor_collective_subscription', 'option');
?>
<div class="wcl-section-4">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (have_rows('list')) : ?>
                <?php
                $count = 0;
                ?>
                <div class="data-list swiper">
                    <div class="data-list-inner swiper-wrapper">
                        <?php while (have_rows('list')) : the_row(); ?>
                            <?php
                            $count++;
                            $text = get_sub_field('text');
                            $link = get_sub_field('link');
                            ?>
                            <div class="data-item swiper-slide">
                                <div class="data-item-inner">
                                    <div class="data-item-inner-b">
                                        <div class="data-item-index">
                                            <?php
                                            $num = sprintf("%02d", $count);
                                            echo $num;
                                            ?>
                                        </div>

                                        <?php if (!empty($text)) : ?>
                                            <div class="data-item-desc">
                                                <div class="data-item-desc-inner">
                                                    <?php echo $text; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($link['url'] && $link['url'] != '#')) : ?>
                                            <?php
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ?: '_self';
                                            ?>
                                            <div class="data-item-link">
                                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                                    <?php echo $link_title; ?>
                                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <div class="data-item-link">
                                                <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link">
                                                    Join now
                                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($logo)) : ?>
                                        <div class="data-item-logo">
                                            <?php echo $logo; ?>
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
</div>