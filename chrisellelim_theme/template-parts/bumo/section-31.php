<?php


$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
?>
<div class="wcl-section-31">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo wpautop($subtitle); ?>
            </div>
        <?php endif; ?>
    </div>
</div>