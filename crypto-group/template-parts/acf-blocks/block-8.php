<?php

$title       = get_field('title');
$description = get_field('description');
?>
<!-- Acf Block #8 – Everything CTA -->
<div class="wcl-acf-block-8" id="everything-cta">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($description)) : ?>
            <div class="data-desc">
                <?php echo $description; ?>
            </div>
        <?php endif; ?>

        <?php get_template_part('template-parts/components/cmp-1-cta'); ?>
    </div>
</div>