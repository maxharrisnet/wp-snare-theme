<?php 
  /**
   * Template Name: Sidebar Right
   *
   * @package WordPress
   * @subpackage Snare
   * @since Snare 1.0
   */
?>

<?php get_header(); ?>
  
<div id="primary" class="container">
  <main id="main">
    <?php
     while ( have_posts() ) : the_post(); ?>
      <div class="entry-content-page">
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
      </div>
      <?php
      endwhile;
      wp_reset_query();
    ?>
  </main>
  <section id="sidebar-right" class="sidebar">
    <?php dynamic_sidebar( 'sidebar-right' ); ?>
  </section>
</div>

<?php get_footer(); ?>