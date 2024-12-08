<?php


$manual_or_automatic_form_fields_below = get_field('manual_or_automatic_form_fields_below');
$manual_or_automatic_form_fields_below = !empty($manual_or_automatic_form_fields_below) ? $manual_or_automatic_form_fields_below : 'manual';

if ($manual_or_automatic_form_fields_below == 'automatic') {
    $place_info_booking      = get_field('place_info_booking', get_the_ID());
    $address                 = $place_info_booking['place_address'];
    $google_map_address_link = $place_info_booking['place_address_link'];

    $address = wcl_format_address($address);

} else {
    $address = get_field('address');
    $google_map_address_link = get_field('google_map_address_link');
}
?>
<!-- Acf Block #14 - Google Map Address -->
<?php if (!empty($address)) : ?>
    <div class="wcl-acf-block-14">
        <div class="data-container wcl-container">
            <div class="data-address">
                <?php if (!empty($google_map_address_link)) : ?>
                    <a class="data-address-inner" href="<?php echo $google_map_address_link; ?>" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/Location-blue.svg'; ?>" alt="img">
                        <?php echo $address . ' - Google Map'; ?>
                    </a>
                <?php else : ?>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/Location-blue.svg'; ?>" alt="img">
                    <?php echo $address . ' - Google Map'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>