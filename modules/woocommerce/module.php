<?php 

if( !class_exists('add_woocommerce_support') ){
    class add_woocommerce_support{

        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct() {
            add_theme_support( 'woocommerce', array(
                'thumbnail_image_width' => 349,
                'single_image_width'    => 541,
        
                'product_grid'          => array(
                    'default_rows'    => 3,
                    'min_rows'        => 2,
                    'max_rows'        => 8,
                    'default_columns' => 3,
                    'min_columns'     => 1,
                    'max_columns'     => 3,
                ),
            ) );
        }

    }

    $add_woocommerce_support = new add_woocommerce_support();
    
}