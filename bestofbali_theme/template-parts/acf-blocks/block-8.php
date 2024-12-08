<?php

$text = get_field('text');
?>
<!-- Acf Block #8 - Text Content -->
<?php if (!empty($text)) : ?>
    <div class="wcl-acf-block-8 wcl-section">
        <div class="data-container wcl-container">
            <div class="data-text">
                <?php echo $text; ?>
            </div>
        </div>
    </div>
<?php endif; ?>