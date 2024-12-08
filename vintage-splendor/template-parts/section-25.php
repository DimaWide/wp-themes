<?php

$title = get_sub_field('title');
?>
<div class="wcl-section-25">
    <div class="data-container wcl-container">
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
                    <div class="data-list">
                        <?php while (have_rows('list')) : the_row(); ?>
                            <?php
                            $image       = get_sub_field('image');
                            $image       = wp_get_attachment_image($image, 'image-size-14');
                            $link        = get_sub_field('link');
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-item">
                                <a href="<?php echo $link_url; ?>" class="data-item-inner" target="<?php echo $link_target; ?>">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($link_title)) : ?>
                                        <h3 class="data-item-link">
                                            <span class="wcl-link">
                                                <?php echo $link_title; ?>
                                            </span>
                                        </h3>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>