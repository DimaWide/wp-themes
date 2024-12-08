<?php


$title       = get_sub_field('title');
$logo        = get_field('logo', 'option');
$logo        = wp_get_attachment_image($logo, 'full');
$link        = get_sub_field('link');
$style       = get_sub_field('style');
$style_class = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style_class;
?>
<div class="wcl-section-11 <?php echo $style_class; ?>">
    <div class="data-container wcl-container">
        <?php if ($style == 'two') : ?>
            <div class="data-a">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <div class="data-link">
                        <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div> <?php else : ?>
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while (have_rows('list')) : the_row(); ?>
                        <?php
                        $title    = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle');
                        $desc     = get_sub_field('desc');
                        ?>
                        <div class="data-item swiper-slide">
                            <div class="data-item-inner">
                                <?php if (!empty($title)) : ?>
                                    <h2 class="data-item-title">
                                        <?php echo $title; ?>
                                    </h2>
                                <?php endif; ?>

                                <?php if (!empty($subtitle)) : ?>
                                    <div class="data-item-subtitle">
                                        <?php echo $subtitle; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($desc)) : ?>
                                    <div class="data-item-desc">
                                        <div class="data-item-desc-inner">
                                            <?php echo $desc; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

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