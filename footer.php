<?php if(!defined('ABSPATH'))exit; ?>

<footer>
  <div class="footer-inner">
    <div class="footer-grid">

      <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
          HypeWave<span>Mart</span>
        </a>
        <p>We find tomorrow's viral products today. Curated from TikTok, Instagram & Amazon — shipped free to your door anywhere in the USA.</p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="Facebook">📘</a>
          <a href="#" class="social-link" aria-label="Instagram">📷</a>
          <a href="#" class="social-link" aria-label="TikTok">🎵</a>
          <a href="#" class="social-link" aria-label="Twitter">🐦</a>
          <a href="#" class="social-link" aria-label="YouTube">▶️</a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Shop</h4>
        <ul>
          <li><a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_page_permalink('shop') : '#'); ?>">Today's Drops</a></li>
          <li><a href="<?php echo esc_url(home_url('/product-category/tiktok-viral')); ?>">TikTok Viral</a></li>
          <li><a href="<?php echo esc_url(home_url('/flash-deals')); ?>">Flash Deals</a></li>
          <li><a href="<?php echo esc_url(home_url('/product-category/top-sellers')); ?>">Top Sellers</a></li>
          <li><a href="<?php echo esc_url(home_url('/new-arrivals')); ?>">New Arrivals</a></li>
          <li><a href="<?php echo esc_url(home_url('/product-category/mystery-box')); ?>">Mystery Box</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Customer Care</h4>
        <ul>
          <li><a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_account_endpoint_url('orders') : '#'); ?>">Track My Order</a></li>
          <li><a href="<?php echo esc_url(home_url('/returns')); ?>">Returns & Exchanges</a></li>
          <li><a href="<?php echo esc_url(home_url('/shipping-info')); ?>">Shipping Info</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
          <li><a href="<?php echo esc_url(home_url('/faq')); ?>">FAQ</a></li>
          <li><a href="<?php echo esc_url(home_url('/affiliate')); ?>">Affiliate Program</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/about')); ?>">About HypeWaveMart</a></li>
          <li><a href="<?php echo esc_url(home_url('/how-it-works')); ?>">How It Works</a></li>
          <li><a href="<?php echo esc_url(get_privacy_policy_url()); ?>">Privacy Policy</a></li>
          <li><a href="<?php echo esc_url(home_url('/terms')); ?>">Terms of Service</a></li>
          <li><a href="<?php echo esc_url(home_url('/sitemap')); ?>">Sitemap</a></li>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <p>© <?php echo date('Y'); ?> <span>HypeWaveMart</span>. All rights reserved. Made for the US market. 🇺🇸</p>
      <div class="payment-icons">
        <span class="payment-icon">VISA</span>
        <span class="payment-icon">MC</span>
        <span class="payment-icon">AMEX</span>
        <span class="payment-icon">PayPal</span>
        <span class="payment-icon">Affirm</span>
        <span class="payment-icon">Apple Pay</span>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
