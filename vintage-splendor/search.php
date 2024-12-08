<?php

get_header();


$search = get_query_var('s');
$paged       = 1;
$page_items  = 4;
$offset      = ($paged - 1) * $page_items;
$have_post   = 'mod-posts-empty';

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => $page_items,
	'offset'         => $offset,
	's'              => $search,
	'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);

$empty_posts_class = '';
if (empty($query_obj->posts)) {
	$empty_posts_class = 'mod-empty-posts';
}
?>
<div class="wcl-search wcl-stories-sc-2 js-wcl-stories-sc-2 <?php echo $empty_posts_class; ?>" data-search="<?php echo esc_attr($search); ?>">
	<div class="data-container wcl-container">
		<div class="data-b1">
			<h2 class="data-title">
				<?php esc_html_e('I am looking for', 'theme'); ?>
			</h2>

			<form class="data-form" action="<?php echo esc_url(home_url('/')); ?>">
				<input type="text" placeholder="Search" name="s" value="<?php echo trim(esc_attr(get_search_query())); ?>">
				<input type="hidden" name="post-type" value="<?php echo $post_type; ?>">
			</form>
		</div>

		<div class="data-list">
			<?php if ($query_obj->have_posts()) : ?>
				<?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
					<?php get_template_part('template-parts/stories/item'); ?>
				<?php endwhile;
				wp_reset_postdata(); ?>
			<?php else : ?>
				<div class="data-list-empty wcl-label-empty">
					Nothing found
				</div>

				<div class="data-link">
					<a href="<?php echo site_url('/'); ?>" class="wcl-link mod-black-to-white mod-center">
						<?php _e('BACK TO HOMEPAGE'); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<?php
		$load_more_class = '';
		if (count($query_obj->posts) % 2 !== 0) {
			$load_more_class = 'mod-offset-clear';
		}
		?>
		<div class="wcl-t4-load-more <?php echo $load_more_class; ?>">
			<div class="t4-container">
				<?php if ($pages_el > 1) : ?>
					<button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>">
						More Stories
					</button>
				<?php else : ?>
					<button class="t4-btn wcl-link" data-page="<?php echo $paged; ?>" disabled="true">
						All Viewed
					</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
