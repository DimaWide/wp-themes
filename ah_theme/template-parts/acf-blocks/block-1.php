<?php


$text_1 = get_field('text_1');
$text_2 = get_field('text_2');
?>
<!-- Acf Block #1 – Hero Section -->
<div class="wcl-acf-block-1">
    <div class="data-container">
        <?php if (!empty($text_1)) : ?>
            <div class="data-text-1">
                <?php echo $text_1; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('3_columns')) : ?>
            <div class="data-list">
                <?php while (have_rows('3_columns')) : the_row(); ?>
                    <?php
                    $text = get_sub_field('text');
                    ?>
                    <div class="data-item">
                        <?php if (!empty($text)) : ?>
                            <div class="data-item-text">
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($text_2)) : ?>
            <div class="data-text-2">
                <?php echo $text_2; ?>
            </div>
        <?php endif; ?>
    </div>
</div>