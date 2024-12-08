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
        'title' => '#01 Who we are',
        'description' => '#01 Who we are',
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
        'title' => '#02 Development',
        'description' => '#02 Development',
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
        'title' => '#03 The company',
        'description' => '#03 The company',
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
        'title' => '#04 Our skills',
        'description' => '#04 Our skills',
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
        'title' => '#05 Recent projects',
        'description' => '#05 Recent projects',
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
        'title' => '#06 News',
        'description' => '#06 News',
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
        'title' => '#07 Development',
        'description' => '#07 Development',
        'render_template' => 'template-parts/acf-blocks/acf-block-7/acf-block-7.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-7/acf-block-7-preview-1.jpg',
                )
            )
        )
    ));

    acf_register_block_type(array(
        'name' => 'acf-block-8',
        'title' => '#08 Our Team',
        'description' => '#08 Our Team',
        'render_template' => 'template-parts/acf-blocks/acf-block-8/acf-block-8.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-8/acf-block-8-preview-1.jpg',
                )
            )
        )
    ));

    acf_register_block_type(array(
        'name' => 'acf-block-9',
        'title' => '#09 Our skills',
        'description' => '#09 Our skills',
        'render_template' => 'template-parts/acf-blocks/acf-block-9/acf-block-9.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-9/acf-block-9-preview-1.jpg',
                )
            )
        )
    ));

    acf_register_block_type(array(
        'name' => 'acf-block-10',
        'title' => '#10 Banner Page',
        'description' => '#10 Banner Page',
        'render_template' => 'template-parts/acf-blocks/acf-block-10/acf-block-10.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-10/acf-block-10-preview-1.jpg',
                )
            )
        )
    ));


    acf_register_block_type(array(
        'name' => 'acf-block-11',
        'title' => '#11 Recent projects',
        'description' => '#11 Recent projects',
        'render_template' => 'template-parts/acf-blocks/acf-block-11/acf-block-11.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-11/acf-block-11-preview-1.jpg',
                )
            )
        )
    ));


    acf_register_block_type(array(
        'name' => 'acf-block-12',
        'title' => '#12 News',
        'description' => '#12 News',
        'render_template' => 'template-parts/acf-blocks/acf-block-12/acf-block-12.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-12/acf-block-12-preview-1.jpg',
                )
            )
        )
    ));


    acf_register_block_type(array(
        'name' => 'acf-block-13',
        'title' => '#13 Blog',
        'description' => '#13 Blog',
        'render_template' => 'template-parts/acf-blocks/acf-block-13/acf-block-13.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-13/acf-block-13-preview-1.jpg',
                )
            )
        )
    ));


    
    acf_register_block_type(array(
        'name' => 'acf-block-14',
        'title' => '#14 Contact Info & Form',
        'description' => '#14 Contact Info & Form',
        'render_template' => 'template-parts/acf-blocks/acf-block-14/acf-block-14.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-14/acf-block-14-preview-1.jpg',
                )
            )
        )
    ));

    
    acf_register_block_type(array(
        'name' => 'acf-block-15',
        'title' => '#15 Hero Page',
        'description' => '#15 Hero Page',
        'render_template' => 'template-parts/acf-blocks/acf-block-15/acf-block-15.php',
        'category' => 'webcomplete',
        'mode' => 'edit',
        'icon' => 'layout',
        'example' => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author' => 'WebComplete',
                    'preview_image_help' => get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-15/acf-block-15-preview-2.jpg',
                )
            )
        )
    ));
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

    if (has_block('acf/acf-block-12')) {
        wp_enqueue_style('acf-block-12', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-12/acf-block-12.css', array(), WCL_THEME_VERSION, 'all');
    }

    if (has_block('acf/acf-block-13')) {
        wp_enqueue_style('acf-block-13', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-13/acf-block-13.css', array(), WCL_THEME_VERSION, 'all');
    }

    if (has_block('acf/acf-block-14')) {
        wp_enqueue_style('acf-block-14', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-14/acf-block-14.css', array(), WCL_THEME_VERSION, 'all');
    }

    if (has_block('acf/acf-block-15')) {
        wp_enqueue_style('acf-block-15', get_template_directory_uri() . '/template-parts/acf-blocks/acf-block-15/acf-block-15.css', array(), WCL_THEME_VERSION, 'all');
    }
}
add_action('wp_enqueue_scripts', 'my_acf_enqueue_block_styles');
