<?php

$instagram = get_field('instagram', 'option');
$shortcode = $instagram['shortcode'];
$account_1 = $instagram['account_1'];
$account_2 = $instagram['account_2'];
?>
<?php if (!empty($instagram)) : ?>
    <div class="wcl-instagram">
        <div class="data-src">
            <?php
            echo do_shortcode($shortcode);
            ?>
        </div>

        <div class="data-container wcl-container">
            <div class="data-list">
                <div class="data-item data-item-2">
                    <div class="data-item-2-inner">
                        <h2 class="data-item-2-title">
                            Instagram
                        </h2>

                        <div class="data-links">
                            <div class="data-links-item">
                                <?php if (!empty($account_1)) : ?>
                                    <?php
                                    $link_url    = $account_1['url'];
                                    $link_title  = $account_1['title'];
                                    $link_target = $account_1['target'] ?: '_self';
                                    ?>
                                    <a href="<?php echo $link_url; ?>" class="wcl-link-underline" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="data-links-item">
                                <?php if (!empty($account_2)) : ?>
                                    <?php
                                    $link_url    = $account_2['url'];
                                    $link_title  = $account_2['title'];
                                    $link_target = $account_2['target'] ?: '_self';
                                    ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram_lock.svg'; ?>" alt="img">

                                    <a href="<?php echo $link_url; ?>" class="wcl-link-underline" target="<?php echo $link_target; ?>">
                                        <?php echo $link_title; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>