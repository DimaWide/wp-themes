<?php

$instagrams  = get_field('instagram', 'option');
$bumo_page   = get_field('bumo_page', 'option');
$instagram   = '';
$instagram_1 = $instagrams[0]['shortcode'];
$instagram_2 = $instagrams[1]['shortcode'];
if (is_page($bumo_page)) {
    $instagram = $instagram_2;
} else {
    $instagram = $instagram_1;
}
?>
<div class="wcl-instagram">
    <?php if (!empty($instagram)) : ?>
        <div class="data-src">
            <?php
            echo do_shortcode($instagram);
            ?>
        </div>
    <?php endif; ?>

    <?php
    $social = get_field('social', 'option');
    ?>
    <div class="data-container">
        <div class="data-list">
            <div class="data-item"></div>
            <div class="data-item-a data-item">
                <ul class="data-list-a">
                    <li class="data-list-a-item">
                        Follow on
                    </li>

                    <li class="data-list-a-item">
                        <?php if (!empty($social['instagram'])) : ?>
                            <a href="<?php echo $social['instagram']['url']; ?>" target="_blank">
                                <?php echo $social['instagram']['title']; ?>
                            </a>
                        <?php endif; ?>
                    </li>

                    <?php if (!is_page($bumo_page)) : ?>
                        <li class="data-list-a-item">
                            Watch on
                        </li>

                        <li class="data-list-a-item">
                            Follow on
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="data-item"></div>

            <div class="data-item-a mod-b data-item">
                <ul class="data-list-a">
                    <li class="data-list-a-item">
                        Instagram
                    </li>

                    <li class="data-list-a-item">
                        <?php if (!empty($social['instagram_2'])) : ?>
                            <a href="<?php echo $social['instagram_2']['url']; ?>" target="_blank">
                                <?php echo $social['instagram_2']['title']; ?>
                            </a>
                        <?php endif; ?>
                    </li>

                    <?php if (!is_page($bumo_page)) : ?>
                        <li class="data-list-a-item">
                            <?php if (!empty($social['youtube'])) : ?>
                                <a href="<?php echo $social['youtube']['url']; ?>" target="_blank">
                                    <?php echo $social['youtube']['title']; ?>
                                </a>
                            <?php endif; ?>
                        </li>

                        <li class="data-list-a-item">
                            <?php if (!empty($social['tiktok'])) : ?>
                                <a href="<?php echo $social['tiktok']['url']; ?>" target="_blank">
                                    <?php echo $social['tiktok']['title']; ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="data-item"></div>
        </div>

        <div class="data-list mod-b">
            <div class="data-item"></div>
            <div class="data-item"></div>
            <div class="data-item"></div>
            <div class="data-item"></div>
            <div class="data-item"></div>
        </div>
    </div>
</div>