<?php


if (display_preview_image($block)) {
    return;
}

$title    = get_field('title');
$subtitle = get_field('subtitle');
$link     = get_field('link');

$args = array(
    'post_type'      => 'wcl-news',
    'posts_per_page' => 8,
);

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;

$class_one = '';

if ($post_count < 8) {
    $class_one = 'mod-less-8';
}
?>
<!-- Acf Block #6 – News -->
<div class="wcl-acf-block-6 <?php echo $class_one; ?>">
    <div class="data-container wcl-container">
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

        <?php if ($query_obj->have_posts()) : ?>
            <?php
            $counter = 0;
            global $post;
            ?>
            <div class="data-list-out">
                <div class="data-lines">
                    <div class="line-container" data-length="614" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="500" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="500" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="614" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1.5">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="160" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                </div>

                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $counter++;
                        $external_link = get_field('external_link', $post->ID);
                        $external_link = ! empty($external_link) ?  $external_link : '#';
                        $image         = get_the_post_thumbnail($post->ID, 'image-size-4');
                        ?>
                        <div class="data-item <?php echo 'post-' . $post->ID; ?>">
                            <a href="<?php echo $external_link; ?>" class="data-item-inner" target="_blank">
                                <div class="data-item-meta">
                                    <div class="data-item-author">
                                        <?php the_author(); ?>
                                    </div>

                                    <div class="data-item-date">
                                        <?php echo get_the_date('j M Y'); ?>
                                    </div>
                                </div>

                                <h3 class="data-item-title">
                                    <?php echo get_the_title(); ?>
                                </h3>

                                <div class="data-item-link">
                                    <div class="cmp-link">
                                        Learn More
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-2.svg'; ?>" alt="img">
                                    </div>
                                </div>

                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>

                        <?php if ($counter == 1 || $counter == 6): ?>
                            <div class="data-item mod-stub">
                            </div>
                        <?php endif; ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link">
                <div class="data-link-inner">
                    <a href="<?php echo $link_url; ?>" class="cmp-button" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>

                    <div class="line-container mod-6" data-length="130" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>