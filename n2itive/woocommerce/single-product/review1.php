<?php
/**
 * Override the WooCommerce review template.
 *
 * @var object $comment  Comment object.
 * @var array  $args     Arguments passed to the template.
 * @var int    $depth    Depth of the comment (for nested comments).
 */

global $woocommerce;

// Get the comment and product rating
$comment_author = get_comment_author();
$comment_date = get_comment_date();
$comment_text = get_comment_text();
$comment_author_email = get_comment_author_email();
$comment_rating = get_comment_meta( $comment->comment_ID, 'rating', true );
$comment_approved = $comment->comment_approved;

?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php comment_author_email(); ?>>
    <div class="review-wrapper">
        <!-- First Column (Avatar, Date, Likes/Dislikes) -->
        <div class="review-column review-column-1">
            <div class="comment-avatar">
                <?php echo get_avatar($comment, 60); ?>
            </div>
            <div class="comment-meta">
                <span class="comment-date"><?php echo $comment_date; ?> - <?php _e( 'Review left', 'woocommerce' ); ?></span>
            </div>
            <div class="comment-likes">
                <!-- Example like/dislike buttons, adjust accordingly -->
                <span class="like-button"><?php _e('Like', 'woocommerce'); ?></span>
                <span class="dislike-button"><?php _e('Dislike', 'woocommerce'); ?></span>
            </div>
        </div>

        <!-- Second Column (Name, Rating, Review Text) -->
        <div class="review-column review-column-2">
            <div class="comment-author">
                <strong><?php echo $comment_author; ?></strong>
            </div>

            <div class="comment-rating">
                <?php
                if ($comment_rating) {
                    echo wc_get_rating_html($comment_rating);
                }
                ?>
            </div>

            <div class="comment-text">
                <?php echo $comment_text; ?>
            </div>

            <!-- Display attached files -->
            <?php
            // Check if there are any files attached to the review
            $attachments = get_comment_meta($comment->comment_ID, 'review_image', false);
            if ($attachments) :
                ?>
                <div class="comment-attachments">
                    <h4><?php _e( 'Attached files', 'woocommerce' ); ?></h4>
                    <ul>
                        <?php foreach ($attachments as $attachment) : ?>
                            <li><a href="<?php echo esc_url($attachment); ?>" target="_blank"><?php echo basename($attachment); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</li>

<?php
