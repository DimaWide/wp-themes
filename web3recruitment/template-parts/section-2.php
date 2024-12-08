<?php


?>
<div class="wcl-section-2">
    <div class="data-container wcl-container">
        <?php if (have_rows('list')) : ?>
            <?php
            $cont = 0;
            ?>
            <div class="data-row">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $count++;
                    $value  = get_sub_field('value');
                    $text  = get_sub_field('text');
                    $icon  = get_sub_field('icon');
                    $icon = wp_get_attachment_image($icon, 'full');
                    ?>
                    <div class="data-col data-item">
                        <div class="data-item-a">
                            <?php if (!empty($icon)) : ?>
                                <div class="data-item-a-icon">
                                    <?php echo $icon; ?>
                                </div>
                            <?php endif; ?>

                            <div class="data-item-a-num">
                                <?php echo $count; ?>
                            </div>
                        </div>

                        <div class="data-item-b">
                            <?php if (!empty($value)) : ?>
                                <div class="data-item-b-val">
                                    <?php echo $value; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <div class="data-item-b-text">
                                    <?php echo $text; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>