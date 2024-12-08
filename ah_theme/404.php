<?php

get_header();

$data_404    = get_field('data_404', 'option');

$group_1     = $data_404['group_1'];
$tagline     = $group_1['tagline'];
$title       = $group_1['title'];
$description = $group_1['description'];

$group_2 = $data_404['group_2'];
$image   = $group_2['image'];
$image   = wp_get_attachment_image($image, 'full');
?>
<div class="wcl-404">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($tagline)) : ?>
                    <div class="data-tagline">
                        <?php echo $tagline; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <h1 class="data-title">
                        <?php echo $title; ?>
                    </h1>
                <?php endif; ?>

                <?php if (!empty($description)) : ?>
                    <div class="data-desc">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/sections/latest-posts'); ?>

<?php
get_footer();
?>