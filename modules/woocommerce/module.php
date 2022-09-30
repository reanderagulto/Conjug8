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
        }

        function enqueque_scripts(){
            if ( is_product() ) {
                wp_enqueue_style( 'product-style', get_stylesheet_directory_uri() . '/modules/woocommerce/css/product.css' );
            }

            if( is_shop() ){
                wp_enqueue_style( 'shop-style', get_stylesheet_directory_uri() . '/modules/woocommerce/css/shop.css' );
            }
        }

    }

    $add_woocommerce_support = new add_woocommerce_support();
    
}