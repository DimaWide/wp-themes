<?php

$cmnt_join = '';
if (!empty($_COOKIE['cmnt_join'])) {
    $cmnt_join = $_COOKIE['cmnt_join'];
    $cmnt_join = 'active';
}

function gb_comment_form_tweaks($fields) {
    //add placeholders and remove labels
    $fields['author'] = '<input id="author" name="author" value="" placeholder="Name" size="30" maxlength="245" required="required" type="text">';
    $fields['email'] = '<input id="email" name="email" type="email" value="" placeholder="Email address" size="30" maxlength="100" aria-describedby="email-notes" required="required">';
    //unset comment so we can recreate it at the bottom
    unset($fields['comment']);
    $fields['comment'] = '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="Message" required="required"></textarea>';
    //remove 
    unset($fields['url']);
    unset($fields['cookies']);
    return $fields;
}

add_filter('comment_form_fields', 'gb_comment_form_tweaks');

function wcl_comments($comment, $args, $depth) {
?>
    <li <?php comment_class('data-list-item'); ?> id="comment-<?php comment_ID() ?>">
        <div class="data-list-item-inner">
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="data-list-item-status">
                    <?php esc_html_e('Your comment is awaiting moderation.') ?>
                </div>
            <?php endif; ?>

            <div class="data-list-item-author">
                <?php echo get_comment_author() ?>
            </div>

            <div class="data-list-item-comment">
                <?php comment_text(); ?>
            </div>

            <?php if ($depth !=  $args['max_depth']) : ?>
                <div class="data-list-item-reply">
                    <?php comment_reply_link(array_merge(
                        $args,
                        array(
                            'depth' => 1, 'max_depth' => 2
                        )
                    )); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (false) : ?>
    </li>
<?php endif; ?>
<?php } ?>

<div class="wcl-section-21">
    <div class="data-container wcl-container">
        <div class="data-title">
            <span>
                chriselle
            </span>
        </div>
    </div>
</div>

<div class="wcl-comments <?php echo $cmnt_join; ?>">
    <div class="data-panel">
        <div class="data-panel-a js-btn">
            <div class="data-panel-a-text data-panel-text">
                DROP A COMMENT 
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-4.svg'; ?>" alt="img">
            </div>
        </div>

        <div class="data-panel-b">
            <div class="data-panel-b-text data-panel-text js-btn">
                LEAVE THE CONVERSATION
            </div>
        </div>
    </div>

    <div class="data-a">
        <div class="data-a-container wcl-container">
            <div class="data-a-row">
                <div class="data-a-col">
                    <?php $comments = get_comments([
                        'post_id' => $post->ID,
                        //'status' => 'approve',
                    ]);
                    ?>
                    
                    <div class="data-b">
                        <h2 class="data-b-title">
                            Comments
                        </h2>

                        <?php if (!empty($comments)) : ?>
                            <div class="data-list-out">
                                <ul class="data-list">
                                    <?php
                                    wp_list_comments(array(
                                        'callback'   => 'wcl_comments',
                                        'reply_text' => 'Reply now',
                                    ), $comments);
                                    ?>
                                </ul>
                                <div class="data-list-el"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="data-a-col">
                    <div class="data-c">

                        <div class="data-c-form">
                            <?php
                            $arg = [
                                'title_reply'          => 'Leave a comment',
                                'comment_notes_before' => '',
                                'label_submit'         => 'SUBMIT',
                            ];
                            comment_form($arg);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-share">
                <div class="data-share-text">
                    Share this post:
                </div>

                <ul class="data-share-list">
                    <li class="data-share-item">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>

                    <li class="data-share-item">
                        <a href="https://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>" target="_blank">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>