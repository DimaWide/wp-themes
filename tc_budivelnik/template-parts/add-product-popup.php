<?php


?>
<div class="wcl-popup mod-add-product-popup js-add-product-popup" data-id="add-product-popup">
    <div class="data-overlay"></div>

    <div class="data-inner-out">
        <div class="data-close js-close">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/close-popup.svg'; ?>" alt="img">
        </div>

        <div class="wcl-add-product-popup cmp-6-form data-inner">
            <div class="data-text">
                <?php echo get_the_title(); ?>
                <strong>додано до кошика!</strong>
            </div>

            <div class="cmp6-form-btns">
                <div class="cmp6-form-submit">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="cmp-button mod-big mod-btn cmp6-to-cart mod-hover">До кошику</a>
                </div>

                <div class="cmp6-form-reset js-close">
                    <button type="reset" name="reset">
                        Продовжити покупки
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>