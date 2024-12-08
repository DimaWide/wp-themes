<?php

$tagline  = get_field('tagline');
$title    = get_field('title');
$subtitle = get_field('subtitle');

$list_text = get_field('list_text');


$products = get_field('products', 'option');
$product  = $products['product_1'];
?>
<!-- Acf Block #7 – Feature Cards -->
<div class="wcl-acf-block-7" id="feature-cards">
    <div class="data-container wcl-container">
        <div class="data-head">
            <?php if (!empty($tagline)) : ?>
                <div class="data-tagline">
                    <?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>

            <div class="data-img">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrows-down.svg'; ?>" alt="img">
            </div>
        </div>

        <?php if (have_rows('list_cards')) : ?>
            <div class="data-list">
                <?php while (have_rows('list_cards')) : the_row(); ?>
                    <?php
                    $style = get_sub_field('style');
                    $style = !empty($style) ? $style : 'image-right';
                    $style = 'mod-' . $style;
                    ?>
                    <div class="data-item <?php echo $style; ?>">
                        <div class="data-item-col">
                            <?php if (have_rows('group_1')) : ?>
                                <?php while (have_rows('group_1')) : the_row(); ?>
                                    <?php
                                    $title       = get_sub_field('title');
                                    $description = get_sub_field('description');
                                    ?>
                                    <?php if (!empty($list_text)) : ?>
                                        <div class="data-item-tagline">
                                            <?php echo $list_text; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($title)) : ?>
                                        <h3 class="data-item-title">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if (!empty($description)) : ?>
                                        <div class="data-item-description">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (have_rows('advantages')) : ?>
                                        <div class="data-item-advantages">
                                            <?php while (have_rows('advantages')) : the_row(); ?>
                                                <?php
                                                $title = get_sub_field('title');
                                                ?>
                                                <?php if (have_rows('list')) : ?>
                                                    <?php if (!empty($title)) : ?>
                                                        <div class="data-item-advantages-title">
                                                            <?php echo $title; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <ul class="data-item-advantages-list">
                                                        <?php while (have_rows('list')) : the_row(); ?>
                                                            <?php
                                                            $text = get_sub_field('text');
                                                            ?>
                                                            <?php if (!empty($text)) : ?>
                                                                <li class="data-item-advantages-item">
                                                                    <i class="fa-fw fas fa-angle-right"></i><?php echo $text; ?>
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>

                        <div class="data-item-col">
                            <?php if (have_rows('group_2')) : ?>
                                <?php while (have_rows('group_2')) : the_row(); ?>
                                    <?php
                                    $link   = get_sub_field('link');
                                    $link_2 = get_sub_field('link_2');

                                    $image  = get_sub_field('image');
                                    $image = wp_get_attachment_image($image, 'image-size-1');
                                    ?>
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-item-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($product)) : ?>
                                        <?php
                                        $link_url    = $link['url'];
                                        $link_title  = $link['title'];
                                        $link_target = $link['target'] ?: '_self';
                                        ?>
                                        <div class="data-item-link">
                                            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>?add-to-cart=<?php echo $product; ?>" class="wcl-cmp-button">
                                                <?php echo $link_title; ?>
                                                <i class="fa-fw fas fa-angle-double-right"></i>
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <?php if (!empty($link)) : ?>
                                            <?php
                                            $link_url    = $link['url'];
                                            $link_title  = $link['title'];
                                            $link_target = $link['target'] ?: '_self';
                                            ?>
                                            <div class="data-item-link">
                                                <a href="<?php echo $link_url; ?>" class="wcl-cmp-button js-popup-open" target="<?php echo $link_target; ?>">
                                                    <?php echo $link_title; ?>
                                                    <i class="fa-fw fas fa-angle-double-right"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($link_2)) : ?>
                                        <?php
                                        $link_url    = $link_2['url'];
                                        $link_title  = $link_2['title'];
                                        $link_target = $link_2['target'] ?: '_self';
                                        ?>
                                        <div class="data-item-link-2">
                                            <a href="<?php echo $link_url; ?>" class="wcl-button" target="<?php echo $link_target; ?>">
                                                <?php echo $link_title; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>