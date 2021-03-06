<?php get_header(); ?>
  
<div id="primary" class="container">
  <main id="main">
    <?php
     while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
      <div class="entry-content-page">
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
      </div>
      <?php
      endwhile;
      wp_reset_query();
    ?>
  </main>
</div>

<?php get_footer(); ?>