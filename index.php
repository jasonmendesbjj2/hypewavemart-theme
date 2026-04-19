<?php
if(!defined('ABSPATH'))exit;
get_header();
?>
<main class="section">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article <?php post_class('page-content'); ?>>
      <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <?php is_singular() ? the_content() : the_excerpt(); ?>
    </article>
  <?php endwhile; else: ?>
    <div class="page-content">
      <p><?php esc_html_e('No content found.','hypewavemart'); ?></p>
    </div>
  <?php endif; ?>
  <?php the_posts_pagination(['prev_text'=>'«','next_text'=>'»']); ?>
</main>
<?php get_footer(); ?>
