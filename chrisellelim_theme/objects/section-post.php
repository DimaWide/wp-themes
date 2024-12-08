<div class='section-post <?php echo $section_class; ?>  <?php if($post->post_excerpt != ''){ echo 'w-excerpt'; } ?>'>
	
	
	<?php 
		$image_size = '395x398';
		if($section_class == 'large')
			$image_size = '819x535';
	?>
	
	<?php $featured_image_id = get_post_thumbnail_id($post->ID); ?>
	<?php $featured_image = exsite_image_resize($featured_image_id, $image_size, false); ?>
	
	<a href='<?php echo get_permalink( $post->ID ); ?>'>
		
		
		<?php $video = get_post_meta( $post->ID, '_post_big_video', true); ?>
	
		<?php if($video): ?>
		
		<div class='video-wrap'>
			<svg class='play'><use xlink:href="#play"></use></svg>
			<video autoplay loop muted playsinline>
				<source src="<?php echo $video; ?>">
			</video>
		</div>	
		
		<?php else: ?>
		
		<img src="<?php echo $featured_image; ?>">
		
		<?php endif; ?>
	</a>
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
</div>