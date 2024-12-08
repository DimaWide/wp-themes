<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');

$become_a_member = get_field('acf_block_15', 'option');
$text_button = $become_a_member['text_button'];
?>
<!-- Acf Block #15 – Secure Your Place at Reway Club -->
<div class="wcl-acf-block-15" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-inner">
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

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($text_button)) : ?>
                <div class="data-link">
                    <button class="data-link-btn wcl-cmp-button-two js-popup-open" data-target="become-a-member">
                        <?php echo $text_button; ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>