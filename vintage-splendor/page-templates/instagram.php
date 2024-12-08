<?php

/**
 * Template Name: Instagram Page
 */

get_header();

$curr_tag = get_query_var('stories_tag');

if (!empty($curr_tag) && $curr_tag !== 'instagram') {
    $curr_tag = get_term_by('slug', $curr_tag, 'post_tag');

    if (empty($curr_tag)) {
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}

$tags      = get_terms_by_post_type(['post_tag'], ['wcl-product']);
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
?>
<div class="wcl-shop-sc-1" data-tag-key="<?php echo $tag_key; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <h1 class="data-title">
                    <span>The</span> Shop
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
                                    <div class="data-nav-item swiper-slide">
                                        <a href="<?php echo site_url('/') . 'stories'; ?>" data-id="all">
                                            All
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="data-nav-item swiper-slide">
                                        <a href="<?php echo get_permalink() . $tag->slug; ?>" data-id="<?php echo $tag->slug; ?>">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>

                            <div class="data-nav-item swiper-slide active">
                                <a href="#" data-id="instagram">
                                    Instagram
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="wcl-shop-sc-1 mod-sticky" data-tag-key="<?php echo $tag_key; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <h1 class="data-title">
                    <span>The</span> Shop
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
                                    <div class="data-nav-item swiper-slide">
                                        <a href="<?php echo site_url('/') . 'stories'; ?>" data-id="all">
                                            All
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="data-nav-item swiper-slide">
                                        <a href="<?php echo get_permalink() . $tag->slug; ?>" data-id="<?php echo $tag->slug; ?>">
                                            <?php echo $tag->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>

                            <div class="data-nav-item swiper-slide active">
                                <a href="#" data-id="instagram">
                                    Instagram
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php
$splendor_collective = get_field('pages', 'option');
$splendor_collective = $splendor_collective['the_splendor_collective'];

?>
<div class="wcl-shop-sc-2">
    <div class="data-tab data-tab-1">
        <div class="data-container wcl-container">
            <div class="data-inner">
                <div class="data-list ">

                </div>
            </div>

            <div class="wcl-t4-load-more">
                <div class="t4-container">
                </div>

                <a href="<?php echo get_permalink($splendor_collective); ?>" class="wcl-link mod-gradient">
                    <span>Splendor Collective</span>
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="data-tab data-tab-2 active">
        <?php
        $shortcode = get_field('shop_instagram_shortcode', 'option');
        ?>
        <?php if (!empty($shortcode)) : ?>
            <div class="wcl-shop-instagram">
                <div class="d2-container wcl-container">
                    <div class="d2-inner">
                        <?php
                        echo do_shortcode($shortcode);
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
