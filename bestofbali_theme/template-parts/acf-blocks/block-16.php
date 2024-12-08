<?php

$link = get_field('link');
?>
<!-- Acf Block #16 - Title and link for post -->
<div class="wcl-acf-block-16 wcl-section">
    <div class="data-container wcl-container">
        <div class="data-block">
            <div class="data-block-icon">
                <img src="<?php echo get_template_directory_uri() . '/img/ico-1-hand.png'; ?>" alt="ico-1-hand">
            </div>

            <div class="data-block-el-1">
                <span class="data-block-label">
                    Read:
                </span>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <span class="data-block-link">
                        <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                        </a>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>