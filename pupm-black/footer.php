<?php


?>
<script>
	var serverTimeUTC = '<?php echo gmdate('Y-m-d H:i:s'); ?>';
</script>

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