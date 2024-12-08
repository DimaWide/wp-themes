<?php


$logo   = $args['logo'];
$style  = $args['style'];
$social = get_field('social', 'option');
?>
<header class="wcl-header wcl-header-1 <?php echo $style; ?>">
    <div class="data-overlay"></div>
    <div class="data-inner">
        <div class="data-menu-btn">
            <div class="data-menu-btn-ico">
                <div class="bar bar-top"></div>
                <div class="bar bar-middle"></div>
                <div class="bar bar-bottom"></div>
            </div>
        </div>

        <div class="data-logo">
            <a href="<?php echo site_url('/'); ?>">
                <?php if (!empty($logo)) : ?>
                    <?php echo file_get_contents($logo['url']); ?>
                <?php else :
                    echo get_bloginfo('name');
                endif; ?>
            </a>
        </div>

        <div class="data-search-btn">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/search.svg'; ?>" alt="search">
        </div>

        <nav class="data-nav">
            <?php wp_nav_menu(
                array(
                    'container'      => '',
                    'items_wrap'     => '<ul class="data-nav-menu">%3$s</ul>',
                    'theme_location' => 'main-menu',
                    'depth'          => 2,
                    'fallback_cb'    => '__return_empty_string',
                )
            ); ?>

            <?php wp_nav_menu(
                array(
                    'container'      => '',
                    'items_wrap'     => '<ul class="data-nav-menu">%3$s</ul>',
                    'theme_location' => 'main-menu-2',
                    'depth'          => 2,
                    'fallback_cb'    => '__return_empty_string',
                )
            ); ?>

            <?php if (!empty($social)) : ?>
                <ul class="data-social">
                    <?php if (!empty($social['instagram'])) : ?>
                        <li class="data-social-item">
                            <a href="<?php echo $social['instagram']['url']; ?>" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($social['youtube'])) : ?>
                        <li class="data-social-item">
                            <a href="<?php echo $social['youtube']['url']; ?>" target="_blank">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($social['tiktok'])) : ?>
                        <li class="data-social-item">
                            <a href="<?php echo $social['tiktok']['url']; ?>" target="_blank">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </nav>
    </div>

    <div class="data-inner-3">
        <div class="data-search">
            <input type="text" placeholder="Search this site..." required>

            <div class="data-search-close">
                <i class="fa-solid fa-x"></i>
            </div>
        </div>
    </div>
</header>