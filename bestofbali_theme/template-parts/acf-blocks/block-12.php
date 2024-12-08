<?php


$place_id = get_field('place_id');
$use_static_data_from_current_place = get_field('use_static_data_from_current_place');

if (!empty($use_static_data_from_current_place) || empty($place_id)) {
    $place_info_booking = get_field('place_info_booking', get_the_ID());
    if (! empty($place_info_booking )) {
        $place_id = $place_info_booking['place_google_id'];
    }
}
?>
<!-- Acf Block #12 – Google Map by Place Id -->
<?php if (!empty($place_id)) : ?>
    <div class="wcl-acf-block-12">
        <div class="data-container wcl-container">
            <div class="data-map" data-place-id="<?php echo $place_id; ?>"></div>
        </div>
    </div>
<?php endif; ?>