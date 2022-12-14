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

            // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
            // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
            
            /* 
            * Add actions before updating/reordering
            */   
            $this->product_details();
            $this->custom_checkout_field();
            $this->cash_on_delivery_status();
            $this->pwd_senior_coupon();
            $this->add_upload_notes();
            add_action( 'add_meta_boxes', [$this, 'add_featured_metabox'] );
            add_action( 'save_post', [$this, 'save_featured_metabox'] );
        }        

        function product_details(){
            add_action( 
                'woocommerce_after_single_product_summary', 
                function(){
                    global $product;
                    $prefix = 'aios_';
                    $post_id = $product->get_id();
                    $manufacturer = get_post_meta( $post_id, 'aios_manufacturer',  true);
                    $distributor = get_post_meta( $post_id, 'aios_distributor',  true);
                    $marketer = get_post_meta( $post_id, 'aios_marketer',  true);
                    $contents = get_post_meta( $post_id, 'aios_contents',  true);
                    $indications_uses = get_post_meta( $post_id, 'aios_indications_uses',  true);
                    $dosage_direction_for_use = get_post_meta( $post_id, 'aios_dosage_direction_for_use',  true);
                    $administration = get_post_meta( $post_id, 'aios_administration',  true);
                    $contraindications = get_post_meta( $post_id, 'aios_contraindications',  true);
                    $special_precautions = get_post_meta( $post_id, 'aios_special_precautions',  true);
                    $atc_classification = get_post_meta( $post_id, 'aios_atc_classification',  true);
                    $presentation_packaging = get_post_meta( $post_id, 'aios_presentation_packaging',  true);
                    $regulatory_classification = get_post_meta( $post_id, 'aios_regulatory_classification',  true);
                    $mims_class = get_post_meta( $post_id, 'aios_mims_class',  true);
                    $storage = get_post_meta( $post_id, 'aios_storage',  true);
                    $active_ingredient = get_post_meta( $post_id, 'aios_active_ingredient',  true);
                    $inn = get_post_meta( $post_id, 'aios_inn',  true);
                    $pharmaceutical_form = get_post_meta( $post_id, 'aios_pharmaceutical_form',  true);
                    $importer = get_post_meta( $post_id, 'aios_importer',  true);

                    echo '<div class="product-details">';
                        if(!empty($manufacturer)) {
                            echo '<div class="detail">';
                            echo '<h2>Manufacturer</h2>';
                            echo '<p>' . $manufacturer. '</p>';
                            echo '</div>';
                        }
                        if(!empty($distributor)) {
                            echo '<div class="detail">';
                            echo '<h2>Distributor</h2>';
                            echo '<p>' . $distributor . '</p>';
                            echo '</div>';
                        }
                        if(!empty($importer)) {
                            echo '<div class="detail">';
                            echo '<h2>Importer</h2>';
                            echo '<p>' . $importer . '</p>';
                            echo '</div>';
                        }
                        if(!empty($marketer)) {
                            echo '<div class="detail">';
                            echo '<h2>Marketer</h2>';
                            echo '<p>' . $marketer . '</p>';
                            echo '</div>';
                        }
                        if(!empty($contents)) {
                            echo '<div class="detail">';
                            echo '<h2>Contents</h2>';
                            echo '<p>' . $contents . '</p>';
                            echo '</div>';
                        }
                        if(!empty($active_ingredient)) {
                            echo '<div class="detail">';
                            echo '<h2>Active Ingredient(s)</h2>';
                            echo '<p>' . $active_ingredient . '</p>';
                            echo '</div>';
                        }
                        if(!empty($mims_class)) {
                            echo '<div class="detail">';
                            echo '<h2>MIMS Class</h2>';
                            echo '<p>' . $mims_class . '</p>';
                            echo '</div>';
                        }
                        if(!empty($inn)) {
                            echo '<div class="detail">';
                            echo '<h2>INN (International Name)</h2>';
                            echo '<p>' . $inn . '</p>';
                            echo '</div>';
                        }
                        if(!empty($storage)) {
                            echo '<div class="detail">';
                            echo '<h2>Storage</h2>';
                            echo '<p>' . $storage . '</p>';
                            echo '</div>';
                        }
                        if(!empty($pharmaceutical_form)) {
                            echo '<div class="detail">';
                            echo '<h2>Pharmaceutical form</h2>';
                            echo '<p>' . $pharmaceutical_form . '</p>';
                            echo '</div>';
                        }
                        if(!empty($indications_uses)) {
                            echo '<div class="detail">';
                            echo '<h2>Indications/Uses</h2>';
                            echo '<p>' . nl2br($indications_uses) . '</p>';
                            echo '</div>';
                        }
                        if(!empty($dosage_direction_for_use)) {
                            echo '<div class="detail">';
                            echo '<h2>Dosage/Direction for Use</h2>';
                            echo '<p>' . nl2br($dosage_direction_for_use) . '</p>';
                            echo '</div>';
                        }
                        if(!empty($administration)) {
                            echo '<div class="detail">';
                            echo '<h2>Administration</h2>';
                            echo '<p>' . $administration . '</p>';
                            echo '</div>';
                        }
                        if(!empty( $contraindications)) {
                            echo '<div class="detail">';
                            echo '<h2>Contraindications</h2>';
                            echo '<p>' .  $contraindications . '</p>';
                            echo '</div>';
                        }
                        if(!empty($special_precautions)) {
                            echo '<div class="detail">';
                            echo '<h2>Special Precautions</h2>';
                            echo '<p>' . nl2br($special_precautions) . '</p>';
                            echo '</div>';
                        }
                        // echo '<div class="detail">';
                        // woocommerce_product_description_tab();
                        // echo '</div>';
                        if(!empty($atc_classification)) {
                            echo '<div class="detail">';
                            echo '<h2>ATC Classification</h2>';
                            echo '<p>' . $atc_classification . '</p>';
                            echo '</div>';
                        }
                        if(!empty($presentation_packaging)) {
                            echo '<div class="detail">';
                            echo '<h2>Presentation / Packaging</h2>';
                            echo '<p>' . $presentation_packaging. '</p>';
                            echo '</div>';
                        }
                        if(!empty($regulatory_classification)) {
                            echo '<div class="detail">';
                            echo '<h2>Regulatory Classification</h2>';
                            echo '<p>' . $regulatory_classification . '</p>';
                            echo '</div>';
                        }
                    echo '</div>';  
                    
                    echo '<div class="related-products">';
                        woocommerce_output_related_products();
                    echo '<div>';
                }
            );

            apply_filters('woocommerce_product_related_products_heading', __( 'Other Products', 'woocommerce' ));

            add_action( 'woocommerce_after_shop_loop_item_title', function(){
                global $product; 

                $product_id = $product->get_id();
                $generic_name = get_post_meta($product_id, 'aios_genericname', true);
                echo '<span class="product-generic-name">' . $generic_name . '</span>';
            }, 6 );
            
            add_filter( 'woocommerce_output_related_products_args', function(){
                $args['posts_per_page'] = 3; // 4 related products
                $args['columns'] = 1; // arranged in 2 columns
                return $args;
            }, 20 );
        }

        function custom_checkout_field(){
            /* Custom Checkout Fields */
            add_action(
                'woocommerce_after_order_notes', 
                function($checkout){
                    echo '<div id="custom_checkout_field">
                        <h3>' . __('Other Details') . '</h3>';
                        woocommerce_form_field(
                            'hospital_name', 
                            array(
                                'type'          => 'text',
                                'class'         => array('my-field-class form-row-wide'),
                                'label'         => __('Hospital\'s Name'),
                                'placeholder'   => __('Enter Hospital Name'),
                                'required'      => true,
                            ),
                            $checkout->get_value('hospital_name')
                        );
                        woocommerce_form_field(
                            'doctor_name', 
                            array(
                                'type'          => 'text',
                                'class'         => array('my-field-class form-row-wide'),
                                'label'         => __('Doctor\'s Name'),
                                'placeholder'   => __('Enter Doctor\'s Name'),
                                'required'      => true,
                            ) ,
                            $checkout->get_value('doctor_name')
                        );
                    echo '</div>';
                }
            );

            /* Validate Custom Checkout Fields */
            add_action(
                'woocommerce_checkout_process', 
                function() {
                    $product_in_cart = $this->is_product_in_cart( array( 681, 685 ) );
                    if ( ! $_POST['hospital_name'] ){
                        if($product_in_cart){
                            wc_add_notice( __( '<strong>Hospital\'s Name</strong> is a required field' ), 'error' );
                        }
                    }
                    if ( ! $_POST['doctor_name'] ){
                        if($product_in_cart){
                            wc_add_notice( __( '<strong>Doctor\'s Name</strong> is a required field' ), 'error' );
                        }
                    }

                    if ( isset($_POST['prescription_val']) ){
                        if(empty($_POST['prescription_val']))
                            wc_add_notice( __( '<strong>Prescription</strong> is a required field' ), 'error' );
                    }
                }
            );

            /* Save Custom Checkout Fields in Order Metadata */
            add_action(
                'woocommerce_checkout_update_order_meta', 
                function($order_id){
                    if( isset($_POST['hospital_name']) ){
                        update_post_meta($order_id, 'hospital_name', sanitize_text_field( $_POST['hospital_name']) );
                    }

                    if( isset($_POST['doctor_name']) ){
                        update_post_meta($order_id, 'doctor_name', sanitize_text_field( $_POST['doctor_name']) );
                    }
                }
            );

            /* Show Custom Checkout Fields in Woocommerce Admin */
            add_action(
                'woocommerce_admin_order_data_after_billing_address',
                function($order){
                    echo '<p><strong>'.__('Hospital\'s Name').':</strong> <p>' . get_post_meta( $order->id, 'hospital_name', true ) . '</p></p>';
                    echo '<p><strong>'.__('Doctor\'s Name').':</strong> <p>' . get_post_meta( $order->id, 'doctor_name', true ) . '</p></p>';
                }
            );
        }

        function is_product_in_cart( $targeted_ids ) {
            $flag = false;
            if ( ! is_null( WC()->cart ) ) {
                foreach( WC()->cart->get_cart() as $cart_item ) {
                    if ( ! in_array( $cart_item['product_id'], $targeted_ids ) ) {
                        $flag = true;
                        break;
                    }
                }
            }
            return $flag;
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

        function add_upload_notes(){
            add_action(
                'woocommerce_after_order_notes', 
                function($checkout){
                    echo '<label style="margin-top: 15px; margin-bottom: 5px;"><em>Note: Discounts will be reflected once your ID is validated.</em></label>';
                    echo '<input type="hidden" name="prescription_val" id="prescription_val">';
                }
            );
        }
        
        function cash_on_delivery_status(){
            // register new post status
            register_post_status(
                'wc-cash-on-delivery', 
                array(
                    'label' => 'Cash on Delivery', 
                    'public' => true, 
                    'show_in_admin_status_list' => true,
                    'show_in_admin_all_list' => true,
                    'exclude_from_search'   => false,
                    'label_count'           => _n_noop( 'Cash on Delivery (%s)', 'Cash on Delivery (%s)' )
                )
            );

            /*
            * Override default order status. - Custom Work 
             */
            add_action( 
                'woocommerce_thankyou', 
                function($order_id){
                    $order = wc_get_order($order_id);
                    if(!empty($order->get_items('fee')) > 0 || $order->get_payment_method() == 'cod'){
                        $order->update_status('wc-on-hold');
                    }
                }, 
                10, 1
            );
        }

        function pwd_senior_coupon(){
            // Apply Coupon on Customer with PWD ID/Senior Citize n ID
            add_action(
                'woocommerce_before_cart', 
                function(){
                    $coupon_code = 'pwd-senior-citizen';
                    if(is_user_logged_in()){
                        $current_user = wp_get_current_user();
                        $id = get_current_user_id();
                        $user_image = get_field('customer_id', 'user_' . $id);
                        if(!empty($user_image)){
                            if ( WC()->cart->has_discount( $coupon_code ) ) return;
                            WC()->cart->apply_coupon( $coupon_code );
                            wc_print_notices();
                        }
                        else{
                            if ( WC()->cart->has_discount( $coupon_code ) ) return;
                            WC()->cart->remove_coupon( $coupon_code );
                        }
                    }
                }
            );
        }
    }
 
    $woocommerce_hooks = new woocommerce_hooks();
}