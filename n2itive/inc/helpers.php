<?php






// custom_fusion_youtube_shortcode
function custom_fusion_youtube_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'id' => '',   
            'width' => '560',            
            'height' => '315',           
            'autoplay' => 'false',       
            'api_params' => '&rel=0',    
            'alignment' => '',           
            'hide_on_mobile' => '',      
            'class' => '',               
            'css_id' => '',              
        ),
        $atts,
        'fusion_youtube'
    );

    preg_match('/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([a-zA-Z0-9_-]{11})|(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/)([a-zA-Z0-9_-]{11})/', $atts['id'], $matches);
    $video_id = isset($matches[1]) ? $matches[1] : (isset($matches[2]) ? $matches[2] : '');

    if ($video_id) {
        $autoplay = $atts['autoplay'] === 'true' ? '1' : '0';

        $src = "https://www.youtube.com/embed/{$video_id}?autoplay={$autoplay}{$atts['api_params']}";

        $iframe = '<iframe width="' . esc_attr($atts['width']) . '" height="' . esc_attr($atts['height']) . '" src="' . esc_url($src) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen';

        if (!empty($atts['class'])) {
            $iframe .= ' class="' . esc_attr($atts['class']) . '"';
        }
        if (!empty($atts['css_id'])) {
            $iframe .= ' id="' . esc_attr($atts['css_id']) . '"';
        }

        $iframe .= '></iframe>';

        return $iframe;
    }

    return ''; 
}
add_shortcode('fusion_youtube', 'custom_fusion_youtube_shortcode');





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







// getModelBySlug
function getModelBySlug($models, $slug) {
    $filtered = array_filter($models, function ($model) use ($slug) {
        return $model['slug'] === $slug;
    });

    return $filtered ? current($filtered) : null;
}





// get_tesla_configurator_data
function get_tesla_configurator_data() {
    $selectedModel     = isset($_COOKIE['selectedModel']) ? $_COOKIE['selectedModel'] : null;
    $selectedCarOption = isset($_COOKIE['selectedCarOption']) ? $_COOKIE['selectedCarOption'] : null;
    $selectedYear      = isset($_COOKIE['selectedYear']) ? $_COOKIE['selectedYear'] : null;

    $stateConfigurator = 0;

    if ($selectedModel) {
        $stateConfigurator = 1;
    }
    if ($selectedCarOption) {
        $stateConfigurator = 2;
    }

    $options = [
        'fix-everything'      => ['name' => 'Fix Everything!'],
        'save-my-half-shafts' => ['name' => 'Save My Half Shafts!'],
        'extend-my-tire-life' => ['name' => 'Extend My Tire Life!'],
        'slam-it'             => ['name' => 'SLAM IT!']
    ];

    $acf_options = get_field('cars_options', 'option');
    $acf_options = $acf_options['options'];

    $options = [];

    if ($acf_options && is_array($acf_options)) {
        foreach ($acf_options as $term_id) {
            $term = get_term($term_id);

            if ($term && !is_wp_error($term)) {
                $options[$term->slug] = ['name' => $term->name];
            }
        }
    }

    $teslaModels = [
        ['name' => 'Model S', 'slug' => 'model-s', 'image' => 'model-s.png', 'main_image' => 'model-s-large.png', 'active_car' => 'model-s-large-on.png', 'years' => []],
        ['name' => 'Model 3', 'slug' => 'model-3', 'image' => 'model-3.png', 'main_image' => 'model-3-large.png', 'active_car' => 'model-3-large-on.png', 'years' => []],
        ['name' => 'Model X', 'slug' => 'model-x', 'image' => 'model-x.png', 'main_image' => 'model-x-large.png', 'active_car' => 'model-x-large-on.png', 'years' => []],
        ['name' => 'Model Y', 'slug' => 'model-y', 'image' => 'model-y.png', 'main_image' => 'model-y-large.png', 'active_car' => 'model-y-large-on.png', 'years' => []],
        ['name' => 'Cybertruck', 'slug' => 'cybertruck', 'image' => 'cybertruck.png', 'main_image' => 'cybertruck-large.png', 'active_car' => 'cybertruck-large-on.png', 'years' => []]
    ];

    $carsData = get_field('cars', 'option');

    if ($carsData && is_array($carsData)) {
        foreach ($teslaModels as &$model) {
            foreach ($carsData as $car) {
                if (!empty($car['name']) && $car['name'] === $model['name']) {
                    $note_1 =  $car['note_1'];
                    $note_2 =  $car['note_2'];
                    $years =  $car['years'];

                    foreach ($years as $year_id) {
                        $year = get_term($year_id);
                        $model['years'][] = $year->slug;
                    }

                    $model['note_1'] = $note_1;
                    $model['note_2'] = $note_2;
                    break;
                }
            }
        }

        unset($model);
    }

    $activeSlideIndex = array_search($selectedModel, array_column($teslaModels, 'slug'));

    return compact('selectedModel', 'selectedCarOption', 'selectedYear', 'stateConfigurator', 'options', 'teslaModels', 'activeSlideIndex');
}





// wcl_debug_arr
function wcl_debug_arr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}



// wcl_clean_phone_number
function wcl_clean_phone_number($phone_number) {
    $phone_number = preg_replace('/\s+/', '', $phone_number);
    $phone_number = preg_replace('/\(|\)|\-|\\+/', '', $phone_number);

    return $phone_number;
}




// wcl_send_error_message_to_admin
function wcl_send_error_message_to_admin($subject, $message) {
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . SITE_NAME . ' <' . EMAIL_SENDER . '>'
    );

    return wp_mail(CONTACT_ERROR_EMAIL, $subject, $message, $headers);
}




// wcl_curl_get
function wcl_curl_get($url) {
    $request = wp_remote_get($url, array(
        'timeout' => 60,
        'sslverify' => false,
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
    ));

    if (is_array($request) && ! is_wp_error($request)) {
        return $request['body'];
    }

    return false;
}



// wcl_captcha_validation
function wcl_captcha_validation($action) {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = RECAPTCHA_SECRET_KEY;
    $recaptcha_response = sanitize_text_field($_REQUEST['token']);

    $recaptcha = wcl_curl_get($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    return ($recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == $action);
}







// wcl_curl_multi_get
function wcl_curl_multi_get($urls) {
    $requests = Requests::request_multiple($urls, array(
        'timeout' => 60,
        'verify' => false,
        'verifyname' => false,
        'data_format' => 'body',
        'useragent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
    ));

    return $requests;
}




// wcl_curl_post
function wcl_curl_post($url, $body = array(), $headers = array()) {
    $request = wp_remote_post($url, array(
        'body' => $body,
        'headers' => $headers,
        'timeout' => 60,
        'sslverify' => false,
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
    ));

    if (is_array($request) && ! is_wp_error($request)) {
        return $request['body'];
    }

    return false;
}
