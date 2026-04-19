<?php
if(!defined('ABSPATH'))exit;
get_header();
?>

<!-- TRUST STRIP -->
<div class="trust-strip">
  <div class="trust-inner">
    <div class="trust-item"><span>🚚</span> Free US Shipping $25+</div>
    <div class="trust-item"><span>🔄</span> 30-Day Easy Returns</div>
    <div class="trust-item"><span>🔒</span> 256-bit Secure Checkout</div>
    <div class="trust-item"><span>⭐</span> 4.9/5 from 50k+ Reviews</div>
    <div class="trust-item"><span>📦</span> Ships in 24–48h</div>
    <div class="trust-item"><span>💳</span> Buy Now, Pay Later</div>
  </div>
</div>

<!-- HERO -->
<section class="hero">
  <div class="hero-main">
    <div class="hero-badge">🔥 Updated Daily</div>
    <h1>Tomorrow's <span>Viral</span><br>Products, Today.</h1>
    <p>Hand-picked trending products from TikTok, Instagram & Amazon — delivered free across the USA in 3–7 days.</p>
    <div class="hero-cta">
      <a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_page_permalink('shop') : '#'); ?>" class="btn-primary">Shop Trending Now</a>
      <a href="<?php echo esc_url(home_url('/new-arrivals')); ?>" class="btn-outline">Today's Drop →</a>
    </div>
    <div class="hero-stats">
      <div class="stat"><div class="stat-num">500K+</div><div class="stat-label">Happy Customers</div></div>
      <div class="stat"><div class="stat-num">4.9★</div><div class="stat-label">Average Rating</div></div>
      <div class="stat"><div class="stat-num">2,400+</div><div class="stat-label">Viral Products</div></div>
    </div>
  </div>
  <div class="hero-side">
    <div class="hero-card hero-card-1" onclick="location.href='<?php echo esc_url(home_url('/flash-deals')); ?>'">
      <span class="emoji">⚡</span>
      <span class="tag">NEW DROP</span>
      <h3>Flash Deals</h3>
      <p>Up to 70% OFF — Ends Tonight</p>
    </div>
    <div class="hero-card hero-card-2" onclick="location.href='<?php echo esc_url(home_url('/product-category/mystery-box')); ?>'">
      <span class="emoji">📦</span>
      <span class="tag">FREE SHIPPING</span>
      <h3>Mystery Box</h3>
      <p>5+ viral items. Always a deal.</p>
    </div>
  </div>
</section>

<!-- CATEGORIES -->
<section class="section">
  <div class="section-header">
    <h2 class="section-title">Shop by <span>Category</span></h2>
    <a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_page_permalink('shop') : '#'); ?>" class="view-all">All Categories</a>
  </div>
  <div class="cat-cards">
    <?php
    $icons = ['📱','🏡','💄','💪','🐾','🌿','👕','🧸','🎮','🍳','🚗','📦'];
    $cats  = get_terms(['taxonomy'=>'product_cat','hide_empty'=>true,'number'=>12,'orderby'=>'count','order'=>'DESC']);
    if(!is_wp_error($cats)){
        $i=0;
        foreach($cats as $cat){
            if($cat->slug==='uncategorized'){continue;}
            echo '<a href="'.esc_url(get_term_link($cat)).'" class="cat-card">';
            echo '<span class="cat-emoji">'.($icons[$i%count($icons)]).'</span>';
            echo '<span class="cat-name">'.esc_html($cat->name).'</span>';
            echo '<span class="cat-count">'.esc_html($cat->count).' products</span>';
            echo '</a>';
            $i++;
        }
    }
    ?>
  </div>
</section>

<!-- TRENDING NOW -->
<section class="section">
  <div class="section-header">
    <h2 class="section-title">🔥 Trending <span>Now</span></h2>
    <a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_page_permalink('shop') : '#'); ?>" class="view-all">See All</a>
  </div>
  <div class="product-grid">
    <?php
    $trending = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'orderby'        => 'meta_value_num',
        'meta_key'       => '_hwm_sold_count',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    ]);
    if($trending->have_posts()):
        while($trending->have_posts()): $trending->the_post();
            get_template_part('woocommerce/content-product');
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<!-- FLASH SALE -->
<section class="section">
  <div class="flash-section">
    <div class="flash-header">
      <div class="flash-title">
        <span style="font-size:1.6rem">⚡</span>
        <h2>Flash Sale — Ends In:</h2>
      </div>
      <div class="flash-timer">
        <span class="timer-label">Time Left:</span>
        <div class="timer-digits">
          <span class="timer-box" id="timerH">06</span>
          <span class="timer-sep">:</span>
          <span class="timer-box" id="timerM">29</span>
          <span class="timer-sep">:</span>
          <span class="timer-box" id="timerS">47</span>
        </div>
      </div>
    </div>
    <div class="flash-products product-grid" style="padding:24px 28px">
      <?php
      $flash = new WP_Query([
          'post_type'      => 'product',
          'posts_per_page' => 4,
          'post_status'    => 'publish',
          'meta_query'     => [[
              'key'     => '_sale_price',
              'value'   => '',
              'compare' => '!=',
          ]],
      ]);
      if($flash->have_posts()):
          while($flash->have_posts()): $flash->the_post();
              get_template_part('woocommerce/content-product');
          endwhile;
          wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</section>

<!-- BANNER STRIP -->
<section class="section">
  <div class="banner-strip">
    <div class="banner-card banner-card-1">
      <span class="bg-emoji">🎯</span>
      <h3>TikTok Made Me Buy It</h3>
      <p>The most viral products straight from your For You Page, curated daily by our team.</p>
      <a href="<?php echo esc_url(home_url('/product-category/tiktok-viral')); ?>" class="btn-sm">Shop the Trend →</a>
    </div>
    <div class="banner-card banner-card-2">
      <span class="bg-emoji">🚀</span>
      <h3>New Drops Every 24h</h3>
      <p>Fresh viral products added daily. Be the first before they sell out.</p>
      <a href="<?php echo esc_url(home_url('/new-arrivals')); ?>" class="btn-sm">Today's Drop →</a>
    </div>
  </div>
</section>

<!-- TOP SELLERS -->
<section class="section">
  <div class="section-header">
    <h2 class="section-title">🏆 Top <span>Sellers</span></h2>
    <a href="<?php echo esc_url(class_exists('WooCommerce') ? wc_get_page_permalink('shop') : '#'); ?>" class="view-all">View All</a>
  </div>
  <div class="product-grid">
    <?php
    $top = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'meta_key'       => 'total_sales',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    ]);
    if($top->have_posts()):
        while($top->have_posts()): $top->the_post();
            get_template_part('woocommerce/content-product');
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<!-- REVIEWS -->
<section class="section">
  <div class="section-header">
    <h2 class="section-title">💬 What Customers <span>Are Saying</span></h2>
    <div style="font-size:.85rem;color:var(--muted)">
      <span style="color:var(--yellow)">★★★★★</span> 4.9/5 from 50,000+ reviews
    </div>
  </div>
  <div class="reviews-grid">
    <?php
    $reviews = [
      ['S','Sarah M.','Austin, TX','linear-gradient(135deg,#ff3c5f,#ff8c00)',
       '"I saw this on TikTok and ordered it the same night. Arrived in 4 days — EXACTLY as advertised. Already on my third order!"',
       'Viral Portable Blender'],
      ['J','James R.','Miami, FL','linear-gradient(135deg,#0057ff,#00c9ff)',
       '"Fast shipping, great packaging. The LED kit makes my gaming room look insane. Legit 10/10."',
       'Smart LED Strip Lights Kit'],
      ['A','Aisha K.','New York, NY','linear-gradient(135deg,#7b2ff7,#f107a3)',
       '"HypeWaveMart proved me wrong. Returns were super easy and support replied in under 2 hours!"',
       'Wireless Ear Massager'],
    ];
    foreach($reviews as $r):
    ?>
    <div class="review-card">
      <div class="review-top">
        <div class="reviewer-avatar" style="background:<?php echo esc_attr($r[3]); ?>">
          <?php echo esc_html($r[0]); ?>
        </div>
        <div>
          <div class="reviewer-name"><?php echo esc_html($r[1]); ?></div>
          <div class="reviewer-loc">📍 <?php echo esc_html($r[2]); ?></div>
        </div>
      </div>
      <div class="review-stars">★★★★★</div>
      <p class="review-text"><?php echo esc_html($r[4]); ?></p>
      <div class="review-product">✅ <?php echo esc_html($r[5]); ?></div>
      <div class="verified-badge">✓ Verified Purchase</div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="section">
  <div class="newsletter-section">
    <div style="font-size:2.4rem;margin-bottom:12px">📩</div>
    <h2>Get Daily <span style="color:var(--brand)">Viral Drops</span> in Your Inbox</h2>
    <p>Join 120,000+ trend-hunters. Get notified before items sell out.</p>
    <form class="newsletter-form" onsubmit="hwmNewsletterSubmit(event)">
      <input type="email" placeholder="your@email.com" required>
      <button type="submit">Subscribe Free →</button>
    </form>
    <div class="newsletter-perks">
      <span>✅ No spam, ever</span>
      <span>✅ Exclusive discount codes</span>
      <span>✅ First access to new drops</span>
    </div>
  </div>
</section>

<?php get_footer(); ?>
