<?php

$group     = get_sub_field('group');
$title     = $group['title'];
$link      = $group['link'];
$shortcode = get_sub_field('shortcode');
?>
<?php if (!empty($shortcode)) : ?>
    <div class="wcl-section-22 wcl-instagram">
        <div class="data-src">
            <?php
            echo do_shortcode($shortcode);
            ?>
        </div>

        <div class="data-container wcl-container">
            <div class="data-list">
                <div class="data-item data-item-2">
                    <div class="data-item-2-inner">
                        <div class="data-a">
                            <div class="data-subtitle">
                                Latest from
                            </div>

                            <?php if (!empty($title)) : ?>
                                <h2 class="data-item-2-title">
                                    <?php echo $title; ?>
                                </h2>
                            <?php endif; ?>
                        </div>

                        <div class="data-links">
                            <div class="data-links-item">
                                <?php if (!empty($link)) : ?>
                                    <?php
                                    $link_url    = $link['url'];
                                    $link_title  = $link['title'];
                                    $link_target = $link['target'] ?: '_self';
                                    ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram_lock.svg'; ?>" alt="img">

                                    <a href="<?php echo $link_url; ?>" class="wcl-link-underline" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>