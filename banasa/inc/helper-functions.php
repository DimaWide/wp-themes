<?php




/*
* Plug for VS
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
create_project_post_type
 */
function create_project_post_type() {
    $labels = array(
        'name'               => _x('Projects', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Project', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Projects', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Project', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'project', 'textdomain'),
        'add_new_item'       => __('Add New Project', 'textdomain'),
        'new_item'           => __('New Project', 'textdomain'),
        'edit_item'          => __('Edit Project', 'textdomain'),
        'view_item'          => __('View Project', 'textdomain'),
        'all_items'          => __('All Projects', 'textdomain'),
        'search_items'       => __('Search Projects', 'textdomain'),
        'parent_item_colon'  => __('Parent Projects:', 'textdomain'),
        'not_found'          => __('No projects found.', 'textdomain'),
        'not_found_in_trash' => __('No projects found in Trash.', 'textdomain')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'textdomain'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'project'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'menu_icon'          => 'dashicons-portfolio',
    );

    register_post_type('project', $args);
}

add_action('init', 'create_project_post_type');





/* 
create_project_taxonomies
 */
function create_project_taxonomies() {
    $labels = array(
        'name'              => _x('Project Categories', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Project Category', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Project Categories', 'textdomain'),
        'all_items'         => __('All Project Categories', 'textdomain'),
        'parent_item'       => __('Parent Project Category', 'textdomain'),
        'parent_item_colon' => __('Parent Project Category:', 'textdomain'),
        'edit_item'         => __('Edit Project Category', 'textdomain'),
        'update_item'       => __('Update Project Category', 'textdomain'),
        'add_new_item'      => __('Add New Project Category', 'textdomain'),
        'new_item_name'     => __('New Project Category Name', 'textdomain'),
        'menu_name'         => __('Project Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-de-proyecto'),
    );

    register_taxonomy('project_category', array('project'), $args);
}

add_action('init', 'create_project_taxonomies', 0);



// Hook into the 'init' action to add custom rewrite rules
add_action('init', 'add_custom_taxonomy_rewrite_rules', 10, 0);

function add_custom_taxonomy_rewrite_rules() {
    // Add a custom rewrite rule for the English taxonomy archive
    add_rewrite_rule(
        '^project-category/?$',
        'index.php?taxonomy=project_category',
        'top'
    );

    // Add a custom rewrite rule for the Spanish taxonomy archive
    add_rewrite_rule(
        '^categoria-de-proyecto/?$',
        'index.php?taxonomy=project_category',
        'top'
    );

    // Add custom rewrite rules for English taxonomy terms
    add_rewrite_rule(
        '^project-category/([^/]+)/?$',
        'index.php?project_category=$matches[1]',
        'top'
    );

    // Add custom rewrite rules for Spanish taxonomy terms
    add_rewrite_rule(
        '^categoria-de-proyecto/([^/]+)/?$',
        'index.php?project_category=$matches[1]',
        'top'
    );
}

// Ensure that rewrite rules are flushed when the theme or plugin is activated
add_action('after_switch_theme', 'flush_rewrite_rules');
add_action('wp_loaded', 'flush_rewrite_rules_once');

function flush_rewrite_rules_once() {
    if (!get_option('custom_rewrite_rules_flushed')) {
        flush_rewrite_rules();
        update_option('custom_rewrite_rules_flushed', true);
    }
}






/* 
add_page_slug_to_body_class_02
 */
function add_page_slug_to_body_class_02($classes) {
    global $post;

    $is_default_page = get_field('is_default_page');
    $is_default_page =  isset($is_default_page) ? $is_default_page : true;

    if ($is_default_page === true && is_page()) {
        $classes[] = 'mod-default-page';
    }

    return $classes;
}
add_filter('body_class', 'add_page_slug_to_body_class_02');





/* 
add_page_slug_to_body_class
 */
function add_page_slug_to_body_class($classes) {
    global $post;

    $pages = get_field('pages', 'option');

    $page_slugs = ['projects_listing'];
    $state = false;

    if (!empty($pages)) {
        foreach ($page_slugs as $page_slug) {
            if (isset($pages[$page_slug]) && $pages[$page_slug] == get_the_ID()) {
                $classes[] = 'page-' . $page_slug;
                $state = true;
                break;
            }
        }
    }

    if ($state == false && is_page()) {
        $classes[] = 'page-' . $post->post_name;
    }

    return $classes;
}
add_filter('body_class', 'add_page_slug_to_body_class');





/* 
my_register_sidebars
 */
function my_register_sidebars() {
    /*
  Register the 'primary' sidebar.
  */
    register_sidebar(array(
        'name'          => __('Primary Sidebar'),
        'id'            => 'primary-sidebar',
        'description'   => __('This is the primary sidebar'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'my_register_sidebars');





/* 
project_breadcrumb
 */
function project_breadcrumb() {
    $pages                = get_field('pages', 'option');
    $projects_listing     = $pages['projects_listing'];
    $projects_listing_url = get_permalink($projects_listing);
?>
    <nav class="data-breadcrumb">
        <div class="data-breadcrumb-container tmp-container">
            <?php
            $projects_word = 'PROYECTOS';

            if (function_exists('icl_t')) {
                $projects_word = icl_t('banasa', 'projects', 'PROYECTOS');
            }
            ?>

            <a href="<?php echo $projects_listing_url; ?>"><?php echo $projects_word; ?></a>

            <?php
            $categories = get_the_terms(get_the_ID(), 'project_category');

            if ($categories && !is_wp_error($categories)) {
            ?>
                / <a href="<?php echo get_category_link($categories[0]->term_id); ?>"><?php echo $categories[0]->name; ?></a>
            <?php
            }
            ?>
            / <?php echo ucwords(strtolower(get_the_title())); ?>
        </div>
    </nav>
<?php
}



/* 
gform_disable_css
*/
add_filter('gform_disable_css', '__return_true');





/* 
custom_language_switcher
 */
function custom_language_switcher() {
    // Check if WPML is installed and active
    if (function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');

        // Check if languages are available
        if (!empty($languages)) {
            echo '<ul class="data-lang-switcher">';
            foreach ($languages as $lang) {
                if ($lang['active']) {
                    echo '<li class="active">' . strtoupper($lang['language_code']) . '</li>';
                } else {
                    echo '<li><a href="' . $lang['url'] . '">' . strtoupper($lang['language_code']) . '</a></li>';
                }
            }
            echo '</ul>';
        }
    } else {
        return;
        // Fallback: Hardcoded languages if WPML is not active
        $languages = array(
            'es' => array(
                'name' => 'ES',
                'url' => '/es/'
            ),
            'en' => array(
                'name' => 'EN',
                'url' => '/en/'
            ),
        );

        $current_lang = 'es';

        if (strpos($_SERVER['REQUEST_URI'], '/en/') !== false) {
            $current_lang = 'en';
        }

        if (!empty($languages)) {
            echo '<ul class="data-lang-switcher">';
            foreach ($languages as $code => $language) {
                if ($code == $current_lang) {
                    echo '<li class="active">' . $language['name'] . '</li>';
                } else {
                    echo '<li><a href="' . $language['url'] . '">' . $language['name'] . '</a></li>';
                }
            }
            echo '</ul>';
        }
    }
}




/* 
lowercase_menu_items
 */
function lowercase_menu_items($items, $args) {
    if ($args->theme_location == 'additional-pages-menu') {
        foreach ($items as $item) {
            $item->title = strtolower($item->title);
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'lowercase_menu_items', 10, 2);




/* 
my_plugin_register_strings
 */
function my_plugin_register_strings() {
    icl_register_string('banasa', 'footer_copyright', 'Todos los derechos reservados!');
    icl_register_string('banasa', 'category_all', 'Todos');
    icl_register_string('banasa', 'projects', 'Proyectos');
    icl_register_string('banasa', 'client', 'Cliente');
    icl_register_string('banasa', 'project', 'Proyecto');
    icl_register_string('banasa', 'location', 'Localización');
    icl_register_string('banasa', 'year_of_construction', 'Año de Construcción');
    icl_register_string('banasa', 'see_more_projects', 'VER MÁS PROYECTOS');
    icl_register_string('banasa', 'load_more', 'Carga más');
    icl_register_string('banasa', 'all_viewed', 'Todo visto');
}
add_action('init', 'my_plugin_register_strings');




/* 
redirect_project_archive_to_page
 */
function redirect_project_archive_to_page() {
    if (is_post_type_archive('project')) {
        $pages            = get_field('pages', 'option');
        $projects_listing = $pages['projects_listing'];
        $redirect_url = get_permalink($projects_listing);

        if ($redirect_url) {
            wp_redirect($redirect_url, 301); // Use 301 status code for SEO-friendly redirection
            exit;
        }
    }

    $current_url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    if ($current_url_path == 'categoria-de-proyecto' || $current_url_path == 'en/project-category') {
        $pages            = get_field('pages', 'option');
        $projects_listing = $pages['projects_listing'];
        $redirect_url     = get_permalink($projects_listing);

        if ($redirect_url) {
            wp_redirect($redirect_url, 301); // Use 301 status code for SEO-friendly redirection
            exit;
        }
    }
}
add_action('template_redirect', 'redirect_project_archive_to_page');



/* 
display_preview_image
 */
function display_preview_image($block) {
    if (isset($block['data']['preview_image_help'])) {
        echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto;">';
        return true;
    }
}
