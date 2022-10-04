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
            add_action( 'add_meta_boxes', [$this, 'add_featured_metabox'] );
            add_action( 'save_post', [$this, 'save_featured_metabox'] );
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

        function add_featured_metabox(){
            add_meta_box( 'featured_product', __('Featured Product', 'aios-textdomain'), [$this, 'display_featured_metabox'], 'product', 'side', 'high' );
        }

        function display_featured_metabox( $post ){
            wp_nonce_field( basename( __FILE__ ), 'featured_product_nonce' );
            $stored_meta = get_post_meta( $post->ID ); ?>
            <label for="featured-product">
                <input type="checkbox" name="featured-product" id="featured-product" value="yes" <?php if ( isset ( $stored_meta['featured-product'] ) ) checked( $stored_meta['featured-product'][0], 'yes' ); ?> />
                <?php _e( 'Is featured?', 'aios-textdomain' )?>
            </label>
        <?php }

        function save_featured_metabox( $post_id ) {
            $is_autosave = wp_is_post_autosave( $post_id );
            $is_revision = wp_is_post_revision( $post_id );
            $is_valid_nonce = ( isset( $_POST[ 'featured_product_nonce' ] ) && wp_verify_nonce( $_POST[ 'featured_product_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

            // Exits script depending on save status
            if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
                return;
            }

            // Checks for input and saves - save checked as yes and unchecked at no
            if( isset( $_POST[ 'featured-product' ] ) ) {
                update_post_meta( $post_id, 'featured-product', 'yes' );
            } else {
                update_post_meta( $post_id, 'featured-product', 'no' );
            }
        }
    }

    $woocommerce_hooks = new woocommerce_hooks();
}