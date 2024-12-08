<?php


$pages                = get_field('pages', 'option');
$projects_listing     = $pages['projects_listing'];
$projects_listing_obj = get_post($projects_listing);

if ($projects_listing_obj && !empty($projects_listing_obj->post_content)) {
	$content = apply_filters('the_content', $projects_listing_obj->post_content);

	global $post;
	$original_post = $post;
	$post = $projects_listing_obj;

	if (has_block('acf/acf-block-5')) {
		wp_enqueue_style('acf-block-5', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-5/acf-block-5.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-6')) {
		wp_enqueue_style('acf-block-6', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-6/acf-block-6.css', array(), WCL_THEME_VERSION, 'all');
	}

	$post = $original_post;
}

get_header();

?>
<div class="wcl-page">
	<div class="container">
		<?php if (!empty($content)) : ?>
			<div class="data-content">
				<?php echo $content; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
?>