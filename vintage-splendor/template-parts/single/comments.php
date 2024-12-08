<?php

function gb_comment_form_tweaks($fields) {
    $fields['author'] = '<div class="data-field data-field-author"><input id="author" name="author" value="" placeholder="Name" size="30" maxlength="245" required="required" type="text"></div>';
    $fields['email'] = '<div class="data-field data-field-email"><input id="email" name="email" type="email" value="" placeholder="Email Address" size="30" maxlength="100" aria-describedby="email-notes" required="required"></div>';
    //unset comment so we can recreate it at the bottom
    // $fields['url'] = '<div class="data-field data-field-url"><input id="url" name="url" type="text" value="" size="30" placeholder="Website" tabindex="3" /></div>';
    unset($fields['comment']);
    $fields['comment'] = '<div class="data-field data-field-message"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="Message" required="required"></textarea></div>';

    unset($fields['url']);
    unset($fields['cookies']);
    return $fields;
}

add_filter('comment_form_fields', 'gb_comment_form_tweaks');

function wcl_comments($comment, $args, $depth) {
?>
    <div <?php comment_class('data-item swiper-slide'); ?> id="comment-<?php comment_ID() ?>">
        <div class="data-item-inner">
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="data-item-status">
                    <?php esc_html_e('Your comment is awaiting moderation.') ?>
                </div>
            <?php endif; ?>

            <div class="data-item-author">
                <?php echo get_comment_author() ?>
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
    </div>
<?php } ?>




<?php 
$reply_class = '';
if (isset($_GET['replytocom'])) {
    $reply_class = 'mod-reply';
}

$cooment_state = '';
if (!empty($_COOKIE['cooment_state'])) {
    $cooment_state = $_COOKIE['cooment_state'];
    $cooment_state = 'active';
}
?>
<div class="wcl-comments <?php echo $reply_class . ' ' . $cooment_state; ?>">
    <div class="data-container wcl-container">
        <div class="data-form">
            <?php
            $arg = [
                'title_reply'          => 'Leave a comment',
                'comment_notes_before' => '',
                'label_submit'         => 'Send now',
                'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="wcl-link %3$s" value="%4$s">Send Now ' . file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false) . '</button>'
            ];
            comment_form($arg);
            ?>
        </div>

        <?php
        $post_id = get_the_ID();

        $args = array(
            'post_id'      => $post_id,
           // 'status'       => 'approve',
            'hierarchical' => 'threaded',
            'threaded'     => true,
            'max_depth'    => 2
        );

        $comments = get_comments($args);
        ?>

        <?php if (!empty($comments) && wcl_is_subscriber()) : ?>
            <div class="data-b">
                <div class="data-list-out">
                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </div>

                        <div class="data-list-nav-btn mod-next">
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                        </div>
                    </div>

                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php foreach ($comments as $key => $comment) : ?>
                                <?php
                                setup_postdata($comment);
                                ?>
                                <div <?php comment_class('data-item data-list-item swiper-slide'); ?> id="comment-<?php comment_ID(); ?>">
                                    <div class="data-item-inner-2">
                                        <div class="data-item-inner">
                                            <?php if ($comment->comment_approved == '0') : ?>
                                                <div class="data-item-status">
                                                    <?php esc_html_e('Your comment is awaiting moderation.') ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="data-item-author">
                                                <?php echo get_comment_author() ?>
                                            </div>

                                            <div class="data-item-comment">
                                                <?php comment_text(); ?>
                                            </div>

                                            <div class="data-item-reply">
                                                <?php comment_reply_link(array_merge(
                                                    $args,
                                                    array(
                                                        'depth' => 1, 'max_depth' => 2
                                                    )
                                                )); ?>
                                            </div>
                                        </div>

                                        <?php
                                        $child_comments_args = array(
                                            'parent'       => $comment->comment_ID,
                                            'hierarchical' => 'threaded',
                                            'threaded'     => true,
                                            'max_depth'    => 1
                                        );

                                        $child_comments = get_comments($child_comments_args);
                                        ?>
                                        <?php if (!empty($child_comments)) : ?>
                                            <div class="data-item-sub-list">
                                                <?php foreach ($child_comments as $key => $child_comment) : ?>
                                                    <?php
                                                    global $comment;
                                                    $comment = $child_comment;
                                                    setup_postdata($child_comment);
                                                    ?>
                                                    <div <?php comment_class('data-item'); ?> id="comment-<?php comment_ID(); ?>">
                                                        <div class="data-item-inner">
                                                            <?php if ($child_comment->comment_approved == '0') : ?>
                                                                <div class="data-item-status">
                                                                    <?php esc_html_e('Your comment is awaiting moderation.') ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div class="data-item-author">
                                                                <?php echo get_comment_author() ?>
                                                                <span>replied</span>
                                                            </div>

                                                            <div class="data-item-comment">
                                                                <?php comment_text(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach;
                                                wp_reset_postdata(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="data-reply">
                        <a href="#">
                            reply
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>