<?php

/**
 * Template Name: Videos Page
 */

get_header();

$outfit_page = get_field('outfit_page', 'option');
$thing_page = get_field('thing_page', 'option');
$phlur_page = get_field('phlur_page', 'option');

$paged      = 1;
$page_items = get_option( 'posts_per_page' );
$offset     = ($paged - 1) * $page_items;

if (is_tax()) {
    $term_active = get_queried_object();
}

$args = array(
    'post_type'      => 'video',
    'posts_per_page' => $page_items,
    'paged'          => $paged,
    'offset'         => $offset,
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
?>
<div class="wcl-shop wcl-videos">
    <div class="data-conainer wcl-container">
        <h1 class="data-title">
            <?php echo get_the_title(); ?>
        </h1>

        <div class="data-nav">
            <div class="data-nav-1">
                <div class="d5-nav-1-tax mod-category active">
                    <ul class="d5-nav-1-tax-list">
                        <li class="d5-nav-1-tax-item active">
                            <a href="#" class="d5-nav-1-tax-item-link" data-id="all">
                                All Videos
                            </a>
                        </li>

                        <li class="d5-nav-1-tax-item">
                            <a href="#" class="d5-nav-1-tax-item-link" data-id="youtube">
                                Youtube
                            </a>
                        </li>

                        <li class="d5-nav-1-tax-item">
                            <a href="#" class="d5-nav-1-tax-item-link" data-id="tiktok">
                                TikTok
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="data-nav-2">
                <ul class="data-nav-2-list">
                    <li class="data-nav-2-item">
                        <a href="<?php echo get_permalink($outfit_page); ?>" class="data-nav-2-item-link">
                            Outfits
                        </a>

                    </li>

                    <li class="data-nav-2-item">
                        <a href="<?php echo get_permalink($thing_page); ?>" class="data-nav-2-item-link">
                            Things I'm Loving
                        </a>
                    </li>

                    <li class="data-nav-2-item">
                        <?php if (!empty($phlur_page)) : ?>
                            <?php
                            $link_url    = $phlur_page['url'];
                            $link_title  = $phlur_page['title'];
                            $link_target = $phlur_page['target'] ?: '_self';
                            ?>
                            <a href="<?php echo $link_url; ?>" class="data-nav-2-item-link" target="<?php echo $link_target; ?>">
                                <?php echo $link_title; ?>
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>

        <?php if ($query_obj->have_posts()) : ?>
            <?php
            $count = $offset;
            ?>
            <div class="d5-list">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $count++;
                    $align = 'left';
                    if ($count % 2 == 0) {
                        $align = 'right';
                    }
                    $args =  array(
                        'align' => $align,
                    );
                    ?>
                    <?php get_template_part('template-parts/videos/item', null, $args); ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div class="d5-list-empty">No Found</div>
        <?php endif; ?>

        <div class="wcl-load-more">
            <div class="data-container">
                <?php if ($pages_el > 1) : ?>
                    <button class="data-btn" data-page="<?php echo $paged; ?>">
                        Load more
                    </button>
                <?php else : ?>
                    <button class="data-btn" data-page="<?php echo $paged; ?>" disabled="true">
                        All Viewed
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
