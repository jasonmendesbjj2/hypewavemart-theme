<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'HWM_VERSION', '1.0.0' );
define( 'HWM_DIR', get_template_directory() );
define( 'HWM_URI', get_template_directory_uri() );

function hwm_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'html5', [
        'search-form','comment-form',
        'comment-list','gallery','caption','style','script'
    ]);

    register_nav_menus([
        'primary' => __( 'Menu Principal', 'hypewavemart' ),
        'mobile'  => __( 'Menu Mobile',    'hypewavemart' ),
        'footer'  => __( 'Menu Rodapé',    'hypewavemart' ),
    ]);

    set_post_thumbnail_size( 600, 600, true );
    add_image_size( 'hwm-product-card',  400, 400, true );
    add_image_size( 'hwm-product-thumb', 100, 100, true );
    add_image_size( 'hwm-hero',         1280, 600, true );
}
add_action( 'after_setup_theme', 'hwm_setup' );

if ( ! isset( $content_width ) ) $content_width = 1280;

/* Enqueue assets */
function hwm_enqueue_assets() {
    wp_enqueue_style(
        'hwm-main',
        HWM_URI . '/assets/css/main.css',
        [], HWM_VERSION
    );

    if ( class_exists('WooCommerce') ) {
        wp_enqueue_style(
            'hwm-woocommerce',
            HWM_URI . '/assets/css/woocommerce.css',
            ['hwm-main'], HWM_VERSION
        );
    }

    wp_enqueue_script(
        'hwm-main',
        HWM_URI . '/assets/js/main.js',
        ['jquery'], HWM_VERSION, true
    );

    wp_localize_script( 'hwm-main', 'HWM', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'cartUrl'  => class_exists('WooCommerce') ? wc_get_cart_url() : home_url('/cart'),
        'nonce'    => wp_create_nonce('hwm_nonce'),
        'currency' => class_exists('WooCommerce') ? get_woocommerce_currency_symbol() : '$',
    ]);
}
add_action( 'wp_enqueue_scripts', 'hwm_enqueue_assets' );

/* Widgets */
function hwm_register_widgets() {
    register_sidebar([
        'name'          => __('Shop Sidebar', 'hypewavemart'),
        'id'            => 'shop-sidebar',
        'before_widget' => '<div class="hwm-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar([
            'name'          => __("Footer Column $i", 'hypewavemart'),
            'id'            => "footer-$i",
            'before_widget' => '<div class="hwm-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
    }
}
add_action( 'widgets_init', 'hwm_register_widgets' );

/* WooCommerce: sold count */
function hwm_get_sold_count( $product_id ) {
    $count = get_post_meta( $product_id, '_hwm_sold_count', true );
    return $count ? (int) $count : rand(100, 3000);
}

add_action( 'woocommerce_order_status_completed', function( $order_id ) {
    $order = wc_get_order( $order_id );
    foreach ( $order->get_items() as $item ) {
        $pid     = $item->get_product_id();
        $qty     = $item->get_quantity();
        $current = (int) get_post_meta( $pid, '_hwm_sold_count', true );
        update_post_meta( $pid, '_hwm_sold_count', $current + $qty );
    }
});

/* WooCommerce: remove default wrappers */
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);

add_action('woocommerce_before_main_content', function(){
    echo '<div class="hwm-woo-wrapper section">';
}, 10);
add_action('woocommerce_after_main_content', function(){
    echo '</div>';
}, 10);

/* WooCommerce: sale badge */
add_filter('woocommerce_sale_flash', function($html, $post, $product){
    $pct = '';
    if ( $product->get_regular_price() && $product->get_sale_price() ) {
        $pct = round((($product->get_regular_price() - $product->get_sale_price())
               / $product->get_regular_price()) * 100);
        $pct = '-' . $pct . '%';
    }
    return '<span class="badge badge-hot">' . $pct . ' OFF</span>';
}, 10, 3);

/* Products per page & columns */
add_filter('loop_shop_columns',  function(){ return 4; });
add_filter('loop_shop_per_page', function(){ return 16; });

/* AJAX cart count */
function hwm_cart_count() {
    wp_send_json([
        'count' => WC()->cart ? WC()->cart->get_cart_contents_count() : 0,
        'total' => WC()->cart ? WC()->cart->get_cart_total() : '$0.00',
    ]);
}
add_action('wp_ajax_hwm_cart_count',        'hwm_cart_count');
add_action('wp_ajax_nopriv_hwm_cart_count', 'hwm_cart_count');

/* Excerpt length */
add_filter('excerpt_length', function(){ return 20; });

/* Body classes */
add_filter('body_class', function($classes){
    if (is_woocommerce()||is_shop()||is_product()||is_cart()||is_checkout())
        $classes[] = 'hwm-woocommerce';
    return $classes;
});
