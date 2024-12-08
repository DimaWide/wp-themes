<?php $term = get_queried_object(); ?>
<?php
if($term->parent == 0)
	$parent = $term; 
else
	$parent = get_term_by( 'id', $term->parent, $term->taxonomy );
	
$cats = get_terms( 'product_cats' , array('parent'=>0));
?>

<nav class='shop-nav'>
	<a href='<?php echo home_url( '/shop' ); ?>' <?php if($term->post_name == 'shop'): ?>class='active'<?php endif; ?>>
		All
	</a>
	<?php foreach($cats as $cat): ?>
	
	<?php $children = get_terms( 'product_cats' , array('parent'=>$cat->term_id)); ?>
	<?php if($children): ?>
	
	<span>
		<a href='<?php echo get_term_link( $cat ); ?>' class='<?php if($term->term_id == $cat->term_id): ?>active<?php endif; ?>'>
			<?php echo $cat->name; ?>
		</a>
		<svg class='chev'><use xlink:href="#chev"></use></svg>
		<div class='dd'>
			<?php foreach($children as $child): ?>
				<a href='<?php echo get_term_link( $child ); ?>' class='<?php if($term->term_id == $child->term_id): ?>active<?php endif; ?>'>
					<?php echo $child->name; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</span>
	
	<?php else: ?>
	
	<a href='<?php echo get_term_link( $cat ); ?>' class='<?php if($term->term_id == $cat->term_id): ?>active<?php endif; ?>'>
		<?php echo $cat->name; ?>
	</a>
	
	<?php endif; ?>
	
	<?php endforeach; ?>
	
	<a class='cta' href='<?php echo home_url( '/shop-my-instagram' ); ?>'>
		<svg class='ig'><use xlink:href="#ig"></use></svg>Shop My Insta
	</a>
</nav>


<nav class='shop-nav-mob'>
	<div class='wrapper'>
		<span class='shop-nav-trigger'>Shop Menu<svg class='chev'><use xlink:href="#chev"></use></svg></span>
		<div class='hidden-nav'>
			<a href='<?php echo home_url( '/shop' ); ?>'>Shop All</a>
			<?php foreach($cats as $cat): ?>
			<a href='<?php echo get_term_link( $cat ); ?>' class='<?php if($term->term_id == $cat->term_id): ?>active<?php endif; ?>'>
				<?php echo $cat->name; ?>
			</a>
			<?php endforeach; ?>
			<a class='cta' href='<?php echo home_url( '/shop-my-instagram' ); ?>'>
				<svg class='ig'><use xlink:href="#ig"></use></svg>Shop My Instagram
			</a>
		</div>
	</div>
</nav>
