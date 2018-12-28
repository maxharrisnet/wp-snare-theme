<?php include_once("header.php") ?>
  
<div id="primary" class="container">
  <main id="main">
    <?php
     while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
      <div class="entry-content-page">
          <h2><?php// the_title(); ?></h2> <!-- Page Content -->
          <?php the_content(); ?> <!-- Page Content -->
      </div><!-- .entry-content-page -->
      <?php
      endwhile; //resetting the page loop
      wp_reset_query(); //resetting the page query
    ?>
  </main>
  <?php // include_once("sidebar.php") ?>
</div>

<?php include_once("footer.php") ?>