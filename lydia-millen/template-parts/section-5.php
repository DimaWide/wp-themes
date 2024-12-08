<?php


$logo_second = get_field('logo_second', 'option');
$logo_second = wp_get_attachment_image($logo_second, 'full');
$list        = get_sub_field('list');
$mod_count   = '';

if (count((array)$list) == 2) {
    $mod_count = 'mod-two';
} elseif (count((array)$list) == 1) {
    $mod_count = 'mod-one';
}
?>
<div class="wcl-section-5 <?php echo $mod_count; ?>">
    <div class="data-container">
        <?php if (have_rows('list')) : ?>
            <?php
            $counter = 0;
            ?>
            <div class="data-nav">
                <?php while (have_rows('list')) : the_row();
                    $counter++;
                    $active = '';
                    if ($counter == 1) {
                        $active = 'active';
                        $index = 'I.';
                    } elseif ($counter == 2) {
                        $index = 'II.';
                    } elseif ($counter == 3) {
                        $index = 'III.';
                    }
                ?>
                    <div class="data-nav-item <?php echo $active; ?>">
                        <div class="data-nav-item-index">
                            <span>
                                <?php echo $index; ?>
                            </span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('list')) : ?>
            <?php
            $counter = 0;
            ?>
            <div class="data-list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php
                    $counter++;
                    $info     = get_sub_field('info');
                    $title    = $info['title'];
                    $desc     = $info['desc'];
                    $link     = $info['link'];
                    $products = get_sub_field('products');
                    $active   = '';
                    $index    = '';
                    if ($counter == 1) {
                        $active = 'active';
                        $index = 'I.';
                    } elseif ($counter == 2) {
                        $index = 'II.';
                    } elseif ($counter == 3) {
                        $index = 'III.';
                    }
                    ?>
                    <div class="data-item <?php echo $active; ?>">
                        <div class="data-item-index">
                            <span>
                                <?php echo $index; ?>
                            </span>
                        </div>

                        <div class="data-item-inner">
                            <div class="data-item-a">
                                <?php if (!empty($logo_second)) : ?>
                                    <div class="data-item-a-logo">
                                        <?php echo $logo_second; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($title)) : ?>
                                    <h3 class="data-item-a-title">
                                        <?php echo $title; ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($desc)) : ?>
                                    <div class="data-item-a-desc">
                                        <div class="data-item-a-desc-inner">
                                            <?php echo wpautop($desc); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($link)) : ?>
                                    <?php
                                    $link_url    = $link['url'];
                                    $link_title  = $link['title'];
                                    $link_target = $link['target'] ?: '_self';
                                    ?>
                                    <div class="data-item-a-link">
                                        <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                            <?php echo $link_title; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php
                            $products = get_sub_field('products');
                            $args = array(
                                'post_type'           => 'cd-product',
                                'posts_per_page'      => 3,
                                'post__in'            => $products,
                                'orderby'             => 'post__in',
                                'ignore_sticky_posts' => 1,
                                'post_status'         => ['publish'],
                            );

                            $query_obj   = new WP_Query($args);
                            $total_count = $query_obj->found_posts;
                            ?>
                            <?php if ($query_obj->have_posts()) : ?>
                                <?php
                                $product_counter = 0;
                                ?>
                                <div class="data-item-b">
                                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                        <?php
                                        $image = get_the_post_thumbnail($post->ID, 'image-size-2');
                                        $link  = get_field('link');
                                        $product_counter++;
                                        ?>
                                        <div class="data-item-c">
                                            <a href="<?php echo $link; ?>" class="data-item-c-inner" target="_blank" onclick="gtag('event', '<?php echo $link; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($post->ID); ?>' })">
                                                <div class="data-item-c-a">
                                                    <div class="data-item-c-num">
                                                        <?php echo 'N°' . $product_counter; ?>
                                                    </div>

                                                    <h4 class="data-item-c-title">
                                                        <?php echo get_the_title(); ?>
                                                    </h4>
                                                </div>

                                                <?php if (!empty($image)) : ?>
                                                    <div class="data-item-c-img">
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
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>