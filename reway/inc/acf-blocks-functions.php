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
            'title'           => __('#01 Extraordinary'),
            'description'     => __('#01 Extraordinary Block'),
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
            'title'           => __('#02 An Extraordinary World Awaiting Discovery'),
            'description'     => __('#02 An Extraordinary World Awaiting Discovery Block'),
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
            'title'           => __('#03 A Haven of Peace and Renewal'),
            'description'     => __('#03 A Haven of Peace and Renewal Block'),
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
            $args = [];

            if (isset($block['className'])) {
                $args['classNameBlock'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_3.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-3', null, $args);
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-4',
            'title'           => __('#04 Reway Club'),
            'description'     => __('#04 Reway Club Block'),
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
            'title'           => __('#05 Privileged Services'),
            'description'     => __('#05 Privileged Services Block'),
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
            'title'           => __('#06 Become a Member'),
            'description'     => __('#06 Become a Member Block'),
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
            'title'           => __('#07 Contact Us - Discover Our Secret World'),
            'description'     => __('#07 Contact Us - Discover Our Secret World Block'),
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
            'title'           => __('#08 Gallery'),
            'description'     => __('#08 Gallery Block'),
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
            'title'           => __('#09 A Different Perspective on Life'),
            'description'     => __('#09 A Different Perspective on Life Block'),
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
            'title'           => __('#10 Video'),
            'description'     => __('#10 Video Block'),
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
            'title'           => __('#11 Experiences at Reway Ankara Club'),
            'description'     => __('#11 Experiences at Reway Ankara Club Block'),
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
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_11.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
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
            'title'           => __('#12 The architect of elegance'),
            'description'     => __('#12 The architect of elegance Block'),
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
            $args = [];

            if (isset($block['className'])) {
                $args['classNameBlock'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_12.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-12', null, $args);
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-13',
            'title'           => __('#13 Reway Offers Four Levels of Privilege'),
            'description'     => __('#13 Reway Offers Four Levels of Privilege Block'),
            'render_template' => 'template-parts/acf-blocks/block-13.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_13',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_13($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_13.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-13');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-14',
            'title'           => __('#14 Elite Social Network and Privileged Living'),
            'description'     => __('#14 Elite Social Network and Privileged Living Block'),
            'render_template' => 'template-parts/acf-blocks/block-14.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_14',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_14($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_14.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-14');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-15',
            'title'           => __('#15 Secure Your Place at Reway Club'),
            'description'     => __('#15 Secure Your Place at Reway Club Block'),
            'render_template' => 'template-parts/acf-blocks/block-15.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_15',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_15($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_15.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-15');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-16',
            'title'           => __('#16 Luxurious Spa Experience in a Hotel Concept'),
            'description'     => __('#16 Luxurious Spa Experience in a Hotel Concept Block'),
            'render_template' => 'template-parts/acf-blocks/block-16.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_16',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_16($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_16.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-16');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-17',
            'title'           => __('#17 What You Will Experience at Our Reway Ankara SPA'),
            'description'     => __('#17 What You Will Experience at Our Reway Ankara SPA Block'),
            'render_template' => 'template-parts/acf-blocks/block-17.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_17',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_17($block, $content = '', $is_preview = false) {
            $args = [];

            if (isset($block['className'])) {
                $args['classNameBlock'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_17.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-17', null, $args);
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-18',
            'title'           => __('#18 An Unforgettable Massage Experience in Ankara'),
            'description'     => __('#18 An Unforgettable Massage Experience in Ankara Block'),
            'render_template' => 'template-parts/acf-blocks/block-18.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_18',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_18($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_18.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-18');
            }
        }
    }

    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-19',
            'title'           => __('#19 The exclusive TurkishBath Pleasure at Reway'),
            'description'     => __('#19 The exclusive TurkishBath Pleasure at Reway Block'),
            'render_template' => 'template-parts/acf-blocks/block-19.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_19',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_19($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_19.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-19');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-20',
            'title'           => __('#20 A Unique Sauna Experience at Reway Ankara SPA'),
            'description'     => __('#20 A Unique Sauna Experience at Reway Ankara SPA Block'),
            'render_template' => 'template-parts/acf-blocks/block-20.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_20',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_20($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_20.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-20');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-21',
            'title'           => __('#21 Time for Purification in the Steam Room'),
            'description'     => __('#21 Time for Purification in the Steam Room Block'),
            'render_template' => 'template-parts/acf-blocks/block-21.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_21',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_21($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_21.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-21');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-22',
            'title'           => __('#22 Elegance and Strength Combined'),
            'description'     => __('#22 Elegance and Strength Combined Block'),
            'render_template' => 'template-parts/acf-blocks/block-22.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_22',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_22($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_22.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-22');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-23',
            'title'           => __('#23 Experiences at Reway Ankara Sports'),
            'description'     => __('#23 Experiences at Reway Ankara Sports Block'),
            'render_template' => 'template-parts/acf-blocks/block-23.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_23',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_23($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_23.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-23');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-24',
            'title'           => __('#24 Become the Best Version of Yourself with PT Fitness'),
            'description'     => __('#24 Become the Best Version of Yourself with PT Fitness Block'),
            'render_template' => 'template-parts/acf-blocks/block-24.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_24',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_24($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_24.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-24');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-25',
            'title'           => __('#25 Meet Your NASM Certified Personal Sports Trainer'),
            'description'     => __('#25 Meet Your NASM Certified Personal Sports Trainer Block'),
            'render_template' => 'template-parts/acf-blocks/block-25.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_25',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_25($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_25.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-25');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-26',
            'title'           => __('#26 Discipline, Order, Motivation.'),
            'description'     => __('#26 Discipline, Order, Motivation. Block'),
            'render_template' => 'template-parts/acf-blocks/block-26.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_26',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_26($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_26.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-26');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-27',
            'title'           => __('#27 Gastronomic Delights at Reway Ankara'),
            'description'     => __('#27 Gastronomic Delights at Reway Ankara Block'),
            'render_template' => 'template-parts/acf-blocks/block-27.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_27',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_27($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_27.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-27');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-28',
            'title'           => __('#28 Personalized Flavor Experience Tailored to Your Palate Preferences'),
            'description'     => __('#28 Personalized Flavor Experience Tailored to Your Palate Preferences Block'),
            'render_template' => 'template-parts/acf-blocks/block-28.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_28',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_28($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_28.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-28');
            }
        }
    }



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-29',
            'title'           => __('#29 Rejuvenate with Exquisite Flavors'),
            'description'     => __('#29 Rejuvenate with Exquisite Flavors Block'),
            'render_template' => 'template-parts/acf-blocks/block-29.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_29',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_29($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_29.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-29');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-30',
            'title'           => __('#30 Sophisticated Culinary Art Filled with Striking Flavors'),
            'description'     => __('#30 Sophisticated Culinary Art Filled with Striking Flavors Block'),
            'render_template' => 'template-parts/acf-blocks/block-30.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_30',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_30($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_30.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-30');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-31',
            'title'           => __('#31 Effective Weight Control with Our Experienced Dietitians'),
            'description'     => __('#31 Effective Weight Control with Our Experienced Dietitians Block'),
            'render_template' => 'template-parts/acf-blocks/block-31.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_31',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_31($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_31.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-31');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-32',
            'title'           => __('#32 Post-Workout Recovery'),
            'description'     => __('#32 Post-Workout Recovery Block'),
            'render_template' => 'template-parts/acf-blocks/block-32.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_32',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_32($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_32.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-32');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-33',
            'title'           => __('#33 Enhance Your Performance with Nutrition from Our Dietitians'),
            'description'     => __('#33 Enhance Your Performance with Nutrition from Our Dietitians Block'),
            'render_template' => 'template-parts/acf-blocks/block-33.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_33',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_33($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_33.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-33');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-34',
            'title'           => __('#34 Journey to Health with Reway Ankara'),
            'description'     => __('#34 Journey to Health with Reway Ankara Block'),
            'render_template' => 'template-parts/acf-blocks/block-34.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_34',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_34($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_34.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-34');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-35',
            'title'           => __('#35 Strengthen with Our Pilates Reformer Program'),
            'description'     => __('#35 Strengthen with Our Pilates Reformer Program Block'),
            'render_template' => 'template-parts/acf-blocks/block-35.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_35',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_35($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_35.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-35');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-36',
            'title'           => __('#36 Achieve Your Goals Quickly'),
            'description'     => __('#36 Achieve Your Goals Quickly Block'),
            'render_template' => 'template-parts/acf-blocks/block-36.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_36',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_36($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_36.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-36');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-37',
            'title'           => __('#37 For a Stronger and Fitter Body, Choose Reway'),
            'description'     => __('#37 For a Stronger and Fitter Body, Choose Reway Block'),
            'render_template' => 'template-parts/acf-blocks/block-37.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_37',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_37($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_37.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-37');
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-38',
            'title'           => __('#38 Contact Us'),
            'description'     => __('#38 Contact Us Block'),
            'render_template' => 'template-parts/acf-blocks/block-38.php',
            'category'        => 'wcl-category',
            'render_callback' => 'render_block_38',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function render_block_38($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_38.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-38');
            }
        }
    }
}

add_action('acf/init', 'wcl_acf_blocks_init');
