<?php


?>
<script>
	var serverTimeUTC = '<?php echo gmdate('Y-m-d H:i:s'); ?>';
</script>

<?php if (have_rows('sounds_of_dex_paid_page', 'option')): ?>
	<div id="audio-container" data-audio-files='<?php echo json_encode(get_audio_urls()); ?>'></div>
<?php endif; ?>

<?php
function get_audio_urls() {
	$audio_files = array();

	if (have_rows('sounds_of_dex_paid_page', 'option')):
		while (have_rows('sounds_of_dex_paid_page', 'option')): the_row();
			$file = get_sub_field('file');
			$file = wp_get_attachment_url($file);

			if ($file) {
				$audio_files[] = $file;
			}
		endwhile;
	endif;

	return $audio_files;
}
?>

<footer class="sct-footer">
	<div class="data-container wcl-container">
		<div class="data-logo">
			<a href="<?php echo site_url(); ?>">
				<img src="<?php echo get_stylesheet_directory_uri() . '/img/logo.svg'; ?>" alt="img">
			</a>
		</div>

		<?php wp_nav_menu(array(
			'theme_location' => 'main-menu',
			'container'      => false,
			'menu_class'     => 'data-menu',
			'depth'          => 1,
		)); ?>

		<div class="data-copyright">
			© 2024 PUMP.BLACK
		</div>
	</div>
</footer>



</div> <!-- .wcl-body-inner -->

<?php wp_footer(); ?>


</body>

</html>