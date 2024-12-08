<?php


$who_we_are = get_field('who_we_are');

$content = $who_we_are['content'];
?>
<!-- sct-9-we-are -->
<?php if (! empty($content)): ?>
    <div class="sct-9-we-are">
        <div class="data-container wcl-container">
            <div class="data-content">
            <?php if (! empty($content)): ?>
                <?php echo $content; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>