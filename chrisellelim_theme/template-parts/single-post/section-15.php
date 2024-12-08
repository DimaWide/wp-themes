<?php

$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$desc = get_sub_field('desc');
?>
<div class="wcl-section-15">
    <div class="data-container wcl-container">
        <div class="data-inner">
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

            <?php if (!empty($desc)) : ?>
                <div class="data-desc">
                    <?php echo wpautop($desc); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>