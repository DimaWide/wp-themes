<?php


$title       = get_sub_field('title');
$subtitle    = get_sub_field('subtitle');
$link_1      = get_sub_field('link_1');
$link_2      = get_sub_field('link_2');
$style       = get_sub_field('style');
$style       = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style;
?>
<div class="wcl-section-12 <?php echo $style_class; ?>">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-row">
                <div class="data-col">
                    <div class="data-a">
                        <?php if (!empty($title)) : ?>
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($subtitle)) : ?>
                            <div class="data-subtitle">
                                <?php echo $subtitle; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-links">
                        <?php if ($style == 'two') : ?>
                            <?php if (!empty($link_1)) : ?>
                                <?php
                                $link_url    = $link_1['url'];
                                $link_title  = $link_1['title'];
                                $link_target = $link_1['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link mod-black-to-white" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if (!empty($link_1)) : ?>
                                <?php
                                $link_url    = $link_1['url'];
                                $link_title  = $link_1['title'];
                                $link_target = $link_1['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link_2)) : ?>
                                <?php
                                $link_url    = $link_2['url'];
                                $link_title  = $link_2['title'];
                                $link_target = $link_2['target'] ?: '_self';
                                ?>
                                <div class="data-links-item">
                                    <a href="<?php echo $link_url; ?>" class="wcl-link mod-gradient" target="<?php echo $link_target; ?>">
                                        <span> <?php echo $link_title; ?></span>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>