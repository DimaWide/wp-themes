<?php


?>
<div class="wcl-section-11">
    <div class="data-container wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <?php if (have_rows('content')) : ?>
            <div class="data-list">
                <?php while (have_rows('content')) : the_row(); ?>
                    <?php
                    $col_1      = get_sub_field('col_1');
                    $title      = $col_1['title'];
                    $subtitle   = $col_1['subtitle'];
                    $desc       = $col_1['desc'];
                    $col_2      = get_sub_field('col_2');
                    $title_2    = $col_2['title'];
                    $subtitle_2 = $col_2['subtitle'];
                    $desc_2     = $col_2['desc'];
                    ?>
                    <?php if (!empty($col_1)) : ?>
                        <div class="data-item">
                            <?php if (!empty($title)) : ?>
                                <h2 class="data-item-title">
                                    <?php echo $title; ?>
                                </h2>
                            <?php endif; ?>

                            <?php if (!empty($subtitle)) : ?>
                                <div class="data-item-subtitle">
                                    <?php echo $subtitle; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($desc)) : ?>
                                <div class="data-item-desc">
                                    <?php echo wpautop($desc); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($col_2)) : ?>
                        <div class="data-item">
                            <?php if (!empty($title_2)) : ?>
                                <h2 class="data-item-title">
                                    <?php echo $title_2; ?>
                                </h2>
                            <?php endif; ?>

                            <?php if (!empty($subtitle_2)) : ?>
                                <div class="data-item-subtitle">
                                    <?php echo $subtitle_2; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($desc_2)) : ?>
                                <div class="data-item-desc">
                                    <?php echo wpautop($desc_2); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>