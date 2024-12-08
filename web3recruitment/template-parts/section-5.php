<?php


$title = get_sub_field('title');
$desc = get_sub_field('desc');
?>
<div class="wcl-section-5">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <div class="data-row">
                <div class="data-col">
                    <?php if (!empty($desc)) : ?>
                        <div class="data-subtitle">
                            <?php echo wpautop($desc); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (have_rows('list')) : ?>
                    <div class="data-col">
                        <div class="data-list">
                            <?php while (have_rows('list')) : the_row(); ?>
                                <?php
                                $name = get_sub_field('name');
                                $icon  = get_sub_field('icon');
                                $icon = wp_get_attachment_image($icon, 'full');
                                ?>
                                <div class="data-item">
                                    <div class="data-item-icon">
                                        <?php echo $icon; ?>
                                    </div>

                                    <div class="data-item-name">
                                        <?php echo $name; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>