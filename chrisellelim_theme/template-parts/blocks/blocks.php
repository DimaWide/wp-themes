<?php

add_action( 'wp_enqueue_scripts', function(){  
  wp_enqueue_style( 'blocks', get_template_directory_uri() . '/blocks.css');
});

add_action('wp_head', function(){
  $count_posts = wp_count_posts();
  echo "<script> var posts_count = {$count_posts->publish}</script>";
  if(is_single() && get_field('full_banner_status') === false):
?>
  <style>
    body .article-intro .featured-image {
      display: none !important;
    }
  </style>
<?php
  endif;
}, 999);

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  $blocks_path = get_stylesheet_directory().'/template-parts/blocks';
  add_action('acf/init', function($blocks_path){
    // register a testimonial block.
    acf_register_block_type(array(
      'name'              => 'image-overlap',
      'title'             => __('Image + Text overlap'),
      'description'       => __('It will insert an image with a overlapped text over it.'),
      'render_callback'	=> function($block){
        $slug = str_replace('acf/', '', $block['name']);
        if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}.php") ) ) {
          include( get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
        }
      },
      'category'          => 'formatting',
      'icon'              => 'format-image',
      'keywords'          => array( 'image', 'text', 'overlap' ),
      'mode' => 'edit',
    ));

    acf_register_block_type(array(
      'name'              => 'two-images-overlapped',
      'title'             => __('Two Images + Quote overlapped'),
      'description'       => __('It will insert two images with a overlapped text over it.'),
      'render_callback'	=> function($block){
        $slug = str_replace('acf/', '', $block['name']);
        if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}.php") ) ) {
          include( get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
        }
      },
      'category'          => 'formatting',
      'icon'              => 'format-image',
      'keywords'          => array( 'image', 'text', 'overlap' ),
      'mode' => 'edit',
      'enqueue_assets' => function(){
        wp_enqueue_style( 'gfonts', 'https://fonts.googleapis.com/css?family=Darker+Grotesque:400,600&display=swap');
      },
    ));

    acf_register_block_type(array(
      'name'              => 'shop-product-list',
      'title'             => __('Product List'),
      'description'       => __('It will show a list of products in a carousel.'),
      'render_callback'	=> function($block){
        $slug = str_replace('acf/', '', $block['name']);
        if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}.php") ) ) {
          include( get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
        }
      },
      'category'          => 'formatting',
      'icon'              => 'cart',
      'keywords'          => array( 'shop', 'list', 'products' ),
      'mode' => 'edit',
      'enqueue_assets' => function(){
        wp_enqueue_style('fontawesome',"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" );
        wp_enqueue_style( 'slick-block', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
        wp_enqueue_script( 'slick-block', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '', false );
        wp_enqueue_script( 'blocks', get_template_directory_uri() . '/blocks.js', array('jquery'), '', false );
      },
    ));

    acf_register_block_type(array(
      'name'              => 'product-focus',
      'title'             => __('Product Focus'),
      'description'       => __('It allow you to insert a highlighted product.'),
      'render_callback'	=> function($block){
        $slug = str_replace('acf/', '', $block['name']);
        if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}.php") ) ) {
          include( get_stylesheet_directory() . "/template-parts/blocks/{$slug}.php");
        }
      },
      'category'          => 'formatting',
      'icon'              => 'cart',
      'keywords'          => array( 'shop', 'list', 'products', 'focus' ),
      'mode' => 'edit',
    ));
  }, 10, 1);
}