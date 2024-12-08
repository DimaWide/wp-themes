<?php

$left_column = get_sub_field('left_column');
$left_column = get_sub_field('left_column');
$image = $left_column['image'];
$image = wp_get_attachment_image($image, 'image-b');
$tag = $left_column['tag'];

$right_column = get_sub_field('right_column');
$title = $right_column['title'];
$subtitle = $right_column['subtitle'];
$desc = $right_column['desc'];
$link = $right_column['link'];

?>

<div class="wcl-section-27">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-a data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-a-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($tag)) : ?>
                    <?php
                    $link_url    = $tag['url'];
                    $link_title  = $tag['title'];
                    $link_target = $tag['target'] ?: '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>" class="data-a-note" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="data-b data-col">
                <div class="data-b-inner">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-b-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($subtitle)) : ?>
                        <div class="data-b-subtitle">
                            <?php echo $subtitle; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($desc)) : ?>
                        <div class="data-b-desc">
                            <?php echo wpautop($desc); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($link)) : ?>
                        <?php
                        $link_url    = $link['url'];
                        $link_title  = $link['title'];
                        $link_target = $link['target'] ?: '_self';
                        ?>
                        <a href="<?php echo $link_url; ?>" class="data-b-link wcl-link" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="data-el">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/sound-wave.png'; ?>" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>