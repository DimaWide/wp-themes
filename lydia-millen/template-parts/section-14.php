<?php


$subtitle = get_sub_field('subtitle');
?>
<div class="wcl-section-14">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-name">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>
    </div>
</div>