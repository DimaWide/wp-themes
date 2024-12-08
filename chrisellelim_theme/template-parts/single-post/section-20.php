<?php


$paged      = 1;
$page_items = 3;
$offset     = ($paged - 1) * $page_items;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'post_status'    => 'publish',
);

$term_list = get_the_terms($post->ID, 'category');

if (!empty($term_list)) {
    $tax_query = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $term_list[0]->slug,
        )
    );
    $args['tax_query'] = $tax_query;
}

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;

if (empty($total_count)) {
    unset($args['tax_query']);
    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
}

$pages_el = ceil(($total_count - $offset) / $page_items);
$count    = 0;
?>
<div class="wcl-section-20">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-a data-col">
                <h2 class="data-a-title">
                    <p>You might</p>
                    <p>Also like</p>
                </h2>
            </div>

            <div class="data-b data-col">
                <?php if ($query_obj->have_posts()) : ?>
                    <div class="data-b-list">
                        <div class="data-b-arrow">
                            Scroll me
                        </div>

                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $count++;
                            $thumbnail = get_the_post_thumbnail($post->ID, 'image-q');
                            $term_list = get_the_terms($post->ID, 'category');
                            $title     = get_the_title();
                            ?>
                            <div class="data-b-item">
                                <div class="data-b-item-inner">
                                    <?php if (!empty($count)) : ?>
                                        <div class="data-b-item-index">
                                            <?php echo $count; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="data-b-item-b">
                                        <h3 class="data-b-item-title">
                                            <a href="<?php echo get_permalink(); ?>">
                                                <?php
                                                $val = explode("\n", wordwrap($title, 45));
                                                $title_2 = array_shift($val);
                                                if (strlen($title) > 45) {
                                                    $title_2 .= '...';
                                                }
                                                ?>
                                                <span>
                                                    <?php echo $title_2; ?>
                                                </span>
                                                <span>
                                                    <?php echo $title; ?>
                                                </span>
                                            </a>
                                        </h3>

                                        <div class="data-b-item-cat">
                                            <?php if (!empty($term_list)) : ?>
                                                <?php foreach ($term_list as $key => $value) : ?>
                                                    <a href="<?php echo get_term_link($value->term_id); ?>" class="data-b-item-cat-link">
                                                        <?php if (count($term_list) - 1 !=  $key) : ?>
                                                            <?php echo strtolower($value->name) . ','; ?>
                                                        <?php else : ?>
                                                            <?php echo strtolower($value->name); ?>
                                                        <?php endif; ?>
                                                    </a>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="data-b-item-img">
                                        <?php if (!empty($thumbnail)) : ?>
                                            <?php echo $thumbnail; ?>
                                            <?php echo $thumbnail; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>