<?php

$pages               = get_field('pages', 'option');
$splendor_collective = $pages['the_splendor_collective'];
$sc_portal           = $pages['sc_portal'];

$instagram = get_field('instagram', 'option');
$account_1 = $instagram['account_1'];
$account_2 = $instagram['account_2'];

$logged = '';

if (wcl_is_subscriber()) {
    $logged = 'wcl-header-nav-e2';
}
?>
<div class="wcl-header-nav <?php echo $logged; ?>">
    <div class="data-inner">
        <div class="data-btn">
            <?php if (wcl_is_subscriber()) : ?>
                <a href="<?php echo get_permalink($sc_portal); ?>" class="wcl-link mod-gradient">
                    <span>SC Portal</span>
                </a>
            <?php else : ?>
                <a href="<?php echo get_permalink($splendor_collective); ?>" class="wcl-link mod-gradient">
                    <span>Splendor Collective</span>
                </a>
            <?php endif; ?>
        </div>

        <?php if (wcl_is_subscriber()) : ?>
            <?php wp_nav_menu(
                array(
                    'container'      => '',
                    'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                    'theme_location' => 'header-mobile-logged',
                    'depth'          => 2,
                    'fallback_cb'    => '',
                )
            ); ?>
        <?php else : ?>
            <?php wp_nav_menu(
                array(
                    'container'      => '',
                    'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                    'theme_location' => 'header-mobile',
                    'depth'          => 2,
                    'fallback_cb'    => '',
                )
            ); ?>
        <?php endif; ?>

        <?php get_template_part('template-parts/search-form'); ?>

        <div class="data-links">
            <?php if (!empty($account_1)) : ?>
                <?php
                $link_url    = $account_1['url'];
                $link_title  = $account_1['title'];
                $link_target = $account_1['target'] ?: '_self';
                ?>
                <div class="data-links-item">
                    <div class="data-link">
                        <a href="<?php echo $link_url; ?>" class="wcl-link-underline" target="<?php echo $link_target; ?>">
                            <?php echo $link_title; ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (wcl_is_subscriber()) : ?>
                <?php if (!empty($account_2)) : ?>
                    <?php
                    $link_url    = $account_2['url'];
                    $link_title  = $account_2['title'];
                    $link_target = $account_2['target'] ?: '_self';
                    ?>
                    <div class="data-links-item">
                        <div class="data-link">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram_lock.svg'; ?>" alt="img">

                            <a href="<?php echo $link_url; ?>" class="wcl-link-underline" target="<?php echo $link_target; ?>">
                                <?php echo $link_title; ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>