<?php

$args_template       = $args['links']['args_template'] ?? '';
$external_link       = $args['links']['external_link'];
$place_book_now_link = $args['links']['place_book_now_link'];
$add_links_manually  = $args['links']['add_links_manually'];
$links_manually      = $args['links']['links_manually'];
?>
<?php if (!empty($args_template) && ($args_template['block-id'] == 'listing' || $args_template['block-id'] == 15)) : ?>
    <?php if (!empty($external_link) || !empty($place_book_now_link)) : ?>
        <div class="data-links">
            <?php if (!empty($external_link)) : ?>
                <div class="data-links-item">
                    <a href="<?php echo $external_link; ?>" class="wcl-btn" target="_blank">
                        Read More
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($place_book_now_link)) : ?>
                <div class="data-links-item mod-two">
                    <a href="<?php echo $place_book_now_link; ?>" target="_blank">
                        Book via booking.com
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <?php if (!empty($add_links_manually)) : ?>
        <div class="data-links">
            <?php
            $link_1 =  $links_manually['link_1'] ?? '';
            ?>
            <?php if (!empty($link_1)) : ?>
                <?php
                $link_url    = $link_1['url'];
                $link_title  = $link_1['title'];
                $link_target = $link_1['target'] ?: '_self';
                ?>
                <div class="data-links-item">
                    <a href="<?php echo $link_url; ?>" class="wcl-btn" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php
            $link_2 = $links_manually['link_2'] ?? '';
            ?>
            <?php if (!empty($link_2)) : ?>
                <?php
                $link_url    = $link_2['url'];
                $link_title  = $link_2['title'];
                $link_target = $link_2['target'] ?: '_self';
                ?>
                <div class="data-links-item mod-two">
                    <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                        <?php echo $link_title; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($external_link) || !empty($place_book_now_link)) : ?>
            <div class="data-links">
                <?php if (!empty($external_link)) : ?>
                    <div class="data-links-item">
                        <a href="<?php echo $external_link; ?>" class="wcl-btn" target="_blank">
                            Read More
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($place_book_now_link)) : ?>
                    <div class="data-links-item mod-two">
                        <a href="<?php echo $place_book_now_link; ?>" target="_blank">
                            Book via booking.com
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>