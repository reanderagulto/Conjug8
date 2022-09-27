
<?php 

/*
 * Template Name: Homepage
 */

get_header();
$post_id = get_the_ID();
$post_fields = get_fields( );
$fields_to_get = array(
    'topfold_banner',
    'product_section',
    'about_company',
    'founder_section',
);
foreach ( $fields_to_get as $field ) {
    ${$field} = $post_fields[ $field ];
}

?>
<!-- Start Topfold Banner -->
<?php if(!empty($topfold_banner)): ?>
<section id="hero-banner">
    <div class="banner-col">
        <div class="banner-text-container">
            <h1>
                <?php
                    // for title
                    $banner_text = $topfold_banner[ 'banner_text' ] ?? '';
                    echo (!empty($banner_text) ? do_shortcode( $banner_text ) : '');
                    unset( $banner_text );
                ?>
            </h1>
        </div>
        <div class="banner-button-container">
            <?php $buy_now_link = $topfold_banner[ 'topfold_cta' ][ 'buy_now_link' ]; ?>
            <?php $topfold_phone = $topfold_banner[ 'topfold_cta' ][ 'topfold_phone_number' ]; ?>
            <a href="<?php echo (!empty($buy_now_link) ? do_shortcode( $buy_now_link ) : '#' ); ?>" class="aios-btn aios-btn-white">Buy Now</a>
            <a href="<?php echo (!empty($topfold_phone) ? 'tel: ' . do_shortcode( $topfold_phone ) : '#' ); ?>" class="aios-btn aios-btn-transparent">
                <?php echo (!empty($topfold_phone) ? do_shortcode( $topfold_phone ) : ''); ?>
            </a>
            <?php unset($buy_now_link, $topfold_phone); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- End of Topfold Banner -->

<!-- Start of Products Slider Section -->
<?php if(!empty($product_section)): ?>
<section id="product-section">
    <div class="product-section-wrap">
        <div class="product-header-nav flex items-center justify-between">
            <h2 class="section-header">
                <?php 
                    $product_title = $product_section[ 'product_title' ] ?? '';
                    echo (!empty($product_title) ? do_shortcode( $product_title ) : '');
                    unset( $product_title );
                ?>
            </h2>
            <div class="product-nav flex items-center">
                <a href="#" class="aios-btn-sm aios-btn-red">View Products</a>
                <button type="button" class="aios-btn-sm aios-btn-red slider-nav prod-prev"><i class="ai-font-arrow-h-p"></i></button>
                <button type="button" class="aios-btn-sm aios-btn-red slider-nav prod-next"><i class="ai-font-arrow-h-n"></i></button>
            </div>
        </div>
        <?php 
            $product_slides = $product_section[ 'product_slider' ] ?? '';
            if ( !empty( $product_slides ) ) {
                /* For Product Slider */
                $slidesHTML = '';
                foreach ($product_slides as $item) {
                    $slidesHTML .= '
                        <div class="product-slide">
                            <div class="product-img">
                                <canvas width="' . $item['image']['width'] . '" height="' . $item['image']['height'] . '"></canvas>
                                <img src="' . $item['image']['url'] . '" width="' . $item['image']['width'] . '" height="' . $item['image']['height'] . '" alt="' . $item['image']['alt'] . '"/>
                            </div>
                            <div class="product-info">
                                <h3>' . $item['name'] . ' <span>' . $item['subname'] . '</span></h3>
                                <a href="' . $item['buy_link'] . '" class="aios-btn aios-btn-red">Buy Now</a>
                            </div>
                        </div>';
                } ?>
            <div class="product-slider">
                <?php echo $slidesHTML; ?>
            </div>          
            <?php 
                unset( $product_slides, $slidesHTML);
            } ?>
    </div>
</section>
<?php endif; ?>
<!-- End of Products Slider Section -->

<!-- Start of Icons  -->
<section id="icons-section">
    <div class="icons-wrap">
        <div class="icons-container flex justify-between">
            <div class="icon">
                <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/lightbulb.png" class="img-responsive" width="68" height="88" alt="Sharp Brain" >
                <h3>Sharp Brain</h3>
            </div>
            <div class="icon">
                <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/brain.png" class="img-responsive" width="84" height="78" alt="Sound Mind" >
                <h3>Sound Mind</h3>
            </div>
            <div class="icon">
                <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/heart-beat.png" class="img-responsive" width="77" height="77" alt="Healty Life" >
                <h3>Healthy Life</h3>
            </div>
        </div>
    </div>
</section>
<!-- End of Icons -->

<!-- Start of About the Company -->
<?php if(!empty($about_company)): ?>
<?php 
    $about_image = $about_company[ 'image' ];
    $about_header = $about_company[ 'about_company_content' ]['about_header'] ?? '';
    $about_subheader = $about_company[ 'about_company_content' ]['about_subheader'] ?? '';
    $about_content = $about_company[ 'about_company_content' ]['about_content'] ?? '';
    $about_read_more = $about_company[ 'about_company_content' ]['about_read_more'] ?? '';
?>
<section id="about-section">
    <div class="about-wrap">
        <div class="about-content">
            <h2 class="section-header">
                <?=(!empty($about_header) ? do_shortcode($about_header) : ''); ?>
            </h2>
            <h3 class="section-subheader">
                <?=(!empty($about_subheader) ? do_shortcode($about_subheader) : ''); ?>
            </h3>
            <p><?=(!empty($about_content) ? do_shortcode($about_content) : ''); ?></p>
            <a href="<?php echo do_shortcode($about_read_more); ?>" class="aios-btn-sm aios-btn-red">Read More</a>
        </div>
        <div class="about-img">            
            <div class="img-container">
                <canvas width="<?=$about_image['width']; ?>" height="<?=$about_image['height']; ?>" ></canvas>
                <img src="<?=$about_image['url']; ?>" width="<?=$about_image['width']; ?>" height="<?=$about_image['height']; ?>" class="img-responsive" alt="About the Company">
            </div>
        </div>
    </div>
</section>
<?php 
    unset($about_image, $about_header, $about_subheader, $about_content, $about_read_more);
?>
<?php endif; ?>
<!-- End of About the Company -->

<?php echo do_shortcode('[agentpro_board_members_slider]'); ?>

<?php get_footer(); ?>