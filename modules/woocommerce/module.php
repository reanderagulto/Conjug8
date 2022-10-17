<?php 

if( !class_exists('add_woocommerce_support') ){
    class add_woocommerce_support{

        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct() {
            
            add_theme_support( 'woocommerce');
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueque_scripts'), 15 );

            // Ajax
            add_action('wp_ajax_cart_count_retriever', array( $this, 'cart_count_retriever'));
            add_action('wp_ajax_nopriv_cart_count_retriever', array( $this, 'cart_count_retriever'));
        }

        function enqueque_scripts(){
            if ( is_product() ) {
                wp_enqueue_style( 'product-style', get_stylesheet_directory_uri() . '/modules/woocommerce/css/product.css' );
            }

            if( is_shop() ){
                wp_enqueue_style( 'shop-style', get_stylesheet_directory_uri() . '/modules/woocommerce/css/shop.css' );
            }
        }

        function cart_count_retriever() {
            global $wpdb;
            echo WC()->cart->get_cart_contents_count();
            wp_die();
        }
    }

    $add_woocommerce_support = new add_woocommerce_support();
    
}

// Woocommerce Hook File
if ( ! class_exists( 'woocommerce_hooks' ) && file_exists( __DIR__ . '/woocommerce-hooks.php' ) ) {
    require_once( __DIR__ . '/woocommerce-hooks.php' );
}

// fallback require for shortcodes.php
if ( ! class_exists( 'woocommerce_featured_product_slider' ) && file_exists( __DIR__ . '/shortcodes.php' ) ) {
    require_once( __DIR__ . '/shortcodes.php' );
}
