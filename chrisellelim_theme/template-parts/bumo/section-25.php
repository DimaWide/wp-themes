<?php


$title = get_sub_field('title');
$style = get_sub_field('style');
$style = !empty($style) ? $style : 'a';
?>
<div class="wcl-section-25 <?php echo 'mod-' . $style; ?>">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    if ($style == 'b') {
                        get_template_part('template-parts/section-25/item-mod-b', null, $args);
                    } else {
                        get_template_part('template-parts/section-25/item', null, $args);
                    }
                    ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>