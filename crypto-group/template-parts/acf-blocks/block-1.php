<?php

$tagline         = get_field('tagline');
$title           = get_field('title');
$subtitle        = get_field('subtitle');


?>
<!-- Acf Block #1 – Hero -->
<div class="wcl-acf-block-1" id="hero">
    <div class="data-container wcl-container">
        <div class="data-head">
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

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php get_template_part('template-parts/components/cmp-1-cta'); ?>

        <?php if (have_rows('list')) : ?>
            <ul class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $name = get_sub_field('name');
                    ?>
                    <?php if (!empty($name)) : ?>
                        <li class="data-list-item">
                            <i class="fa-fw fas fa-check-circle"></i>
                            <?php echo $name; ?>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>