
<?php 

/*
 * Template Name: Homepage
 */

get_header();

?>
<!-- Start Topfold Banner -->
<section id="hero-banner">
    <div class="banner-col">
        <div class="banner-text-container">
            <h1>High quality, effective and safe treatments for neuropsychiatric illnesses and disorders.</h1>
        </div>
        <div class="banner-button-container">
            <a href="#" class="aios-btn aios-btn-white">Buy Now</a>
            <a href="tel: +63282524028" class="aios-btn aios-btn-transparent">+63 2 8252 4028</a>
        </div>
    </div>
</section>
<!-- End of Topfold Banner -->

<!-- Start of Products Slider Section -->
<section id="product-section">
    <div class="product-section-wrap">
        <div class="product-header-nav flex items-center justify-between">
            <h2 class="section-header">
                Our Products
            </h2>
            <div class="product-nav">
                <a href="http://" class="aios-btn-sm aios-btn-red">View Products</a>
            </div>
        </div>

        <div class="product-slider">
                <div class="product-slide">
                    <div class="product-img">
                        <canvas width="350" height="280"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/product-slide-1.png" width="350" height="280" alt="Neurotain Plus"/>
                    </div>
                    <div class="product-info">
                        <h3>Neurotain Plus <span></span></h3>
                        <a href="#" class="aios-btn aios-btn-red">Buy Now</a>
                    </div>
                </div>

                <div class="product-slide">
                    <div class="product-img">
                        <canvas width="350" height="280"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/product-slide-2.png" width="350" height="280" alt="Ricoverin Plus"/>
                    </div>
                    <div class="product-info">
                        <h3>Ricoverin Plus<span></span></h3>
                        <a href="#" class="aios-btn aios-btn-red">Buy Now</a>
                    </div>
                </div>

                <div class="product-slide">
                    <div class="product-img">
                        <canvas width="350" height="280"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/product-slide-3.png" width="350" height="280" alt="Ricoverin Plus"/>
                    </div>
                    <div class="product-info">
                        <h3>Zonia-10<span>Olanzapine</span></h3>
                        <a href="#" class="aios-btn aios-btn-red">Buy Now</a>
                    </div>
                </div>

                <div class="product-slide">
                    <div class="product-img">
                        <canvas width="350" height="280"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/product-slide-3.png" width="350" height="280" alt="Ricoverin Plus"/>
                    </div>
                    <div class="product-info">
                        <h3>Conjupram<span>Escitalopram</span></h3>
                        <a href="#" class="aios-btn aios-btn-red">Buy Now</a>
                    </div>
                </div>
                
            </div>
    </div>
</section>
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
<section id="about-section">
    <div class="about-wrap">
        <div class="about-content">
            <h2 class="section-header">About the Company</h2>
            <h3 class="section-subheader">Who we are</h3>
            <p>Conjug8 Corporation was established in July 2010 by a group of leading health practitioners in the neurosciences. These health practitioners are considered the pillars of the neurosciences in the Philippines, having more than 200 years of combined practice. The term CONJUG8 hails from the word conjugate, which means to connect, in reference to the synapses of the brain.</p>
            <a href="#" class="aios-btn-sm aios-btn-red">Read More</a>
        </div>
        <div class="about-img">
            <div class="img-container">
            <canvas width="1012" height="549" ></canvas>
            <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/about-banner.png" width="1012" height="549" class="img-responsive" alt="About the Company">
            </div>
        </div>
    </div>
</section>
<!-- End of About the Company -->

<?php get_footer(); ?>