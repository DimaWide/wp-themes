
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
</head>

<body <?php body_class(); ?>>

	<!-- 
	======================================================================================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	=======================================================================================================================================
	 -->

	<?php

	$logo = get_field('hd_logo', 'option');
	$header_sticky = '';
	$header_sticky_2 = '';
	$header_sticky = 'sticky';
	$header_sticky_2 = 'header-sticky';
	$style = '';
	if (is_page('about')) {
		$header_sticky = 'sticky-b';
		$header_sticky_2 = 'header-sticky-b';
	} else if (is_front_page()) {
		$header_sticky = 'sticky-b';
		$header_sticky_2 = 'header-sticky-b';
	} else if (is_category()) {
		$header_sticky = 'sticky';
		$header_sticky_2 = 'header-sticky';
	} else if (is_page('378')) {
		$style = 'style-b';
		$header_sticky = 'sticky-b';
		$header_sticky_2 = 'header-sticky-b';
	}
	$header_state = is_front_page() || is_page('378');
	?>
	<div class="wcl-body-inner <?php echo $header_sticky_2; ?>">
		<?php if (is_front_page() || is_page('378')) : ?>
			<?php
			$args =  array(
				'logo' => $logo,
				'style' => $style,
			);
			get_template_part('template-parts/header/item-1', null, $args);
			?>
			<?php
			$args =  array(
				'logo' => $logo,
				'style' => $style,
				'header_sticky' => $header_sticky,
			);
			get_template_part('template-parts/header/item-2', null, $args);
			?>
		<?php else : ?>
			<?php if ($header_state) : ?>
				<?php
				$args =  array(
					'logo' => $logo,
					'style' => $style,
				);
				get_template_part('template-parts/header/item-1', null, $args);
				?>
			<?php else : ?>
				<?php
				$args =  array(
					'logo' => $logo,
					'style' => $style,
					'header_sticky' => $header_sticky,
				);
				get_template_part('template-parts/header/item-2', null, $args);
				?>
			<?php endif; ?>
		<?php endif; ?>