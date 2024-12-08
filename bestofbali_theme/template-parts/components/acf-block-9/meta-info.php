<?php



$place_price_range  = $args['meta_info']['place_price_range'];
$place_address      = $args['meta_info']['place_address'];
$place_address_link = $args['meta_info']['place_address_link'];

$place_address = wcl_format_address($place_address);
?>
<?php if (!empty($place_price_range) || !empty($place_address)) : ?>
    <div class="data-meta-2">
        <?php if (!empty($place_address)) : ?>
            <div class="data-meta-2-item">
                <?php if (!empty($place_address_link)) : ?>
                    <a class="data-meta-2-item-inner" href="<?php echo $place_address_link; ?>" target="_blank">
                        <div class="data-meta-2-item-icon">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_Location.svg'; ?>" alt="img">
                        </div>

                        <div class="data-meta-2-item-text">
                            <?php echo $place_address; ?>
                            <span> - Google Map</span>
                        </div>
                    </a>
                <?php else : ?>
                    <div class="data-meta-2-item-icon">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_Location.svg'; ?>" alt="img">
                    </div>

                    <div class="data-meta-2-item-text">
                        <?php echo $place_address; ?>
                        <span> - Google Map</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($place_price_range)) : ?>
            <div class="data-meta-2-item mod-price">
                <div class="data-meta-2-item-icon">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_dollar-symbol.svg'; ?>" alt="img">
                </div>

                <div class="data-meta-2-item-text">
                    <span>Price Range: </span>
                    <?php echo wcl_get_price_range($place_price_range); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>