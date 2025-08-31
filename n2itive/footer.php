<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');


$logo = get_field('logo', 'option');
$logo = wp_get_attachment_image($logo, 'full');

$social_media = get_field('social_media', 'option');
?>

<?php get_template_part('template-parts/models-car-popup'); ?>

<?php get_template_part('template-parts/cart-product-popup'); ?>

<?php get_template_part('template-parts/shipping-calculator-popup'); ?>

<?php get_template_part('template-parts/info-car-popup'); ?>


<!-- FOOTER -->
<footer class="sct-footer" id="wcl-main-footer">
    <div class="data-block">
        <div class="data-container wcl-container">
            <div class="data-block-inner">
                <?php if (!empty($logo)) : ?>
                    <div class="data-logo">
                        <a href="<?php echo site_url(); ?>">
                            <?php echo $logo; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php wp_nav_menu(
                    array(
                        'container'      => '',
                        'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                        'theme_location' => 'main-menu',
                        'depth'          => 1,
                        'fallback_cb'    => '',
                    )
                ); ?>

                <?php if (!empty($social_media)) : ?>
                    <ul class="cmp-social-media">
                        <?php if (!empty($social_media['facebook'])) : ?>
                            <li class="cmp-item">
                                <a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank" rel="noopener nofollow">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/media-facebook.svg'; ?>" alt="img">
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (!empty($social_media['twitter'])) : ?>
                            <li class="cmp-item">
                                <a href="<?php echo $social_media['twitter']['url']; ?>" target="_blank" rel="noopener nofollow">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/media-twitter.svg'; ?>" alt="img">
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (!empty($social_media['instagram'])) : ?>
                            <li class="cmp-item">
                                <a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/media-instagram.svg'; ?>" alt="img">
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="data-copyright">
                <div class="data-copyright-text">
                    © Copyright <?php echo date('Y'); ?> &nbsp;&nbsp;|&nbsp;&nbsp; All Rights Reserved &nbsp;&nbsp;|&nbsp;&nbsp;
                    N2itive Products Are Patent Pending &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="<?php echo get_privacy_policy_url(); ?>" target="_blank" rel="nofollow noopener">Privacy Policy</a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    Powered by
                    <a href="https://webcomplete.io/" target="_blank" rel="nofollow noopener">WebComplete</a>
                </div>
            </div>
        </div>
    </div>
</footer> <!-- #wcl-main-footer -->

<?php get_template_part('template-parts/sections/configurator'); ?>

</div> <!-- .wcl-body-inner -->

<?php wp_footer(); ?>


</body>

</html>