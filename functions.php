<?php

// ADD THEME SUPPORTS
add_theme_support('editor-styles');

add_theme_support( 'post-thumbnails' );
add_theme_support( 'align-wide' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'custom-logo', array(
  'height'      => 200,
  'width'       => 200,
  'flex-height' => true,
  'header-text' => array( 'site-title', 'site-description' ),
) );

// REGISTER NAVIGATION MENUS
function snare_register_menus() {
  register_nav_menus( array(
    'header_menu' => 'Header Menu',
    'social_media_menu' => 'Social Media Menu'
  ));
}

add_action( 'after_setup_theme', 'snare_register_menus' );


// POST SLUG BODY CLASS
function snare_add_slug_body_class( $classes ) {
  global $post;

  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }

  return $classes;
}
    
add_filter( 'body_class', 'snare_add_slug_body_class' );

   
// function custom_post_type_archive($where,$args){  
//   $post_type  = isset($args['post_type'])  ? $args['post_type']  : 'post';  
//   $where = "WHERE post_type = '$post_type' AND post_status = 'publish'";
//   return $where;
// }

// add_filter( 'getarchives_where','custom_post_type_archive',10,2);


// REGISTER WIDGETS
function snare_widgets_init() {
  register_sidebar(array(
    'name' => __( 'Left Sidebar', 'left' ),
    'id' => 'sidebar-left',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));

  register_sidebar(array(
    'name' => __( 'Right Sidebar', 'right' ),
    'id' => 'sidebar-right',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __( 'Header Sidebar', 'header' ),
    'id' => 'sidebar-header',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  ));

  register_sidebar(array(
    'name' => __( 'Bottom Sidebar', 'bottom' ),
    'id' => 'sidebar-bottom',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __( 'WooCommerce Sidebar', 'woocommerce' ),
    'id' => 'sidebar-woocommerce',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

add_action( 'init', 'snare_widgets_init' );


// ENQUEUE STYLES
function enqueue_styles() {
  wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css' );
  wp_enqueue_style( 'fontawesome' );

  wp_register_style( 'main-style', get_stylesheet_uri() );
  wp_enqueue_style( 'main-style' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
   

// ENQUEUE SCRIPTS
function enqueue_scripts() {
  wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array( 'jquery' ), '1', false );
  wp_enqueue_script( 'modernizr' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


// ENQUEUE FOOTER SCRIPTS
function enqueue_footer_scripts() {
    // wp_register_script( 'lodash', get_stylesheet_directory_uri() . '/assets/src/js/lodash.custom.min.js', array( 'jquery' ), '1', true );
    // wp_enqueue_script( 'lodash' );

    wp_register_script( 'custom-script', get_stylesheet_directory_uri() . '/assets/src/js/scripts.js', array( 'jquery' ), '1', true );
    wp_enqueue_script( 'custom-script' );
    
    $upload_dir = wp_upload_dir();
    $media_url = trailingslashit($upload_dir['baseurl']); // Uploads url
    $loc_array = array(
      'stylesheetUri' =>  get_stylesheet_directory_uri(),
      'mediaLibraryUri' => $media_url
    );
    wp_localize_script('custom-script','theme_paths', $loc_array);
  }

add_action( 'wp_enqueue_scripts', 'enqueue_footer_scripts' );


// WOOCOMMERCE
function woocommerce_support() {
  add_theme_support( 'woocommerce' ); 
}

add_action( 'after_setup_theme', 'woocommerce_support' );


// GENRE TAXONOMY
function snare_register_product_genre_tax() {

  $labels = array(
    'name'                  => _x( 'Genre', 'Genres', 'snare' ),
    'singular_name'         => _x( 'Genre', 'Genree', 'snare' ),
    'search_items'          => __( 'Search Genres', 'snare' ),
    'popular_items'         => __( 'Popular Genres', 'snare' ),
    'all_items'             => __( 'All Genres', 'snare' ),
    'parent_item'           => __( 'Parent Genre', 'snare' ),
    'parent_item_colon'     => __( 'Parent Genre', 'snare' ),
    'edit_item'             => __( 'Edit Genre', 'snare' ),
    'update_item'           => __( 'Update Genre', 'snare' ),
    'add_new_item'          => __( 'Add New Genre', 'snare' ),
    'new_item_name'         => __( 'New Genre Name', 'snare' ),
    'add_or_remove_items'   => __( 'Add or remove Genres', 'snare' ),
    'choose_from_most_used' => __( 'Choose from most used Genres', 'snare' ),
    'menu_name'             => __( 'Genres', 'snare' ),
  );

  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'hierarchical'      => true,
    'show_tagcloud'     => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => true,
    'query_var'         => true,
    'capabilities'      => array(),
  );

  register_taxonomy( 'genres', array( 'product' ), $args );
  
  // Remove Categories from products (replaced with Genres)
  unregister_taxonomy_for_object_type( 'product_cat', 'product' );
}

add_action( 'init', 'snare_register_product_genre_tax' );


// PRODUCT TABS
function snare_product_tabs( $tabs ) {
    
  $tabs['test_tab'] = array(
    'title'   => __( 'Related Tracks', 'woocommerce' ),
    'priority'  => 1,
    'callback'  => 'woo_new_product_tab_content'
  );

  return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'snare_product_tabs' );


function woo_new_product_tab_content() {
  woocommerce_output_related_products();
}

// * @hooked woocommerce_template_single_title - 5
// * @hooked woocommerce_template_single_rating - 10
// * @hooked woocommerce_template_single_price - 10
// * @hooked woocommerce_template_single_excerpt - 20
// * @hooked woocommerce_template_single_add_to_cart - 30
// * @hooked woocommerce_template_single_meta - 40
// * @hooked woocommerce_template_single_sharing - 50
// * @hooked WC_Structured_Data::generate_product_data() - 60

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );


// Remove product data tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] );   // Remove the additional information tab
  return $tabs;
}

// Limit min to 1
function snare_woocommerce_quantity_input_min_callback( $min, $product ) {
  $min = 1;  
  return $min;
}

add_filter( 'woocommerce_quantity_input_min', 'snare_woocommerce_quantity_input_min_callback', 10, 2 );


// Limit max to 1
function snare_woocommerce_quantity_input_max_callback( $max, $product ) {
  $max = 1;  
  return $max;
}

add_filter( 'woocommerce_quantity_input_max', 'snare_woocommerce_quantity_input_max_callback', 10, 2 );

// Remove category title prefix
function avf_change_which_archive($output) {
  if(is_category()) {
    $output = single_cat_title('',false);
  }

  return $output;
}

add_filter('avf_which_archive_output','avf_change_which_archive', 10, 3);

// FONT ICON MENU (MUSIC & SOCIAL NETWORKS)
function snare_social_icons_networks( $networks ) {
  $extra_icons = array (
    '/apple' => array(                  
      'name' => 'Apple',
      'class' => 'fa fa-apple',
      'icon' => 'fa-apple',
      'icon-sign' => 'fa-apple'
    ),
    '/bandcamp' => array(                  
      'name' => 'Bandcamp',
      'class' => 'bandcamp',
      'icon' => 'fa-bandcamp',
      'icon-sign' => 'fa-bandcamp'
    ),
    '/facebook' => array(                  
      'name' => 'Facebook',
      'class' => 'facebook',
      'icon' => 'fa-facebook',
      'icon-sign' => 'fa-facebook'
    ),
    '/feed' => array(                  
      'name' => 'RSS',
      'class' => 'rss',
      'icon' => 'fa-rss',
      'icon-sign' => 'fa-rss-sign'
    ),
    '/instagram' => array(                  
      'name' => 'Instagram',
      'class' => 'instagram',
      'icon' => 'fa-instagram',
      'icon-sign' => 'fa-instagram'
    ),
    '/soundcloud' => array(                  
      'name' => 'Soundcloud',
      'class' => 'soundcloud',
      'icon' => 'fa-soundcloud',
      'icon-sign' => 'fa-soundcloud'
    ),
    '/spotify' => array(                  
      'name' => 'Spotify',
      'class' => 'spotify',
      'icon' => 'fa-spotify',
      'icon-sign' => 'fa-spotify'
    ),
    '/twitter' => array(                  
      'name' => 'Twitter',
      'class' => 'twitter',
      'icon' => 'fa-twitter',
      'icon-sign' => 'fa-twitter'
    ),
  );

  $extra_icons = array_merge( $networks, $extra_icons );

  return $extra_icons;
}

add_filter( 'snare_social_icons_networks', 'snare_social_icons_networks');


// REMOVE GENERATOR META TAG TO CONCEAL VERSION
remove_action('wp_head', 'wp_generator');

?>
