<?php

define("THEME_DIR", get_template_directory_uri());
/*--- REMOVE GENERATOR META TAG ---*/
remove_action('wp_head', 'wp_generator');

//  Theme Supports
add_theme_support('editor-styles');

add_theme_support( 'post-thumbnails' );
add_theme_support( 'align-wide' );
add_theme_support( 'custom-logo', array(
  'height'      => 200,
  'width'       => 200,
  'flex-height' => true,
  'header-text' => array( 'site-title', 'site-description' ),
) );

// Image Sizes
add_image_size('playlist-thumbnail', 50, 50, true);

// REGISTER MENUS
function register_menus() {
    register_nav_menus( array(
      'header_menu' => 'Header Menu',
        'shop_header_menu' => 'Shop Header Menu',
      'social_media_menu' => 'Social Media Menu'
    ));
}
add_action( 'after_setup_theme', 'register_menus' );

// BODY CLASS
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
    return $classes;
  }
  
add_filter( 'body_class', 'add_slug_body_class' );

 
function custom_post_type_archive($where,$args){  
    $post_type  = isset($args['post_type'])  ? $args['post_type']  : 'post';  
    $where = "WHERE post_type = '$post_type' AND post_status = 'publish'";
    return $where;  
}

add_filter( 'getarchives_where','custom_post_type_archive',10,2);


// WooCommerce

function woocommerce_support() {
  add_theme_support( 'woocommerce' ); 
}
add_action( 'after_setup_theme', 'woocommerce_support' );

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

// Add to Cart Text
function custom_woocommerce_product_add_to_cart_text( $text ) {
    if( 'Read more' == $text ) {
      $text = __( 'More Info', 'woocommerce' );
    }

    return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );


/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'snare_product_tabs' );
function snare_product_tabs( $tabs ) {
    
  $tabs['test_tab'] = array(
    'title'   => __( 'Related Tracks', 'woocommerce' ),
    'priority'  => 1,
    'callback'  => 'woo_new_product_tab_content'
  );

  return $tabs;
}

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
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 11 );

/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    // unset( $tabs['description'] );        // Remove the description tab
    // unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;
}


function is_realy_woocommerce_page () {
if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
  }
  $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
                                  "woocommerce_terms_page_id" ,
                                  "woocommerce_cart_page_id" ,
                                  "woocommerce_checkout_page_id" ,
                                  "woocommerce_pay_page_id" ,
                                  "woocommerce_thanks_page_id" ,
                                  "woocommerce_myaccount_page_id" ,
                                  "woocommerce_edit_address_page_id" ,
                                  "woocommerce_view_order_page_id" ,
                                  "woocommerce_change_password_page_id" ,
                                  "woocommerce_logout_page_id" ,
                                  "woocommerce_lost_password_page_id" ) ;
  foreach ( $woocommerce_keys as $wc_page_id ) {
          if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                  return true ;
          }
  }
  return false;
}

function child_manage_woocommerce_styles() {
 //remove generator meta tag
 // remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
 
 //first check that woo exists to prevent fatal errors
 if ( function_exists( 'is_woocommerce' ) ) {
   //dequeue scripts and styles
   if ( ! is_realy_woocommerce_page() ) {
     wp_dequeue_style( 'woocommerce_frontend_styles' );
     wp_dequeue_style( 'woocommerce_fancybox_styles' );
     wp_dequeue_style( 'woocommerce_chosen_styles' );
     wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
     wp_dequeue_script( 'wc_price_slider' );
     wp_dequeue_script( 'wc-single-product' );
     wp_dequeue_script( 'wc-add-to-cart' );
     wp_dequeue_script( 'wc-cart-fragments' );
     wp_dequeue_script( 'wc-checkout' );
     wp_dequeue_script( 'wc-add-to-cart-variation' );
     wp_dequeue_script( 'wc-single-product' );
     wp_dequeue_script( 'wc-cart' );
     wp_dequeue_script( 'wc-chosen' );
     wp_dequeue_script( 'woocommerce' );
     wp_dequeue_script( 'prettyPhoto' );
     wp_dequeue_script( 'prettyPhoto-init' );
     wp_dequeue_script( 'jquery-blockui' );
     wp_dequeue_script( 'jquery-placeholder' );
     wp_dequeue_script( 'fancybox' );
     wp_dequeue_script( 'jqueryui' );
   }

   else {
    wp_register_style( 'woo-style', THEME_DIR . '/css/shop.css', array(), '1', 'all' );
    wp_enqueue_style( 'woo-style' );
   }
 }
}

/*
* Changing the minimum quantity to 2 for all the WooCommerce products
*/
function woocommerce_quantity_input_min_callback( $min, $product ) {
  $min = 1;  
  return $min;
}
add_filter( 'woocommerce_quantity_input_min', 'woocommerce_quantity_input_min_callback', 10, 2 );

/*
* Changing the maximum quantity to 5 for all the WooCommerce products
*/
function woocommerce_quantity_input_max_callback( $max, $product ) {
  $max = 1;  
  return $max;
}
add_filter( 'woocommerce_quantity_input_max', 'woocommerce_quantity_input_max_callback', 10, 2 );


function firstlady_widgets_init() {
    register_sidebar(array(
      'name' => __( 'Left Sidebar', 'sidebar-left' ),
      'id' => 'sidebar-left',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __( 'Right Sidebar', 'sidebar-right' ),
        'id' => 'sidebar-right',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __( 'WooCommerce Sidebar', 'woocommerce' ),
        'id' => 'sidebar-woocommerce',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}

add_action( 'init', 'firstlady_widgets_init' );


add_filter('avf_which_archive_output','avf_change_which_archive', 10, 3);
function avf_change_which_archive($output)
{
  if(is_category())
  {
    $output = single_cat_title('',false);
  }

  return $output;
}

// FONT MENU

function storm_social_icons_networks( $networks ) {
 
    $extra_icons = array (
        '/feed' => array(                  
            'name' => 'RSS',
            'class' => 'rss',
            'icon' => 'fa-rss',
            'icon-sign' => 'fa-rss-sign'
        ),
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
        '/feed' => array(                  
            'name' => 'RSS',
            'class' => 'rss',
            'icon' => 'fa-rss',
            'icon-sign' => 'fa-rss-sign'
        ),
        '/feed' => array(                  
            'name' => 'RSS',
            'class' => 'rss',
            'icon' => 'fa-rss',
            'icon-sign' => 'fa-rss-sign'
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
add_filter( 'storm_social_icons_networks', 'storm_social_icons_networks');

// ENQUEUE STYLES
function enqueue_styles() {   
  wp_register_style( 'main-style', get_stylesheet_uri() );
  wp_enqueue_style( 'main-style' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
   

// ENQUEUE SCRIPTS
function enqueue_scripts() {
  wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array( 'jquery' ), '1', false );
  wp_enqueue_script( 'modernizr' );

  // wp_enqueue_script( 'jb-analytics', get_theme_file_uri('/js/analytics.js'), array( 'jquery' ), '1', false );
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


// ENQUEUE FOOTER SCRIPTS
function enqueue_footer_scripts() {
  if ( is_front_page() ) {
    wp_register_script( 'lodash', get_stylesheet_directory_uri() . '/assets/src/js/lodash.custom.min.js', array( 'jquery' ), '1', true );
    wp_enqueue_script( 'lodash' );

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
}

add_action( 'wp_enqueue_scripts', 'enqueue_footer_scripts' );

?>
