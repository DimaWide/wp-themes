<?php

$posts = get_sub_field('posts');
$group = get_sub_field('group');
$group_subtitle = $group['subtitle'];
$group_title    = $group['title'];
$group_link     = $group['link'];

if (empty($posts)) {
    $posts = [''];
}

$args = array(
    'post_type'   => 'post',
    'post__in'    => $posts,
    'orderby'     => 'post__in',
    'post_status' => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-section-21">
    <div class="data-container wcl-container">
        <div class="data-c">
            <?php if (!empty($group_subtitle)) : ?>
                <div class="data-c-subtitle">
                    <?php echo $group_subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($group_title)) : ?>
                <h3 class="data-c-title">
                    <?php echo $group_title; ?>
                </h3>
            <?php endif; ?>
        </div>


        <div class="data-list swiper">
            <div class="data-list-inner swiper-wrapper">
                <?php if (!empty($group)) : ?>

                    <div class="data-item data-item-2 swiper-slide">
                        <div class="data-obj1 mod-v2">
                            <div class="data-obj1-inner">
                                <div class="data-obj1-b">
                                    <div class="data-obj1-b-col">
                                        <?php if (!empty($group_subtitle)) : ?>
                                            <div class="data-obj1-brand">
                                                <?php echo $group_subtitle; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($group_title)) : ?>
                                            <h3 class="data-obj1-title">
                                                <?php echo $group_title; ?>
                                            </h3>
                                        <?php endif; ?>
                                    </div>

                                    <div class="data-obj1-b-col">
                                        <?php if (!empty($group_link)) : ?>
                                            <?php
                                            $link_url    = $group_link['url'];
                                            $link_title  = $group_link['title'];
                                            $link_target = $group_link['target'] ?: '_self';
                                            ?>
                                            <div class="data-obj1-link">
                                                <a href="<?php echo $link_url; ?>" class="wcl-link mod-black-to-white" target="<?php echo $link_target; ?>">
                                                    <?php echo $link_title; ?>
                                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($query_obj->have_posts()) : ?>
                    <?php
                    $count = 0;
                    ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $count++;
                        $image    = get_the_post_thumbnail($post->ID, 'image-size-4');
                        $category = get_the_terms($post->ID, 'category');
                        ?>
                        <div class="data-item swiper-slide">
                            <div class="data-obj1">
                                <a href="<?php echo get_permalink(); ?>" class="data-obj1-inner">
                                    <div class="data-obj1-a">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-obj1-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="data-obj1-b">
                                        <div class="data-obj1-b-col">
                                            <?php if (!empty($category)) : ?>
                                                <div class="data-obj1-brand">
                                                    <?php echo $category[0]->name; ?>
                                                </div>
                                            <?php endif; ?>

                                            <h3 class="data-obj1-title">
                                                <?php echo get_the_title(); ?>
                                            </h3>
                                        </div>

                                        <div class="data-obj1-b-col">
                                            <div class="data-obj1-link">
                                                <div class="wcl-link mod-black-to-white">
                                                    Shop now
                                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-obj1-logo">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo_private_black.svg'; ?>" alt="img">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-c">
            <?php if (!empty($group_link)) : ?>
                <?php
                $link_url    = $group_link['url'];
                $link_title  = $group_link['title'];
                $link_target = $group_link['target'] ?: '_self';
                ?>
                <div class="data-c-link">
                    <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>