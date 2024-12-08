<?php


$pop_up   = get_field('pop_up_1', 'option');
$title    = $pop_up['title'];
$subtitle = $pop_up['subtitle'];

$splendor_collective              = get_field('pages', 'option');
$splendor_collective              = $splendor_collective['the_splendor_collective'];
$splendor_collective_subscription = get_field('splendor_collective_subscription', 'option');
?>
<div class="wcl-popup wcl-popup-type-2 mod-type-1 js-mod-1 js-popup">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-inner">
            <div class="data-close">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/popup_close.svg'; ?>" alt="img">
            </div>

            <h2 class="data-title">
                SPLENDOR
                <br>
                COLLECTIVE
            </h2>

            <div class="data-subtitle">
                Get exclusive access to content now.
            </div>

            <div class="data-links">
                <div class="data-links-item">
                    <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link mod-gradient">
                        <span> Join now</span>
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>

                <div class="data-links-item">
                    <a href="<?php echo get_permalink($splendor_collective); ?>" class="wcl-link">
                        <span> Learn more</span>
                        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
