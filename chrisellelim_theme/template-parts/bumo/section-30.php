<?php

$image = get_sub_field('image');
$image = wp_get_attachment_image($image, 'image-m');

$column_right = get_sub_field('column_right');
$title = $column_right['title'];
$list = $column_right['list'];
$tag = $column_right['tag'];

?>
<div class="wcl-section-30">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-b data-col">
                <div class="data-b-inner">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php
                        if( !empty($list) ) {
                            ?>
                            <div class="data-list">
                                <?php 
                                    foreach ($list as $list_item) {

                                        // var_dump($list_item);
                                        $text  = $list_item['text'];
                                        $icon = $list_item['icon'];
                                        $icon = wp_get_attachment_image($icon);
                                        $url = $list_item['url'];
                                    
                                        ?>

                                        <p>
                                            <a href="<?php echo $url; ?>" target="_blank">
                                                <?php if (!empty($icon)) : ?>
                                                    <span>
                                                        <?php echo $icon; ?>
                                                    </span>
                                                <?php endif; ?>
                                                
                                                <?php if (!empty($text)) : ?>
                                                    <?php echo $text; ?>
                                                <?php endif; ?>
                                            </a>
                                        </p>

                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>

                    <?php if (!empty($tag)) : ?>
                        <?php
                        $link_url    = $tag['url'];
                        $link_title  = $tag['title'];
                        $link_target = $tag['target'] ?: '_self';
                        ?>
                        <a href="<?php echo $link_url; ?>" class="data-tag" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>