<?php

$shortcode = get_field('instagram_shortcode', 'option');
?>
<?php if (!empty($shortcode)) : ?>
    <div class="wcl-instagram">
        <div class="data-src">
            <?php
            echo do_shortcode($shortcode);
            ?>
        </div>

        <div class="data-container wcl-container">
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>