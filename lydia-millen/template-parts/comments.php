<?php

function gb_comment_form_tweaks($fields) {
    //add placeholders and remove labels
    $fields['author'] = '<div class="data-field data-field-author"><label for="author">Name</label><input id="author" name="author" value="" placeholder="Name" size="30" maxlength="245" required="required" type="text"></div>';
    $fields['email'] = '<div class="data-field data-field-email"><label for="email">Email address</label><input id="email" name="email" type="email" value="" placeholder="Email address" size="30" maxlength="100" aria-describedby="email-notes" required="required"></div>';
    //unset comment so we can recreate it at the bottom
    $fields['url'] = '<div class="data-field data-field-url"><label for="url">Website</label><input id="url" name="url" type="text" value="" size="30" placeholder="Website" tabindex="3" /></div>';

    unset($fields['comment']);
    $fields['comment'] = '<div class="data-field data-field-message"><label for="comment">Message</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="Message" required="required"></textarea></div>';
    // unset($fields['url']);
    unset($fields['cookies']);
    return $fields;
}

add_filter('comment_form_fields', 'gb_comment_form_tweaks');

function wcl_comments($comment, $args, $depth) {
?>
    <li <?php comment_class('data-item'); ?> id="comment-<?php comment_ID() ?>">
        <div class="data-item-inner">
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="data-item-status">
                    <?php esc_html_e('Your comment is awaiting moderation.') ?>
                </div>
            <?php endif; ?>

            <div class="data-item-author">
                <?php echo get_comment_author() ?>
            </div>

            <div class="data-item-date">
                    <?php
                    printf(
                        __('%1$s at %2$s'),
                        get_comment_date(),
                        get_comment_time()
                    ); ?>
            </div>

            <div class="data-item-comment">
                <?php comment_text(); ?>
            </div>

            <?php if ($depth !=  $args['max_depth']) : ?>
                <div class="data-item-reply">
                    <?php comment_reply_link(array_merge(
                        $args,
                        array(
                            'depth' => $depth, 'max_depth' => $args['max_depth']
                        )
                    )); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (false) : ?>
    </li>
<?php endif; ?>
<?php } ?>

<div class="wcl-comments">
    <div class="data-container wcl-container">
        <div class="data-form">
            <?php
            $arg = [
                'title_reply'          => 'Leave comment',
                'comment_notes_before' => '',
                'label_submit'         => 'Post Comment',
                'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">Send Now</button>'
            ];
            comment_form($arg);
            ?>
        </div>


        <?php $comments = get_comments([
            'post_id' => $post->ID,
        ]);
        ?>

        <?php if (!empty($comments)) : ?>
            <ul class="data-list">
                <?php
                wp_list_comments(array(
                    'callback'   => 'wcl_comments',
                    'reply_text' => 'Reply now',
                ), $comments);
                ?>
            </ul>
        <?php endif; ?>
    </div>
</div>