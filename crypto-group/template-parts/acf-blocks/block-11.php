<?php

$title       = get_field('title');
$description = get_field('description');
$cta_title   = get_field('cta_title');
?>
<!-- Acf Block #11 – Could You Be The Next ‘Two Comma Club’ Award Winner? -->
<div class="wcl-acf-block-11" id="two-comma-club">
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

        <?php if (have_rows('list')) : ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $image = get_sub_field('image');
                    $image = wp_get_attachment_image($image, 'full');

                    $text_1 = get_sub_field('text_1');
                    $text_2 = get_sub_field('text_2');
                    ?>
                    <div class="data-item">
                        <div class="data-item-inner">
                            <?php if (!empty($image)) : ?>
                                <div class="data-item-img">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($text_1) || !empty($text_2)) : ?>
                                <div class="data-item-info">
                                    <?php if (!empty($text_1)) : ?>
                                        <div class="data-item-text-1">
                                            <?php echo $text_1; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($text_2)) : ?>
                                        <div class="data-item-text-2">
                                            <?php echo $text_2; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>



        <?php if (!empty($cta_title)) : ?>
            <div class="data-cta-title">
                <?php echo $cta_title; ?>
            </div>
        <?php endif; ?>

        <?php
        $args =  array(
            // 'custom-class' => 'mod-type-1',
        );
        get_template_part('template-parts/components/cmp-1-cta', '', $args);
        ?>

    </div>
</div>