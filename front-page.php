<?php get_header(); ?>
  
<div id="primary" class="container">
  <main id="main">
    <aside id="sidebar-header" class="sidebar">
      <?php dynamic_sidebar( 'sidebar-header' ); ?>
    </aside>
      <div class="entry-content-page">
        <?php get_template_part( 'partials/woocommerce-product', 'loop' ); ?>
      </div>
  </main>
</div>

<?php get_footer(); ?>