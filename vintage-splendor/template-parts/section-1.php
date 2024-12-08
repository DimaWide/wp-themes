<?php


$text_1 = get_sub_field('text_1');
$text_2 = get_sub_field('text_2');
$logo   = get_field('logo_text', 'option');
$logo   = wp_get_attachment_image($logo, 'full');
$logo_2 = get_field('logo', 'option');
$logo_2 = wp_get_attachment_image($logo_2, 'full');

$splendor_collective = get_field('pages', 'option');
$splendor_collective = $splendor_collective['the_splendor_collective'];

$args = array(
    'numberposts' => 1,
    'post_type'   => 'post'
);

$posts_data = get_posts($args);
?>
<?php if (!empty($posts_data)) : ?>
    <?php
    $post_item = $posts_data[0];
    $image     = get_the_post_thumbnail($post_item->ID, 'image-size-1');
    ?>
    <div class="wcl-section-1">
        <div class="wcl-header wcl-header-t-2">
            <div class="data-container">
                <div class="data-row">
                    <div class="data-col">
                        <div class="wcl-t3-btn-menu">
                            <div class="t3-text">
                                <span>
                                    Menu
                                </span>

                                <span>
                                    Close
                                </span>
                            </div>

                            <div class="t3-img">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd_menu_ico.svg'; ?>" alt="img">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/popup_close.svg'; ?>" alt="img">
                            </div>
                        </div>
                    </div>

                    <div class="data-col">
                        <div class="data-logo">
                            <a href="<?php echo site_url('/'); ?>">
                                <?php if (!empty($logo_2)) : ?>
                                    <?php echo $logo_2; ?>
                                <?php else :
                                    echo get_bloginfo('name');
                                endif; ?>
                            </a>
                        </div>
                    </div>

                    <div class="data-col">
                        <div class="data-btns">
                            <div class="data-btns-item">
                                <?php get_template_part('template-parts/search-form'); ?>
                            </div>

                            <div class="data-btns-item">
                                <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="data-btns-sign wcl-t2-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/sign.svg'; ?>" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d1-container wcl-container">
            <div class="d1-b">
                <div class="d1-b-row">
                    <div class="d1-b-col">
                        <div class="d1-b-logo">
                            <a href="<?php echo site_url('/'); ?>">
                                <?php if (!empty($logo)) : ?>
                                    <?php echo $logo; ?>
                                <?php else :
                                    echo get_bloginfo('name');
                                endif; ?>
                            </a>
                        </div>
                    </div>

                    <div class="d1-b-col">
                        <div class="d1-c">
                            <?php get_template_part('template-parts/search-form'); ?>

                            <div class="d1-c-sign">
                                <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="wcl-t2-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/sign.svg'; ?>" alt="img">
                                </a>
                            </div>

                            <div class="d1-c-btn wcl-t6-link">
                                <div class="t6-inner">
                                    <a href="<?php echo get_permalink($splendor_collective); ?>" class="t6-inner-b wcl-link mod-gradient">
                                        <div class="t6-text">
                                            <span class="mod-1">Splendor Collective</span>
                                            <span class="mod-2">Learn more</span>
                                        </div>
                                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d1-item">
                <div class="d1-item-inner">
                    <?php if (!empty($image)) : ?>
                        <div class="d1-item-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <div class="d1-item-content">
                        <div class="d1-item-subtitle">
                            Read THE LATEST
                        </div>

                        <h2 class="d1-item-title">
                            <?php echo get_the_title($post_item->ID); ?>
                        </h2>

                        <div class="d1-item-link">
                            <a href="<?php echo get_permalink($post_item->ID); ?>" class="wcl-link">
                                Read now
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d1-a">
                <?php if (!empty($text_1)) : ?>
                    <div class="d1-a-text-1">
                        <?php echo $text_1; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($text_2)) : ?>
                    <div class="d1-a-text-2">
                        <?php echo $text_2; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>