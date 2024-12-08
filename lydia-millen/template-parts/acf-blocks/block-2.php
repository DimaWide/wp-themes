<?php

$group_1           = get_field('group_1');
$group_2           = get_field('group_2');

if (empty($group_1) && empty($group_1)) {
    return;
}

$image             = $group_1['image'];
$corner_type       = $group_1['corner_type'];
$image             = wp_get_attachment_image($image, 'image-size-9');
$title             = $group_2['title'];
$text              = $group_2['text'];
$type_content      = $group_2['type_content'];
$align             = get_field('align');
$align             = ($align == 'image_left') ? 'mod-image-left' : 'mod-image-right';
$type_content      = !empty($type_content) ? $type_content : 'lines';
$type_content_class = 'mod-' . $type_content;
$corner_type       = !empty($corner_type) ? $corner_type : 'default';
$corner_type_class = 'mod-corner-' . $corner_type;
?>
<?php if (!empty($group_1) || !empty($group_2)) : ?>
    <div class="wcl-acf-block-2 wcl-block-clear <?php echo $align . ' ' . $corner_type_class . ' ' . $type_content_class; ?>">
        <div class="data-inner-2">
            <div class="data-container wcl-container">
                <div class="data-inner">
                    <div class="data-img">
                        <?php if (!empty($image)) : ?>
                            <?php echo $image; ?>
                        <?php endif; ?>

                        <?php if ($corner_type == 'cropped') : ?>
                            <div class="wcl-shape">
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($title) || !empty($group_2['list']) || !empty($text)) : ?>
                        <div class="data-a">
                            <?php if (!empty($title)) : ?>
                                <h2 class="data-title">
                                    <?php echo $title; ?>
                                </h2>
                            <?php endif; ?>

                            <?php if (have_rows('group_2')) : ?>
                                <?php while (have_rows('group_2')) : the_row(); ?>
                                    <?php if ($type_content == 'lines') : ?>
                                        <?php if (have_rows('list')) : ?>
                                            <div class="data-list">
                                                <?php while (have_rows('list')) : the_row(); ?>
                                                    <?php
                                                    $item_name = get_sub_field('item_name');
                                                    $brand     = get_sub_field('brand');
                                                    $item_name = explode(',', (string)$item_name);
                                                    $link      = get_sub_field('link');
                                                    $link_class = '';
                                                    $tag_start = '<div class="data-item-inner">';
                                                    $tag_end = '</div>';

                                                    if (!empty($link)) {
                                                        $tag_start = '<a href="' . $link . '" class="data-item-inner" target="_blank">';
                                                        $tag_end = '</a>';
                                                        $link_class = 'mod-link';
                                                    }
                                                    ?>
                                                    <div class="data-item <?php echo $link_class; ?>">
                                                        <?php echo $tag_start; ?>

                                                        <span class="data-item-name">
                                                            <?php foreach ($item_name as $key => $value) : ?>
                                                                <?php if ($key > 0) : ?>
                                                                    <span class="data-item-dash"></span>
                                                                    <?php echo $value; ?>
                                                                <?php else : ?>
                                                                    <?php echo $value; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </span>

                                                        <?php if (!empty($item_name) || !empty($brand)) : ?>
                                                            <?php if (count($item_name) - 1 == $key && count($item_name) > 1) : ?>
                                                                <span class="data-item-line">-</span>
                                                            <?php else : ?>
                                                                <span class="data-item-dash"></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?php if (!empty($brand)) : ?>
                                                            <span class="data-item-brand">
                                                                <?php echo $brand; ?>
                                                            </span>
                                                        <?php endif; ?>

                                                        <?php echo $tag_end; ?>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($text)) : ?>
                                            <div class="data-text">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>