<?php

$pages             = get_field('pages', 'option');
$video_listing     = $pages['video_listing'];
$video_listing_obj = get_post($video_listing);

if ($video_listing_obj && !empty($video_listing_obj->post_content)) {
	$content = apply_filters('the_content', $video_listing_obj->post_content);
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