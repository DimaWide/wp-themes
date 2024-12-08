<?php

?>
<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button') ?>">
		<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/search-dark.svg', false); ?>
	</button>

	<input type="search" class="search-field" required placeholder="<?php echo esc_attr_x('Enter keyword', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />

	<div class="data-close">
		<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/close-black.svg', false); ?>
	</div>
</form>