<?php $category = get_main_cat( $post ); ?>
<?php 
	$image_size = '364x223';
	if($show_category)
		$image_size = '818x533';
?>
<div class='<?php if(isset($video_class)){ echo $video_class; }else{ echo 'video-post'; } ?>' data-post="<?php echo $post->ID; ?>">
	<?php $video = get_post_meta( $post->ID, '_post_small_video', true); ?>
	<?php $preview_image = get_post_meta( $post->ID, '_post_preview_image_id', true); ?>
	
	<?php if($video): ?>
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		<div class='video-wrap'>
			<svg class='play video-trigger' data-post="<?php echo $post->ID; ?>">
				<use xlink:href="#play"></use>
			</svg>
			<video autoplay loop muted playsinline>
				<source src="<?php echo $video; ?>">
			</video>
		</div>
	</a>
	<?php elseif($preview_image): ?>
	
	<?php $featured_image = exsite_image_resize($preview_image, $image_size, false); ?>
	<a class='video-wrap' href='<?php echo get_permalink( $post->ID ); ?>'>
		<svg class='play video-trigger' data-post="<?php echo $post->ID; ?>">
			<use xlink:href="#play"></use>
		</svg>
		<img src="<?php echo $featured_image; ?>">
	</a>
	
	<?php else: ?>
	
	<?php $featured_image_id = get_post_thumbnail_id($post->ID); ?>
	<?php $featured_image = exsite_image_resize($featured_image_id, $image_size, false); ?>
	<a class='video-wrap' href='<?php echo get_permalink( $post->ID ); ?>'>
		<svg class='play video-trigger' data-post="<?php echo $post->ID; ?>">
			<use xlink:href="#play"></use>
		</svg>
		<img src="<?php echo $featured_image; ?>">
	</a>
	
	<?php endif; ?>

	<div class='content'>
		<h2>
			<a href='<?php echo get_permalink( $post->ID ); ?>'>
				<?php echo $post->post_title; ?>
			</a>
		</h2>
		<?php if(isset($video_class)): ?>
		<?php if($post->post_excerpt != ''): ?>
		<p><?php echo $post->post_excerpt; ?></p>
		<?php else: ?>
		<p><?php echo exsite_excerpt($post->post_content,'',25,false); ?></p>
		<?php endif; ?>
		<?php endif; ?>
		
		<?php if($show_category): ?>
		<h3>
			<a href='<?php echo get_term_link( $category ); ?>'>
				<?php echo $category->name; ?>
			</a> 
		</h3>
		<?php endif; ?>
	</div>
</div>