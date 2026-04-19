<?php
if(!defined('ABSPATH'))exit;
get_header();
?>
<main class="section">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article <?php post_class('page-content'); ?>>
      <h1><?php the_title(); ?></h1>
      <p style="font-size:.85rem;color:var(--muted);margin-bottom:18px">
        Published on <?php echo get_the_date(); ?>
      </p>
      <?php the_content(); ?>
    </article>
    <?php if(comments_open()||get_comments_number()) comments_template(); ?>
  <?php endwhile; else: ?>
    <div class="page-content">
      <p><?php esc_html_e('Post not found.','hypewavemart'); ?></p>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
