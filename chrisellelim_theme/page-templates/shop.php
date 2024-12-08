<?php

/**
 * Template Name: Shop Thing page
 */

get_header();


$outfit_page = get_field('outfit_page', 'option');
$thing_page = get_field('thing_page', 'option');
$phlur_page = get_field('phlur_page', 'option');

$title       = get_field('title');
$list_static = get_field('list');
//var_dump( $list_static[1]);
$phlur       = get_field('phlur');
$phlur_img   = $phlur['images'];
$phlur_logo  = $phlur['logo'];
$phlur_link  = $phlur['link'];
$phlur_img   = wp_get_attachment_image($phlur_img);
$phlur_logo  = wp_get_attachment_image($phlur_logo);

$terms = get_terms([
    'taxonomy'   => 'shop_category',
    'hide_empty' => false,
    'parent'     => 0,
]);

$occasions = get_terms([
    'taxonomy'   => 'shop_occasion',
    'hide_empty' => false,
    'parent'     => 0,
]);

$term_all       = new stdClass();
$term_all->slug = 'all';
$term_all->name = 'All';
$term_active    = $term_all;
$paged          = 1;
$page_items     = 7;
$offset         = ($paged - 1) * $page_items;
$cycle          = ['counter' => 0, 'cycle_trig' => 0, 'switcher' => true, 'multi' => -1];

array_unshift($terms, $term_all);

if (is_tax()) {
    $term_active = get_queried_object();
}

$args = array(
    'post_type'      => 'shop',
    'posts_per_page' => $page_items,
    'paged'          => $paged,
    'offset'         => $offset,
    'post_status'    => 'publish',
);

if (!empty($term_active) && $term_active->slug != 'all') {
    $tax_query = array(
        array(
            'taxonomy' => 'shop_category',
            'field'    => 'slug',
            'terms'    => $term_active->slug,
        )
    );
    $args['tax_query'] = $tax_query;
}

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
?>
<div class="wcl-shop mod-shop-things">
    <div class="data-conainer wcl-container">
        <h1 class="data-title">
            <?php echo $title; ?>
        </h1>

        <div class="data-nav">
            <?php if (!empty($terms)) : ?>
                <div class="data-nav-1">
                    <div class="data-nav-1-view">
                        <span>
                            <span>Filter</span>
                        </span>
                        <span>
                            <span><i class="fa-sharp fa-solid fa-plus"></i></span>
                            <span><i class="fa-sharp fa-solid fa-minus"></i></span>
                        </span>
                    </div>

                    <div class="data-nav-1-tax mod-category active">
                        <h2 class="data-nav-1-tax-title">
                            CATEGORIES
                        </h2>

                        <ul class="data-nav-1-tax-list">
                            <?php foreach ($terms as $key => $term) : ?>
                                <?php
                                $term_active_class = '';
                                if ($term->slug == $term_active->slug) {
                                    $term_active_class = 'active';
                                }
                                ?>
                                <?php if ($term->slug != 'all') : ?>
                                    <li class="data-nav-1-tax-item <?php echo $term_active_class; ?>">
                                        <a href="<?php echo get_term_link($term->term_id); ?>" class="data-nav-1-tax-item-link" data-id="<?php echo $term->slug; ?>">
                                            <?php echo $term->name; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <div class="data-nav-1-tax mod-occasion">
                        <h2 class="data-nav-1-tax-title">
                            OCCASIONS
                        </h2>

                        <ul class="data-nav-1-tax-list">
                            <?php foreach ($occasions as $key => $term) : ?>
                                <?php if ($term->slug != 'all') : ?>
                                    <li class="data-nav-1-tax-item <?php echo $term_active_class; ?>">
                                        <a href="<?php echo get_term_link($term->term_id); ?>" class="data-nav-1-tax-item-link" data-id="<?php echo $term->slug; ?>">
                                            <?php echo $term->name; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach ?>
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

                        <li class="data-nav-2-item active">
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
            <?php endif; ?>
        </div>

        <div class="data-list">
            <?php if ($query_obj->have_posts()) : ?>
                <?php
                $counter = $cycle['counter'];
                ?>
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $counter++;
                    // $multi = 1;
                    if ($cycle['switcher'] == true) {
                        $cycle['switcher'] = false;
                        $cycle['multi'] = $cycle['multi'] + 1;
                        $style = wcl_gen_style($cycle['multi'], $cycle['cycle_trig']);
                        $cycle['cycle_trig'] = $cycle['cycle_trig'] + 12;
                    }
                    if ($counter % ($cycle['cycle_trig'])  == 0) {
                        $cycle['switcher'] = true;
                    }
                    set_query_var('shop_counter', $counter);
                    $args =  array(
                        'cycle'       => $cycle,
                        'phlur'       => $phlur,
                        'style'       => $style,
                        'list_static' => $list_static,
                    );
                    get_template_part('template-parts/shop/item', null, $args);
                    $style = '';
                    $cycle['counter'] = get_query_var('shop_counter');
                    $counter = $cycle['counter'];
                    ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <div class="wcl-load-more">
            <div class="data-container">
                <?php if ($pages_el > 1) : ?>
                    <button class="data-btn" data-cycle="<?php echo esc_attr(json_encode($cycle)); ?>" data-page="<?php echo $paged; ?>">
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
