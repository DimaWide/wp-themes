<div class='shop-lightbox-shade'></div>
<div class='shop-lightbox-main'>
	<span class='lightbox-close'>Close</span>
	<?php $featured_image = exsite_image_resize(get_post_thumbnail_id($post->ID), '366x366'); ?>
	<div class='main-img'><img class='' src="<?php echo $featured_image; ?>"></div>
	<div class='lightbox-main'>
		<?php $products = get_post_meta( $post->ID, '_instagram_products', true ); ?>
		<?php if($products): ?>
		<div class='lightbox-slider'>
			<?php foreach($products as $product_id): ?>
			<?php $product = get_post($product_id); ?>
			<?php $link = get_post_meta( $product->ID, 'link', true ); ?>
			<div class='slide'>
				<div class='img-wrap'>
					<a href='<?php echo $link; ?>' target="_blank">
						<?php $featured_image = exsite_image_resize(get_post_thumbnail_id($product->ID), '97x169', false); ?>
						<img class='' src="<?php echo $featured_image; ?>">
					</a>
				</div>
				<h3><a href='<?php echo $link; ?>' target="_blank"><?php echo get_post_meta( $product->ID, 'brand', true ); ?></a></h3>
				<h2><a href='<?php echo $link; ?>' target="_blank"><?php echo $product->post_title; ?></a></h2>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class='lightbox-extras'>
			<h2>
				<a href='<?php echo get_post_meta( $post->ID, 'link', true ); ?>' target="_blank"><span>@chrisellelim</span></a>
				<a href="<?php echo exsite_option('instagram'); ?>" target="_blank">Follow Me<svg class='arrow-right'><use xlink:href="#arrow-right"></use></svg></a>
			</h2>
			
			
			<?php 
			$next_video = array();
			$args = array(
			    'posts_per_page'	=> -1,
			    'post_type' => 'instagram'
			);
			$posts = get_posts(  $args );	
			$get_next = false;
			foreach($posts as $insta_check)
			{
				if($get_next)
				{
					$next_post = $insta_check;
					break;
				}
				if($post->ID == $insta_check->ID)
					$get_next = true;
			}
			
			if($next_post):
			?>
			<?php $featured_image = exsite_image_resize(get_post_thumbnail_id($next_post->ID), '63x63'); ?>
			<span class='next-post shop-my-instagram shop-my-instagram-post'  data-id="<?php echo $next_post->ID ; ?>">Next<img src="<?php echo $featured_image; ?>"></span>
			<?php endif; ?>
		</div>
	</div>
</div>


