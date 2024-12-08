<?php


?>
<form role="search" method="get" class="search-form" action="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Пошук товарів', 'placeholder', 'textdomain'); ?>" value="<?php echo get_search_query(); ?>" name="s" />

	<button type="submit" class="search-submit">
		<img src="<?php echo get_stylesheet_directory_uri() . '/img/search-btn.svg'; ?>" alt="img">
	</button>
</form>