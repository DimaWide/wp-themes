<?php

$content_group = get_sub_field('content_group');
$text_1 = $content_group['text_1'];
$text_2 = $content_group['text_2'];
$style  = get_sub_field('style');
$style  = !empty($style) ? $style : 'a';
$margin = get_sub_field('margin');
$margin = !empty($margin) ? $margin : 'a';
$row    = get_row_index();
?>
<div class="wcl-section-13 <?php echo 'style-' . $style . ' margin-' . $margin . ' row-' . $row; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <?php if (!empty($text_1)) : ?>
                <div class="data-col">
                    <div class="data-text">
                        <?php echo wpautop($text_1); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($text_2)) : ?>
                <div class="data-col">
                    <div class="data-text">
                        <?php echo wpautop($text_2); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>