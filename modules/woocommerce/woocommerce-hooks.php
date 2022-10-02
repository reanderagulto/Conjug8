<?php 

if(!class_exists('woocommerce_hooks')) {
    class woocommerce_hooks{
        function __construct(){
            $this->product_summary();
        }

        function product_summary(){
            
        }
    }

    $woocommerce_hooks = new woocommerce_hooks();
}