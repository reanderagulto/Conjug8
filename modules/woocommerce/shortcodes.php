<?php 

/* 
<a href="?add-to-cart=' . $post_id . '"  data-quantity="1" class="aios-btn-sm aios-btn-red button product_type_simple add_to_cart_button ajax_add_to_cart btn-slider" data-product_id="' . $post_id . '" data-product_sku="" aria-label="Add “' . $post_title .  '” to your cart rel="nofollow">
    Add to Cart                                                
</a>
 */

if( !class_exists('woocommerce_featured_product_slider')){
    class woocommerce_featured_product_slider{
        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct(){
            add_shortcode( 'products_slider', [ $this, 'products_slider' ] );
            add_shortcode( 'featured_products_slider', [ $this, 'featured_products_slider' ] );
        }

        public function products_slider( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'desc',
            ], $atts );

            wp_enqueue_style( 'product-slider', get_stylesheet_directory_uri() . '/modules/woocommerce/css/product.css' );
            wp_enqueue_script( 'product-slider', get_stylesheet_directory_uri() . '/modules/woocommerce/js/product.js' );

            extract( $atts ); // create variables using the above array keys

            $args = [
                'post_type' => 'product',
                'post_status' => 'publish',
                'orderby' => 'meta_value_num',
                'order' => $order, 
                'meta_key' => '_price',
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
                        <div class="product-header-nav flex items-center justify-between" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">
                            <h2 class="section-header">Our Products</h2>
                            <div class="product-nav flex items-center">
                                <a href="' . home_url() . '/products/" class="aios-btn aios-btn-red">View Products</a>
                                <div class="slider-navs">
                                    <button type="button" class="aios-btn aios-btn-red slider-nav prod-prev ai-icon-prev"></button>
                                    <button type="button" class="aios-btn aios-btn-red slider-nav prod-next ai-icon-next"></button>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider" data-aos="fade-left" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">';
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $post_title = $post->post_title;
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
                        $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                        $attachment = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
                        $width = $attachment[1];
                        $height = $attachment[2];
                        $generic_name = get_post_meta($post_id, 'aios_genericname', true);

                        $return .= '
                        <div class="product-slide">
                            <div class="product-img">
                                <canvas width="' . $width . '" height="' . $height . '"></canvas>
                                <img src="' . $post_thumbnail_url . '" width="' . $width . '" height="' . $height . '"/>
                            </div>
                            <div class="product-info">
                                <h3>' 
                                    . $post_title . 
                                    '<span>' . $generic_name . '</span>
                                </h3>
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

        public function featured_products_slider( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
            ], $atts );

            extract( $atts ); // create variables using the above array keys
            
            wp_enqueue_style( 'product-slider', get_stylesheet_directory_uri() . '/modules/woocommerce/css/product.css' );
            wp_enqueue_script( 'product-slider', get_stylesheet_directory_uri() . '/modules/woocommerce/js/product.js' );

            $args = [
                'post_type' => 'product',
                'post_status' => 'publish',
                'order' => $order,
                'posts_per_page' => $posts_per_page,
                'meta_query' =>[
                    [
                        'key' => 'featured-product',
                        'value' => 'yes',
                        'compare' => '='
                    ]
                ],
            ];

            $products_query = new WP_Query( $args );
            $products_total = $products_query->post_count;

            if($products_total > 0){
                $return = '';
                $posts = $products_query->posts;

                $return .= '
                <section class="featured-products" data-aos="fade-up" data-aos-once="true">
                    <div class="featured-products-wrap">
                        <div class="featured-product-slider">';
                            foreach( $posts as $key => $post ) {
                                $post_id = $post->ID;
                                $post_title = $post->post_title;
                                $post_permalink = get_the_permalink( $post_id );
                                $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
                                $generic_name = get_post_meta($post_id, 'aios_genericname', true);
                                
                                $return .= '
                                <div class="product-slide single-product-slide" data-url="' . $post_permalink . '">
                                    <div class="img-container">
                                        <canvas width="482" height="347"></canvas>
                                        <img src="' . $post_thumbnail_url . '" width="482" height="347"/>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="section-header">' 
                                            . $post_title .
                                            '<span>' . $generic_name . '</span>
                                        </h3>
                                        <div class="cart-button-container" id="slider-' . $post_id . '">
                                            <div class="added-cart-text"><span class="ai-font-check"></span> Added</div>
                                        </div>
                                    </div>
                                </div>  
                            ';
                            }
                $return .= '
                        </div>
                        <div class="slider-navs">
                            <button type="button" class="aios-btn aios-btn-transparent slider-nav prod-prev ai-icon-prev"></button>
                            <button type="button" class="aios-btn aios-btn-transparent slider-nav prod-next ai-icon-next"></button>
                        </div>
                        <div class="accent-bg">
                            <div class="accent-red">
                        </div>
                    </div>
                </section>';

                wp_reset_postdata();
                wp_reset_query();
            }
            else{
                $return = "No Product(s) Found";
            }
            return $return;
        }
    }

    $woocommerce_featured_product_slider = new woocommerce_featured_product_slider();
}