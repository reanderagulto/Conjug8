<?php 

if(!class_exists('woocommerce_hooks')) {
    class woocommerce_hooks{
        function __construct(){
            $this->products_page();
        }

        function products_page(){

            /* 
            * Remove actions before updating/reordering 
            */
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
            
            /* 
            * Add actions before updating/reordering
            */   
            $this->product_details();         
        }        

        function product_details(){
            add_action( 
                'woocommerce_after_single_product_summary', 
                function(){
                    $product_attributes = get_field('product_attributes');

                    echo '<div class="product-details">';
                        if(!empty($product_attributes['manufacturer'])) {
                            echo '<div class="detail">';
                            echo '<h2>Manufacturer</h2>';
                            echo '<p>' . $product_attributes['manufacturer'] . '</p>';
                            echo '</div>';
                        }
                        if(!empty($product_attributes['contents'])) {
                            echo '<div class="detail">';
                            echo '<h2>Contents</h2>';
                            echo '<p>' . $product_attributes['contents'] . '</p>';
                            echo '</div>';
                        }
                        if(!empty($product_attributes['indications_uses'])) {
                            echo '<div class="detail">';
                            echo '<h2>Indications/Uses</h2>';
                            echo '<p>' . $product_attributes['indications_uses'] . '</p>';
                            echo '</div>';
                        }
                        if(!empty($product_attributes['dosage_direction_for_use'])) {
                            echo '<div class="detail">';
                            echo '<h2>Dosage/Direction for Use</h2>';
                            echo '<p>' . $product_attributes['dosage_direction_for_use'] . '</p>';
                            echo '</div>';
                        }
                        if(!empty($product_attributes['special_precautions'])) {
                            echo '<div class="detail">';
                            echo '<h2>Special Precautions</h2>';
                            echo '<p>' . $product_attributes['special_precautions'] . '</p>';
                            echo '</div>';
                        }
                        echo '<div class="detail">';
                        woocommerce_product_description_tab();
                        echo '</div>';
                        if(!empty($product_attributes['atc_classification'])) {
                            echo '<div class="detail">';
                            echo '<h2>ATC Classification</h2>';
                            echo '<p>' . $product_attributes['atc_classification'] . '</p>';
                            echo '</div>';
                        }
                        if(!empty($product_attributes['presentation_packaging'])) {
                            echo '<div class="detail">';
                            echo '<h2>Presentation / Packaging</h2>';
                            echo '<p>' . $product_attributes['presentation_packaging'] . '</p>';
                            echo '</div>';
                        }
                        if(!empty($product_attributes['regulatory_classification'])) {
                            echo '<div class="detail">';
                            echo '<h2>Regulatory Classification</h2>';
                            echo '<p>' . $product_attributes['regulatory_classification'] . '</p>';
                            echo '</div>';
                        }
                    echo '</div>';
                    
                    echo '<div class="related-products">';
                        woocommerce_output_related_products();
                    echo '<div>';
                }
            );

            apply_filters('woocommerce_product_related_products_heading', __( 'Other Products', 'woocommerce' ));
        }

        function related_products(){

        }
    }

    $woocommerce_hooks = new woocommerce_hooks();
}