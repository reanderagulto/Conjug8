<?php 

if( !class_exists('woocommerce_featured_product_slider')){
    class woocommerce_featured_product_slider{
        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct(){
            add_shortcode( 'featured_products_slider', [ $this, 'featured_product_slider' ] );
        }

        public function featured_product_slider( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
            ], $atts );

            wp_enqueue_style( 'product-slider', get_stylesheet_directory_uri() . '/modules/woocommerce/css/product.css' );
            wp_enqueue_script( 'product-slider', get_stylesheet_directory_uri() . '/modules/woocommerce/js/product.js' );

            extract( $atts ); // create variables using the above array keys

            get_header();
            $post_id = get_the_ID();
            $post_fields = get_fields( );
            $fields_to_get = array(
                'product_section',
            );
            foreach ( $fields_to_get as $field ) {
                ${$field} = $post_fields[ $field ];
            }

            $args = [
                'post_type' => 'product',
                'post_status' => 'publish',
                'order' => $order,
                'posts_per_page' => $posts_per_page,
            ];

            $products_query = new WP_Query( $args );
            $products_total = $products_query->post_count;

            if($products_total > 0){
                $return = '';
                $posts = $products_query->posts;

                $return .= '
                <section id="product-section">
                    <div class="product-section-wrap">
                        <div class="product-header-nav flex items-center justify-between">
                            <h2 class="section-header">Our Products</h2>
                            <div class="product-nav flex items-center">
                                <a href="' . home_url() . '/products/" class="aios-btn aios-btn-red">View Products</a>
                                <div class="slider-navs">
                                    <button type="button" class="aios-btn aios-btn-red slider-nav prod-prev"><i class="ai-font-arrow-h-p"></i></button>
                                    <button type="button" class="aios-btn aios-btn-red slider-nav prod-next"><i class="ai-font-arrow-h-n"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider">';
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $post_title = $post->post_title;
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
                        $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                        $attachment = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
                        $width = $attachment[1];
                        $height = $attachment[2];

                        $return .= '
                        <div class="product-slide">
                            <div class="product-img">
                                <canvas width="' . $width . '" height="' . $height . '"></canvas>
                                <img src="' . $post_thumbnail_url . '" width="' . $width . '" height="' . $height . '"/>
                            </div>
                            <div class="product-info">
                                <h3>' . $post_title . '</h3>
                                <a href="' . $post_permalink . '" class="aios-btn-sm aios-btn-red">Buy Now</a>
                            </div>
                        </div>';
                    }

                $return .= '
                        </div>
                    </div>
                </section>';
                wp_reset_postdata();
                wp_reset_query();

            }
            else{
                $return = "No Post Found";
            }
            return $return;
        }
    }

    $woocommerce_featured_product_slider = new woocommerce_featured_product_slider();
}