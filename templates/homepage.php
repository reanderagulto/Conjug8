
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
<section id="hero-banner" data-aos="fade-up" data-aos-once="true">
    <div class="banner-wrap-slider">
        <?php if(!empty($topfold_banner['banner_slider'])): ?>
            <?php foreach($topfold_banner['banner_slider'] as $banner): ?>
                <div class="banner-container">
                    <div class="banner-col">
                        <?php if(!empty($banner['content'])): ?>
                            <?php echo $banner['content']; ?>
                        <?php endif; ?>
                    </div>
                    <div class="accent-bg">
                        <div class="accent-red"></div>
                        <div class="accent-blue"></div>
                    </div>
                    <div class="banner-background">
                        <div class="banner-image">
                            <?php if(!empty($banner['background_image'])): ?>
                                <img src="<?php echo $banner['background_image']['url'];?>" width="<?php echo $banner['background_image']['width'];?>" height="<?php echo $banner['background_image']['height'];?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>    
</section>
<?php endif; ?>
<!-- End of Topfold Banner -->

<!-- Start of Products Slider Section -->
<?php echo do_shortcode('[products_slider]'); ?>
<!-- End of Products Slider Section -->

<!-- Start of Icons  -->
<section id="icons-section">
    <div class="icons-wrap">
        <div class="icons-container flex justify-around" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">
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
        <div class="about-content" data-aos="fade-right" data-aos-once="true">
            <h2 class="section-header">
                <?=(!empty($about_header) ? do_shortcode($about_header) : ''); ?>
            </h2>
            <h3 class="section-subheader">
                <?=(!empty($about_subheader) ? do_shortcode($about_subheader) : ''); ?>
            </h3>
            <p><?=(!empty($about_content) ? do_shortcode($about_content) : ''); ?></p>
            <a href="<?php echo do_shortcode($about_read_more); ?>" class="aios-btn aios-btn-red">Read More</a>
        </div>
        <div class="about-img" data-aos="fade-up" data-aos-once="true">            
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