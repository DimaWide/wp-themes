<?php

$class_block = '';

if (!empty($args)) {
    $class_block = $args['classNameBlock'];
}

$google_api_key = get_field('google_api_key', 'option');
$title          = get_field('title');
$work_hours     = get_field('work_hours', 'option');
$social_media   = get_field('social_media', 'option');
?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key; ?>&callback=initMap"></script>

<!-- Acf Block #6 – Наші контакти -->
<div class="wcl-acf-block-6 <?php echo $class_block; ?>">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="cmp-title data-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <div class="data-row">
            <div class="data-col">
                <?php if (have_rows('shops', 'option')) : ?>
                    <div class="data-shops">
                        <?php while (have_rows('shops', 'option')) : the_row(); ?>
                            <?php
                            $phone = get_sub_field('phone');
                            $address = get_sub_field('address');
                            ?>
                            <div class="data-shops-item">
                                <div class="data-shops-item-row">
                                    <div class="data-shops-item-col">
                                        <div class="data-shops-item-label">
                                            Телефон
                                        </div>

                                        <?php if (!empty($phone)) : ?>
                                            <div class="data-shops-item-value">
                                                <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="data-shops-item-col">
                                        <div class="data-shops-item-label">
                                            Адреса
                                        </div>

                                        <?php if (!empty($address)) : ?>
                                            <address class="data-shops-item-value">
                                                <?php echo $address; ?>
                                            </address>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('shops', 'option')) : ?>
                    <div class="data-map mod-v2">
                        <div class="data-map-item"></div>

                        <div class="data-map-markers">
                            <?php while (have_rows('shops', 'option')) : the_row();
                                $place_on_map = get_sub_field('place_on_map');
                            ?>
                                <div class="data-map-marker" data-address="<?php echo esc_attr($place_on_map['address']); ?>" data-lat="<?php echo esc_attr($place_on_map['lat']); ?>" data-lng="<?php echo esc_attr($place_on_map['lng']); ?>">
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="data-b1">
                    <div class="data-b1-row">
                        <div class="data-b1-col">
                            <?php if (!empty($work_hours)) : ?>
                                <div class="data-work-hours">
                                    <div class="data-work-hours-label">
                                        Час роботи:
                                    </div>

                                    <div class="data-work-hours-info">
                                        <?php echo $work_hours; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="data-b1-col">
                            <div class="data-social">
                                <div class="data-social-label">
                                    Ми в соц. мережах
                                </div>

                                <?php if (!empty($social_media)) : ?>
                                    <ul class="cmp-2-social-media">
                                        <?php if (!empty($social_media['facebook'])) : ?>
                                            <li class="cmp2-item">
                                                <a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank" rel="noopener nofollow">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/facebook.svg'; ?>" alt="img">
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($social_media['instagram'])) : ?>
                                            <li class="cmp2-item">
                                                <a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram.svg'; ?>" alt="img">
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($social_media['telegram'])) : ?>
                                            <li class="cmp2-item">
                                                <a href="<?php echo $social_media['telegram']['url']; ?>" target="_blank" rel="noopener nofollow">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/telegram.svg'; ?>" alt="img">
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-col">
                <?php if (have_rows('shops', 'option')) : ?>
                    <div class="data-map">
                        <div class="data-map-item"></div>

                        <div class="data-map-markers">
                            <?php while (have_rows('shops', 'option')) : the_row();
                                $place_on_map = get_sub_field('place_on_map');
                            ?>
                                <div class="data-map-marker" data-address="<?php echo esc_attr($place_on_map['address']); ?>" data-lat="<?php echo esc_attr($place_on_map['lat']); ?>" data-lng="<?php echo esc_attr($place_on_map['lng']); ?>">
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function initMap() {
        // wcl-acf-block-6
        if (document.querySelector('.wcl-acf-block-6')) {
            let section = document.querySelector('.wcl-acf-block-6')

            // Define custom map styles
            var customMapStyles = [{
                    featureType: 'landscape',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#D2F7E1'
                    }]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#9e9e9e'
                    }]
                },
                // Add more custom styles as needed
            ];


            section.querySelectorAll('.data-map').forEach(map_elem => {
                var map = new google.maps.Map(map_elem.querySelector('.data-map-item'), {
                    zoom: 8.3,
                    center: {
                        lat: 50.443028048389984,
                        lng: 31.6556914738394,
                    }, // Начальные координаты центра карты
                    styles: customMapStyles // Apply custom map styles here
                });

                // Добавление маркеров на карту и соответствующих дивов на страницу
                var markers = map_elem.querySelectorAll('.data-map-marker');
                markers.forEach(function(markerElem) {
                    var lat = parseFloat(markerElem.getAttribute('data-lat'));
                    var lng = parseFloat(markerElem.getAttribute('data-lng'));
                    var address = markerElem.getAttribute('data-address');

                    var marker = new google.maps.Marker({
                        position: {
                            lat: lat,
                            lng: lng
                        },
                        map: map,
                        title: address,
                        icon: '<?php echo esc_url(get_template_directory_uri() . '/img/marker-ico.svg'); ?>',
                        scaledSize: new google.maps.Size(46, 59) //
                    });

                    var infowindow = new google.maps.InfoWindow({
                        content: '<p>' + address + '</p>'
                    });

                    // Отображение информационного окна при клике на маркер
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                });
            });
        }
    }
</script>