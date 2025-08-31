<?php

$data = get_tesla_configurator_data();

$selectedModel = $data['selectedModel'];
?>
<div class="cmp-4-popup mod-shipping-calculator" data-id="shipping-calculator">
    <div class="cmp4-overlay"></div>
    <div class="cmp4-inner-out">
        <div class="cmp4-inner">
            <div class="cmp-3-shipping-calculator" data-active-index="<?php echo $activeSlideIndex; ?>">
                <div class="cmp4-close js-close">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close.svg'; ?>" alt="img">
                </div>

                <div class="cmp3-inner">
                    <h3 class="cmp3-title">
                        Calculate shipping
                    </h3>

                    <?php
                    woocommerce_shipping_calculator();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>