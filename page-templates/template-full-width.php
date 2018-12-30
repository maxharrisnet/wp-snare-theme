<?php 
  /**
   * Template Name: Full Width
   *
   * @package WordPress
   * @subpackage Snare
   * @since Snare 1.0
   */
?>

<?php include_once("header.php") ?>
  
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
</div>

<?php include_once("footer.php") ?>