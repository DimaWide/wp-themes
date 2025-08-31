<?php

$title       = get_field('title');
$description = get_field('description');
$item_1      = get_field('item_1');
$item_2      = get_field('item_2');
?>
<!-- acf-2-about-products – About Products s-->
<div class="acf-2-about-products">
    <div class="data-block">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/act-2-logo.svg'; ?>" height="197.5px" alt="img">
    </div>

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
                <?php if (!empty($description)) : ?>
                    <div class="data-desc">
                        <?php echo $description; ?>

                        <div class="data-arrow">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/act-2-arrow.svg'; ?>" alt="img">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-row-2">
            <div class="data-col-2">
                <?php if (! empty($item_1)): ?>
                    <?php
                    $image       = $item_1['image'];
                    $title       = $item_1['title'];
                    $description = $item_1['description'];
                    $link        = $item_1['link'];
                    $link_02      = $item_1['link_2'];

                    $image = wp_get_attachment_image($image, 'image-size-1');
                    ?>
                    <div class="data-item">
                        <?php if (!empty($image)) : ?>
                            <div class="data-item-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>

                        <div class="data-item-info">
                            <?php if (!empty($title)) : ?>
                                <h3 class="data-item-title">
                                    <?php echo $title; ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($description)) : ?>
                                <div class="data-item-desc">
                                    <?php echo $description; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                                <?php
                                $link_url    = $link['url'];
                                $link_title  = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                ?>
                                <div class="data-item-link">
                                    <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link_02)) : ?>
                                <?php
                                $link_url    = $link_02['url'];
                                $link_title  = $link_02['title'];
                                $link_target = $link_02['target'] ?: '_self';
                                ?>
                                  <div class="data-item-link-2">
                                    <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col-2">
                <?php if (! empty($item_2)): ?>
                    <?php
                    $image       = $item_2['image'];
                    $title       = $item_2['title'];
                    $description = $item_2['description'];
                    $link        = $item_2['link'];
                    $link_02      = $item_2['link_2'];

                    $image = wp_get_attachment_image($image, 'full');
                    ?>
                    <div class="data-item">
                        <?php if (!empty($image)) : ?>
                            <div class="data-item-img">
                                <?php echo $image; ?>
                            </div>
                        <?php endif; ?>

                        <div class="data-item-info">
                            <?php if (!empty($title)) : ?>
                                <h3 class="data-item-title">
                                    <?php echo $title; ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($description)) : ?>
                                <div class="data-item-desc">
                                    <?php echo $description; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                                <?php
                                $link_url    = $link['url'];
                                $link_title  = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                ?>
                                <div class="data-item-link">
                                    <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link_02)) : ?>
                                <?php
                                $link_url    = $link_02['url'];
                                $link_title  = $link_02['title'];
                                $link_target = $link_02['target'] ?: '_self';
                                ?>
                                  <div class="data-item-link-2">
                                    <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>