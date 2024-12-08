<?php


$bar = get_field('bar', 'option');
?>
<?php if (!empty($bar)) : ?>
    <div class="wcl-bar">
        <?php
        $link        = $bar['link'];
        $link_url    = $link['url'];
        $link_target = $link['target'] ?: '_self';

        $text = $bar['text'];
        ?>
        <a href="<?php echo $link_url; ?>" class="data-inner" target="<?php echo $link_target; ?>">
            <div class="data-container wlc-container">
                <?php if (!empty($text)) : ?>
                    <?php echo $text; ?>
                <?php endif; ?>
            </div>
        </a>
    </div>
<?php endif; ?>