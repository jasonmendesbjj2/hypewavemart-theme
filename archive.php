<?php
if(!defined('ABSPATH'))exit;
get_header();
?>
<section class="search-header">
  <h1><?php the_archive_title(); ?></h1>
  <p><?php the_archive_description(); ?></p>
</section>
<main class="section">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article <?php post_class('page-content'); ?>>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p style="font-size:.8rem;color:var(--muted)"><?php echo get_the_date(); ?></p>
      <?php the_excerpt(); ?>
    </article>
  <?php endwhile;
  the_posts_pagination(['prev_text'=>'«','next_text'=>'»']);
  else: ?>
    <div class="page-content">
      <p><?php esc_html_e('No posts found.','hypewavemart'); ?></p>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
