<?php

/**
 * Template Name: Stories Page
 */


$splendor_collective = get_field('pages', 'option');
$splendor_collective = $splendor_collective['the_splendor_collective'];

$curr_tag = get_query_var('stories_tag');

if (!empty($curr_tag)) {
    $curr_tag = get_term_by('slug', $curr_tag, 'post_tag');

    if (empty($curr_tag)) {
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}

$tags      = get_terms_by_post_type(['post_tag'], ['post']);
$tags_slug = wp_list_pluck($tags, 'slug');

$tag_all       = new stdClass();
$tag_all->slug = 'all';
$tag_all->name = 'All';
$tag_active    = $tag_all;

array_unshift($tags, $tag_all);

$tag_key = 0;
if (!empty($curr_tag)) {
    $tag_active = $curr_tag;
    $tag_key    = array_search($curr_tag->slug, $tags_slug);
}

get_header();
?>
<div class="wcl-stories-sc-1" data-tag-key="<?php echo $tag_key; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <h1 class="data-title">
                    Stories
                </h1>
            </div>

            <div class="data-col">
                <?php if (!empty($tags)) : ?>
                    <div class="data-nav swiper">
                        <div class="data-nav-inner swiper-wrapper">
                            <?php foreach ($tags as $key => $tag) : ?>
                                <?php
                                $tag_active_class = '';
                                if ($tag->slug == $tag_active->slug) {
                                    $tag_active_class = 'active';
                                }
                                ?>
                                <?php if ($tag->slug == 'all') : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo site_url('/') . 'stories'; ?>" data-id="all">
                                            All
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo get_permalink() . $tag->slug;; ?>" data-id="<?php echo $tag->slug; ?>">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="wcl-stories-sc-1 mod-sticky" data-tag-key="<?php echo $tag_key; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <h1 class="data-title">
                    Stories
                </h1>
            </div>

            <div class="data-col">
                <?php if (!empty($tags)) : ?>
                    <div class="data-nav swiper">
                        <div class="data-nav-inner swiper-wrapper">
                            <?php foreach ($tags as $key => $tag) : ?>
                                <?php
                                $tag_active_class = '';
                                if ($tag->slug == $tag_active->slug) {
                                    $tag_active_class = 'active';
                                }
                                ?>
                                <?php if ($tag->slug == 'all') : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo site_url('/') . 'stories'; ?>" data-id="all">
                                            All
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="data-nav-item swiper-slide <?php echo $tag_active_class; ?>">
                                        <a href="<?php echo get_permalink() . $tag->slug;; ?>" data-id="<?php echo $tag->slug; ?>">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php
$page_items = 4;
$paged      = $_POST['paged'] ? $_POST['paged'] : 1;
$offset     = ($paged - 1) * $page_items;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'offset'         => $offset,
    'post_status'    => 'publish',
);

if (!empty($tag_active) && $tag_active->slug != 'all') {
    $tax_query = array(
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $tag_active->slug,
        )
    );
    $args['tax_query'] = $tax_query;
}

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);

$name_cat = 'splendor-collective-stories';
if ($_SERVER["SERVER_ADDR"] != '127.0.0.1') {
    $name_cat = 'splendor-collective';
}

$empty_posts_class = '';
if (empty($query_obj->posts)) {
    $empty_posts_class = 'mod-empty-posts';
}

$odd_class = '';
if (count($query_obj->posts) % 2 !== 0) {
    $odd_class = 'mod-odd';
}
?>
<div class="wcl-stories-sc-2 js-wcl-stories-sc-2 <?php echo $empty_posts_class . ' ' . $odd_class; ?>">
    <div class="data-container wcl-container">
        <div class="data-list">
            <?php if ($query_obj->have_posts()) : ?>
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php get_template_part('template-parts/stories/item'); ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="data-list-empty wcl-label-empty">
                    Nothing found
                </div>
            <?php endif; ?>
        </div>

        <div class="wcl-stories-bl-1">
            <?php if (wcl_is_subscriber()) : ?>
                <a href="<?php echo get_term_link(CATS_EXCLUSIVE_ASSOC[$name_cat]); ?>" class="d1-btn">
                    splendor collective exclusive
                </a>
            <?php else : ?>
                <div class="d1-btn js-popup-1">
                    splendor collective exclusive
                </div>
            <?php endif; ?>
        </div>

        <?php
        $load_more_class = '';
        if (count($query_obj->posts) % 2 !== 0) {
            $load_more_class = 'mod-offset-clear';
        }
        ?>
        <div class="wcl-t4-load-more <?php echo $load_more_class; ?>">
            <div class="t4-container">
                <?php if ($pages_el > 1) : ?>
                    <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>">
                        More Stories
                    </button>
                <?php else : ?>
                    <button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
                        All Viewed
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-btn">
            <?php if (wcl_is_subscriber()) : ?>
                <a href="<?php echo get_term_link(CATS_EXCLUSIVE_ASSOC[$name_cat]); ?>" class="data-btn-item">
                    splendor collective exclusive
                </a>
            <?php else : ?>
                <div class="data-btn-item js-popup-1">
                    splendor collective exclusive
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>