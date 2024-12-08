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
            'title'           => __('#01 Слайдер, Банер'),
            'description'     => __('#01 Слайдер, Банер Block'),
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
            'title'           => __('#02 Акційні пропозиції'),
            'description'     => __('#02 Акційні пропозиції Block'),
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
            'title'           => __('#03 Відгуки наших клієнтів'),
            'description'     => __('#03 Відгуки наших клієнтів Block'),
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
            'title'           => __('#04 Інформація про компанію'),
            'description'     => __('#04 Інформація про компанію Block'),
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
            $args = [];

            if (isset($block['className'])) {
                $args['classNameBlock'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_4.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-4', null, $args);
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-5',
            'title'           => __('#05 Останні події'),
            'description'     => __('#05 Останні події Block'),
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
            $args = [];

            if (isset($block['className'])) {
                $args['classNameBlock'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_5.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-5', null, $args);
            }
        }
    }


    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-6',
            'title'           => __('#06 Наші контакти'),
            'description'     => __('#06 Наші контакти Block'),
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
            $args = [];

            if (isset($block['className'])) {
                $args['classNameBlock'] = $block['className'];
            }

            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_6.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-6', null, $args);
            }
        }
    }
}

add_action('acf/init', 'wcl_acf_blocks_init');
