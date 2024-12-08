<?php

if (display_preview_image($block)) {
    return;
}

$title = get_field('title');
?>
<!-- Acf Block #4 – Our skills -->
<div class="wcl-acf-block-4">
    <div class="data-container wcl-container">
        <div class="data-lines">
            <div class="line-container" data-length="439" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                <div class="line"></div>
            </div>

            <div class="line-container" data-length="498" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                <div class="line"></div>
            </div>
        </div>

        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list-out">
                <div class="data-list">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $image = get_sub_field('image');
                        $image = wp_get_attachment_image($image, 'full');

                        $content = get_sub_field('content');
                        $title   = $content['title'];
                        $points  = $content['points'];
                        $link    = $content['link'];
                        ?>
                        <div class="data-item">
                            <div class="data-item-inner">
                                <div class="data-item-img">
                                    <?php if (!empty($image)) : ?>
                                        <?php echo $image; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="data-item-info">
                                    <?php if (!empty($title)) : ?>
                                        <h3 class="data-item-title">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <div class="data-item-img mod-mobile">
                                        <?php if (!empty($image)) : ?>
                                            <?php echo $image; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($points)) : ?>
                                        <?php
                                        $index = 0;

                                        $updated_points = preg_replace_callback(
                                            '/<li>(.*?)<\/li>/',
                                            function ($matches) use (&$index) {
                                                $index++;
                                                return '<li><span>' . $index . '.</span> ' . $matches[1] . '</li>';
                                            },
                                            $points
                                        );
                                        ?>
                                        <div class="data-item-points">
                                            <?php echo $updated_points; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($link)) : ?>
                                        <?php
                                        $link_url    = $link['url'];
                                        $link_title  = $link['title'];
                                        $link_target = $link['target'] ?: '_self';
                                        ?>
                                        <div class="data-item-link">
                                            <a href="<?php echo $link_url; ?>" class="cmp-link" target="<?php echo $link_target; ?>">
                                                <?php echo $link_title; ?>
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right.svg'; ?>" alt="img">
                                            </a>
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