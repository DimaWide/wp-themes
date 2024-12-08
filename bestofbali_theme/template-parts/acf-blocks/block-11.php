<?php

$block = $args['block'];
$class = '';

if (isset($block['className']) && !empty($block['className'])) {
    $class = $block['className'];
}

$title    = get_field('title');
$subtitle = get_field('subtitle');
$content  = get_field('content');
?>
<!-- Acf Block #11 – Article -->
<div class="wcl-acf-block-11 <?php echo $class; ?>">
    <div class="data-container wcl-container">
        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($content)) : ?>
            <div class="data-content">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
    </div>
</div>