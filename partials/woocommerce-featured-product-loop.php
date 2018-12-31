<?php
  $paged                   = false;
  $ordering                = WC()->query->get_catalog_ordering_args();
  // $ordering['orderby']     = array_shift(explode(' ', $ordering['orderby']));
  $ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
  $products_per_page       = 1;

  $featured_products       = wc_get_products(array(
    'meta_key'             => '_price',
    'status'               => 'publish',
    'limit'                => $products_per_page,
    'page'                 => false,
    'featured'             => true,
    'paginate'             => true,
    'return'               => 'ids',
    'orderby'              => $ordering['orderby'],
    'order'                => $ordering['order'],
  ));

  wc_set_loop_prop('current_page', $paged);
  wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
  wc_set_loop_prop('page_template', get_page_template_slug());
  wc_set_loop_prop('per_page', $products_per_page);
  wc_set_loop_prop('total', $featured_products->total);
  wc_set_loop_prop('total_pages', 1);

  if($featured_products) {
    // do_action('woocommerce_before_shop_loop');
    woocommerce_product_loop_start();
      foreach($featured_products->products as $featured_product) {
        $post_object = get_post($featured_product);
        setup_postdata($GLOBALS['post'] =& $post_object);
        wc_get_template_part('content', 'featured-product');
      }
      wp_reset_postdata();
    woocommerce_product_loop_end();
    do_action('woocommerce_after_shop_loop');
  } else {
    do_action('woocommerce_no_products_found');
  }

  if ( have_posts() ) {
    // do_action( 'woocommerce_before_shop_loop' );
    woocommerce_product_loop_start();
    if ( wc_get_loop_prop( 'total' ) ) {
      while ( have_posts() ) {
        the_post();
        do_action( 'woocommerce_shop_loop' );
        wc_get_template_part( 'content', 'featured-product' );
      }
    }
    woocommerce_product_loop_end();
    // do_action( 'woocommerce_after_shop_loop' );
  } else {
    do_action( 'woocommerce_no_products_found' );
  }
?>