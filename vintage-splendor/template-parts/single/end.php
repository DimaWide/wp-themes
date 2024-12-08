<?php

$logo   = get_field('logo', 'option');
$logo   = wp_get_attachment_image($logo, 'full');

$cooment_state = '';
if (!empty($_COOKIE['cooment_state'])) {
    $cooment_state = $_COOKIE['cooment_state'];
    $cooment_state = 'active';
}

?>
<div class="wcl-single-end">
    <div class="data-container wcl-container">
        <div class="data-b1">
            <div class="data-b1-line"></div>

            <?php if (!empty($logo)) : ?>
                <div class="data-b1-logo">
                    <?php echo $logo; ?>
                </div>
            <?php endif; ?>

            <div class="data-b1-line"></div>
        </div>

        <div class="data-b2">
            <div class="data-b2-row">
                <div class="data-b2-col">
                    <?php if (comments_open()) : ?>
                        <div class="data-b2-btn wcl-link mod-center <?php echo $cooment_state; ?>">
                            <span>Join the Conversation</span>
                            <span>Leave the Conversation</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-b2-col">
                    <div class="data-b2-note">
                        Thank you for reading.
                    </div>
                </div>

                <div class="data-b2-col">
                    <div class="data-b2-share">
                        <div class="data-b2-share-inner">
                            <div class="data-b2-share-label">
                                Share
                            </div>

                            <div class="data-b2-share-list">
                                <div class="data-b2-share-list-item">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
                                        Facebook
                                    </a>
                                </div>

                                <div class="data-b2-share-list-item">
                                    <a href="https://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>" target="_blank">
                                        Twitter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>