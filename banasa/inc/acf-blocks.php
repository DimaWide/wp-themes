<?php




/** Create custom block category */
function wcl_custom_block_category($categories) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'webcomplete',
				'title' => 'WebComplete',
			),
		)
	);
}

add_filter('block_categories_all', 'wcl_custom_block_category', 10, 2);



// Registration Blocks
function wcl_acf_blocks_init() {

	acf_register_block_type(array(
		'name' => 'acf-block-1',
		'title' => '#01 Hero',
		'description' => '#01 Hero',
		'render_template' => 'template-parts/acf-blocks/acf-block-1/acf-block-1.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-1/acf-block-1-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-2',
		'title' => '#02 Slider',
		'description' => '#02 Slider',
		'render_template' => 'template-parts/acf-blocks/acf-block-2/acf-block-2.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-2/acf-block-2-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-3',
		'title' => '#03 Main projects',
		'description' => '#03 Main projects',
		'render_template' => 'template-parts/acf-blocks/acf-block-3/acf-block-3.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-3/acf-block-3-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-4',
		'title' => '#04 Latest news',
		'description' => '#04 Latest news',
		'render_template' => 'template-parts/acf-blocks/acf-block-4/acf-block-4.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-4/acf-block-4-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-5',
		'title' => '#05 Projects Listing Page Hero',
		'description' => '#05 Projects Listing Page Hero',
		'render_template' => 'template-parts/acf-blocks/acf-block-5/acf-block-5.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-5/acf-block-5-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-6',
		'title' => '#06 Projects List',
		'description' => '#06 Projects List',
		'render_template' => 'template-parts/acf-blocks/acf-block-6/acf-block-6.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-6/acf-block-6-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-7',
		'title' => '#07 Contact',
		'description' => '#07 Contact',
		'render_template' => 'template-parts/acf-blocks/acf-block-7/acf-block-7.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-7/acf-block-7-preview.jpg',
				)
			)
		)
	));


	acf_register_block_type(array(
		'name' => 'acf-block-8',
		'title' => '#08 Building ',
		'description' => '#08 Building ',
		'render_template' => 'template-parts/acf-blocks/acf-block-8/acf-block-8.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-8/acf-block-8-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-9',
		'title' => '#09 High degree of specialization ',
		'description' => '#09 High degree of specialization ',
		'render_template' => 'template-parts/acf-blocks/acf-block-9/acf-block-9.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-9/acf-block-9-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-10',
		'title' => '#10 Personal relationships with clients',
		'description' => '#10 Personal relationships with clients',
		'render_template' => 'template-parts/acf-blocks/acf-block-10/acf-block-10.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-10/acf-block-10-preview.jpg',
				)
			)
		)
	));

	acf_register_block_type(array(
		'name' => 'acf-block-11',
		'title' => '#11 The trust of our clients',
		'description' => '#11 The trust of our clients',
		'render_template' => 'template-parts/acf-blocks/acf-block-11/acf-block-11.php',
		'category' => 'webcomplete',
		'mode' => 'edit',
		'icon' => 'layout',
		'example' => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'author' => 'WebComplete',
					'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-11/acf-block-11-preview.jpg',
				)
			)
		)
	));
	
	// acf_register_block_type(array(
	// 	'name' => 'test',
	// 	'title' => '#07 Contact',
	// 	'description' => '#07 Contact',
	// 	'render_template' => 'template-parts/acf-blocks/test/test.php',
	// 	'enqueue_style' => get_template_directory_uri() . '/template-parts/acf-blocks/test/test.css?ver=' . WCL_THEME_VERSION,
	// 	'category' => 'webcomplete',
	// 	'mode' => 'edit',
	// 	'icon' => 'layout',
	// 	'example' => array(
	// 		'attributes' => array(
	// 			'mode' => 'preview',
	// 			'data' => array(
	// 				'author' => 'WebComplete',
	// 				'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/test/test-preview.jpg',
	// 			)
	// 		)
	// 	)
	// ));
}

add_action('acf/init', 'wcl_acf_blocks_init');


function my_acf_enqueue_block_styles() {
	if (has_block('acf/acf-block-1')) {
		wp_enqueue_style('acf-block-1', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-1/acf-block-1.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-2')) {
		wp_enqueue_style('acf-block-2', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-2/acf-block-2.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-3')) {
		wp_enqueue_style('acf-block-3', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-3/acf-block-3.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-4')) {
		wp_enqueue_style('acf-block-4', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-4/acf-block-4.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-5')) {
		wp_enqueue_style('acf-block-5', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-5/acf-block-5.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-6')) {
		wp_enqueue_style('acf-block-6', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-6/acf-block-6.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-7')) {
		wp_enqueue_style('acf-block-7', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-7/acf-block-7.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-8')) {
		wp_enqueue_style('acf-block-8', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-8/acf-block-8.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-9')) {
		wp_enqueue_style('acf-block-9', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-9/acf-block-9.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-10')) {
		wp_enqueue_style('acf-block-10', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-10/acf-block-10.css', array(), WCL_THEME_VERSION, 'all');
	}

	if (has_block('acf/acf-block-11')) {
		wp_enqueue_style('acf-block-11', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-11/acf-block-11.css', array(), WCL_THEME_VERSION, 'all');
	}
}
add_action('wp_enqueue_scripts', 'my_acf_enqueue_block_styles');
