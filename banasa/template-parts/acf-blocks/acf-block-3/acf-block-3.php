<?php

if (display_preview_image($block)) {
    return;
}

$pages            = get_field('pages', 'option');
$projects_listing = $pages['projects_listing'];

$text         = get_field('text');
$running_line = get_field('running_line');

$group_1 = get_field('group_1');
$title   = $group_1['title'];
$image   = $group_1['image'];
$image   = wp_get_attachment_image($image, 'image-size-1');

$group_2 = get_field('group_2');
$list    = $group_2['list'];
$note    = $group_2['note'];
?>
<!-- Acf Block #3 – Main projects -->
<div class="wcl-acf-block-3">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($image)) : ?>
                    <div class="data-image">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($list)) : ?>
                    <div class="data-list">
                        <?php foreach ($list as $item) : ?>
                            <?php
                            $text = $item['text'];
                            $link = $item['link'];
                            $link = !empty($link) ? get_permalink($link) : '';
                            ?>
                            <div class="data-item">
                                <?php if (!empty($link)) : ?>
                                    <a href="<?php echo $link; ?>" class="data-item-inner">
                                        <?php if (!empty($text)) : ?>
                                            <div class="data-item-text">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="data-item-arrow">
                                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-red.svg', false); ?>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="data-item-inner">
                                        <?php if (!empty($text)) : ?>
                                            <div class="data-item-text">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="data-item-arrow">
                                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-red.svg', false); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($note)) : ?>
                    <div class="data-note">
                        <?php echo $note; ?>
                    </div>
                <?php endif; ?>

                <div class="data-arrow">
                    <a href="<?php echo get_permalink($projects_listing); ?>">
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-red.svg', false); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($running_line)) : ?>
        <div class="data-running-line">
            <div class="data-running-line-item">
                <?php echo $running_line; ?>
            </div>

            <div class="data-running-line-item">
                <?php echo $running_line; ?>
            </div>
        </div>
    <?php endif; ?>
</div>