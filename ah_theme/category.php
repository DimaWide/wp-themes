<?php



get_header();


$blog_page = get_field('blog_page', 'option');
?>
<div class="wcl-page-second">
	<div class="m6-container wcl-container">
		<?php
		$blog_page_obj = get_post($blog_page);
		$content = apply_filters('the_content', $blog_page_obj->post_content);
		echo $content;
		?>
	</div>
</div>


<?php
get_footer();
?>