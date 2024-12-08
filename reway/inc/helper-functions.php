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
true_load_theme_textdomain
 */
add_action('after_setup_theme', 'true_load_theme_textdomain');

function true_load_theme_textdomain() {
    load_theme_textdomain('reway-theme', get_template_directory() . '/languages');
}






/* 
add_page_slug_to_body_class
 */
function add_page_slug_to_body_class($classes) {
    global $post;

    $pages = get_field('pages', 'option');

    $page_slugs = ['home', 'partners', 'spa', 'sports', 'dietitans', 'pilates', 'contact'];
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

    if (!$state) {
        if (is_page() && isset($post)) {
            $classes[] = 'page-' . $post->post_name;
        }
    }

    return $classes;
}
add_filter('body_class', 'add_page_slug_to_body_class');






/* 
wcl_get_current_site_url_lang
 */
function wcl_get_current_site_url_lang() {
    $site_url = site_url('/');

    if (!defined('ICL_LANGUAGE_CODE')) {
        return $site_url;
    }

    $default_language_code = '';

    $sitepress_settings = get_option('icl_sitepress_settings');

    if (isset($sitepress_settings['default_language'])) {
        $default_language_code = $sitepress_settings['default_language'];
    }

    $current_language_code = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : '';

    if (!empty($current_language_code) && $current_language_code !== $default_language_code) {
        $site_url .= $current_language_code;
    }

    return $site_url;
}






/* 
Custom_Walker_Nav_Menu
Custom Walker class to add data-field attribute to each menu item
 */
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        // Add custom data-field attribute
        $data_field = 'itemprop="name"';

        $output .= $indent . '<li' . $id . $class_names . $data_field . '>';

        // Your custom modifications here
        $output .= '<a href="' . $item->url . '">' . $item->title . '</a>';

        $output .= "</li>\n";
    }
}






/* 
generate_dynamic_json_ld_schema
 */
function generate_dynamic_json_ld_schema() {
    $pages      = get_field('pages', 'option');
    $page_slugs = ['home', 'partners', 'spa', 'sports', 'dietitans', 'pilates', 'contact'];

    if (is_page()) {
        $schema = array(
            "@context"    => "http://schema.org",
            "@type"       => 'Organization',
            "name"        => get_bloginfo('name'),
            "url"         => get_site_url(),
        );

        $description = get_bloginfo('description');

        if (!empty($description)) {
            $schema['description'] = $description;
        }

        $organization_logo = get_field('logo_header', 'option');
        $organization_logo = wp_get_attachment_image_url($organization_logo);

        if (!empty($organization_logo)) {
            $schema['logo'] = $organization_logo;
        }

        $social_media      = get_field('social_media', 'option');
        $social_media_urls = [];

        if (!empty($social_media['twitter']['url'])) {
            $social_media_urls[] = $social_media['twitter']['url'];
        }

        if (!empty($social_media['facebook']['url'])) {
            $social_media_urls[] = $social_media['facebook']['url'];
        }

        if (!empty($social_media['instagram']['url'])) {
            $social_media_urls[] = $social_media['instagram']['url'];
        }

        if (!empty($social_media['linkedin']['url'])) {
            $social_media_urls[] = $social_media['linkedin']['url'];
        }

        if (!empty($social_media_urls)) {
            $schema['sameAs'] = $social_media_urls;
        }

        $contact_info = get_field('contact_info', 'option');
        $place        = $contact_info['place'];
        $phone        = $contact_info['phone'];

        if (!empty($place)) {
            $schema['address'] = $place;
        }

        if (!empty($telephone)) {
            $schema['address'] = $telephone;
        }

        switch (get_the_ID()) {
            case $pages['home']:
                $type_schema = 'Organization';
                break;
            case $pages['spa']:
                $type_schema = 'HealthAndBeautyBusiness';
                break;
            case $pages['sports']:
                $type_schema = 'SportsActivityLocation';
                break;
            case $pages['pilates']:
                $type_schema = 'ExerciseGym';
                break;
            case $pages['gastronomy']:
                $type_schema = 'FoodEstablishment';
                break;
            case $pages['dietitans']:
                $type_schema = 'MedicalBusiness';
                break;
            case $pages['partners']:
                $type_schema = 'AboutPage';
                break;
            case $pages['contact']:
                $type_schema = 'ContactPage';
                break;
            default:
                break;
        }
    }

    if (!empty($type_schema)) {
        $schema['@type'] = $type_schema;
    }

    $json_schema = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    echo $json_schema;
}

add_action('wp_head', 'generate_dynamic_json_ld_schema');
