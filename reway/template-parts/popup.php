<?php



$popup_id = '';
$contact_form = get_field('contact_form', 'option');

if (empty($contact_form)) {
    return;
}

if (!empty($args)) {
    $popup_id = $args['id'];
}

if ($popup_id == 'make-a-reservation') {
    $contact_form_unique = $contact_form['form_2'];
    $popup = get_field('popup_spa', 'option');
} else {
    $contact_form_unique = $contact_form['form_1'];
    $popup = get_field('popup', 'option');
}

$title          = !empty($popup['title']) ? $popup['title'] : $contact_form_unique['title'];
$button_text    = $contact_form_unique['button_text'];
$form_shortcode = $contact_form['form_shortcode'];
?>
<?php if (!empty($contact_form)) : ?>
    <div class="wcl-popup <?php echo 'mod-' . $popup_id; ?>" data-id="<?php echo $popup_id; ?>" itemscope itemtype="https://schema.org/CreativeWork">
        <div class="data-overlay"></div>

        <div class="data-inner-out">
            <div class="data-inner">
                <div class="data-close">X</div>

                <div class="data-form" itemprop="mainEntity">
                    <?php if (!empty($title)) : ?>
                        <h3 class="data-form-title" itemprop="alternativeHeadline">
                            <?php echo $title; ?>
                        </h3>
                    <?php endif; ?>

                    <?php if (!empty($form_shortcode)) : ?>
                        <?php
                        ob_start();

                        echo do_shortcode($form_shortcode);

                        $form_content = ob_get_clean();

                        $form_content = str_replace('type="submit"', 'type="submit" value="' . esc_attr($button_text) . '"', $form_content);

                        echo $form_content;
                        ?>
                        <?php if ($popup_id == 'make-a-reservation') : ?>
                            <?php
                            $contact_info = get_field('contact_info', 'option');
                            $phone        = $contact_info['phone'];
                            ?>
                            <?php if (!empty($phone)) : ?>
                                <div class="data-phone">
                                    <a href="tel:<?php echo $phone; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/phone.svg'; ?>" alt="ico-phone">
                                        <div class="data-phone-num">
                                            <?php echo $phone; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>