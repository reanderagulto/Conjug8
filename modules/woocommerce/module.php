<?php 

if ( ! class_exists('agentpro_woocommerce_support')){
    class agentpro_woocommerce_support{
        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct() {
            add_theme_support( 'woocommerce', array(
                'thumbnail_image_width' => 349,
                'product_grid'          => array(
                    'default_rows'    => 3,
                    'min_rows'        => 2,
                    'max_rows'        => 8,
                    'default_columns' => 3,
                    'min_columns'     => 2,
                    'max_columns'     => 5,
                ),
            ) );
        }
    }
}