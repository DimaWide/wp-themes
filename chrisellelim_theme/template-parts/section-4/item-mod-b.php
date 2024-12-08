<?php

$align = $args['align'];
$list_item = $args['list_item'];

if( !empty($list_item) ) {

    $image = $list_item['image'];
    $image = wp_get_attachment_image($image, 'image-g');

    $title = $list_item['content_group']['title'];
    $desc  = $list_item['content_group']['desc'];
    $link  = $list_item['content_group']['link'];
    ?>
    <div class="data-item <?php echo 'mod-' . $align; ?>">
        <div class="data-item-a">
            <?php if (!empty($image)) : ?>
                <div class="data-item-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-item-b">
            <?php if (!empty($title)) : ?>
                <h2 class="data-item-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($desc)) : ?>
                <div class="data-item-desc">
                    <?php echo wpautop($desc); ?>
                </div>
            <?php endif; ?>

            <div class="data-item-cat">
                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>" class="data-item-cat-link wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <?php 

}