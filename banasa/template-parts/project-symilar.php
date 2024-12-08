<?php

$pages            = get_field('pages', 'option');
$projects_listing = $pages['projects_listing'];

$args = array(
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'post__not_in'   => array(get_the_ID()),
);

$terms           = wp_get_post_terms($post->ID, 'project_category');
$categorie_slugs = [];

if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $key => $term) {
        $categorie_slugs[] = $term->slug;
    }
} else {
    return;
}

if (!empty($categorie_slugs)) {
    $args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $categorie_slugs,
        ),
    ];
}

$query_obj  = new WP_Query($args);
$post_count = $query_obj->post_count;
?>
<?php if (!empty($post_count)) : ?>
    <div class="wcl-project-symilar">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                <a href="<?php echo get_permalink($projects_listing); ?>">
                    <?php
                    if (function_exists('icl_t')) {
                        echo icl_t('banasa', 'see_more_projects', 'VER MÁS PROYECTOS');
                    } else {
                        echo 'VER MÁS PROYECTOS';
                    }
                    ?>
                </a>
            </h2>

            <?php if ($query_obj->have_posts()) : ?>
                <?php
                $count = -1;
                ?>
                <div class="data-slider-out">
                    <div class="data-slider swiper">
                        <div class="data-slider-inner swiper-wrapper">
                            <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                <?php
                                $count++;
                                $terms = wp_get_post_terms($post->ID, 'project_category');
                                $image = get_the_post_thumbnail($post->ID, 'image-size-2');
                                ?>
                                <div class="data-item swiper-slide <?php echo 'post-' . $post->ID; ?>">
                                    <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                        <div class="data-item-img">
                                            <div class="data-item-img-item">
                                                <?php if (!empty($image)) : ?>
                                                    <?php echo $image; ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="data-item-img-item mod-2">
                                                <?php if (!empty($image)) : ?>
                                                    <?php echo $image; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="data-item-b1">
                                            <h3 class="data-item-title">
                                                <?php echo get_the_title(); ?>
                                            </h3>

                                            <div class="data-item-b2">
                                                <div class="data-item-b2-col">
                                                    <?php if (!is_wp_error($terms) && !empty($terms)) : ?>
                                                        <div class="data-item-cat">
                                                            <?php echo $terms[0]->name; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="data-item-arrow">
                                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-right-2.svg', false); ?>
                                            </div>
                                        </div>
                                    </a>

                                    <?php if ($count === 0) : ?>
                                        <div class="data-slider-arrow">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-2.svg'; ?>" alt="img">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>