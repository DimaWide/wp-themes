<?php

/**
 * Template Name: Home page
 */

get_header();

$page_content   = get_field('page_content');
$luxury_goods   = '';
$home_banner    = '';
$quote          = '';
$latest_video   = '';
$shop_favorites = '';
if (is_array($page_content)) {
    foreach ($page_content as $row_index => $layout) {
        if ($layout['acf_fc_layout'] == 'home_banner') {
            $home_banner = $layout;
        } elseif ($layout['acf_fc_layout'] == 'quote') {
            $quote = $layout;
        } elseif ($layout['acf_fc_layout'] == 'luxury_goods') {
            $luxury_goods = $layout;
        } elseif ($layout['acf_fc_layout'] == 'latest_video') {
            $latest_video = $layout;
        } elseif ($layout['acf_fc_layout'] == 'shop_favorites') {
            $shop_favorites = $layout;
        }
    }
}
?>

<?php
$args =  array(
    'layout' => $home_banner,
);
get_template_part('template-parts/home-banner', null, $args);
?>

<?php
$args =  array(
    'layout' => $quote,
);
get_template_part('template-parts/quote', null, $args);
?>

<?php
$offset = 0;
$posts_per_page = 3;
$args = array(
    'post_type'      => array('post', 'video'),
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
    'post_status'    => 'publish',
);
$posts_list_query = new WP_Query($args);
?>
<?php if ($posts_list_query->have_posts()) : ?>
    <div class="wlc-posts-list">
        <div class="data-container">
            <?php while ($posts_list_query->have_posts()) : $posts_list_query->the_post(); ?>
                <?php get_template_part('template-parts/posts-list-item'); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>

<?php
$args =  array(
    'layout' => $luxury_goods,
);
get_template_part('template-parts/luxury-goods', null, $args);
?>

<?php
$offset += $posts_per_page;
$posts_per_page = 2;

$args = array(
    'post_type'      => array('post', 'video'),
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
    'post_status'    => 'publish',
);

$posts_list_query = new WP_Query($args);
?>
<?php if ($posts_list_query->have_posts()) : ?>
    <div class="wlc-posts-list">
        <div class="data-container">
            <?php while ($posts_list_query->have_posts()) : $posts_list_query->the_post(); ?>
                <?php get_template_part('template-parts/posts-list-item'); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>

<?php
$args =  array(
    'layout' => $latest_video,
);
get_template_part('template-parts/latest-video', null, $args);
?>

<?php
$offset += $posts_per_page;
$posts_per_page = 2;
$args = array(
    'post_type'      => array('post', 'video'),
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
    'post_status'    => 'publish',
);
$posts_list_query = new WP_Query($args);
?>
<?php if ($posts_list_query->have_posts()) : ?>
    <div class="wlc-posts-list">
        <div class="data-container">
            <?php while ($posts_list_query->have_posts()) : $posts_list_query->the_post(); ?>
                <?php get_template_part('template-parts/posts-list-item'); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>
<?php
$args =  array(
    'layout' => $shop_favorites,
);
get_template_part('template-parts/shop-favorites', null, $args);
?>

<?php
$offset += $posts_per_page;
$posts_per_page = 2;

$args = array(
    'post_type'      => array('post', 'video'),
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
    'post_status'    => 'publish',
);

$posts_list_query = new WP_Query($args);
?>
<?php if ($posts_list_query->have_posts()) : ?>
    <div class="wlc-posts-list">
        <div class="data-container">
            <?php while ($posts_list_query->have_posts()) : $posts_list_query->the_post(); ?>
                <?php get_template_part('template-parts/posts-list-item'); ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>

<div class="wlc-view-more">
    <div class="data-container">
        <div class="data__link wcl-link-outer">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="wcl-link">
                View more
            </a>
        </div>
    </div>
</div>

<?php
get_footer();
