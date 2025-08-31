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





/** Registration Blocks */
function wcl_acf_blocks_init() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-1-configurator',
            'title'           => __('#01 Configurator'),
            'description'     => __('#01 Configurator Block'),
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-configurator.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-1-configurator');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-2-about-products',
            'title'           => __('#02 About Products'),
            'description'     => __('#02 About Products Block'),
            'render_template' => 'template-parts/acf-blocks/acf-2-about-products.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-2-about-products.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-2-about-products');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-3-blog',
            'title'           => __('#03 Blog'),
            'description'     => __('#03 Blog Block'),
            'render_template' => 'template-parts/acf-blocks/acf-3-blog.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-3-blog.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-3-blog');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-4-faq',
            'title'           => __('#04 FAQ'),
            'description'     => __('#04 FAQ Block'),
            'render_template' => 'template-parts/acf-blocks/acf-4-faq.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-4-faq.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-4-faq');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-5-gallery',
            'title'           => __('#05 Gallery'),
            'description'     => __('#05 Gallery Block'),
            'render_template' => 'template-parts/acf-blocks/acf-5-gallery.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-5-gallery.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-5-gallery');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-6-testimonials',
            'title'           => __('#06 Testimonials'),
            'description'     => __('#06 Testimonials Block'),
            'render_template' => 'template-parts/acf-blocks/acf-6-testimonials.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-6-testimonials.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-6-testimonials');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-7-about',
            'title'           => __('#07 About'),
            'description'     => __('#07 About Block'),
            'render_template' => 'template-parts/acf-blocks/acf-7-about.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-7-about.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-7-about');
            }
        }
    }




    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-8-our-team',
            'title'           => __('#08 Our Team'),
            'description'     => __('#08 Our Team Block'),
            'render_template' => 'template-parts/acf-blocks/acf-8-our-team.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-8-our-team.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-8-our-team');
            }
        }
    }





    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-9-contact-us',
            'title'           => __('#09 Contact Us'),
            'description'     => __('#09 Contact Us Block'),
            'render_template' => 'template-parts/acf-blocks/acf-9-contact-us.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-9-contact-us.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-9-contact-us');
            }
        }
    }





    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-10-faq',
            'title'           => __('#10 FAQ'),
            'description'     => __('#10 FAQ Block'),
            'render_template' => 'template-parts/acf-blocks/acf-10-faq.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-10-faq.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-10-faq');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-11-instalation',
            'title'           => __('#11 Instalation'),
            'description'     => __('#11 Instalation Block'),
            'render_template' => 'template-parts/acf-blocks/acf-11-instalation.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-11-instalation.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-11-instalation');
            }
        }
    }





    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-12-blog',
            'title'           => __('#12 Blog'),
            'description'     => __('#12 Blog Block'),
            'render_template' => 'template-parts/acf-blocks/acf-12-blog.php',
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-12-blog.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/acf-12-blog');
            }
        }
    }
}

add_action('acf/init', 'wcl_acf_blocks_init');
