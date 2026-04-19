<?php if(!defined('ABSPATH'))exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="announce-bar">
  🔥 FREE US Shipping on orders $25+ &nbsp;|&nbsp;
  <span>TODAY'S DROP:</span> 47 new viral products just added &nbsp;|&nbsp;
  🛡️ 30-Day Money-Back Guarantee
</div>

<header>
  <div class="header-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
      HypeWave<span>Mart</span>
    </a>
    <div class="search-bar">
      <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s"
               placeholder="Search viral products, gadgets, home…"
               value="<?php echo esc_attr(get_search_query()); ?>">
        <button type="submit">🔍</button>
      </form>
    </div>
    <div class="header-actions">
      <a href="<?php echo esc_url(class_exists('WooCommerce')
          ? wc_get_page_permalink('myaccount')
          : wp_login_url()); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        Account
      </a>
      <a href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
        Wishlist
      </a>
      <a href="<?php echo esc_url(class_exists('WooCommerce')
          ? wc_get_cart_url() : '#'); ?>" class="cart-btn">
        🛒 Cart
        <span class="cart-badge" id="cartCount">
          <?php echo class_exists('WooCommerce') && WC()->cart
              ? WC()->cart->get_cart_contents_count() : 0; ?>
        </span>
      </a>
    </div>
    <button class="hamburger" onclick="toggleMobileNav()">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<nav>
  <div class="nav-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>"
       <?php echo is_front_page() ? 'class="active"' : ''; ?>>
      <span class="nav-icon">🏠</span> Home
    </a>
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'fallback_cb'    => function(){
            $cats  = get_terms(['taxonomy'=>'product_cat','hide_empty'=>true,'number'=>10]);
            $icons = ['🔥','⚡','📱','🏡','💪','🐾','💄','👕','🧸','🌿'];
            if(!is_wp_error($cats)){
                $i=0;
                foreach($cats as $cat){
                    if($cat->slug==='uncategorized'){continue;}
                    echo '<a href="'.esc_url(get_term_link($cat)).'">';
                    echo '<span class="nav-icon">'.($icons[$i]??'🛒').'</span> ';
                    echo esc_html($cat->name).'</a>';
                    $i++;
                }
            }
        },
    ]);
    ?>
  </div>
</nav>

<div class="mobile-nav" id="mobileNav" onclick="closeMobileNav(event)">
  <div class="mobile-nav-panel">
    <button class="close-btn" onclick="toggleMobileNav()">✕</button>
    <a href="<?php echo esc_url(home_url('/')); ?>">🏠 Home</a>
    <?php
    $mcats  = get_terms(['taxonomy'=>'product_cat','hide_empty'=>true,'number'=>12]);
    $micons = ['🔥','⚡','📱','🏡','💪','🐾','💄','👕','🧸','🎮','🌿','📦'];
    if(!is_wp_error($mcats)){
        $i=0;
        foreach($mcats as $cat){
            if($cat->slug==='uncategorized'){continue;}
            echo '<a href="'.esc_url(get_term_link($cat)).'">';
            echo ($micons[$i]??'🛒').' '.esc_html($cat->name).'</a>';
            $i++;
        }
    }
    ?>
    <hr style="border-color:rgba(255,255,255,.08);margin:8px 0">
    <a href="<?php echo esc_url(class_exists('WooCommerce')
        ? wc_get_page_permalink('myaccount') : wp_login_url()); ?>">👤 Account</a>
    <a href="#">❤️ Wishlist</a>
    <a href="<?php echo esc_url(class_exists('WooCommerce')
        ? wc_get_cart_url() : '#'); ?>">🛒 Cart</a>
  </div>
</div>
