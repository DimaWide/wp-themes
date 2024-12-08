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
create_video_post_type
 */
function create_video_post_type() {
    $labels = array(
        'name'               => _x('Vaizdo įrašai', 'post type general name', 'crypto-group'),
        'singular_name'      => _x('Vaizdo įrašas', 'post type singular name', 'crypto-group'),
        'menu_name'          => _x('Vaizdo įrašai', 'admin menu', 'crypto-group'),
        'name_admin_bar'     => _x('Vaizdo įrašas', 'add new on admin bar', 'crypto-group'),
        'add_new'            => _x('Pridėti naują', 'video', 'crypto-group'),
        'add_new_item'       => __('Pridėti naują vaizdo įrašą', 'crypto-group'),
        'new_item'           => __('Naujas vaizdo įrašas', 'crypto-group'),
        'edit_item'          => __('Redaguoti vaizdo įrašą', 'crypto-group'),
        'view_item'          => __('Peržiūrėti vaizdo įrašą', 'crypto-group'),
        'all_items'          => __('Visi vaizdo įrašai', 'crypto-group'),
        'search_items'       => __('Ieškoti vaizdo įrašų', 'crypto-group'),
        'parent_item_colon'  => __('Pirminiai vaizdo įrašai:', 'crypto-group'),
        'not_found'          => __('Vaizdo įrašų nerasta.', 'crypto-group'),
        'not_found_in_trash' => __('Šiukšlinėje vaizdo įrašų nerasta.', 'crypto-group')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Pasirinktinis įrašo tipas vaizdo įrašams.', 'crypto-group'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'video'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'menu_icon'          => 'dashicons-video-alt3',
    );

    register_post_type('video', $args);
}

add_action('init', 'create_video_post_type');




/*
create_video_taxonomies
*/
function create_video_taxonomies() {
    $labels = array(
        'name'              => _x('Vaizdo įrašų kategorijos', 'taxonomy general name', 'crypto-group'),
        'singular_name'     => _x('Vaizdo įrašų kategorija', 'taxonomy singular name', 'crypto-group'),
        'search_items'      => __('Ieškoti vaizdo įrašų kategorijų', 'crypto-group'),
        'all_items'         => __('Visos vaizdo įrašų kategorijos', 'crypto-group'),
        'parent_item'       => __('Pirminė vaizdo įrašų kategorija', 'crypto-group'),
        'parent_item_colon' => __('Pirminė vaizdo įrašų kategorija:', 'crypto-group'),
        'edit_item'         => __('Redaguoti vaizdo įrašų kategoriją', 'crypto-group'),
        'update_item'       => __('Atnaujinti vaizdo įrašų kategoriją', 'crypto-group'),
        'add_new_item'      => __('Pridėti naują vaizdo įrašų kategoriją', 'crypto-group'),
        'new_item_name'     => __('Naujas vaizdo įrašų kategorijos pavadinimas', 'crypto-group'),
        'menu_name'         => __('Vaizdo įrašų kategorijos', 'crypto-group'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'video-category'),
    );

    register_taxonomy('video_category', array('video'), $args);
}

add_action('init', 'create_video_taxonomies', 0);





/* 
Hook into the 'init' action to add custom rewrite rules
 */
function add_custom_taxonomy_rewrite_rules() {
    add_rewrite_rule(
        '^video-category/?$',
        'index.php?taxonomy=video_category',
        'top'
    );

    add_rewrite_rule(
        '^video-category/([^/]+)/?$',
        'index.php?video_category=$matches[1]',
        'top'
    );
}
add_action('init', 'add_custom_taxonomy_rewrite_rules', 10, 0);

// Ensure that rewrite rules are flushed when the theme or plugin is activated
add_action('after_switch_theme', 'flush_rewrite_rules');
add_action('wp_loaded', 'flush_rewrite_rules_once');


/* 
flush_rewrite_rules_once
 */
function flush_rewrite_rules_once() {
    if (!get_option('custom_rewrite_rules_flushed')) {
        flush_rewrite_rules();
        update_option('custom_rewrite_rules_flushed', true);
    }
}





/* 
custom_woocommerce_redirects
 */
function custom_woocommerce_redirects() {
    $pages         = get_field('pages', 'option');
    $video_listing = $pages['video_listing'];

    if (is_product()) {
        wp_redirect(site_url(), 301);
        exit();
    }

    if (is_tax('product_cat')) {
        wp_redirect(site_url('/'), 301);
        exit();
    }

    if (is_shop()) {
        wp_redirect(wc_get_cart_url(), 301);
        exit();
    }

    if (is_checkout()) {
        if (isset($_GET['add-to-cart']) &&  WC()->cart->is_empty()) {
            $product_id = intval($_GET['add-to-cart']);
            WC()->cart->add_to_cart($product_id);
        }
    }

    if (is_cart()) {
        if (user_is_active_subscriber()) {
            wp_redirect(get_permalink($video_listing), 301);
            exit();
        } else {
            WC()->cart->empty_cart();

            $products = get_field('products', 'option');
            $product  = $products['product_1'];
            wp_redirect(wc_get_checkout_url() . '?add-to-cart=' . $product, 301);
            exit();
        }
    }
}
add_action('template_redirect', 'custom_woocommerce_redirects');




/* 
check_product_id_on_checkout
 */
function check_product_id_on_checkout($quantity_html, $cart_item, $cart_item_key) {
    $products = get_field('products', 'option');
    $product_id_to_check  = $products['product_1'];

    $product = $cart_item['product_id'];

    if ($product != $product_id_to_check) {
        WC()->cart->empty_cart();
        wp_redirect(wc_get_checkout_url() . '?add-to-cart=' . $product_id_to_check, 301);
        exit();
    }

    return $quantity_html;
}
add_action('woocommerce_checkout_cart_item_quantity', 'check_product_id_on_checkout', 10, 3);



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
* Custom_Walker_Nav_Menu
*/
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */


    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }

        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';


        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $data_output = '';

        $mega_menu_item_id = get_field('mega_menu_item_id', 'option');

        $menuIds = [$mega_menu_item_id];

        if (in_array($item->ID, $menuIds)) {
            ob_start();
            wcl_mega_menu_generate_tab();
            $data_output = ob_get_clean();
        }
?>

    <?php

        if (!is_object($args)) {
            $item_output = '<a' . $attributes . '>';
            $item_output .=  apply_filters('the_title', $item->title, $item->ID);
            $item_output .= '</a>';
            $item_output .= $data_output;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $data_output;
            $item_output .= $args->after;
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "{$indent}</ul>\n";
    }
}







/* 
wcl_mega_menu_generate_tab
 */
function wcl_mega_menu_generate_tab() {
    ?>
    <div class="wcl-cmp-2-mega-menu">
        <div class="cmp2-container">
            <?php if (have_rows('mega_menu', 'option')) : ?>
                <div class="cmp2-list">
                    <?php while (have_rows('mega_menu', 'option')) : the_row(); ?>
                        <?php
                        $icon        = get_sub_field('icon');
                        $icon        = wp_get_attachment_image($icon, 'full');
                        $title       = get_sub_field('title');
                        $description = get_sub_field('description');
                        $link        = get_sub_field('link');
                        $is_new      = get_sub_field('is_new');
                        $is_comming  = get_sub_field('is_comming');
                        $link        = !empty($link['url']) ? $link['url'] : '#';

                        $is_comming_class = '';

                        if ($is_comming) {
                            $is_comming_class = 'mod-is-comming';
                        }

                        if ($link != '#') {
                            $tag_link_start = '<a href="' . $link . '" class="cmp2-item-inner">';
                            $tag_link_end = '</a>';
                        } else {
                            $tag_link_start = '<div class="cmp2-item-inner">';
                            $tag_link_end = '</div>';
                        }
                        ?>

                        <div class="cmp2-item <?php echo $is_comming_class; ?>">
                            <?php echo $tag_link_start; ?>

                            <?php if (!empty($icon)) : ?>
                                <div class="cmp2-item-icon">
                                    <?php echo $icon; ?>
                                </div>
                            <?php endif; ?>

                            <div class="cmp2-item-info">
                                <?php if (!empty($title)) : ?>
                                    <?php if (!empty($is_new)) : ?>
                                        <h3 class="cmp2-item-title mod-is-new">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php else : ?>
                                        <h3 class="cmp2-item-title">
                                            <?php echo $title; ?>
                                        </h3>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($is_comming)) : ?>
                                    <div class="cmp2-item-is-comming">
                                        GREITAI
                                    </div>
                                <?php else : ?>
                                    <?php if (!empty($description)) : ?>
                                        <div class="cmp2-item-description">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <?php echo $tag_link_end; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
}




/* 
wcl_add_custom_body_class
 */
function wcl_add_custom_body_class($classes) {
    $bar = get_field('bar', 'option');

    if (!empty($bar) && is_front_page()) {
        $classes[] = 'mod-bar-show';
    }

    return $classes;
}
add_filter('body_class', 'wcl_add_custom_body_class');




/* 
replaceSecondYearWithCurrent
 */
function replaceSecondYearWithCurrent($string) {
    // Find the position of the second year in the format "20xx"
    preg_match('/20\d{2}/', $string, $matches, PREG_OFFSET_CAPTURE, strpos($string, '20') + 4);

    if (!empty($matches)) {
        $second_year_position = $matches[0][1];

        // Get the current year
        $current_year = date('Y');

        // Replace the second matched year with the current year
        $string = substr_replace($string, $current_year, $second_year_position, 4);

        return $string;
    }
}





/* 
handle_lost_password
*/
function handle_lost_password() {
    $result = array();

    if (isset($_POST['submit'])) {
        $user_login = sanitize_text_field($_POST['user_login']);
        $referer = site_url('/lost-password');

        if (empty($user_login)) {
            $result['error_type'] = 'empty_username';
        } else {
            $user_data = get_user_by('login', $user_login);
            if (!$user_data && is_email($user_login)) {
                $user_data = get_user_by('email', $user_login);
            }

            if (!$user_data) {
                $result['error_type'] = 'invalid_username';
            } else {
                $user_login = $user_data->user_login;
                $user_email = $user_data->user_email;

                $key = get_password_reset_key($user_data);

                $user_login_encoded = rawurlencode($user_login);
                $key_encoded        = rawurlencode($key);
                $reset_password_url = site_url('/lost-password') . '?reset-password=active&login=' . $user_login_encoded . '&key=' . $key_encoded;

                $message  = __('Kažkas paprašė atstatyti slaptažodį šiai paskyrai:', 'crypto-group') . "\r\n\r\n";
                $message .= sprintf(__('Vartotojo vardas: %s', 'crypto-group'), $user_login) . "\r\n\r\n";
                $message .= __('Jei tai buvo klaida, tiesiog ignoruokite šį laišką ir nieko neatsitiks.', 'crypto-group') . "\r\n\r\n";
                $message .= __('Norėdami atstatyti slaptažodį, apsilankykite šiuo adresu:', 'crypto-group') . "\r\n\r\n";
                $message .= ($reset_password_url) . "\r\n";
                $headers = array('Content-Type: text/plain; charset=UTF-8');

                if (wp_mail($user_email, 'Slaptažodžio nustatymas iš naujo', $message, $headers)) {
                    $result['checkemail'] = 'confirm'; // Успешная отправка email
                } else {
                    $result['error_type'] = 'mail_failed'; // Ошибка при отправке email
                }
            }
        }
    }

    return $result;
}






/* 
custom_rewrite_rule
 */
function custom_rewrite_rule() {
    add_rewrite_rule('^lost-password/?$', 'index.php?lost_password=1', 'top');
}
add_action('init', 'custom_rewrite_rule');

function custom_query_vars($vars) {
    $vars[] = 'lost_password';
    return $vars;
}
add_filter('query_vars', 'custom_query_vars');




/* 
custom_template_include
 */
function custom_template_include($template) {
    if (get_query_var('lost_password') == 1 && !isset($_GET['reset-password'])) {
        get_template_part('template-parts/lost-password');
    }
    return $template;
}
add_filter('template_include', 'custom_template_include');





/* 
custom_template_include_02
 */
function custom_template_include_02($template) {
    // Получаем текущий URL
    $current_url = $_SERVER['REQUEST_URI'];

    if (false !== strpos($current_url, 'lost-password/?reset-password')) {
        get_template_part('template-parts/reset-password');
        return $template;
    }
    return $template;
}
add_filter('template_include', 'custom_template_include_02');




/* 
handle_reset_password_action
 */
function handle_reset_password_action() {
    if (isset($_POST['reset_password'])) {
        $login            = sanitize_text_field($_POST['user_login']);
        $key              = sanitize_text_field($_POST['key']);
        $password         = sanitize_text_field($_POST['password']);
        $confirm_password = sanitize_text_field($_POST['confirm_password']);

        $success_message = '';
        $error_message = '';

        if (empty($password) || empty($confirm_password)) {
            $error_message = __('Prašome įvesti abu slaptažodžio laukus.', 'crypto-group');
        } elseif (strlen($password) < 8) {
            $error_message = __('Slaptažodis turi būti ilgesnis nei 8 simboliai.', 'crypto-group');
        } elseif ($password !== $confirm_password) {
            $error_message = __('Slaptažodžiai nesutampa.', 'crypto-group');
        } else {
            $user = check_password_reset_key($key, $login);

            if ($user && !is_wp_error($user)) {
                reset_password($user, $password);
                $success_message = __('Jūsų slaptažodis buvo sėkmingai atstatytas.', 'crypto-group');

                $to = $user->user_email;
                $subject = __('Jūsų naujas slaptažodis', 'crypto-group');
                $message = sprintf(__('Sveiki %s,', 'crypto-group'), $user->display_name) . "\r\n\r\n";
                $message .= __('Jūsų slaptažodis buvo atstatytas. Štai jūsų naujas slaptažodis:', 'crypto-group') . "\r\n";
                $message .= $password . "\r\n\r\n";
                $message .= __('Prašome pakeisti slaptažodį prisijungus.', 'crypto-group') . "\r\n";
                $message .= get_site_url() . "\r\n";

                $headers = array('Content-Type: text/plain; charset=UTF-8');

                wp_mail($to, $subject, $message, $headers);
            } else {
                $error_message = __('Neteisingas atstatymo raktas arba vartotojas.', 'crypto-group');
            }
        }

        return array(
            'error_message'   => $error_message,
            'success_message' => $success_message,
        );
    }
}




/* 
assign_customer_role_nextend
 */
function assign_customer_role_nextend($user_id, $provider) {
    $user = new WP_User($user_id);

    if (!in_array('customer', $user->roles)) {
        $user->add_role('customer');
    }
}
add_action('nsl_register_new_user', 'assign_customer_role_nextend', 10, 2);






/* 
custom_login_redirect
 */
function custom_login_redirect($redirect_to, $request, $user) {
    if (is_a($user, 'WP_User') && (in_array('customer', $user->roles) || in_array('subscriber', $user->roles))) {
        return get_permalink(get_option('woocommerce_myaccount_page_id'));
    } else {
        return $redirect_to;
    }
}
add_filter('nsl_login_redirect', 'custom_login_redirect', 10, 3);






/* 
my_custom_body_classes
 */
function my_custom_body_classes($classes) {
    if (is_user_logged_in()) {
        $classes[] = 'logged-in';
    } else {
        $classes[] = 'not-logged-in';
    }
    return $classes;
}
add_filter('body_class', 'my_custom_body_classes');





/* 
remove_pmpro_frontend_css
 */
function remove_pmpro_frontend_css() {
    wp_dequeue_style('pmpro_frontend');
    wp_deregister_style('pmpro_frontend');
}
add_action('wp_enqueue_scripts', 'remove_pmpro_frontend_css', 100);




/* 
custom_login_logout_link
 */
function custom_login_logout_link($items, $args) {
    if (is_user_logged_in()) {
        $items = str_replace('Prisijungti', 'Mano paskyra', $items);
        $items = str_replace('href="/my-account"', 'href="/my-account"', $items);
    } else {
        $items = str_replace('Mano paskyra', 'Prisijungti', $items);
        $items = str_replace('href="/my-account"', 'href="/my-account"', $items);
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'custom_login_logout_link', 10, 2);





/* 
remove_menu_item_154_class
 */
function remove_custom_classes_from_menu_item($classes, $item, $args) {
    if (is_user_logged_in()) {
        $classes_to_remove = array('js-popup-2-open', 'mod-login-popup');
        $classes = array_diff($classes, $classes_to_remove);
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'remove_custom_classes_from_menu_item', 10, 3);







/* 
get_state_user_subscription
 */
function get_state_user_subscription() {
    $state_user_subscription = get_user_meta(get_current_user_id(), 'state_user_subscription', true);
    $state_user_subscription = !empty($state_user_subscription) ? $state_user_subscription : 'unactive';

    if (!is_user_logged_in()) {
        $state_user_subscription = 'logged-out';
    }

    return $state_user_subscription;
}
