<?php


$logo        = get_field('logo', 'option');
$logo        = wp_get_attachment_image($logo, 'full');
$logo_second = get_field('logo_second', 'option');
$logo_second = wp_get_attachment_image($logo_second, 'full');
$social      = get_field('social', 'option');
?>
<div class="wcl-body-inner">
    <div class="wcl-header-menu">
        <?php wp_nav_menu(
            array(
                'container'      => '',
                'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                'theme_location' => 'main-menu',
                'depth'          => 1,
                'fallback_cb'    => '__return_empty_string',
            )
        ); ?>

        <?php if (!empty($social)) : ?>
            <ul class="data-social">
                <?php if (!empty($social['instagram'])) : ?>
                    <li class="data-social-item">
                        <a href="<?php echo $social['instagram']['url']; ?>" target="_blank">
                            <?php echo $social['instagram']['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($social['youtube'])) : ?>
                    <li class="data-social-item">
                        <a href="<?php echo $social['youtube']['url']; ?>" target="_blank">
                            <?php echo $social['youtube']['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($social['tiktok'])) : ?>
                    <li class="data-social-item">
                        <a href="<?php echo $social['tiktok']['url']; ?>" target="_blank">
                            <?php echo $social['tiktok']['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($social['pinterest'])) : ?>
                    <li class="data-social-item">
                        <a href="<?php echo $social['pinterest']['url']; ?>" target="_blank">
                            <?php echo $social['pinterest']['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($logo_second)) : ?>
            <div class="data-logo">
                <?php echo $logo_second; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="wcl-header-search">
        <div class="data-inner">
            <div class="data-filter">
                <div class="data-filter-view" data-val="post">
                    <span>By Post</span>
                    <div class="data-filter-arrow">
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/hd-search-arrow.svg'); ?>
                    </div>
                </div>

                <div class="data-filter-list">
                    <div class="data-filter-item" data-val="video">
                        <span>By Video</span>
                    </div>
                    <div class="data-filter-item" data-val="product">
                        <span>By Product</span>
                    </div>
                </div>
            </div>

            <form class="data-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" placeholder="I’m looking for “spring dresses”" name="s" value="<?php echo esc_attr(get_search_query()); ?>">
                <input type="hidden" name="post-type" value="post">
                <button type="reset">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd-menu-btn-close.svg'; ?>" alt="img">
                </button>
            </form>
        </div>
    </div>

    <!-- HEADER -->
    <header class="wcl-header">
        <div class="data-container wcl-container">
            <div class="data-row">
                <div class="data-col">
                    <div class="data-a">
                        <div class="data-a-item active">
                            <div class="data-a-item-img">
                                <img width="30" height="13" src="<?php echo get_stylesheet_directory_uri() . '/img/hd-menu-btn.svg'; ?>" alt="img">
                            </div>

                            <div class="data-a-item-label">
                                Menu
                            </div>
                        </div>

                        <div class="data-a-item">
                            <div class="data-a-item-img">
                                <img width="13" height="13" src="<?php echo get_stylesheet_directory_uri() . '/img/hd-menu-btn-close.svg'; ?>" alt="img">
                            </div>

                            <div class="data-a-item-label">
                                Close
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-logo">
                        <a href="<?php echo site_url('/'); ?>">
                            <?php if (!empty($logo)) : ?>
                                <?php echo $logo; ?>
                            <?php else :
                                echo get_bloginfo('name');
                            endif; ?>
                        </a>
                    </div>
                </div>

                <div class="data-col">
                    <?php wp_nav_menu(
                        array(
                            'container'      => '',
                            'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                            'theme_location' => 'header-right',
                            'depth'          => 1,
                            'fallback_cb'    => '__return_empty_string',
                        )
                    ); ?>

                    <div class="data-search">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd-search-ico.svg'; ?>" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </header> <!-- #wcl-main-header -->