<?php






/**
 * block_categories_all
 */
add_filter('block_categories_all', function ($categories) {

    // Adding a new category.
    $categories[] = array(
        'slug'  => 'wcl-category',
        'title' => 'WCL Blocks'
    );

    return $categories;
});





/**
 * wcl_acf_blocks_init
 */
function wcl_acf_blocks_init() {
    
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-1',
            'title'           => __('#01 Hero'),
            'description'     => __('#01 Hero Block'),
            'render_template' => 'template-parts/acf-blocks/block-1.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_1',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_1($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_1.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-1');
            }
        }
    }




    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-2',
            'title'           => __('#02 Video'),
            'description'     => __('#02 Video Block'),
            'render_template' => 'template-parts/acf-blocks/block-2.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_2',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_2($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_2.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-2');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-3',
            'title'           => __('#03 CF Love - Team'),
            'description'     => __('#03 CF Love - Team Block'),
            'render_template' => 'template-parts/acf-blocks/block-3.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_3',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_3($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_3.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-3');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-4',
            'title'           => __('#04 Why Funnels'),
            'description'     => __('#04 Why Funnels Block'),
            'render_template' => 'template-parts/acf-blocks/block-4.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_4',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_4($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_4.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-4');
            }
        }
    }





    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-5',
            'title'           => __('#05 With & Without'),
            'description'     => __('#05 With & Without Block'),
            'render_template' => 'template-parts/acf-blocks/block-5.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_5',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_5($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_5.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-5');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-6',
            'title'           => __('#06 Funnels Customers'),
            'description'     => __('#06 Funnels Customers Block'),
            'render_template' => 'template-parts/acf-blocks/block-6.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_6',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_6($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_6.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-6');
            }
        }
    }
    


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-7',
            'title'           => __('#07 Feature Cards'),
            'description'     => __('#07 Feature Cards Block'),
            'render_template' => 'template-parts/acf-blocks/block-7.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_7',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_7($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_7.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-7');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-8',
            'title'           => __('#08 Everything CTA'),
            'description'     => __('#08 Everything CTA Block'),
            'render_template' => 'template-parts/acf-blocks/block-8.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_8',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_8($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_8.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-8');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-9',
            'title'           => __('#09 Brands'),
            'description'     => __('#09 Brands Block'),
            'render_template' => 'template-parts/acf-blocks/block-9.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_9',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_9($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_9.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-9');
            }
        }
    }


    
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-10',
            'title'           => __('#10 FAQ'),
            'description'     => __('#10 FAQ Block'),
            'render_template' => 'template-parts/acf-blocks/block-10.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_10',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_10($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_10.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-10');
            }
        }
    }


        
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-11',
            'title'           => __('#11 Could You Be The Next ‘Two Comma Club’ Award Winner?'),
            'description'     => __('#11 Could You Be The Next ‘Two Comma Club’ Award Winner? Block'),
            'render_template' => 'template-parts/acf-blocks/block-11.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_11',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_11($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_11.jpg'; ?>" style="width: 110%; height: 110%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-11');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-12',
            'title'           => __('#12 Listing Video'),
            'description'     => __('#12 Listing Video Block'),
            'render_template' => 'template-parts/acf-blocks/block-12.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_12',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_12($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_12.jpg'; ?>" style="width: 120%; height: 120%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-12');
            }
        }
    }

}

add_action('acf/init', 'wcl_acf_blocks_init');
