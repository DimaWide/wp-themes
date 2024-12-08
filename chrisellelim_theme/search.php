<?php

get_header();

$paged       = 1;
$page_items  = get_option( 'posts_per_page' );
$offset      = ($paged - 1) * $page_items;
$search_term = get_query_var('s');

$args = array(
	'post_type'      => ['post', 'page', 'video'],
	'posts_per_page' => $page_items,
	'offset'         => $offset,
	'paged'          => $paged,
	's'              => $search_term,
	'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
?>
<div class="wcl-search">
	<div class="data-container wcl-container">
		<h2 class="data-title">
			<?php esc_html_e('Search Results for:', 'theme'); ?>
			<?php echo get_query_var('s'); ?>
		</h2>

		<?php if ($query_obj->have_posts()) : ?>
			<div class="data-list">
				<?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
					<?php get_template_part('template-parts/search/item'); ?>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div class="data-list-empty">Nothing found</div>
		<?php endif; ?>
	</div>

	<div class="wcl-load-more">
		<div class="data-container" data-search="<?php echo esc_attr($search_term); ?>">
			<?php if ($pages_el > 1) : ?>
				<button class="data-btn wcl-link" data-page="<?php echo $paged; ?>">
					Load more
				</button>
			<?php else : ?>
				<button class="data-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
					All Viewed
				</button>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();
