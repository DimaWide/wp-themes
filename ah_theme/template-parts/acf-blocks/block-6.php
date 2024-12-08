<?php


$categories = [];

if (!empty(get_query_var('wcl_category_name'))) {
	$categories = get_query_var('wcl_category_name');
}

// Get Posts

$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = 9;
$offset     = ($page - 1) * $page_items;

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => $page_items,
	'paged'          => $page,
	'offset'         => $offset,
	'post_status'    => 'publish',
	'meta_key'       => 'featured_post',
	'orderby'        => array(
		'meta_value' => 'DESC',
		'date'       => 'DESC',
	),
	'order'          => 'DESC',
);

if (is_category()) {
	$current_category = get_queried_object();
	$categories[] = $current_category->slug;
}

if (!empty($categories)) {
	if (!is_array($categories)) {
		$categories = explode(',', $categories);
	}

	$args['tax_query'] = [
		'relation' => 'OR',
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $categories,
		),
	];
};

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_elem  = ceil(($total_count - $offset) / $page_items);

// Get Terms
$terms = ordered_categories('all');

?>
<!-- Acf Block #6 – Posts Feed with Filters -->
<div class="wcl-acf-block-6">
	<div class="data-container">
		<?php if (!empty($terms)) : ?>
			<div class="data-nav">
				<div class="data-nav-view">
					<div class="data-nav-view-inner">
						<?php if (!empty($categories)) : ?>
							<?php foreach ($categories as $key => $slug) : ?>
								<?php
								$term = get_term_by('slug', $slug, 'category');
								?>
								<?php if (count($categories) - 1 == $key) : ?>
									<?php echo $term->name; ?>
								<?php else : ?>
									<?php echo $term->name . ' / '; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php else : ?>
							Select a category
						<?php endif; ?>
					</div>
				</div>

				<div class="data-cats">
					<?php foreach ($terms as $term_id => $count) : ?>
						<?php
						$term = get_category($term_id);
						$term_active = '';

						if (in_array($term->slug, $categories)) {
							$term_active = 'active';
						}
						?>
						<div class="data-cats-item <?php echo $term_active; ?>">
							<a href="<?php echo get_term_link((int)$term->term_id); ?>" class="data-cats-item-link" data-id="<?php echo $term->slug; ?>">
								<?php echo $term->name; ?>
							</a>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($query_obj->have_posts()) : ?>
			<div class="data-list">
				<?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
					<?php get_template_part('template-parts/components/post-item'); ?>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>

		<?php
		$class_pagination = '';
		if (($total_count / $page_items)  > 1) {
			$class_pagination = 'active';
		}

		if (!empty($categories)) {
			$categories = implode(',', $categories);
		}
		?>
		<div class="data-pagination <?php echo $class_pagination; ?>">
			<div class="data-pagination-inner">
				<?php
				blog_page_pagination($query_obj, '', $categories);
				?>
			</div>
		</div>
	</div>
</div>