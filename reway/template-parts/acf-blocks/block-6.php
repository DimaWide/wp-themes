<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');

$become_a_member = get_field('acf_block_6', 'option');
$button_text = $become_a_member['text_button'];
?>
<!-- Acf Block #6 – Become a Member -->
<div class="wcl-acf-block-6" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-info">
            <?php if (!empty($tagline)) : ?>
                <div class="data-tagline" itemprop="alternativeHeadline">
                    <?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h2 class="data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-desc data-desc" itemprop="description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($button_text)) : ?>
                <div class="data-link">
                    <button class="data-link-btn wcl-cmp-button-two js-popup-open" data-target="become-a-member">
                        <?php echo $button_text; ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>