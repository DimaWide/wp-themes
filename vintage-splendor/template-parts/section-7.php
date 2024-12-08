<?php


$title = get_sub_field('title');
$link  = get_sub_field('link');
$logo  = get_field('logo_private', 'option');
$logo  = wp_get_attachment_image_url($logo, 'full');

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
);

$args['tax_query'] = [
    array(
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => 'splendor-collective',
    ),
];

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-section-7">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $tags  = get_the_terms($post->ID, 'post_tag');
                    $image = get_the_post_thumbnail($post->ID, 'image-size-3');

                    $tag_start    = '<div class="data-item-inner">';
                    $tag_end      = '</div>';
                    $access_state = 'mod-not-have-access';

                    if (wcl_is_subscriber()) {
                        $tag_start    = '<a href="' . get_permalink() . '" class="data-item-inner">';
                        $tag_end      = '</a>';
                        $access_state = 'mod-have-access';
                    }
                    ?>
                    <div class="data-item <?php echo $access_state; ?>">
                        <?php echo $tag_start; ?>

                        <div class="data-item-a">
                            <?php if (!empty($tags)) : ?>
                                <div class="data-item-cat wcl-link-cat">
                                    <?php echo $tags[0]->name; ?>
                                </div>
                            <?php endif; ?>

                            <div class="data-item-img">
                                <?php if (!empty($image)) : ?>
                                    <?php echo $image; ?>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($logo)) : ?>
                                <div class="data-item-logo">
                                    <?php echo file_get_contents($logo, false); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h3 class="data-item-title">
                            <?php echo get_the_title(); ?>
                        </h3>

                        <?php echo $tag_end; ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link">
                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                    <?php echo $link_title; ?>
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>