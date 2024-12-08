<?php

/**
 * Template Name: Dex Paid Page
 */

$sound_status = '';

if (isset($_COOKIE['dex_paid_page_sound'])) {
    $sound_status = $_COOKIE['dex_paid_page_sound'] === 'true' ? 'mod-enable' : 'mod-disable';
}

$ca_mint = 'AnM6bkqJy3D4douPgp1keUTmQNygP2KKiM7bVw9qpump';
$ca_mint = '';

$token     = '';
$isDexPaid = '';

if (isset($_GET['mint'])) {
    $ca_mint = $_GET['mint'];
}

get_header();
?>

<?php get_template_part('template-parts/sct-1-featured-fields', null, ['page' => 'home-3']); ?>

<?php if (! empty($ca_mint)): ?>
    <div class="sct-10-product mod-type-1 dex_paid_page_sound" data-mint="<?php echo $ca_mint; ?>">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                PUMP
                <span>.BLACK</span>
            </h2>

            <div class="data-inner-out">
                <div class="preloader" style="display: none;">
                    <div class='loader loader1'>
                        <div>
                            <div>
                                <div>
                                    <div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-b1">
                    <div class="data-b1-icon <?php echo $sound_status; ?>">
                        <?php if ($sound_status == 'mod-enable'): ?>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-up.svg'; ?>" alt="img">
                        <?php else: ?>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-off.svg'; ?>" alt="img">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="data-inner data-row">

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>





<?php get_template_part('template-parts/sct-4-dex-paid'); ?>





<?php if (! empty($ca_mint)): ?>
    <div id="product-to-img" class="sct-10-product mod-generate">
        <div class="data-container wcl-container">
            <h2 class="data-title">
                PUMP
                <span>.BLACK</span>
            </h2>

            <div class="data-inner data-row">

            </div>
        </div>
    </div>
<?php endif; ?>

<?php
get_footer();
