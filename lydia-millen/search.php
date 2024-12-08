<?php

get_header();

$post_types = [
	[
		'name' => 'Post',
		'slug' => 'post',
	],
	[
		'name' => 'Product',
		'slug' => 'cd-product',
	],
	[
		'name' => 'Video',
		'slug' => 'cd-video',
	]
];

$post_type   = 'post';

if (isset($_GET['post-type'])) {
	$post_type = $_GET['post-type'];
	$vals      = array_column($post_types, 'name');
	$key       = array_search(ucfirst($post_type), $vals);
	$post_type_new = $post_types[$key]['slug'];
}

$search_term = get_query_var('s');

$paged      = 1;
$page_items = 9;
$offset     = ($paged - 1) * $page_items;

$args = array(
	'post_type'           => $post_type_new,
	'posts_per_page'      => $page_items,
	'offset'              => $offset,
	'paged'               => $paged,
	's'                   => $search_term,
	'ignore_sticky_posts' => 1,
	'post_status'         => ['publish'],
	'suppress_filters'    => true,
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
$pages_el    = ceil(($total_count - $offset) / $page_items);
?>
<div class="wcl-search" data-post-type="<?php echo $post_type_new; ?>" data-search="<?php echo esc_attr($search_term); ?>" data-post-types="<?php echo esc_attr(json_encode($post_types)); ?>">
	<div class="data-b">
		<div class="data-b-container wcl-container">
			<h2 class="data-title">
				<?php esc_html_e('I am looking for', 'theme'); ?>
			</h2>

			<form class="data-form" action="<?php echo esc_url(home_url('/')); ?>">
				<input type="text" placeholder="Search" name="s" value="<?php echo trim(esc_attr(get_search_query())); ?>">
				<input type="hidden" name="post-type" value="<?php echo $post_type; ?>">
			</form>
		</div>
	</div>

	<div class="data-nav wcl-nav">
		<div class="d6-inner wcl-container">
			<?php foreach ($post_types as $key => $item) : ?>
				<?php
				$active_class = '';
				if ($item['slug'] == $post_type_new) {
					$active_class = 'active';
				}
				?>
				<div class="d6-item <?php echo $active_class; ?>">
					<a href="#" class="d6-item-link" data-id="<?php echo $item['slug']; ?>">
						<?php echo $item['name']; ?>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	</div>

	<div class="data-a">
		<div class="data-a-container wcl-container">
			<?php if ($query_obj->have_posts()) : ?>
				<?php
				$videos_ids = get_posts(array(
					'post_type'   => 'cd-video',
					'numberposts' => -1,
					'fields'      => 'ids',
					'meta_query'  => array(
						array(
							'key'     => 'youtube_video',
							'value'   => '',
							'compare' => '!=',
						),
					),
				));
				?>
				<div class="data-list">
					<?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
						<?php
						$args =  array(
							'post_type' => $post_type,
							'videos_ids' => $videos_ids,
						);
						get_template_part('template-parts/search/item', null, $args);
						?>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
			<?php else : ?>
				<div class="data-list">
					<div class="data-list-empty wcl-label-empty">Nothing found</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="wcl-load-more">
		<div class="d2-container">
			<?php if ($pages_el > 1) : ?>
				<button class="d2-btn" data-page="<?php echo $paged; ?>">
					View More
				</button>
			<?php else : ?>
				<button class="d2-btn" data-page="<?php echo $paged; ?>" disabled="true">
					All Viewed
				</button>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();
