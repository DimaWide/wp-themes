<?php

$stars    = get_field('stars');
$title    = get_field('title');
$subtitle = get_field('subtitle');
?>
<!-- Acf Block #3 – CF Love - Team -->
<div class="wcl-acf-block-3" id="cf-love-team">
    <div class="data-container wcl-container">
        <?php
        $args =  array(
            'custom-class' => 'mod-type-1',
        );
        get_template_part('template-parts/components/cmp-1-cta', '', $args);
        ?>

        <?php if (have_rows('options')) : ?>
            <div class="data-options">
                <div class="data-options-row">
                    <?php while (have_rows('options')) : the_row(); ?>
                        <?php
                        $icon = get_sub_field('icon');
                        $icon = wp_get_attachment_image($icon, 'image-size-2');
                        $name = get_sub_field('name');
                        ?>
                        <div class="data-options-item">
                            <?php if (!empty($icon)) : ?>
                                <div class="data-options-item-icon">
                                    <?php echo $icon; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($name)) : ?>
                                <div class="data-options-item-name">
                                    <?php echo $name; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $stars = round((float)$stars);
        ?>
        <?php if (!empty($stars)) : ?>
            <div class="data-stars">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                ?>
                    <?php if ($stars >= $i) : ?>
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/star-rate.svg'; ?>" alt="img">
                    <?php endif; ?>
                <?php
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($subtitle)) : ?>
            <div class="data-subtitle">
                <?php echo $subtitle; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('list_team')) : ?>
            <div class="data-grid">
                <?php while (have_rows('list_team')) : the_row(); ?>
                    <?php
                    $photo = get_sub_field('photo');
                    $photo = wp_get_attachment_image($photo, 'image-size-2');

                    $name           = get_sub_field('name');
                    $specialization = get_sub_field('specialization');
                    $description    = get_sub_field('description');
                    ?>
                    <div class="data-list-item data-grid-item">
                        <div class="data-list-item-inner">
                            <div class="data-list-item-b1">
                                <?php if (!empty($photo)) : ?>
                                    <div class="data-list-item-photo">
                                        <?php echo $photo; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="data-list-item-b1-col">
                                    <?php if (!empty($name)) : ?>
                                        <div class="data-list-item-name">
                                            <?php echo $name; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($specialization)) : ?>
                                        <div class="data-list-item-specialization">
                                            <?php echo $specialization; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if (!empty($description)) : ?>
                                <div class="data-list-item-description">
                                    <?php echo $description; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php get_template_part('template-parts/components/cmp-1-cta'); ?>
    </div>
</div>