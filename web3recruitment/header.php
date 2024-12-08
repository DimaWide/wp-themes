<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->

	<?php
	$logo = get_field('logo', 'option');
	$logo = wp_get_attachment_image($logo, 'full');
	$get_in_touch = get_field('get_in_touch', 'option');
	?>
	<div class="wcl-body-inner">
		<header class="wcl-header">
			<div class="data-container wcl-container">
				<div class="data-row">
					<div class="data-col">
						<div class="data-logo">
							<a href="<?php echo site_url('/'); ?>">
								<?php if (!empty($logo)) : ?>
									<?php echo $logo; ?>
								<?php else :
									echo get_bloginfo('name');
								endif; ?>
							</a>
						</div>
					</div>

					<div class="data-col">
						<div class="data-menu-btn mod-to-open">
							<div class="data-menu-btn-ico ">
								<div class="bar bar-top"></div>
								<div class="bar bar-middle"></div>
								<div class="bar bar-bottom"></div>
							</div>
						</div>

						<nav class="data-nav">
							<div class="data-logo">
								<a href="<?php echo site_url('/'); ?>">
									<?php if (!empty($logo)) : ?>
										<?php echo $logo; ?>
									<?php else :
										echo get_bloginfo('name');
									endif; ?>
								</a>
							</div>

							<div class="data-menu-btn mod-to-close">
								<div class="data-menu-btn-ico active">
									<div class="bar bar-top"></div>
									<div class="bar bar-middle"></div>
									<div class="bar bar-bottom"></div>
								</div>
							</div>

							<?php wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '<ul class="data-nav-menu">%3$s</ul>',
									'theme_location' => 'main-menu',
									'depth'          => 2,
									'fallback_cb'    => '__return_empty_string',
								)
							); ?>
						</nav>

						<?php if (!empty($get_in_touch)) : ?>
							<?php
							$link_url    = $get_in_touch['url'];
							$link_title  = $get_in_touch['title'];
							$link_target = $get_in_touch['target'] ?: '_self';
							?>

							<div class="data-btn">
								<a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
									<?php echo $link_title; ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->
