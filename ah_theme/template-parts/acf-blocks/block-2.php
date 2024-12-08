<?php


$cases = get_field('cases', 'option');
$label = $cases['label'];
$title = $cases['title'];
?>
<!-- Acf Block #2 – Cases -->
<div class="wcl-acf-block-2">
    <div class="data-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-b1">
                    <?php if (!empty($label)) : ?>
                        <div class="data-label">
                            <?php echo $label; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                        <div class="data-title">
                            <?php echo $title; ?>
                        </div>
                    <?php endif; ?>

                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-left.svg', false); ?>
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/dark-arrow-left.svg', false); ?>
                        </div>

                        <div class="data-list-nav-btn mod-next">
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-left.svg', false); ?>
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/dark-arrow-left.svg', false); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-col">
                <?php if (have_rows('cases', 'option')) : ?>
                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php while (have_rows('cases', 'option')) : the_row(); ?>
                                <?php if (have_rows('list')) : ?>
                                    <?php while (have_rows('list')) : the_row(); ?>
                                        <?php
                                        $logo_for_light_theme = get_sub_field('logo_for_light_theme');
                                        $logo_for_light_theme = wp_get_attachment_image_url($logo_for_light_theme, 'full');
                                        $logo_for_dark_theme = get_sub_field('logo_for_dark_theme');
                                        $logo_for_dark_theme = wp_get_attachment_image_url($logo_for_dark_theme, 'full');
                                        $title = get_sub_field('title');
                                        $desc  = get_sub_field('desc');
                                        ?>
                                        <div class="data-item js-post-item swiper-slide">
                                            <div class="data-item-inner">
                                                <?php if (!empty($logo_for_light_theme || $logo_for_dark_theme)) : ?>
                                                    <div class="data-item-logo">
                                                        <?php if (!empty($logo_for_light_theme)) : ?>
                                                            <div class="data-item-logo-item mod-light">
                                                                <?php echo get_new_attr_for_image($logo_for_light_theme); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (!empty($logo_for_dark_theme)) : ?>
                                                            <div class="data-item-logo-item mod-dark">
                                                                <?php echo get_new_attr_for_image($logo_for_dark_theme); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($title)) : ?>
                                                    <h3 class="data-item-title js-post-item-title">
                                                        <?php echo $title; ?>
                                                    </h3>
                                                <?php endif; ?>

                                                <?php if (!empty($desc)) : ?>
                                                    <div class="data-item-desc js-post-item-desc">
                                                        <?php echo $desc; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (have_rows('links')) : ?>
                                                    <div class="data-item-links">
                                                        <?php while (have_rows('links')) : the_row(); ?>
                                                            <?php
                                                            $post_id = get_sub_field('link');
                                                            ?>
                                                            <?php if (!empty($post_id)) : ?>
                                                                <div class="data-item-links-item">
                                                                    <a href="<?php echo get_permalink($post_id); ?>">
                                                                        <?php echo get_the_title($post_id); ?>

                                                                        <span class="data-item-links-item-arrow">
                                                                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-up-right.svg', false); ?>
                                                                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/dark-arrow-up-right.svg', false); ?>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>