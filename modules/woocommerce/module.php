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

            // Custom Metabox
            $this->custom_metabox();
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

        function custom_metabox(){
            add_action( 'add_meta_boxes', [$this, 'product_custom_metabox']);
            add_action( 'save_post', [$this, 'save_metabox']);
        }

        function product_custom_metabox(){
            add_meta_box(
                'custom_product_meta_box',
                __( 'Product Attributes <em>(optional)</em>', 'cmb' ),
                [$this, 'display_metabox'],
                'product',
                'normal',
                'high'
            );
        }

        function display_metabox( $post ){
            $prefix = 'aios_';
            $genericname = get_post_meta($post->ID, $prefix.'genericname', true) ? get_post_meta($post->ID, $prefix.'genericname', true) : '';
            $manufacturer = get_post_meta($post->ID, $prefix.'manufacturer', true) ? get_post_meta($post->ID, $prefix.'manufacturer', true) : '';
            $distributor = get_post_meta($post->ID, $prefix.'distributor', true) ? get_post_meta($post->ID, $prefix.'distributor', true) : '';
            $marketer = get_post_meta($post->ID, $prefix.'marketer', true) ? get_post_meta($post->ID, $prefix.'marketer', true) : '';
            $contents = get_post_meta($post->ID, $prefix.'contents', true) ? get_post_meta($post->ID, $prefix.'contents', true) : '';
            $indications_uses = get_post_meta($post->ID, $prefix.'indications_uses', true) ? get_post_meta($post->ID, $prefix.'indications_uses', true) : '';
            $dosage_direction_for_use = get_post_meta($post->ID, $prefix.'dosage_direction_for_use', true) ? get_post_meta($post->ID, $prefix.'dosage_direction_for_use', true) : '';
            $administration = get_post_meta($post->ID, $prefix.'administration', true) ? get_post_meta($post->ID, $prefix.'administration', true) : '';
            $contraindications = get_post_meta($post->ID, $prefix.'contraindications', true) ? get_post_meta($post->ID, $prefix.'contraindications', true) : '';
            $special_precautions = get_post_meta($post->ID, $prefix.'special_precautions', true) ? get_post_meta($post->ID, $prefix.'special_precautions', true) : '';
            $atc_classification = get_post_meta($post->ID, $prefix.'atc_classification', true) ? get_post_meta($post->ID, $prefix.'atc_classification', true) : '';
            $presentation_packaging  = get_post_meta($post->ID, $prefix.'presentation_packaging ', true) ? get_post_meta($post->ID, $prefix.'presentation_packaging ', true) : '';
            $regulatory_classification  = get_post_meta($post->ID, $prefix.'regulatory_classification ', true) ? get_post_meta($post->ID, $prefix.'regulatory_classification ', true) : ''; 
            $mims_class = !empty(get_post_meta($post->ID, $prefix.'mims_class', true)) ? get_post_meta($post->ID, $prefix.'mims_class', true) : ''; 
            $storage = get_post_meta($post->ID, $prefix.'storage', true) ? get_post_meta($post->ID, $prefix.'storage', true) : '';
            $active_ingredient = get_post_meta($post->ID, $prefix.'active_ingredient', true) ? get_post_meta($post->ID, $prefix.'active_ingredient', true) : ''; 
            $inn = get_post_meta($post->ID, $prefix.'inn', true) ? get_post_meta($post->ID, $prefix.'inn', true) : ''; 
            $pharmaceutical_form = get_post_meta($post->ID, $prefix.'pharmaceutical_form', true) ? get_post_meta($post->ID, $prefix.'pharmaceutical_form', true) : ''; 
            $importer = get_post_meta($post->ID, $prefix.'importer', true) ? get_post_meta($post->ID, $prefix.'importer', true) : ''; 
            ?>
            
            <div class="flex">
                <label for="genericname">
                    <strong><?php _e( 'Generic Name', 'aios-products' )?></strong> <br/>
                    <input type="text" name="genericname" id="genericname" value="<?php echo (isset($genericname) ? $genericname : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="manufacturer">
                    <strong><?php _e( 'Manufacturer', 'aios-products' )?></strong> <br/>
                    <input type="text" name="manufacturer" id="manufacturer" value="<?php echo (isset($manufacturer) ? $manufacturer : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="distributor">
                    <strong><?php _e( 'Distributor', 'aios-products' )?></strong> <br/>
                    <input type="text" name="distributor" id="distributor" value="<?php echo (isset($distributor) ? $distributor : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="importer">
                    <strong><?php _e( 'Importer', 'aios-products' )?></strong> <br/>
                    <input type="text" name="importer" id="importer" value="<?php echo (isset($importer) ? $importer : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="marketer">
                    <strong><?php _e( 'Marketer', 'aios-products' )?></strong> <br/>
                    <input type="text" name="marketer" id="marketer" value="<?php echo (isset($marketer) ? $marketer : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="contents">
                    <strong><?php _e( 'Contents', 'aios-products' )?></strong> <br/>
                    <input type="text" name="contents" id="contents" value="<?php echo (isset($contents) ? $contents : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="active_ingredient">
                    <strong><?php _e( 'Active Ingredient(s)', 'aios-products' )?></strong> <br/>
                    <input type="text" name="active_ingredient" id="active_ingredient" value="<?php echo (isset($active_ingredient) ? $active_ingredient : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="mims_class">
                    <strong><?php _e( 'MIMS Class', 'aios-products' )?></strong> <br/>
                    <input type="text" name="mims_class" id="mims_class" value="<?php echo (isset($mims_class) ? $mims_class : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="inn">
                    <strong><?php _e( 'INN (International Name)', 'aios-products' )?></strong> <br/>
                    <input type="text" name="inn" id="inn" value="<?php echo (isset($inn) ? $inn : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="storage">
                    <strong><?php _e( 'Storage', 'aios-products' )?></strong> <br/>
                    <input type="text" name="storage" id="storage" value="<?php echo (isset($storage) ? $storage : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="pharmaceutical_form">
                    <strong><?php _e( 'Pharmaceutical form', 'aios-products' )?></strong> <br/>
                    <input type="text" name="pharmaceutical_form" id="pharmaceutical_form" value="<?php echo (isset($pharmaceutical_form) ? $pharmaceutical_form : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="indications_usesindications_uses">
                    <strong><?php _e( 'Indications/Uses', 'aios-products' )?></strong> <br/>
                    <textarea type="text" name="indications_uses" id="indications_uses" rows="6" style="width: 100%; margin: 15px 0;"><?php echo (isset($indications_uses) ? $indications_uses : ''); ?></textarea>
                </label>
                
                <label for="dosage_direction_for_use">
                    <strong><?php _e( 'Dosage/Direction for Use', 'aios-products' )?></strong> <br/>
                    <textarea type="text" name="dosage_direction_for_use" id="dosage_direction_for_use" rows="6" style="width: 100%; margin: 15px 0;"><?php echo (isset($dosage_direction_for_use) ? $dosage_direction_for_use : ''); ?></textarea>
                </label>

                <label for="administration">
                    <strong><?php _e( 'Administration', 'aios-products' )?></strong> <br/>
                    <input type="text" name="administration" id="administration" value="<?php echo (isset($administration) ? $administration : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="contraindications">
                    <strong><?php _e( 'Contraindications', 'aios-products' )?></strong> <br/>
                    <input type="text" name="contraindications" id="contraindications" value="<?php echo (isset($contraindications) ? $contraindications : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="special_precautions">
                    <strong><?php _e( 'Dosage/Direction for Use', 'aios-products' )?></strong> <br/>
                    <textarea type="text" name="special_precautions" id="special_precautions" rows="6" style="width: 100%; margin: 15px 0;"><?php echo (isset($special_precautions) ? $special_precautions : ''); ?></textarea>
                </label>

                <label for="atc_classification">
                    <strong><?php _e( 'ATC Classification', 'aios-products' )?></strong> <br/>
                    <input type="text" name="atc_classification" id="atc_classification" value="<?php echo (isset($atc_classification) ? $atc_classification : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="presentation_packagingpresentation_packaging">
                    <strong><?php _e( 'Presentation / Packaging', 'aios-products' )?></strong> <br/>
                    <input type="text" name="presentation_packaging" id="presentation_packaging" value="<?php echo (isset($presentation_packaging) ? $presentation_packaging : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>

                <label for="regulatory_classification">
                    <strong><?php _e( 'Regulatory Classification', 'aios-products' )?></strong> <br/>
                    <input type="text" name="regulatory_classification" id="regulatory_classification" value="<?php echo (isset($regulatory_classification) ? $regulatory_classification : ''); ?>" style="width: 100%; margin: 15px 0;"/>
                </label>
                
            </div>

        <?php 
            echo '<input type="hidden" name="custom_product_field_nonce" value="' . wp_create_nonce() . '">';
        }

        function save_metabox( $post_id ){
            $prefix = 'aios_';
            if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
                return $post_id;
            }
            $nonce = $_REQUEST[ 'custom_product_field_nonce' ];
            if ( ! wp_verify_nonce( $nonce ) ) {
                return $post_id;
            }
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
            if ( 'product' == $_POST[ 'post_type' ] ){
                if ( ! current_user_can( 'edit_product', $post_id ) )
                    return $post_id;
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) )
                    return $post_id;
            }

            update_post_meta( $post_id, $prefix.'genericname', wp_kses_post($_POST[ 'genericname' ]) );
            update_post_meta( $post_id, $prefix.'manufacturer', wp_kses_post($_POST[ 'manufacturer' ]) );
            update_post_meta( $post_id, $prefix.'distributor', wp_kses_post($_POST[ 'distributor' ]) );
            update_post_meta( $post_id, $prefix.'marketer', wp_kses_post($_POST[ 'marketer' ]) );
            update_post_meta( $post_id, $prefix.'contents', wp_kses_post($_POST[ 'contents' ]) );
            update_post_meta( $post_id, $prefix.'indications_uses', wp_kses_post($_POST[ 'indications_uses' ]) );
            update_post_meta( $post_id, $prefix.'dosage_direction_for_use', wp_kses_post($_POST[ 'dosage_direction_for_use' ]) );
            update_post_meta( $post_id, $prefix.'administration', wp_kses_post($_POST[ 'administration' ]) );
            update_post_meta( $post_id, $prefix.'contraindications', wp_kses_post($_POST[ 'contraindications' ]) );
            update_post_meta( $post_id, $prefix.'special_precautions', wp_kses_post($_POST[ 'special_precautions' ]) );
            update_post_meta( $post_id, $prefix.'atc_classification', wp_kses_post($_POST[ 'atc_classification' ]) );
            update_post_meta( $post_id, $prefix.'presentation_packaging', wp_kses_post($_POST[ 'presentation_packaging' ]) );
            update_post_meta( $post_id, $prefix.'regulatory_classification', wp_kses_post($_POST[ 'regulatory_classification' ]) );
            update_post_meta( $post_id, $prefix.'mims_class', wp_kses_post($_POST[ 'mims_class' ]) );
            update_post_meta( $post_id, $prefix.'storage', wp_kses_post($_POST[ 'storage' ]) );
            update_post_meta( $post_id, $prefix.'active_ingredient', wp_kses_post($_POST[ 'active_ingredient' ]) );
            update_post_meta( $post_id, $prefix.'inn', wp_kses_post($_POST[ 'inn' ]) );
            update_post_meta( $post_id, $prefix.'pharmaceutical_form', wp_kses_post($_POST[ 'pharmaceutical_form' ]) );
            update_post_meta( $post_id, $prefix.'importer', wp_kses_post($_POST[ 'importer' ]) );
            
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
