<?php

if (display_preview_image($block)) {
    return;
}

$contact_form = get_field('contact_form', 'option');
$contact_info = get_field('contact_info', 'option');
$social_media = get_field('social_media', 'option');

$group = get_field('group');
$form  = get_field('form');

$embed_map = get_field('embed_map');
?>
<!-- Acf Block #7 – Contact -->
<div class="wcl-acf-block-7">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($group)) : ?>
                    <?php
                    $title    = $group['title'];
                    $subtitle = $group['subtitle'];
                    $email    = $contact_info['email'];
                    ?>
                    <div class="data-head">
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
                    </div>

                    <?php if (!empty($email)) : ?>
                        <div class="data-email">
                            <a href="mailto:<?php echo $email; ?>">
                                <?php echo $email; ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($social_media)) : ?>
                        <ul class="cmp-social-media data-social-media">
                            <?php if (!empty($social_media['linkedin'])) : ?>
                                <li class="cmp-item">
                                    <a href="<?php echo $social_media['linkedin']['url']; ?>" target="_blank" rel="noopener nofollow">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/linkedin.svg'; ?>" alt="img">
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($social_media['instagram'])) : ?>
                                <li class="cmp-item">
                                    <a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram.svg'; ?>" alt="img">
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($contact_form)) : ?>
                    <?php
                    $title          = $contact_form['title'];
                    $form_shortcode = $contact_form['form_shortcode'];
                    ?>
                    <div class="cmp-2-form data-form">
                        <?php if (!empty($title)) : ?>
                            <div class="cmp2-head">
                                <h3 class="cmp2-title">
                                    <?php echo $title; ?>
                                </h3>

                                <div class="cmp2-arrow">
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-right.svg', false); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="cmp2-body">
                            <?php echo do_shortcode($form_shortcode); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($embed_map)) : ?>
            <div class="data-map">
                <?php echo $embed_map; ?>
            </div>
        <?php endif; ?>
    </div>
</div>