<?php




/*
* Plug for vs
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
display_preview_image
 */
function display_preview_image($block) {
    if (isset($block['data']['preview_image_help'])) {
        echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto;">';
        return true;
    }
}



/* 
custom_post_types
 */
function custom_post_types() {
    // Register Projects Post Type
    $projects_labels = array(
        'name'               => _x('Projects', 'post type general name'),
        'singular_name'      => _x('Project', 'post type singular name'),
        'menu_name'          => _x('Projects', 'admin menu'),
        'name_admin_bar'     => _x('Project', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'project'),
        'add_new_item'       => __('Add New Project'),
        'new_item'           => __('New Project'),
        'edit_item'          => __('Edit Project'),
        'view_item'          => __('View Project'),
        'all_items'          => __('All Projects'),
        'search_items'       => __('Search Projects'),
        'not_found'          => __('No projects found.'),
        'not_found_in_trash' => __('No projects found in Trash.')
    );

    $projects_args = array(
        'labels'       => $projects_labels,
        'public'       => false,
        'show_ui'      => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'project'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-portfolio',
    );

    register_post_type('project', $projects_args);



    // Register News Post Type
    $news_labels = array(
        'name'               => _x('News', 'post type general name'),
        'singular_name'      => _x('News', 'post type singular name'),
        'menu_name'          => _x('News', 'admin menu'),
        'name_admin_bar'     => _x('News', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'news'),
        'add_new_item'       => __('Add New News'),
        'new_item'           => __('New News'),
        'edit_item'          => __('Edit News'),
        'view_item'          => __('View News'),
        'all_items'          => __('All News'),
        'search_items'       => __('Search News'),
        'not_found'          => __('No news found.'),
        'not_found_in_trash' => __('No news found in Trash.')
    );

    $news_args = array(
        'labels'      => $news_labels,
        'public'      => false,
        'show_ui'     => true,
        'has_archive' => true,
         // 'rewrite'            => array('slug' => 'news'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-megaphone',
    );

    register_post_type('wcl-news', $news_args);
}

add_action('init', 'custom_post_types');





/* 
redirect_single_news
 */
function redirect_single_news() {
    if (is_singular('wcl-news')) {
        $redirect_url = home_url(); 
        wp_redirect($redirect_url, 301);
        exit;
    }

    if (is_singular('project')) {
        $redirect_url = home_url(); 
        wp_redirect($redirect_url, 301); 
        exit;
    }

    if (is_post_type_archive('wcl-news')) {
        $redirect_url = home_url(); 
        wp_redirect($redirect_url, 301);
        exit;
    }

    if (is_post_type_archive('project')) {
        $redirect_url = home_url(); 
        wp_redirect($redirect_url, 301);
        exit;
    }
}
add_action('template_redirect', 'redirect_single_news');




/* 
custom_page_redirects
 */

function custom_redirects_based_on_uri() {
    $request_uri = trim($_SERVER['REQUEST_URI'], '/'); // Get the current request URI

    switch ($request_uri) {
        case 'westchester-county-property-management':
            wp_redirect(home_url('/property-management/'), 301);
            exit;

        case 'investments':
            wp_redirect(home_url('/'), 301);
            exit;

        case 'projects':
            wp_redirect(home_url('/recent-projects/'), 301);
            exit;

        case 'our-team':
            wp_redirect(home_url('/the-company/'), 301);
            exit;

        case 'westchester-county-homes-for-rent':
            wp_redirect(home_url('/'), 301);
            exit;

        default:
            // No redirect needed
            break;
    }
}
add_action('template_redirect', 'custom_redirects_based_on_uri');




/* 
add_page_slug_to_body_class
 */
function add_page_slug_to_body_class($classes) {
    global $post;

    $pages = get_field('pages', 'option');

    $page_slugs = ['the_company'];
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
wcl_is_page
 */
function wcl_is_page($page_slug) {
    $pages      = get_field('pages', 'option');
    $state      = false;

    if (!empty($pages)) {
        if (isset($pages[$page_slug]) && $pages[$page_slug] == get_the_ID()) {
            $state = true;
        }
    }

    return $state;
}



/* 
footer_menu
 */
function footer_menu() {
    $menu_name  = 'footer-menu';
    $locations  = get_nav_menu_locations();
    $menu       = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_items_by_parent = array();
    foreach ($menu_items as $item) {
        $menu_items_by_parent[$item->menu_item_parent][] = $item;
    }

    $items_without_submenus = array();
    foreach ($menu_items as $item) {
        if ($item->menu_item_parent == 0) {
            $items_without_submenus[] = $item;
        }
    }

    $columns = array_chunk($items_without_submenus, ceil(count($items_without_submenus) / 3));

?>
    <div class="data-menu">
        <?php foreach ($columns as $column): ?>
            <?php display_menu_items($column, $menu_items_by_parent); ?>
        <?php endforeach; ?>
    </div>
<?php
}





/* 
display_menu_items
 */
function display_menu_items($items, $menu_items_by_parent, $parent_id = 0) {
    echo '<ul class="data-menu-col">';
    foreach ($items as $item) {
        if ($parent_id == 0 && $item->menu_item_parent != 0) {
            continue;
        }

        $classes = array('menu-item', 'menu-item-type-' . $item->type, 'menu-item-object-' . $item->object);

        if (isset($menu_items_by_parent[$item->ID])) {
            $classes[] = 'menu-item-has-children';
        }

        $classes[] = 'menu-item-' . $item->ID;

        $class_string = implode(' ', $classes);

        echo '<li class="' . esc_attr($class_string) . '">';
        echo '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';

        if (isset($menu_items_by_parent[$item->ID])) {
            echo '<ul class="sub-menu">';
            foreach ($menu_items_by_parent[$item->ID] as $child_item) {
                $child_classes = array('menu-item', 'menu-item-type-' . $child_item->type, 'menu-item-object-' . $child_item->object);
                $child_classes[] = 'menu-item-' . $child_item->ID;
                $child_class_string = implode(' ', $child_classes);

                echo '<li class="' . esc_attr($child_class_string) . '">';
                echo '<a href="' . esc_url($child_item->url) . '">' . esc_html($child_item->title) . '</a>';

                echo '</li>';
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}





/* 
generate_post_table_of_contents
 */
function generate_post_table_of_contents($post_content) {

    preg_match_all('/<h2.*?>(.*?)<\/h2>/', $post_content, $matches);

    if (!empty($matches[1])) {
        $html = '<ul>';
        foreach ($matches[1] as $index => $heading) {
            $anchor_link = sanitize_title_with_dashes($heading);

            $html .= '<li><a href="#' . $anchor_link . '">' . strip_tags($heading) . '</a></li>';
        }
        $html .= '</ul>';

        return $html;
    }

    return '';
}



/*
add_ids_to_h2_tags
*/
function add_ids_to_h2_tags($content) {
    if (is_single()) {
        preg_match_all('/<h2(.*?)>(.*?)<\/h2>/', $content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $index => $attributes) {
                $attributes = preg_replace('/\bid=[\'"](.*?)[\'"]/', '', $attributes);

                $anchor_link = sanitize_title_with_dashes($matches[2][$index]);

                $replacement = '<h2' . $attributes . ' id="' . $anchor_link . '">' . $matches[2][$index] . '</h2>';
                $content = str_replace($matches[0][$index], $replacement, $content);
            }
        }
    }

    return $content;
}
add_filter('the_content', 'add_ids_to_h2_tags');




/* 
list_all_pages_with_links
 */
function list_all_pages_with_links() {
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,        // Get all pages
        'orderby'        => 'title',
        'order'          => 'ASC'
    );
    $pages = new WP_Query($args);

    if ($pages->have_posts()) {
        $output = '<ul>';
        while ($pages->have_posts()) {
            $pages->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
        wp_reset_postdata();
    } else {
        $output = 'No pages found.';
    }

    return $output;
}

add_shortcode('list_pages', 'list_all_pages_with_links');




/* 
add_required_star_to_cf7
 */
function add_required_star_to_cf7($form) {
    // Найти все обязательные поля и добавить к ним звездочку
    $form = preg_replace('/(<span class="wpcf7-form-control-wrap .+?">.+?<input[^>]+?aria-required="true"[^>]*?>)/', '<label class="required-field-label">* </label>$1', $form);
    
    return $form;
}
add_filter('wpcf7_form_elements', 'add_required_star_to_cf7');