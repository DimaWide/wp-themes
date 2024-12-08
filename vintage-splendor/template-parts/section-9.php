<?php


$stories = get_field('pages', 'option');
$stories = $stories['stories'];

$title    = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$style    = get_sub_field('style');

if ($style == 'two') {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
    );

    $args['tax_query'] = [
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => 'splendor-collective',
        ),
    ];

    $query_obj = new WP_Query($args);

    $posts = $query_obj->posts;
} else {
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
            'operator' => 'NOT IN'
        ),
    ];

    $query_obj_1 = new WP_Query($args);

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

    $query_obj_2 = new WP_Query($args);

    $posts = array_merge($query_obj_1->posts, $query_obj_2->posts);
    shuffle($posts);
}

$odd_class = '';
if (count($posts) % 2 !== 0) {
    $odd_class = 'mod-odd';
}
?>
<?php if ($style == 'two') : ?>
    <div class="wcl-section-9 mod-two <?php echo $odd_class; ?>">
        <div class="data-container wcl-container">
            <div class="data-a mod-mobile">
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>

                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            </div>

            <?php if (!empty($posts)) : ?>
                <?php
                $count = 0;
                $col_1 = '';
                $col_2 = '';
                ?>
                <?php foreach ($posts as $key => $post_item) : ?>
                    <?php
                    $count++;
                    global $post;
                    $post = $post_item;
                    setup_postdata($post_item);

                    if ($count % 2 == 0) {
                        ob_start();
                        get_template_part('template-parts/stories/item');
                        $col_2 .= ob_get_clean();
                    } else {
                        ob_start();
                        get_template_part('template-parts/stories/item');
                        $col_1 .= ob_get_clean();
                    }
                    ?>
                <?php endforeach;
                wp_reset_postdata();
                ?>
                <div class="data-row">
                    <div class="data-col">
                        <?php echo $col_1; ?>
                    </div>

                    <div class="data-col">
                        <div class="data-a mod-desktop">
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>

                            <div class="data-subtitle">
                                <?php echo $subtitle; ?>
                            </div>
                        </div>

                        <?php echo $col_2; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>
    <div class="wcl-section-9 <?php echo $odd_class; ?>">
        <div class="data-container wcl-container">
            <div class="data-a mod-mobile">
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>

                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            </div>

            <?php if (!empty($posts)) : ?>
                <?php
                $count = 0;
                $col_1 = '';
                $col_2 = '';
                ?>
                <?php foreach ($posts as $key => $post_item) : ?>
                    <?php
                    $count++;
                    global $post;
                    $post = $post_item;
                    setup_postdata($post_item);

                    if ($count % 2 == 0) {
                        ob_start();
                        get_template_part('template-parts/stories/item');
                        $col_2 .= ob_get_clean();
                    } else {
                        ob_start();
                        get_template_part('template-parts/stories/item');
                        $col_1 .= ob_get_clean();
                    }
                    ?>
                <?php endforeach;
                wp_reset_postdata();
                ?>
                <div class="data-row">
                    <div class="data-col">
                        <?php echo $col_1; ?>
                    </div>

                    <div class="data-col">
                        <div class="data-a mod-desktop">
                            <h2 class="data-title">
                                <?php echo $title; ?>
                            </h2>

                            <div class="data-subtitle">
                                <?php echo $subtitle; ?>
                            </div>
                        </div>

                        <?php echo $col_2; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="data-link">
                <a href="<?php echo get_permalink($stories); ?>" class="wcl-link">
                    All Stories
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>