<?php

$class_block = '';

if (!empty($args)) {
    $class_block = $args['classNameBlock'];
}

$title = get_field('title');

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 3,
];

$query_obj = new WP_Query($args);
?>
<!-- Acf Block #5 – Останні події -->
<div class="wcl-acf-block-5 <?php echo $class_block; ?>">
    <div class="data-container wcl-container">
        <div class="cmp-1-heading">
            <?php if (!empty($title)) : ?>
                <h2 class="cmp-title cmp1-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <div class="cmp1-link">
                <a href="<?php echo get_post_type_archive_link('post'); ?>" class="cmp-button mod-hover-2">Всі новини</a>
            </div>
        </div>

        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list-out">
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/components/post-item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="data-link">
            <a href="<?php echo get_post_type_archive_link('post'); ?>" class="cmp-button">Всі новини</a>
        </div>
    </div>
</div>