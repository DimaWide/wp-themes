<?php

if (display_preview_image($block)) {
    return;
}

$group = get_field('group');
$team = get_field('team');
?>
<!-- Acf Block #3 – The company -->
<div class="wcl-acf-block-3">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (! empty($group)): ?>
                    <div class="data-info">
                        <div class="data-lines">
                            <div class="line-container" data-length="470" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.2">
                                <div class="line"></div>
                            </div>
                            <div class="line-container" data-length="207" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                                <div class="line"></div>
                            </div>
                        </div>

                        <div class="data-lines-2">
                            <div class="line-container" data-length="750" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.2">
                                <div class="line"></div>
                            </div>

                            <div class="line-container" data-length="626" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                                <div class="line"></div>
                            </div>

                            <div class="line-container" data-length="750" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1">
                                <div class="line"></div>
                            </div> 
                        </div>

                        <?php
                        $title       = $group['title'];
                        $description = $group['description'];
                        $link        = $group['link'];
                        ?>
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="data-desc">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                            <?php
                            $link_url    = $link['url'];
                            $link_title  = $link['title'];
                            $link_target = $link['target'] ?: '_self';
                            ?>
                            <div class="data-link">
                                <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                                    <?php echo $link_title; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (have_rows('team')) : ?>
                    <div class="data-slider swiper">
                        <div class="data-slider-inner swiper-wrapper">
                            <?php while (have_rows('team')) : the_row(); ?>
                                <?php
                                $photo          = get_sub_field('photo');
                                $photo          = wp_get_attachment_image($photo, 'image-size-2');
                                $name           = get_sub_field('name');
                                $specialization = get_sub_field('specialization');
                                ?>
                                <div class="data-item swiper-slide">
                                    <div class="data-item-inner">
                                        <div class="data-item-img">
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

                                            <?php if (!empty($specialization)) : ?>
                                                <div class="data-item-specialization">
                                                    <?php echo $specialization; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>