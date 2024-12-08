<?php

$title       = get_field('title');
$description = get_field('description');
$link        = get_field('link');
?>
<!-- Acf Block #33 – Enhance Your Performance with Nutrition from Our Dietitians -->
<div class="wcl-acf-block-33" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="wcl-cmp-head data-head">
            <?php if (!empty($title)) : ?>
                <h2 class="wcl-cmp-title data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
        </div>

        <?php if (!empty($description) || !empty($link)) : ?>
            <div class="wcl-cmp-info data-info">
                <?php if (!empty($description)) : ?>
                    <div class="wcl-cmp-desc data-desc" itemprop="description">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link)) : ?>
                    <?php
                    $link_url    = $link['url'];
                    $link_title  = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    ?>
                    <div class="data-link">
                        <button class="wcl-cmp-button js-popup-open" data-target="make-a-reservation">
                            <?php echo $link_title; ?>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>