<?php
$google_api_key = get_field('bob_google_api_key', 'option');
?>
<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php wp_head(); ?>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key; ?>&libraries=places&callback=initMap"></script>

	<script>
		/* 
		initMap
		*/
		function initMap() {
			// wcl-acf-block-12 

			if (document.querySelector('.wcl-acf-block-12, .wcl-section-3')) {
				let sections = document.querySelectorAll('.wcl-acf-block-12, .wcl-section-3');

				sections.forEach(element => {
					let map_el = element.querySelector('.data-map')

					let placeId = map_el.getAttribute('data-place-id')

					let map = new google.maps.Map(map_el, {
						center: {
							lat: -33.8666,
							lng: 151.1958
						}, // Default to Sydney, Australia
						zoom: 15
					});

					let request = {
						placeId: placeId,
						fields: ['name', 'formatted_address', 'geometry']
					};

					let service = new google.maps.places.PlacesService(map);

					service.getDetails(request, function(place, status) {
						if (status === google.maps.places.PlacesServiceStatus.OK) {
							let marker = new google.maps.Marker({
								map: map,
								position: place.geometry.location
							});

							map.setCenter(place.geometry.location);
						}
					});
				});
			}
		}
	</script>
</head>

<?php
$banner_is_active = '';

if (is_page() || is_single()) {
	$banner_is_active = is_banner_first(get_the_ID());

	$places_by_rating = get_field('show_the_best_places_by_rating', get_the_ID());

	if (!empty($places_by_rating)) {
		$enable = $places_by_rating['enable'];

		if (!empty($enable)) {
			$banner_is_active = true;
		}
	}

	$banner_is_active = !empty($banner_is_active) ? 'mod-have-banner' : '';
}
?>

<body <?php body_class($banner_is_active); ?>>


	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->

	<div class="wcl-body-inner">

		<!-- HEADER -->
		<header class="wcl-header" id="wcl-main-header">
			<div class="data-container wcl-container">
				<div class="data-row">
					<div class="data-col">
						<div class="data-logo">
							<a href="<?php echo site_url('/'); ?>">
								<?php echo get_bloginfo('name'); ?>
							</a>
						</div>
					</div>

					<div class="data-col">
						<div class="data-nav">
							<div class="data-nav-inner">
								<?php wp_nav_menu(
									array(
										'container'      => '',
										'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
										'theme_location' => 'main-menu',
										'depth'          => 2,
										'fallback_cb'    => '',
										'link_before' => '<span>', 'link_after' => '</span>',
									)
								); ?>

								<?php if (!empty($social_media)) : ?>
									<ul class="wcl-social mod-mobile">
										<?php if (!empty($social_media['facebook'])) : ?>
											<li class="m3-item">
												<a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank">
													<img src="<?php echo get_stylesheet_directory_uri() . '/img/icon-facebook.svg'; ?>" alt="img">
												</a>
											</li>
										<?php endif; ?>

										<?php if (!empty($social_media['instagram'])) : ?>
											<li class="m3-item">
												<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank">
													<img src="<?php echo get_stylesheet_directory_uri() . '/img/icon-instagram.svg'; ?>" alt="img">
												</a>
											</li>
										<?php endif; ?>
									</ul>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="data-col">
						<div class="data-search toggle-search">
							<img src="<?php echo get_stylesheet_directory_uri() . '/img/search.svg'; ?>" alt="img">
						</div>

						<?php if (!empty($social_media)) : ?>
							<ul class="wcl-social">
								<?php if (!empty($social_media['facebook'])) : ?>
									<li class="m3-item">
										<a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank">
											<img src="<?php echo get_stylesheet_directory_uri() . '/img/icon-facebook.svg'; ?>" alt="img">
										</a>
									</li>
								<?php endif; ?>

								<?php if (!empty($social_media['instagram'])) : ?>
									<li class="m3-item">
										<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank">
											<img src="<?php echo get_stylesheet_directory_uri() . '/img/icon-instagram.svg'; ?>" alt="img">
										</a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

						<div class="data-btn-menu">
							<div class="data-btn-menu-item">
								<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/menu-btn.svg', false); ?>
							</div>

							<div class="data-btn-menu-item">
								<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/menu-close.svg', false); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->

		<div class="wcl-search">
			<div class="data-container wcl-container">
				<?php get_search_form(); ?>
			</div>
		</div>