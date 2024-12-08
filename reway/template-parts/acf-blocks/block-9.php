<?php

$tagline      = get_field('tagline');
$title        = get_field('title');
$description  = get_field('description');
$bg_text      = get_field('bg_text');
$type_heading = get_field('type_heading');
$type_heading = !empty($type_heading) ? $type_heading : 'h2';
?>
<!-- Acf Block #9 – A Different Perspective on Life -->
<div class="wcl-acf-block-9" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($bg_text)) : ?>
            <div class="data-bg-text" itemprop="text">
                <?php echo $bg_text; ?>
            </div>
        <?php endif; ?>

        <div class="wcl-cmp-head data-head">
            <?php if (!empty($tagline)) : ?>
                <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                    <?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <?php if ($type_heading == 'h1') : ?>
                    <h1 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h1>
                <?php else : ?>
                    <h2 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($description)) : ?>
            <div class="wcl-cmp-info data-info">
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>