<?php

get_header();

$current_category = get_queried_object();

$paged       = 1;
$page_items  = 9;
$offset      = ($paged - 1) * $page_items;

$args = array(
	'post_type'      => ['page', 'post'],
	'posts_per_page' => $page_items,
	'offset'         => $offset,
	'post_status'    => 'publish',
	'tax_query' => [
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $current_category->slug,
		),
	],
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
?>
<div class="wcl-search-page" data-cat-query="<?php echo esc_attr($current_category->slug); ?>">
	<div class="data-container wcl-container">
		<div class="data-b1">
			<h2 class="data-title">
				<?php echo $current_category->name; ?>
			</h2>

			<div class="data-query">
				Best <?php echo $current_category->name; ?> in Bali
			</div>
		</div>

		<div class="data-list">
			<?php if ($query_obj->have_posts()) : ?>
				<?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
					<?php
					$image = get_the_post_thumbnail($post->ID, 'image-size-10');
					?>
					<div class="data-item">
						<a href="<?php echo get_permalink(); ?>" class="data-item-inner">
							<?php if (!empty($image)) : ?>
								<div class="data-item-img">
									<?php echo $image; ?>
								</div>
							<?php else : ?>
								<div class="data-item-img mod-empty">
								</div>
							<?php endif; ?>

							<div class="data-item-info">
								<h3 class="data-item-title">
									<?php echo strtolower(get_the_title()); ?>
								</h3>

								<div class="data-item-desc">
									<?php
									if (!empty(get_the_excerpt())) {
										// Assuming $post_excerpt contains the excerpt retrieved from WordPress
										$post_excerpt = get_the_excerpt();

										// Check if the excerpt length is greater than 114 characters
										if (mb_strlen($post_excerpt) > 114) {
											// Trim the excerpt to 114 characters
											$trimmed_excerpt = mb_substr($post_excerpt, 0, 114);

											// Find the position of the last space in the trimmed excerpt
											$last_space = mb_strrpos($trimmed_excerpt, ' ');

											// If a space is found, trim at that position and add ellipsis, else directly add ellipsis
											if ($last_space !== false) {
												$trimmed_excerpt = mb_substr($trimmed_excerpt, 0, $last_space);
											}

											$trimmed_excerpt .= '...'; // Add ellipsis
											echo $trimmed_excerpt; // Output the trimmed excerpt with ellipsis
										} else {
											// If excerpt length is less than or equal to 114 characters, display the excerpt as it is
											echo $post_excerpt;
										}
									}
									?>
								</div>

								<div class="data-item-date">
									<?php echo get_the_date('M j, Y'); ?>
								</div>
							</div>
						</a>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
			<?php else : ?>
				<div class="data-list-empty wcl-label-empty">
					No found
				</div>
			<?php endif; ?>
		</div>

		<?php if (!empty($total_count)) : ?>
			<div class="wcl-load-more">
				<div class="m5-container">
					<?php if ($pages_el > 1) : ?>
						<button class="m5-btn wcl-btn" data-page="<?php echo $paged; ?>">
							View More
						</button>
					<?php else : ?>
						<button class="m5-btn wcl-btn" data-page="<?php echo $paged; ?>" disabled="true">
							All Viewed
						</button>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
