<?php

$site_name    = get_bloginfo('name');
$logo_header  = get_field('logo_header', 'option');
$logo_header  = wp_get_attachment_image_url($logo_header);

$contact_form = get_field('contact_form', 'option');
$contact_info = get_field('contact_info', 'option');

$contact_form_unique = $contact_form['form_3'];
$form_title          = $contact_form_unique['title'];
$form_button_text    = $contact_form_unique['button_text'];
$form_shortcode      = $contact_form['form_shortcode'];

$title     = get_field('title');
$bg_text   = get_field('bg_text');
$embed_map = get_field('embed_map');

$title = !empty($title) ? $title : $form_title;
?>
<!-- Acf Block #38 – Contact US -->
<div class="wcl-acf-block-38 wcl-cmp-3-form" itemscope itemtype="https://schema.org/ContactPage">
    <div class="data-container wcl-container">
        <?php if (!empty($bg_text)) : ?>
            <div class="data-bg-text" itemprop="keywords">
                <?php echo $bg_text; ?>
            </div>
        <?php endif; ?>

        <div class="data-block-contact">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title wcl-cmp-tagline" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($form_shortcode)) : ?>
                <div class="cmp3-inner">
                    <div class="cmp3-form data-form" itemprop="mainContentOfPage">
                        <?php
                        ob_start();

                        echo do_shortcode($form_shortcode);

                        $form_content = ob_get_clean();

                        $form_content = str_replace('type="submit"', 'type="submit" value="' . esc_attr($form_button_text) . '"', $form_content);

                        echo $form_content;
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-info-out">
            <div class="data-info wcl-cmp-info" itemprop="subjectOf" itemscope itemtype="https://schema.org/LocalBusiness">
                <?php if (!empty($site_name)) : ?>
                    <meta itemprop="name" content="<?php echo $site_name; ?>">
                <?php endif; ?>

                <?php if (!empty($logo_header)) : ?>
                    <meta itemprop="image" content="<?php echo $logo_header; ?>">
                <?php endif; ?>

                <?php if (!empty($embed_map)) : ?>
                    <div class="data-info-map" itemprop="hasMap" itemscope itemtype="https://schema.org/Map">
                        <?php echo $embed_map; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($contact_info)) : ?>
                    <?php
                    $place     = $contact_info['place'];
                    $work_time = $contact_info['work_time'];
                    $phone     = $contact_info['phone'];
                    ?>
                    <div class="data-info-list">
                        <?php if (!empty($place)) : ?>
                            <div class="data-info-item data-info-place" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/marker.svg'; ?>" alt="img">

                                <span itemprop="addressRegion">
                                    <?php echo $place; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($work_time)) : ?>
                            <div class="data-info-item mod-work-time" itemprop="openingHours">
                                <?php echo $work_time; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($phone)) : ?>
                            <div class="data-info-item mod-phone">
                                <a href="tel:<?php echo $phone; ?>">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/phone.svg'; ?>" alt="ico-phone">

                                    <span itemprop="telephone"><?php echo $phone; ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>