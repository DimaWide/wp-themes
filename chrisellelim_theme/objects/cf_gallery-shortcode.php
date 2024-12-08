</div>


<?php 
	if(isset($atts['description']))
		$desc = $atts['description'];
	else
		$desc = $innercontent;
?>

<?php global $shop_products; ?>

<?php if($atts['type'] == 'medium-large'): ?>
<div class='gallery-widget'>
	<div class='gallery-wrap'>
		<div class='small-wrap'>
			<?php $featured_image = exsite_image_resize($atts['image_1'], '623x0'); ?>
			<img class='' src="<?php echo $featured_image; ?>">
			<?php 
			if($atts['products'] != '')
			{
				$product_ids = explode(',', $atts['products']);
				foreach($product_ids as $product_id)
				{
					$shop_products[$product_id] = $product_id;
					$product = get_post($product_id);
					$short_name = true;
					include('shop-hover.php');
				}
			}
			?>
		</div>
	</div>
	<div class='gallery-wrap'>
		<?php $featured_image = exsite_image_resize($atts['image_2'], '623x0'); ?>
		<img class='' src="<?php echo $featured_image; ?>">
	</div>
</div>
<?php endif; ?>




<?php if($atts['type'] == 'large-medium'): ?>
<div class='gallery-widget'>
	<div class='gallery-wrap'>
		<?php $featured_image = exsite_image_resize($atts['image_1'], '623x0'); ?>
		<img class='' src="<?php echo $featured_image; ?>">
	</div>
	<div class='gallery-wrap'>
		<div class='small-wrap'>
			<?php $featured_image = exsite_image_resize($atts['image_2'], '623x0'); ?>
			<img class='' src="<?php echo $featured_image; ?>">
			<?php 
			if($atts['products'] != '')
			{
				$product_ids = explode(',', $atts['products']);
				foreach($product_ids as $product_id)
				{
					$shop_products[$product_id] = $product_id;
					$product = get_post($product_id);
					$short_name = true;
					include('shop-hover.php');
				}
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($atts['type'] == 'full'): ?>
<div class='full-image-widget-wrap'>
	<?php $featured_image = exsite_image_resize($atts['image_1'], '2000x0'); ?>
	<div class='full-image-widget' style='background-image: url("<?php echo $featured_image; ?>")'></div>
</div>
<?php endif; ?>



<?php if($atts['type'] == 'content-large'): ?>
<div class='gallery-widget gallery-text-widget'>
	<div class='gallery-wrap'>
		<div class='gallery-content'>
			<?php echo $desc; ?>
		</div>
	</div>
	<div class='gallery-wrap'>
		<?php $featured_image = exsite_image_resize($atts['image_1'], '623x0'); ?>
		<img class='' src="<?php echo $featured_image; ?>">
		<?php 
		if($atts['products'] != '')
		{
			$product_ids = explode(',', $atts['products']);
			foreach($product_ids as $product_id)
			{
				$shop_products[$product_id] = $product_id;
				$product = get_post($product_id);
				$short_name = true;
				include('shop-hover.php');
			}
		}
		?>
	</div>
</div>
<?php endif; ?>




<?php if($atts['type'] == 'large-small-medium'): ?>
<div class='gallery-widget gallery-three-widget'>
	<div class='big-image'>
		<?php $featured_image = exsite_image_resize($atts['image_1'], '623x0'); ?>
		<img class='' src="<?php echo $featured_image; ?>">
	</div>
	<div class='small-images'>
		<?php $featured_image = exsite_image_resize($atts['image_2'], '623x0'); ?>
		<img class='' src="<?php echo $featured_image; ?>">
		<div class='shop-image'>
			<?php $featured_image = exsite_image_resize($atts['image_3'], '623x0'); ?>
			<img class='' src="<?php echo $featured_image; ?>">
			<?php 
			if($atts['products'] != '')
			{
				$product_ids = explode(',', $atts['products']);
				foreach($product_ids as $product_id)
				{
					$shop_products[$product_id] = $product_id;
					$product = get_post($product_id);
					$short_name = true;
					include('shop-hover.php');
				}
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($atts['type'] == 'large-content'): ?>
<div class='large-image-widget'>
	<div class='img-wrap'>
		<?php $featured_image = exsite_image_resize($atts['image_1'], '784x0'); ?>
		<img class='' src="<?php echo $featured_image; ?>">
		<?php 
		if($atts['products'] != '')
		{
			$product_ids = explode(',', $atts['products']);
			foreach($product_ids as $product_id)
			{
				$shop_products[$product_id] = $product_id;
				$product = get_post($product_id);
				$short_name = true;
				include('shop-hover.php');
			}
		}
		?>
	</div>
	<div class='content'>
		<?php echo $desc; ?>
	</div>
</div>
<?php endif; ?>


<?php if($atts['type'] == 'shop-carousel'): ?>
<?php $shop_product_carousel = explode(',', $atts['products']); ?>
<div class='post-slider'>
	<h2><?php echo $atts['content']; ?></h2>
	<div class='slider'>
		<div class='mob-hide'>
			<h2><?php echo $atts['content']; ?></h2>
		</div>
		<?php foreach($shop_product_carousel as $shop_product_id): ?>
		<?php $product = get_post($shop_product_id); ?>
		<?php $link = get_post_meta( $product->ID, 'link', true ); ?>
		<?php $brand = get_post_meta( $product->ID, 'brand', true ); ?>
		
		<div class='slide'>
		     <a href='<?php echo $link; ?>' target="_blank">
			    <?php $image = exsite_image_resize(get_post_thumbnail_id($product->ID), '165x165', false); ?>
				<img class="no-wrap" src="<?php echo $image; ?>">
		     </a>
		     <div class='content'>
		          <h3><a href='<?php echo $link; ?>' target="_blank"><?php echo $brand; ?></a></h3>
		          <h2><a href='<?php echo $link; ?>' target="_blank"><?php echo $product->post_title; ?></a></h2>
		          <a href='<?php echo $link; ?>' target="_blank">Get It <svg class='arrow-right'><use xlink:href="#arrow-right"></use></svg></a>
		     </div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>






<div class='article-content'>