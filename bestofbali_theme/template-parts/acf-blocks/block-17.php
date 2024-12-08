<?php

$link_1 = get_field('link_1');
$link_2 = get_field('link_2');
?>
<!-- Acf Block #17 - Two Links -->
<?php if (!empty($link_1) || !empty($link_2)) : ?>
    <div class="wcl-acf-block-17 wcl-section">
        <div class="data-container wcl-container">
            <div class="data-links">
                <?php if (!empty($link_1)) : ?>
                    <?php
                    $link_url    = $link_1['url'];
                    $link_title  = $link_1['title'];
                    $link_target = $link_1['target'] ?: '_self';
                    ?>
                    <div class="data-links-item">
                        <a href="<?php echo $link_url; ?>" class="wcl-btn" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link_2)) : ?>
                    <?php
                    $link_url    = $link_2['url'];
                    $link_title  = $link_2['title'];
                    $link_target = $link_2['target'] ?: '_self';
                    ?>
                    <div class="data-links-item mod-two">
                        <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>