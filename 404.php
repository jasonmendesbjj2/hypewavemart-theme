<?php
if(!defined('ABSPATH'))exit;
get_header();
?>
<main class="page-404">
  <h1>404</h1>
  <h2>Page Not Found</h2>
  <p>The page you're looking for doesn't exist or has been moved.</p>
  <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
    Back to Home
  </a>
</main>
<?php get_footer(); ?>
