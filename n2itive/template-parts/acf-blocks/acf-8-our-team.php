<?php


$title = get_field('title');
?>
<!-- acf-8-our-team -->
<div class="acf-8-our-team">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <div class="data-list-out">
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $specialization = get_sub_field('specialization');
                    $name           = get_sub_field('name');
                    $description    = get_sub_field('description');

                    $picture = get_sub_field('picture');
                    $picture = wp_get_attachment_image($picture, 'full');
                    ?>
                    <div class="data-item">
                        <div class="data-item-inner">
                            <?php if (!empty($picture)) : ?>
                                <div class="data-item-picture">
                                    <?php echo $picture; ?>
                                </div>
                            <?php endif; ?>

                            <div class="data-item-info">
                                <?php if (!empty($specialization)) : ?>
                                    <div class="data-item-specialization">
                                        <?php echo $specialization; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($name)) : ?>
                                    <div class="data-item-name">
                                        <?php echo $name; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($description)) : ?>
                                    <div class="data-item-desc">
                                        <?php echo $description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            </div>
        <?php endif; ?>
    </div>
</div>