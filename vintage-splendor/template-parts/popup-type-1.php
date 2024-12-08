<?php


$pop_up   = get_field('pop_up_1', 'option');
$title    = $pop_up['title'];
$subtitle = $pop_up['subtitle'];

$splendor_collective              = get_field('pages', 'option');
$splendor_collective              = $splendor_collective['the_splendor_collective'];
$splendor_collective_subscription = get_field('splendor_collective_subscription', 'option');
?>
<div class="wcl-popup wcl-popup-type-1 mod-type-1 js-popup">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-inner">
            <div class="data-close">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/popup_close.svg'; ?>" alt="img">
            </div>

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

            <div class="data-links">
                <div class="data-links-item">
                    <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link mod-gradient">
                        <span> Join now</span>
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>

                <div class="data-links-item">
                    <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="wcl-link">
                        <span> Sign in</span>
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>
            </div>

            <div class="data-link">
                <a href="<?php echo get_permalink($splendor_collective); ?>" class="wcl-link-underline">
                    Learn more
                </a>
            </div>
        </div>
    </div>
</div>