<?php


$content = get_field('content');
?>
<div class="wcl-acf-block-8 wcl-block-clear">
    <div class="data-container wcl-container">
        <?php if (!empty($content)) : ?>
            <div class="data-text">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
