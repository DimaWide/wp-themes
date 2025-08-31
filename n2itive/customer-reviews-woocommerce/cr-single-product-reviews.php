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

?>
<div id="reviews" class="woocommerce-Reviews">
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

                    // Capture the output of comment_form
                    ob_start();
                    comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                    $form_html = ob_get_clean();

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

                        // Add a button inside the label to trigger the file input
                        $button = $doc->createElement('button', 'Select file');
                        $button->setAttribute('type', 'button');
                        $button->setAttribute('class', 'cr-upload-btn');
                        $button->setAttribute('onclick', 'document.getElementById("cr_review_image").click();'); // Trigger the file input on button click

                        // Find the label and add the button inside the label
                        foreach ($upload_node->getElementsByTagName('label') as $label) {
                            if ($label->getAttribute('for') === 'cr_review_image') {
                                // Remove the duplicate text inside the label
                                $label->nodeValue = ''; // Clear the existing text

                                // Wrap the label text in a span
                                $span = $doc->createElement('span', 'Upload up to 15 images or videos');
                                $label->appendChild($span);

                                // Add the button inside the label
                                $label->appendChild($button);
                                break;
                            }
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