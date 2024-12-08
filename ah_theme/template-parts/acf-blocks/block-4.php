<?php



$subheading = get_field('subheading');
$title      = get_field('title');
$subtitle   = get_field('subtitle');
?>
<!-- Acf Block #4 – Case Study & Newsletter -->
<div class="wcl-acf-block-4">
    <div class="data-container">
        <div class="data-inner">
            <?php if (!empty($subheading)) : ?>
                <div class="data-subhead">
                    <?php echo $subheading; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h1 class="data-title">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>