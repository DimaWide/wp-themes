<?php



/* 
custom_page_categories
 */
function custom_page_categories() {
    register_taxonomy(
        'category',
        array('post', 'page'),
        array(
            'label' => 'Categories',
            'show_in_rest' => true,
            'hierarchical' => true,
        )
    );
}
add_action('init', 'custom_page_categories');






/*
* plug for vs
*/
if (false) {
    function get_field() {
    }
    function acf_add_options_page() {
    }
    function get_sub_field() {
    }
    function have_rows() {
    }
    function the_row() {
    }
    function get_row_layout() {
    }
    function get_field_object() {
    }
    function update_field() {
    }
    function acf_register_block_type() {
    }
}






/*
* wcL_add_tax_for_post
*/
function wcL_add_tax_for_post() {
    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Places',
            'singular_name'     => 'Place',
            'search_items'      => 'Search Places',
            'all_items'         => 'All Places',
            'view_item '        => 'View Place',
            'parent_item'       => 'Parent Place',
            'parent_item_colon' => 'Parent Place:',
            'edit_item'         => 'Place Place',
            'update_item'       => 'Update Place',
            'add_new_item'      => 'Add New Place',
            'new_item_name'     => 'New Place Name',
            'menu_name'         => 'Places',
            'back_to_items'     => '← Back to Place',
        ),
        'hierarchical' => true,
        'show_ui'      => true,
        'query_var'    => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'place'),
    );

    register_taxonomy('wcl-place', ['post', 'page'], $args);
}
add_action('init', 'wcL_add_tax_for_post');






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

    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'            => 'acf-block-banner',
            'title'           => __('Banner'),
            'description'     => __('Banner Block'),
            'render_template' => 'template-parts/acf-blocks/block-banner.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_banner',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_banner($block, $content = '', $is_preview = false) {
            if ($is_preview) {
?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_banner.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-banner');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-1',
            'title'           => __('#1 Dive into Bali\'s Top Destinations'),
            'description'     => __('#1 Dive into Bali\'s Top Destinations Block'),
            'render_template' => 'template-parts/acf-blocks/block-1.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_1',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_1($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_1.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-1');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-2',
            'title'           => __('#2 Find Bali\'s Finest Accommodations Tailored for You'),
            'description'     => __('#2 Find Bali\'s Finest Accommodations Tailored for You Block'),
            'render_template' => 'template-parts/acf-blocks/block-2.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_2',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_2($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_2.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-2');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-3',
            'title'           => __('#3 Explore Bali\'s Breathtaking Natural Wonders'),
            'description'     => __('#3 Explore Bali\'s Breathtaking Natural Wonders Block'),
            'render_template' => 'template-parts/acf-blocks/block-3.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_3',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_3($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_3.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-3');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-4',
            'title'           => __('#4 Immerse Yourself in the Essence of Balinese Traditions'),
            'description'     => __('#4 Immerse Yourself in the Essence of Balinese Traditions Block'),
            'render_template' => 'template-parts/acf-blocks/block-4.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_4',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_4($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_4.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-4');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-5',
            'title'           => __('#5 Discover Bali\'s Essential Experiences and Activities'),
            'description'     => __('#5 Discover Bali\'s Essential Experiences and Activities Block'),
            'render_template' => 'template-parts/acf-blocks/block-5.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_5',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_5($block, $content = '', $is_preview = false, $post_id) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_5.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-5');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-6',
            'title'           => __('#6 Uncover Bali\'s Best Beats and Clubs'),
            'description'     => __('#6 Uncover Bali\'s Best Beats and Clubs Block'),
            'render_template' => 'template-parts/acf-blocks/block-6.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_6',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_6($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_6.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-6');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-7',
            'title'           => __('#7 Bali’s Top Upcomig Events'),
            'description'     => __('#7 Bali’s Top Upcomig Events Block'),
            'render_template' => 'template-parts/acf-blocks/block-7.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_7',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_7($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_7.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-7');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-8',
            'title'           => __('#8 Text Content'),
            'description'     => __('#8 Text Content Block'),
            'render_template' => 'template-parts/acf-blocks/block-8.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_8',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_8($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_8.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-8');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-9',
            'title'           => __('#9 Place'),
            'description'     => __('#9 Place Block'),
            'render_template' => 'template-parts/acf-blocks/block-9.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_9',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_9($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_9.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-9');
            }
        }




        acf_register_block_type(array(
            'name'            => 'acf-block-10',
            'title'           => __('#10 Ads Shortcode'),
            'description'     => __('#10 Ads Shortcode'),
            'render_template' => 'template-parts/acf-blocks/block-10.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_10',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_10($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_10.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-10');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-11',
            'title'           => __('#11 Article'),
            'description'     => __('#11 Article Block'),
            'render_template' => 'template-parts/acf-blocks/block-11.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_11',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_11($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_11.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                $args =  array(
                    'block' => $block,
                );

                get_template_part('template-parts/acf-blocks/block-11', null, $args);
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-12',
            'title'           => __('#12 Google Map by Place Id'),
            'description'     => __('#12 Google Map by Place Id Block'),
            'render_template' => 'template-parts/acf-blocks/block-12.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_12',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_12($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_12.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-12');
            }
        }


        acf_register_block_type(array(
            'name'            => 'acf-block-13',
            'title'           => __('#13 Single Post Info'),
            'description'     => __('#13 Single Post Info'),
            'render_template' => 'template-parts/acf-blocks/block-13.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_13',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_13($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_13.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-13');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-14',
            'title'           => __('#14 Google Map Address'),
            'description'     => __('#14 Google Map Address'),
            'render_template' => 'template-parts/acf-blocks/block-14.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_14',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_14($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_14.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-14');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-15',
            'title'           => __('#15 Automatic Generate Places with Order by Priority'),
            'description'     => __('#15 Automatic Generate Places with Order by Priority'),
            'render_template' => 'template-parts/acf-blocks/block-15.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_15',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_15($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_15.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-15');
            }
        }



        acf_register_block_type(array(
            'name'            => 'acf-block-16',
            'title'           => __('#16 Title and link for post'),
            'description'     => __('#16 Title and link for post'),
            'render_template' => 'template-parts/acf-blocks/block-16.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_16',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_16($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_16.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-16');
            }
        }





        acf_register_block_type(array(
            'name'            => 'acf-block-17',
            'title'           => __('#17 Two Links'),
            'description'     => __('#17 Two Links'),
            'render_template' => 'template-parts/acf-blocks/block-17.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_17',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_17($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_17.jpg'; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="img">
    <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-17');
            }
        }
    }
}
add_action('acf/init', 'wcl_acf_blocks_init');





/*
* wcl_subscribe
*/
function wcl_subscribe() {
    $email     = $_POST["email"];
    $mailchimp = get_field('mailchimp', 'option');
    $list_id   = $mailchimp['list_id'];
    $api_key   = $mailchimp['api_key'];
    $data      = [];

    $data_center = substr($api_key, strpos($api_key, '-') + 1);
    $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
    $json = json_encode([
        'email_address' => $email,
        'status'        => 'subscribed',
    ]);

    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (200 == $status_code) {
            $data['code'] = 'success';
            $data['message'] = "You have successfully subscribed";
        } else {
            $val = json_decode($result);
            $data['code'] = 'error';
            $data['message'] = str_replace('Use PUT to insert or update list members.', '', $val->detail);
        }
    } catch (Exception $e) {
        $data[0] = $e->getMessage();
    }

    if (empty($data)) {
        $data['code'] = 'error';
        $data['message'] = 'An error has occurred';
    }

    echo json_encode($data);
    wp_die();
}

add_action('wp_ajax_wcl_subscribe', 'wcl_subscribe');
add_action('wp_ajax_nopriv_wcl_subscribe', 'wcl_subscribe');






/**
 * search_load_post
 */
function search_load_post() {
    $search     = $_POST['search'];
    $category   = $_POST['category'];
    $page_items = 9;
    $paged      = $_POST['paged'] ? $_POST['paged'] : 1;
    $offset     = ($paged - 1) * $page_items;

    $args = array(
        'post_type'      => ['page', 'post'],
        'posts_per_page' => $page_items,
        'offset'         => $offset,
        's'              => $search,
        'post_status'    => 'publish',
    );

    if (!empty($category)) {
        $args['tax_query'] = [
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_el    = ceil(($total_count - $offset) / $page_items);
    ob_start();
    ?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            global $post;
            $image = get_the_post_thumbnail($post->ID, 'image-size-10');
            ?>
            <div class="data-item swiper-slide">
                <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                    <?php if (!empty($image)) : ?>
                        <div class="data-item-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <div class="data-item-info">
                        <h3 class="data-item-title">
                            <?php echo strtolower(get_the_title()); ?>
                        </h3>

                        <div class="data-item-desc">
                            <?php
                            if (!empty(get_the_excerpt())) {
                                // Assuming $post_excerpt contains the excerpt retrieved from WordPress
                                $post_excerpt = get_the_excerpt();

                                // Check if the excerpt length is greater than 114 characters
                                if (mb_strlen($post_excerpt) > 114) {
                                    // Trim the excerpt to 114 characters
                                    $trimmed_excerpt = mb_substr($post_excerpt, 0, 114);

                                    // Find the position of the last space in the trimmed excerpt
                                    $last_space = mb_strrpos($trimmed_excerpt, ' ');

                                    // If a space is found, trim at that position and add ellipsis, else directly add ellipsis
                                    if ($last_space !== false) {
                                        $trimmed_excerpt = mb_substr($trimmed_excerpt, 0, $last_space);
                                    }

                                    $trimmed_excerpt .= '...'; // Add ellipsis
                                    echo $trimmed_excerpt; // Output the trimmed excerpt with ellipsis
                                } else {
                                    // If excerpt length is less than or equal to 114 characters, display the excerpt as it is
                                    echo $post_excerpt;
                                }
                            }
                            ?>
                        </div>

                        <div class="data-item-date">
                            <?php echo get_the_date('M j, Y'); ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();
    ob_start();
    ?>
    <?php if ($pages_el > 1) : ?>
        <button class="m5-btn wcl-btn" data-page="<?php echo $paged; ?>">
            View More
        </button>
    <?php else : ?>
        <button class="m5-btn wcl-btn" data-page="<?php echo $paged; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_search_load_post', 'search_load_post');
add_action('wp_ajax_nopriv_search_load_post', 'search_load_post');





/* 
add_block_numbers
 */
function add_block_numbers($content) {
    // Начинаем буферизацию вывода
    if (is_page() && !is_admin()) {
        ob_start();

        // Parse the content of the page to find blocks with the class "wcl-acf-block-9"
        $doc = new DOMDocument();
        $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $xpath = new DOMXPath($doc);

        // Get all blocks with the class "wcl-acf-block-9"
        //  $blocks = $xpath->query("//div[contains(@class, 'wcl-acf-block-9')]");
        $blocks = $xpath->query("//div[contains(@class, 'wcl-acf-block-9') and contains(@class, 'mod-solo')]");

        // Counter for the block number
        $block_count = 0;

        // Iterate through all blocks
        foreach ($blocks as $block) {
            // Increment the block number
            $block_count++;

            // Create a new element for the block number
            $number_element = $doc->createElement('span', $block_count . '.');

            // Add a class to the created element
            $number_element->setAttribute('class', 'data-block-number');

            // Find the element .data-head-title within the block
            $data_head_title = $xpath->query(".//h2[contains(@class, 'data-head-title')]", $block);
            if ($data_head_title->length > 0) {
                // Insert the block number at the beginning of h2.data-head-title
                $data_head_title->item(0)->insertBefore($number_element, $data_head_title->item(0)->firstChild);
            }
        }

        // Получаем обновленное содержимое страницы
        $content = $doc->saveHTML();

        // Очищаем буфер вывода и возвращаем обновленное содержимое
        ob_end_clean();
    }

    return $content;
}

add_filter('the_content', 'add_block_numbers');






/* 
remove_private_prefix_from_title
 */
function remove_private_prefix_from_title($title, $id = null) {
    if (is_admin() || !is_singular()) {
        return $title;
    }

    if (get_post_status($id) === 'private') {
        $title = preg_replace('/^\s*Private\s*:\s*/', '', $title);
    }

    return $title;
}
add_filter('the_title', 'remove_private_prefix_from_title', 10, 2);







/* 
get_acf_gutenberg_image_id
 */
function get_acf_gutenberg_image_id($post_id) {
    $image = '';

    // Get post content
    $content = get_the_content($post_id);

    // Parse content for ACF Gutenberg block
    $blocks = parse_blocks($content);

    // Loop through each block
    foreach ($blocks as $block) {
        // Check if it's an ACF block
        if ($block['blockName'] === 'acf/acf-block-banner') { // Replace 'acf/block-name' with the actual ACF block name
            // Get ACF field values from block attributes
            $image = $block['attrs']['data']['image']; // Replace 'your_image_field' with the actual image field name/key in the block
            // If image is found, break the loop
            if ($image) {
                break;
            }
        }
    }

    // Return the image URL
    if ($image) {
        return $image;
    } else {
        return false;
    }
}





/* 
is_banner_first
 */
function is_banner_first($post_id) {
    $state   = false;
    $content = get_the_content($post_id);
    $blocks  = parse_blocks($content);

    foreach ($blocks as $block) {
        if ($block['blockName'] === 'acf/acf-block-banner') { // Replace 'acf/block-name' with the actual ACF block name
            $state = true;
            break;
        }
    }

    // Return the image URL
    if ($state) {
        return true;
    } else {
        return false;
    }
}




/* 
get_rating_description
 */
function get_rating_description($rating) {
    $data = '';

    if ($rating >= 9.6 && $rating <= 10) {
        $data = "Exceptional";
    } elseif ($rating >= 9 && $rating < 9.6) {
        $data = "Superb";
    } elseif ($rating >= 8.5 && $rating < 9) {
        $data = "Fabulous";
    } elseif ($rating >= 8 && $rating < 8.5) {
        $data = "Very Good";
    } elseif ($rating < 8) {
        $data = "Good";
    } else {
        $data = "";
    }

    return $data . ' ' . $rating;
}






/* 
wcl_get_price_range
 */
function wcl_get_price_range($price) {
    global $wcl_price_type;

    if (!empty($price)) {
        if (is_numeric($price) && $price <= 5) {
            $new_price = '';

            for ($i = 0; $i < $price; $i++) {
                $new_price .= "$";
            }

            $price = $new_price;
        } elseif (is_numeric($price)) {
            $price = number_format($price);
            $price = 'USD ' . $price;
        }
    }

    return $price;
}






/* 
wcl_rating_to_stars
 */
function wcl_rating_to_stars($rating) {
    if ($rating < 1.3) {
        return 1;
    } elseif ($rating < 1.8) {
        return 1.5;
    } elseif ($rating < 2.3) {
        return 2;
    } elseif ($rating < 2.8) {
        return 2.5;
    } elseif ($rating < 3.3) {
        return 3;
    } elseif ($rating < 3.8) {
        return 3.5;
    } elseif ($rating < 4.3) {
        return 4;
    } elseif ($rating < 4.8) {
        return 4.5;
    } else {
        return 5;
    }
}






/* 
wcl_format_address
 */
function wcl_format_address($address) {
    $state = false;

    $classes_to_check = ['street-address', 'extended-address', 'locality', 'region', 'postal-code', 'country-name'];

    foreach ($classes_to_check as $class) {
        if (strpos($address, 'class="' . $class . '"') !== false) {
            $state = true;
        } else {
            $state = false;
            break;
        }
    }

    if (!empty($address) && $state) {
        $classesToRemove = array('region', 'postal-code', 'country-name');

        foreach ($classesToRemove as $class) {
            $pattern = '/<span class="' . $class . '">.*?<\/span>/';
            $address = preg_replace($pattern, '', $address);
        }

        $address = rtrim($address, ', ');
        $address = trim($address);
    }

    return $address;
}
