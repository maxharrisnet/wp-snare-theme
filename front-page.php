<?php get_header(); ?>
  
<div id="primary" class="container">
  <main id="main">
    
      <?php get_template_part( 'partials/woocommerce-featured-product-loop', 'loop', 'featured' ); ?>

      <div class="entry-content-page">
        <?php get_template_part( 'partials/woocommerce-product', 'loop' ); ?>
      </div>
  </main>
</div>

<?php get_footer(); ?>