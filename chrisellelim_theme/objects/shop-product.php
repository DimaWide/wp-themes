<?php $link = get_post_meta( $product->ID, 'link', true ); ?>
<div class='product'>
	<div class='img-wrap'>
		<a href='<?php echo $link; ?>' target="_blank">
			<?php $image = exsite_image_resize(get_post_thumbnail_id($product->ID), '350x0'); ?>
			<img src="<?php echo $image; ?>">
		</a>
	</div>
	<span><a href='<?php echo $link; ?>' target="_blank"><?php echo get_post_meta( $product->ID, 'brand', true ); ?></a></span>
	<h3><a href='<?php echo $link; ?>' target="_blank"><?php echo $product->post_title; ?></a></h3>
</div>
