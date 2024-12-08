<?php

$title        = get_field('title');
$subtitle     = get_field('subtitle');
$list_with    = get_field('list_with');
$list_without = get_field('list_without');
$group        = get_field('group');
?>
<!-- Acf Block #5 – With & Without -->
<div class="wcl-acf-block-5" id="with-and-without">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-head">
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
            </div>

            <div class="data-lists">
                <?php if (have_rows('list_without')) : ?>
                    <div class="data-block-1 mod-without">
                        <?php while (have_rows('list_without')) : the_row(); ?>
                            <?php
                            $title = get_sub_field('title');
                            ?>
                            <?php if (!empty($title)) : ?>
                                <h3 class="data-block-1-title">
                                    <?php echo $title; ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (have_rows('list')) : ?>
                                <ul class="data-block-1-list">
                                    <?php while (have_rows('list')) : the_row(); ?>
                                        <?php
                                        $text = get_sub_field('text');
                                        ?>
                                        <?php if (!empty($text)) : ?>
                                            <li class="data-block-1-item">
                                                <div class="data-block-1-item-text">
                                                    <i class="fa-fw fas fa-times-circle"></i>
                                                    <?php echo $text; ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('list_with')) : ?>
                    <div class="data-block-1 mod-with">
                        <?php while (have_rows('list_with')) : the_row(); ?>
                            <?php
                            $title = get_sub_field('title');
                            ?>
                            <?php if (!empty($title)) : ?>
                                <h3 class="data-block-1-title">
                                    <?php echo $title; ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (have_rows('list')) : ?>
                                <ul class="data-block-1-list">
                                    <?php while (have_rows('list')) : the_row(); ?>
                                        <?php
                                        $text = get_sub_field('text');
                                        ?>
                                        <?php if (!empty($text)) : ?>
                                            <li class="data-block-1-item">
                                                <div class="data-block-1-item-text">
                                                    <i class="fa-fw fas fa-check-circle"></i>
                                                    <?php echo $text; ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($group)) : ?>
                <?php
                $tagline = $group['tagline'];
                $title = $group['title'];
                ?>
                <div class="data-block-2">
                    <?php if (!empty($tagline)) : ?>
                        <div class="data-block-2-tagline">
                            <?php echo $tagline; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <h2 class="data-block-2-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php get_template_part('template-parts/components/cmp-1-cta'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>