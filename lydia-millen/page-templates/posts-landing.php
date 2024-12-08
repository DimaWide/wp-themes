<?php

/**
 * Template Name: Posts Landing Page
 */

get_header();

$terms = get_terms([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'parent'     => 0,
    'exclude'    => 1,
]);

$term = get_queried_object();

$term_all       = new stdClass();
$term_all->slug = 'all';
$term_all->name = 'All';
$term_active    = $term_all;

array_unshift($terms, $term_all);

if (is_category()) {
    $term_active = get_queried_object();
}

$post_date   = date("Y-M");
$has_post    = '';
$count_month = 3;
?>
<div class="wcl-posts-landing">
    <h1 class="data-title">
        <div class="data-container wcl-container">
            <span>All</span> Posts
        </div>
    </h1>

    <div class="data-nav wcl-nav">
        <div class="d6-inner wcl-container">
            <div class="d6-list swiper">
                <div class="d6-list-inner swiper-wrapper">
                    <?php if (!empty($terms)) : ?>
                        <?php foreach ($terms as $key => $term) : ?>
                            <?php
                            $term_active_class = '';
                            if ($term->slug == $term_active->slug) {
                                $term_active_class = 'active';
                            }
                            ?>
                            <?php if ($term->slug == 'all') : ?>
                                <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                    <a href="<?php echo site_url('/') . 'posts-landing'; ?>" class="d6-item-link" data-id="all">
                                        All posts
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="d6-item swiper-slide <?php echo $term_active_class; ?>">
                                    <a href="<?php echo get_term_link($term->term_id); ?>" class="d6-item-link" data-id="<?php echo $term->slug; ?>">
                                        <?php echo $term->name; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="data-a">
        <div class="data-a-container wcl-container">
            <?php
            while ($count_month > 0) {
                $posts     = posts_landing_page_render_month($post_date, $term_active->slug);
                $post_date = $posts['post_date'];
                $post_date = date("Y-M", strtotime('-1 month', strtotime($post_date)));

                if (!empty($posts)) {
                    $count_month--;
                    echo $posts['posts'];
                }

                $has_post = posts_landing_page_if_has_post($post_date, $term_active->slug);
                if (empty($has_post)) {
                    break;
                }
            }
            ?>
        </div>
    </div>

    <div class="wcl-load-more">
        <div class="d2-container">
            <?php if (!empty($has_post)) : ?>
                <button class="d2-btn" data-post-date="<?php echo $post_date; ?>">
                    View More
                </button>
            <?php else : ?>
                <button class="d2-btn" data-post-date="<?php echo $post_date; ?>" disabled="true">
                    All Viewed
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
