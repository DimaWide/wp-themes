<?php $youtube = get_post_meta($post->ID, '_post_youtube', true); ?>
<?php $category = get_main_cat( $post ); ?>
<div class='wrapper'>
	<div class='lightbox-main'>
		<span class='lightbox-close'><svg class='close'><use xlink:href="#close"></use></svg></span>
		<div class='video-wrap'>
			<div class='video-inner'>
				<iframe id="lightbox-video-iframe" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube; ?>?autoplay=1&showinfo=0&rel=0&enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>
		<div class='content'>
			<h2><span>Watching</span><?php echo $post->post_title; ?><a href='<?php echo get_permalink($post->ID); ?>'>View Post</a></h2>
			
			<?php 
			$next_video = array();
			$args = array(
			    'posts_per_page'	=> -1,
			    'meta_query' => array(
					array(
						'key'     => '_post_youtube',
						'compare' => 'EXISTS'
					)
				),
			);
			$posts = get_posts(  $args );	
			$get_next = false;
			foreach($posts as $video_check)
			{
				if($get_next)
				{
					$next_post = $video_check;
					break;
				}
				if($post->ID == $video_check->ID)
					$get_next = true;
			}
				
			
			if($next_post):
			?>
			
			<div class='up-next' data-post="<?php echo $next_post->ID; ?>">
				<h2>Up Next</h2>
				<a href='<?php echo get_permalink($next_post->ID); ?>'>
					<?php $featured_image_id = get_post_thumbnail_id($next_post->ID); ?>
					<?php $featured_image = exsite_image_resize($featured_image_id, '164x92', false); ?>
					<img class='' src="<?php echo $featured_image; ?>">
				</a>
				<div class='inner'>
					<span>Up Next</span>
					<h2><?php echo $next_post->post_title; ?></h2>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	
	<script>
	if(document.getElementById('iframe-youtube') === null)
	{
		var tag = document.createElement('script');
		tag.id = 'iframe-youtube';
		tag.src = 'https://www.youtube.com/iframe_api';
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	}
	else
		runPlayer();
	
	
	function onYouTubeIframeAPIReady() {
		runPlayer();
	}
	
	function onPlayerStateChange(event) {
		if (event.data == 0)
		{
			jQuery('.video-lightbox .up-next').click();
		}
	}
	
	function runPlayer()
	{
		var player;
		player = new YT.Player('lightbox-video-iframe', {
			events: {
				'onStateChange': onPlayerStateChange
			}
		});
	}
	</script>
	
	
	<?php
		$args = array(
		    'posts_per_page'    =>  4,
		    'exclude'			=> array($post->ID, $next_post->ID),
		    'category' 			=> $category->term_id,
		    'meta_query' => array(
				array(
					'key'     => '_post_youtube',
					'compare' => 'EXISTS'
				)
			),
		);
		$posts = get_posts(  $args );
		
		if(count($posts)<4)
		{
			$need_posts = 4 - count($posts);
			$exclude = array();
			$exclude[] = $post->ID;
			foreach($posts as $post)
				$exclude[] = $post->ID;	
				
			$args = array(
			    'posts_per_page'    =>  $need_posts,
			    'exclude'			=> $exclude,
			    'orderby'		 	=> 'rand',
			    'meta_query' => array(
					array(
						'key'     => '_post_youtube',
						'compare' => 'EXISTS'
					)
				),
			);
	
			$filler_posts = get_posts($args);	
			$posts = array_merge($posts, $filler_posts);
		}
		
	?>
	
	
	<?php if($posts): ?>
	<div class='lightbox-related'>
		<h2>Related</h2>
		<?php foreach($posts as $post): ?>
		<div class='related-post video-grid-post' data-post="<?php echo $post->ID; ?>">
			<a href='<?php echo get_permalink($post->ID); ?>'>
				<span class='video-trigger' data-post="<?php echo $post->ID; ?>">
					<svg class='play'><use xlink:href="#play"></use></svg>
				</span>
				<?php $featured_image_id = get_post_thumbnail_id($post->ID); ?>
				<?php $featured_image = exsite_image_resize($featured_image_id, '266x149'); ?>
				<img class='' src="<?php echo $featured_image; ?>">
			</a>
			<?php $category = get_main_cat( $post ); ?>
			<span><?php echo $category->name; ?></span>
			<h2><?php echo $post->post_title; ?></h2>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
</div>
