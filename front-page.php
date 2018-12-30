<?php include_once("header.php") ?>
  
<div id="primary" class="container">
  <main id="main">
    <aside id="sidebar" class="sidebar">
      <?php dynamic_sidebar( 'sidebar-header' ); ?>
    </aside>
    <?php
     while ( have_posts() ) : the_post(); ?>
      <div class="entry-content-page">
        <?php the_content(); ?>
      </div>
      <?php
      endwhile;
      wp_reset_query();
    ?>
  </main>
</div>

<?php include_once("footer.php") ?>