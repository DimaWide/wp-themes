<?php $link = get_post_meta( $product->ID, 'link', true ); ?>
<a href='<?php echo $link; ?>' class='shop-hover' target="_blank">
	
	<?php $title = $product->post_title;
		if(isset($short_name))
		{
			$short_name = get_post_meta( $product->ID, 'short_name', true );
			if($short_name)
				$title = $short_name;
		}
	?>
	
	<span><?php echo $title; ?></span><?php echo get_post_meta( $product->ID, 'brand', true ); ?>
	<svg class='plus'>
		<use xlink:href="#plus"></use>
	</svg>
	<svg class='diag'>
		<use xlink:href="#diag"></use>
	</svg>
	<div class='shop-hover-item'>
		<?php $image = exsite_image_resize(get_post_thumbnail_id($product->ID), '350x0'); ?>
		<img class="no-wrap" src="<?php echo $image; ?>">
	</div>
</a>
