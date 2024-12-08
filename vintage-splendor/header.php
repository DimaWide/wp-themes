

<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/AVS_Favicon.jpg" type="image/x-icon">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/AVS_Favicon.jpg" type="image/x-icon">

	<?php wp_head(); ?>

	<?php if ($_SERVER["SERVER_ADDR"] != '127.0.0.1') : ?>
		<script>
			window.Userback = window.Userback || {};
			Userback.access_token = '29700|81278|8siNujGo3FtHIbHdIxqvySxG2';
			(function(d) {
				var s = d.createElement('script');
				s.async = true;
				s.src = 'https://static.userback.io/widget/v1.js';
				(d.head || d.body).appendChild(s);
			})(document);
		</script>
	<?php endif; ?>

	

	<?php if ($_SERVER["SERVER_ADDR"] == '127.0.0.1') : ?>
		<?php if (is_user_logged_in()) : ?>
			<style>
				/* .wcl-header.mod-sticky-offset {
					display: none;
				}

				.wcl-header.mod-sticky {
					position: absolute;
				} */
			</style>
		<?php endif; ?>
	<?php endif; ?>
</head>

<?php
$page_type       = get_field('page_type');
$page_type_class = !empty($page_type) ? 'wcl-' . $page_type : '';

$cat       = get_queried_object();
$cats      = ['splendor-collective-stories', 'shopping-lists', 'splendor-collective-guides', 'splendor-collective'];
$cat_class = '';

if (in_array($cat->slug, $cats)) {
	$cat_class = 'wcl-exclusive-cat';
}

$about_page       = get_field('pages', 'option');
$about_page       = $about_page['about'];
$about_page_class = '';

if (get_the_ID() == $about_page) {
	$about_page_class = ' mod-about-page';
}
?>

<body <?php body_class($page_type_class . ' ' . $cat_class . $about_page_class); ?>>


	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->


	<?php
	$pages                   = get_field('pages', 'option');
	$the_splendor_collective = $pages['the_splendor_collective'];
	?>
	<?php if (is_page($the_splendor_collective)) : ?>
		<div class="wcl-t7-bg"></div>
	<?php endif; ?>

	<div class="wcl-body-inner">
		<?php if ($page_type == 'splendor-collective' || is_singular('product')) : ?>
			<?php get_template_part('template-parts/header/item-2'); ?>
		<?php else : ?>
			<?php get_template_part('template-parts/header/item-1'); ?>
		<?php endif; ?>