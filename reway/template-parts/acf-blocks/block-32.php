<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$list        = get_field('list');
?>
<!-- Acf Block #32 – Post-Workout Recovery -->
<div class="wcl-acf-block-32" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-inner-out">
            <div class="data-inner">
                <div class="data-head">
                    <?php if (!empty($tagline)) : ?>
                        <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                            <?php echo $tagline; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <h2 class="wcl-cmp-title data-title" itemprop="headline">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>
                </div>

                <?php if (!empty($description)) : ?>
                    <div class="wcl-cmp-desc data-desc" itemprop="description">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($list)) : ?>
                    <h3 class="data-list" itemprop="text">
                        <?php echo $list; ?>
                    </h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>