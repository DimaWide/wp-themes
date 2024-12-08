<?php


$text_quote            = get_field('text_quote');
$author_picture        = get_field('author_picture');
$author_picture        = wp_get_attachment_image($author_picture, 'image-size-6');
$author_name           = get_field('author_name');
$author_specialization = get_field('author_specialization');
?>
<!-- Acf Block #9 – Individual Blog Post – Quote -->
<div class="wcl-acf-block-9">
	<div class="data-container">
		<?php if (!empty($text_quote)) : ?>
			<div class="data-text">
				<blockquote>
					<?php echo $text_quote; ?>
				</blockquote>
			</div>
		<?php endif; ?>

		<div class="data-author">
			<?php if (!empty($author_picture)) : ?>
				<div class="data-author-picture">
					<?php echo $author_picture; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($author_name)) : ?>
				<div class="data-author-name">
					<?php echo $author_name; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($author_specialization)) : ?>
				<div class="data-author-specialization">
					<?php echo $author_specialization; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>