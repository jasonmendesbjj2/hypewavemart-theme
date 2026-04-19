<?php
if(!defined('ABSPATH'))exit;
global $product;
if(!$product||!$product->is_visible()) return;

$pid          = $product->get_id();
$sold         = hwm_get_sold_count($pid);
$sold_pct     = min(round(($sold/5000)*100),98);
$reg          = (float)$product->get_regular_price();
$sale         = (float)$product->get_sale_price();
$disc         = ($reg>0&&$sale>0) ? round((($reg-$sale)/$reg)*100) : 0;
$rating       = $product->get_average_rating();
$review_count = $product->get_review_count();
$is_new       = strtotime($product->get_date_created()) > strtotime('-7 days');
?>
<article <?php post_class('product-card'); ?> data-id="<?php echo esc_attr($pid); ?>">
  <div class="product-img-wrap">
    <a href="<?php the_permalink(); ?>">
      <?php if(has_post_thumbnail()):
          the_post_thumbnail('hwm-product-card',['alt'=>get_the_title()]);
      else: ?>
        <div class="no-thumb">🛒</div>
      <?php endif; ?>
    </a>
    <div class="badges">
      <?php if($product->is_featured()): ?>
        <span class="badge badge-viral">🔥 Viral</span>
      <?php endif; ?>
      <?php if($product->is_on_sale()): ?>
        <span class="badge badge-hot">⚡ Hot</span>
      <?php endif; ?>
      <?php if($is_new): ?>
        <span class="badge badge-new">✨ New</span>
      <?php endif; ?>
    </div>
    <button class="wish-btn"
            onclick="hwmToggleWishlist(<?php echo esc_attr($pid); ?>,this)"
            aria-label="Wishlist">♡</button>
  </div>
  <div class="product-info">
    <h3 class="product-name">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>
    <?php if($review_count>0): ?>
    <div class="stars">
      <span class="stars-icons">
        <?php for($i=0;$i<5;$i++) echo $i<floor($rating)?'★':'☆'; ?>
      </span>
      <span class="stars-count">
        <?php echo number_format($rating,1); ?> • <?php echo number_format_i18n($review_count); ?> reviews
      </span>
    </div>
    <?php endif; ?>
    <div class="price-row">
      <span class="price-now"><?php echo wc_price($product->get_price()); ?></span>
      <?php if($product->is_on_sale()&&$reg): ?>
        <span class="price-old"><?php echo wc_price($reg); ?></span>
        <?php if($disc>0): ?>
          <span class="price-pct">-<?php echo esc_html($disc); ?>%</span>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="sold-row">
      <div class="sold-bar">
        <div class="sold-fill" style="width:<?php echo esc_attr($sold_pct); ?>%"></div>
      </div>
      <span class="sold-text"><?php echo number_format_i18n($sold); ?> sold</span>
    </div>
    <button class="add-btn"
            onclick="hwmAddToCart(<?php echo esc_attr($pid); ?>,this)">
      <span>Add to Cart</span> <span>+</span>
    </button>
  </div>
</article>
