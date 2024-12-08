<?php

$card        = get_field('card', 'option');
$image_1     = $card['image_1'];
$image_1     = wp_get_attachment_image($image_1, 'image-size-9');
$image_2     = $card['image_2'];
$image_2     = wp_get_attachment_image($image_2, 'image-size-9');
$style       = get_sub_field('style');
$style       = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style;

$instagram = get_field('instagram', 'option');
$account_1 = $instagram['account_1'];

$pages     = get_field('pages', 'option');
$contact   = $pages['contact'];
$shop      = $pages['shop'];

$splendor_collective_subscription = get_field('splendor_collective_subscription', 'option');
?>
<div class="wcl-section-17 <?php echo $style_class; ?>">
    <div class="data-container wcl-container">
        <?php if ($style == 'two') : ?>
            <div class="data-row">
                <div class="data-col">
                    <div class="data-a">
                        <?php if (!empty($image_1)) : ?>
                            <div class="data-a-img">
                                <?php echo $image_1; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="data-a-title">
                            Private IG <br> Community
                        </h3>

                        <div class="data-a-link">
                            <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link">
                                <span>Follow now</span>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-b">
                        <div class="data-b-a">
                            <div class="data-b-subtitle">
                                Curated
                            </div>

                            <h3 class="data-b-title">
                                Shopping
                                <br>
                                lists
                            </h3>
                        </div>

                        <div class="data-b-link">
                            <a href="<?php echo get_permalink($shop); ?>" class="wcl-link">
                                <span>Shop now</span>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-a mod-v2">
                        <?php if (!empty($image_2)) : ?>
                            <div class="data-a-img">
                                <?php echo $image_2; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="data-a-title">
                            Private fb Community
                        </h3>

                        <div class="data-a-link">
                            <a href="#" class="wcl-link">
                                <span>Join now</span>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-b">
                        <div class="data-b-subtitle">
                            Still not convinced?
                        </div>

                        <h3 class="data-b-title">
                            Get in
                            <br>
                            Touch.
                        </h3>

                        <div class="data-b-link">
                            <a href="<?php echo get_permalink($contact); ?>" class="wcl-link">
                                Contact
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="data-row">
                <div class="data-col">
                    <div class="data-a">
                        <?php if (!empty($image_1)) : ?>
                            <div class="data-a-img">
                                <?php echo $image_1; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="data-a-title">
                            instagram
                        </h3>

                        <?php if (!empty($account_1)) : ?>
                            <?php
                            $link_url    = $account_1['url'];
                            $link_title  = $account_1['title'];
                            $link_target = $account_1['target'] ?: '_self';
                            ?>
                            <div class="data-a-link">
                                <a href="<?php echo $link_url; ?>" class="wcl-link" target="<?php echo $link_target; ?>">
                                    <span>Follow now</span>
                                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-b mod-v2">
                        <div class="data-b-a">
                            <div class="data-b-subtitle">
                                The Subscription
                            </div>

                            <h3 class="data-b-title">
                                Splendor
                                <br>
                                collective
                            </h3>
                        </div>

                        <div class="data-b-link">
                            <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link">
                                <span>Join now</span>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-a mod-v2">
                        <?php if (!empty($image_2)) : ?>
                            <div class="data-a-img">
                                <?php echo $image_2; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="data-a-title">
                            Contact
                        </h3>

                        <div class="data-a-link">
                            <a href="<?php echo get_permalink($contact); ?>" class="wcl-link">
                                <span>Get in Touch</span>
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="data-col">
                    <div class="data-b">
                        <div class="data-b-subtitle">
                            Annette’s
                        </div>

                        <h3 class="data-b-title">
                            Monthly
                            <br>
                            Picks
                        </h3>

                        <div class="data-b-link">
                            <a href="<?php echo get_permalink($splendor_collective_subscription); ?>" class="wcl-link">
                                Shop now
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>