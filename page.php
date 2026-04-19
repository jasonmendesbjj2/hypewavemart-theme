<?php
if(!defined('ABSPATH'))exit;
get_header();
?>
<main class="section">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article <?php post_class('page-content'); ?>>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </article>
  <?php endwhile; else: ?>
    <div class="page-content">
      <p><?php esc_html_e('Page not found.','hypewavemart'); ?></p>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
