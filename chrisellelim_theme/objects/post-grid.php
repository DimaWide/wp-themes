<?php $category = get_main_cat( $post ); ?>
<div class='post <?php if($post->post_excerpt != ''){ echo 'w-excerpt'; } ?> <?php if(@$loaded){ echo 'loaded'; } ?>'>
	<?php $video = get_post_meta( $post->ID, '_post_small_video', true); ?>
	<?php $preview_image = get_post_meta( $post->ID, '_post_preview_image_id', true); ?>
	
	<?php if($video): ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<div class='video-wrap'>
			<video autoplay loop muted playsinline>
				<source src="<?php echo $video; ?>">
			</video>
		</div>
	</a>
	<?php elseif($preview_image): ?>
	
	<?php $featured_image = exsite_image_resize($preview_image, '395x398', false); ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<img src="<?php echo $featured_image; ?>">
	</a>
	
	<?php else: ?>
	
	<?php $featured_image_id = get_post_thumbnail_id($post->ID); ?>
	<?php $featured_image = exsite_image_resize($featured_image_id, '395x398', false); ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<img src="<?php echo $featured_image; ?>">
	</a>
	
	<?php endif; ?>
	<div class='content'>
	<h2>
		<a href='<?php echo get_permalink( $post->ID ); ?>'>
			<?php echo $post->post_title; ?>
		</a>
	</h2>
	<?php if($post->post_excerpt != ''): ?>
	<p><?php echo $post->post_excerpt; ?></p>
	<?php else: ?>
	<p><?php echo exsite_excerpt($post->post_content,'',25,false); ?></p>
	<?php endif; ?>
	<h3>
		<a href='<?php echo get_term_link( $category ); ?>'>
			<?php echo $category->name; ?>
		</a> 
		<?php echo exsite_time_ago( $post->post_date ); ?>
	</h3>
	</div>
</div>




