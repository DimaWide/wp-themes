<?php

/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined('ABSPATH') || exit;

global $product;

if (! comments_open()) {
    return;
}

$no_comments_yet = true;

//check for old WooCommerce versions
if (method_exists($product, 'get_id')) {
    $cr_product_id  = $product->get_id();
} else {
    $cr_product_id  = $product->id;
}

$nonce = wp_create_nonce("cr_product_reviews_" . $cr_product_id);

?>


<div id="reviews-2" class="woocommerce-Reviews">
    <div id="comments">
        <h2 class="woocommerce-Reviews-title">
            Reviews
        </h2>

        <div class="data-b1-title">
            Additional information
        </div>

        <div class="data-b1-subtitle">
            Your email address will not be published. Required fields are marked *
        </div>

        <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
            <div class="review_form_wrapper" id="review_form_wrapper">
                <div id="review_form" class="cr-single-product-review">
                    <?php
                    $commenter    = wp_get_current_commenter();
                    $comment_form = array(
                        /* translators: %s is product title */
                        'title_reply'         => have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
                        /* translators: %s is product title */
                        'title_reply_to'      => esc_html__('Leave a Reply to %s', 'woocommerce'),
                        'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
                        'title_reply_after'   => '</span>',
                        'comment_notes_after' => '',
                        'label_submit'        => esc_html__('Submit', 'woocommerce'),
                        'logged_in_as'        => '',
                        'comment_field'       => '',
                        'class_submit'        => 'cmp-button mod-red  cr-single-product-rev-submit',
                    );

                    $name_email_required = (bool) get_option('require_name_email', 1);
                    $fields              = array(
                        'author' => array(
                            'label'    => __('Name', 'woocommerce'),
                            'type'     => 'text',
                            'value'    => $commenter['comment_author'],
                            'required' => $name_email_required,
                        ),
                        'email' => array(
                            'label'    => __('Email', 'woocommerce'),
                            'type'     => 'email',
                            'value'    => $commenter['comment_author_email'],
                            'required' => $name_email_required,
                        ),
                    );

                    $comment_form['fields'] = array();

                    foreach ($fields as $key => $field) {
                        $field_html  = '<p class="comment-form-' . esc_attr($key) . '">';
                        $field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);

                        if ($field['required']) {
                            $field_html .= '&nbsp;<span class="required">*</span>';
                        }

                        $field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';

                        $comment_form['fields'][$key] = $field_html;
                    }

                    $account_page_url = wc_get_page_permalink('myaccount');
                    if ($account_page_url) {
                        /* translators: %s opening and closing link tags respectively */
                        $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
                    }

                    if (wc_review_ratings_enabled()) {
                        $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__('Rate our product', 'woocommerce') . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
						<option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
						<option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
						<option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
						<option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
						<option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
					</select></div>';
                    }

                    $comment_form['comment_field'] = apply_filters('cr_review_form_before_comment', $comment_form['comment_field']);

                    $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your review', 'woocommerce') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required class="cr-review-form-textbox"></textarea></p>';

                    // Capture the output of comment_form
                    ob_start();


                    comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                    
                    $form_html = ob_get_clean();
                        // Add placeholders by appending them directly
                        $form_html = str_replace(
                            array(
                                '<input id="author"',
                                '<input id="email"',
                                '<textarea id="comment"',
                            ),
                            array(
                                '<input id="author" placeholder="Please enter your name"',
                                '<input id="email" placeholder="Please enter your email address"',
                                '<textarea id="comment" placeholder="Tell us about your impressions"',
                            ),
                            $form_html
                        );

                    // Load the HTML into DOMDocument
                    $doc = new DOMDocument();
                    libxml_use_internal_errors(true); // Suppress warnings about invalid HTML
                    $doc->loadHTML(mb_convert_encoding($form_html, 'HTML-ENTITIES', 'UTF-8'));

                    // Create a new div with class 'cr-upload-container' to wrap the elements
                    $cr_upload_container = $doc->createElement('div');
                    $cr_upload_container->setAttribute('class', 'cr-upload-container');

                    // Find the comment-form-rating and cr-upload-local-images elements
                    $rating_node = null;
                    $upload_node = null;

                    // Try to find 'comment-form-rating' and 'cr-upload-local-images' by tag names and classes
                    foreach ($doc->getElementsByTagName('div') as $div) {
                        if ($div->getAttribute('class') === 'comment-form-rating') {
                            $rating_node = $div;
                        }
                        if ($div->getAttribute('class') === 'cr-upload-local-images') {
                            $upload_node = $div;
                        }
                    }

                    // Ensure both nodes are found
                    if ($rating_node && $upload_node) {
                        // Find the input file field inside the cr-upload-local-images div
                        $file_input = null;
                        foreach ($upload_node->getElementsByTagName('input') as $input) {
                            if ($input->getAttribute('type') === 'file') {
                                $file_input = $input;
                                break;
                            }
                        }

                        // Find the label and add the button inside the label
                        foreach ($upload_node->getElementsByTagName('label') as $label) {
                            if ($label->getAttribute('for') === 'cr_review_image') {
                                // Remove the duplicate text inside the label
                                $label->nodeValue = ''; // Clear the existing text

                                // Wrap the label text in a span
                                $span = $doc->createElement('span', 'Upload up to 15 images or videos');
                                $label->appendChild($span);

                                break;
                            }
                        }

                        // Новый лейбл под cr_review_image
                        $new_label = $doc->createElement('label', 'Select files');
                        $new_label->setAttribute('class', 'cr-upload-info'); // Класс для нового лейбла
                        $new_label->setAttribute('for', 'cr_review_image'); // Связь с элементом cr_review_image

                        // Добавляем новый лейбл под upload_node
                        if ($upload_node) {
                            $upload_node->insertBefore($new_label, $label);
                        }

                        // Append both the nodes to the cr-upload-container
                        $cr_upload_container->appendChild($rating_node);
                        $cr_upload_container->appendChild($upload_node);

                        // Find the parent of these elements to replace them
                        $parent = $doc->getElementsByTagName('form')->item(0);

                        if ($parent) {
                            $parent->appendChild($cr_upload_container);
                        }
                    }

                    // Output the modified HTML
                    echo $doc->saveHTML();
                    ?>
                </div>
            </div>
        <?php else : ?>
            <p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
        <?php endif; ?>

        <div class="clear"></div>

        <?php if (have_comments()) : ?>
        <?php else : ?>
            <p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet', 'customer-reviews-woocommerce'); ?></p>
        <?php endif; ?>
    </div>

</div>


<div id="reviews" class="cr-reviews-ajax-reviews">
    <div id="comments" class="cr-reviews-ajax-comments" data-nonce="<?php echo $nonce; ?>" data-page="1">
        <h2 class="woocommerce-Reviews-title">
            <?php
            $count = $product->get_review_count();
            if ($count && wc_review_ratings_enabled()) {
                /* translators: 1: reviews count 2: product name */
                $reviews_title = sprintf(esc_html(_n('%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce')), esc_html($count), '<span>' . get_the_title() . '</span>');
                echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product); // WPCS: XSS ok.
            } else {
                esc_html_e('Reviews', 'woocommerce');
            }
            ?>
        </h2>

        <?php
        $cr_form_permissions = CR_Forms_Settings::get_default_review_permissions();
        $form_settings = CR_Forms_Settings::get_default_form_settings();
        $cr_form_checkbox = ('yes' === CR_Forms_Settings::get_onsite_form_checkbox($form_settings)) ? true : false;
        $cr_form_checkbox_text = CR_Forms_Settings::get_onsite_form_checkbox_text($form_settings);
        if (false === $cr_form_checkbox_text) {
            $cr_form_checkbox_text = CR_Forms_Settings::get_default_form_onsite_checkbox_text();
        }
        $new_reviews_allowed = in_array($cr_form_permissions, array('registered', 'verified', 'anybody')) ? true : false;
        $cr_per_page = CR_Ajax_Reviews::get_per_page();
        if (have_comments()) : ?>
            <?php
            $no_comments_yet = false;
            $cr_get_reviews = CR_Ajax_Reviews::get_reviews($cr_product_id);
            do_action('cr_reviews_summary', $cr_product_id, true, $new_reviews_allowed);
            do_action('cr_reviews_customer_images', $cr_get_reviews['reviews']);
            if ($new_reviews_allowed) {
                do_action('cr_reviews_nosummary', $cr_product_id);
            }
            do_action('cr_reviews_search', $cr_get_reviews['reviews']);
            do_action('cr_reviews_count_row', $cr_get_reviews['reviews_count'], 1, $cr_per_page);
            // WPML switch to show reviews in all or some languages
            if (has_filter('wpml_object_id')) {
                if (class_exists('WCML_Comments')) {
                    global $woocommerce_wpml;
                    if ($woocommerce_wpml) :
            ?>
                        <div class="cr-ajax-reviews-wpml-switch">
                            <?php
                            $woocommerce_wpml->comments->comments_link();
                            ?>
                        </div>
            <?php
                        // remove the default WPML switch from above the review form
                        remove_action('comment_form_before', array($woocommerce_wpml->comments, 'comments_link'));
                    endif;
                }
            }
            ?>
            <ol class="commentlist cr-ajax-reviews-list" data-product="<?php echo $cr_product_id; ?>">
                <?php
                $hide_avatars = 'hidden' === get_option('ivole_avatars', 'standard') ? true : false;
                wp_list_comments(
                    apply_filters(
                        'woocommerce_product_review_list_args',
                        array(
                            'callback' => array('CR_Reviews', 'callback_comments'),
                            'reverse_top_level' => false,
                            'per_page' => $cr_per_page,
                            'page' => 1,
                            'cr_hide_avatars' => $hide_avatars
                        )
                    ),
                    $cr_get_reviews['reviews'][0]
                );
                ?>
            </ol>

            <?php
            if ($cr_get_reviews['reviews_count'] > $cr_per_page) {
            ?>
                <div class="cr-show-more-review-spinner-cnt">
                    <button class="cr-show-more-reviews-prd" type="button">
                        <?php
                        echo sprintf(
                            __('Show more reviews (%d)', 'customer-reviews-woocommerce'),
                            $cr_get_reviews['reviews_count'] - $cr_per_page
                        );
                        ?>
                    </button>
                    <span class="cr-show-more-review-spinner" style="display:none"></span>
                </div>
            <?php
            } else {
            ?>
                <span class="cr-show-more-review-spinner" style="display:none"></span>
            <?php
            }
            ?>
            <p class="cr-search-no-reviews" style="display:none"><?php esc_html_e("Sorry, no reviews match your current selections", "customer-reviews-woocommerce"); ?></p>
        <?php else : ?>
            <p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet', 'customer-reviews-woocommerce'); ?></p>
        <?php endif; ?>
    </div>

    <?php
    $cr_ajax_review_form_class = 'cr-ajax-reviews-review-form';
    if ($no_comments_yet && $new_reviews_allowed) {
        $cr_ajax_review_form_class .= ' cr-ajax-reviews-review-form-nc';
    }
    ?>
    <div class="<?php echo $cr_ajax_review_form_class; ?>">
        <div id="review_form_wrapper">
            <div id="review_form" class="cr-single-product-review">
                <?php
                $item_id = $cr_product_id;
                $item_name = $product->get_name();
                $item_pic = wp_get_attachment_image_url($product->get_image_id(), 'thumbnail', false);
                $media_upload = ('yes' === get_option('ivole_attach_image', 'no') ? true : false);
                $cr_form_item_media_array = array();
                $cr_form_item_media_desc = __('Add photos or video to your review', 'customer-reviews-woocommerce');
                wc_get_template(
                    'cr-review-form.php',
                    array(
                        'cr_item_id' => $item_id,
                        'cr_item_name' => $item_name,
                        'cr_item_pic' => $item_pic,
                        'cr_form_media_enabled' => $media_upload,
                        'cr_form_item_media_array' => $cr_form_item_media_array,
                        'cr_form_item_media_desc' => $cr_form_item_media_desc,
                        'cr_form_permissions' => $cr_form_permissions,
                        'cr_form_checkbox' => $cr_form_checkbox,
                        'cr_form_checkbox_text' => wp_specialchars_decode($cr_form_checkbox_text, ENT_QUOTES)
                    ),
                    'customer-reviews-woocommerce',
                    dirname(dirname(__FILE__)) . '/templates/'
                );
                ?>
            </div>
        </div>
    </div>

    <div class="clear"></div>
</div>