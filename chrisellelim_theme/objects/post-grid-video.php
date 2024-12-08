<?php $category = get_main_cat( $post ); ?>
<div class='post video-grid-post <?php echo $section_class; ?>  <?php if($post->post_excerpt != ''){ echo 'w-excerpt'; } ?>' data-post="<?php echo $post->ID; ?>">
	<?php $video = get_post_meta( $post->ID, '_post_small_video', true); ?>
	<?php $preview_image = get_post_meta( $post->ID, '_post_preview_image_id', true); ?>
	
	<?php if($video): ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<div class='video-wrap'>
			<svg class='play' data-post="<?php echo $post->ID; ?>">
				<use xlink:href="#play"></use>
			</svg>
			<video autoplay loop muted playsinline>
				<source src="<?php echo $video; ?>">
			</video>
		</div>
	</a>
	<?php elseif($preview_image): ?>
	
	<?php $featured_image = exsite_image_resize($preview_image, '564x319'); ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<span class='video-trigger' data-post="<?php echo $post->ID; ?>"><svg class='play'><use xlink:href="#play"></use></svg></span>
		<img src="<?php echo $featured_image; ?>">
	</a>
	
	<?php else: ?>
	
	<?php $featured_image_id = get_post_thumbnail_id($post->ID); ?>
	<?php $featured_image = exsite_image_resize($featured_image_id, '564x319'); ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<span class='video-trigger' data-post="<?php echo $post->ID; ?>"><svg class='play'><use xlink:href="#play"></use></svg></span>
		<img src="<?php echo $featured_image; ?>">
	</a>
	
	<?php endif; ?>
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

