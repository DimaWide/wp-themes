<?php


$content = get_field('content');
?>
<?php if (!empty($content)) : ?>
    <div class="wcl-acf-block-9 wcl-block-clear">
        <div class="data-container wcl-container">
            <div class="data-text">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php endif; ?>