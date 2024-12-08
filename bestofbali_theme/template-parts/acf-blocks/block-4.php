<?php

$group_1  = get_field('group_1');
$title    = $group_1['title'];
$subtitle = $group_1['subtitle'];
$desc     = $group_1['desc'];

$group_2 = get_field('group_2');

$select_by = $group_2['select_by'];
$select_by = !empty($select_by) ? $select_by : '';
?>
<!-- Acf Block #4 - Immerse Yourself in the Essence of Balinese Traditions -->
<div class="wcl-acf-block-4 wcl-section">
    <div class="data-imgs">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_4_img_1.png'; ?>" alt="img">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_4_img_2.png'; ?>" alt="img">
    </div>

    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="wcl-block-1 data-head">
                    <?php if (!empty($subtitle)) : ?>
                        <div class="m1-subtitle">
                            <?php echo $subtitle; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <h2 class="m1-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($desc)) : ?>
                        <div class="m1-desc">
                            <?php echo $desc; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php
                $args = '';
                $query_obj = [];

                if ($select_by == 'one') {
                    $list = $group_2['list'];

                    if (empty($list)) {
                        $list = [''];
                    }

                    $args = array(
                        'post_type'      => 'page',
                        'posts_per_page' => 4,
                        'post__in'       => $list,
                        'orderby'        => 'post__in',
                        'post_status'    => 'publish',
                    );
                } elseif ($select_by == 'category') {
                    $category_id = $group_2['category'];

                    $args = array(
                        'post_type'      => 'page',
                        'posts_per_page' => 4,
                        'post_status'    => 'publish',
                    );

                    $tax_query = array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'id',
                            'terms'    => $category_id,
                        )
                    );
                    $args['tax_query'] = $tax_query;
                }

                $query_obj   = new WP_Query($args);
                $total_count = $query_obj->found_posts;
                ?>
                <?php if ($query_obj->have_posts()) : ?>
                    <div class="data-list">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $image = get_the_post_thumbnail($post->ID, 'image-size-2');
                            ?>
                            <div class="wcl-block-2 data-item">
                                <a href="<?php echo get_permalink(); ?>" class="m2-inner">
                                    <div class="m2-info">
                                        <h3 class="m2-title">
                                            <?php echo get_the_title(); ?>
                                        </h3>
                                    </div>

                                    <?php if (!empty($image)) : ?>
                                        <div class="m2-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>