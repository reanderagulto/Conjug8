
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
            <div class="product-nav flex items-center">
                <a href="#" class="aios-btn-sm aios-btn-red">View Products</a>
                <button type="button" class="aios-btn-sm aios-btn-red slider-nav prod-prev"><i class="ai-font-arrow-h-p"></i></button>
                <button type="button" class="aios-btn-sm aios-btn-red slider-nav prod-next"><i class="ai-font-arrow-h-n"></i></button>
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

<!-- Start of Brains Behind the Company -->
<section id="founders-section">
    <div class="founder-wrap">
        <div class="founder-nav flex items-center justify-between">
            <h2 class="section-header">
                The Brains Behind The Company
            </h2>
            <div class="the-company-nav flex items-center">
                <button type="button" class="aios-btn-sm aios-btn-red slider-nav founder-prev"><i class="ai-font-arrow-h-p"></i></button>
                <button type="button" class="aios-btn-sm aios-btn-red slider-nav founder-next"><i class="ai-font-arrow-h-n"></i></button>
            </div>
        </div>
        <div class="founder-slider">
            <div class="founder-slide">
                <div class="founder-img">
                    <canvas width="350" height="473"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/founder-placeholder.png" width="350" height="473" alt="Neurotain Plus"/>
                </div>
                <div class="founder-info">
                    <h3>Remus V. Magabilen <span>MD, FPCPSYCH</span></h3>
                    <p>President & Chief Executive Officer</p>
                </div>
            </div>
            <div class="founder-slide">
                <div class="founder-img">
                    <canvas width="350" height="473"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/founder-placeholder.png" width="350" height="473" alt="Neurotain Plus"/>
                </div>
                <div class="founder-info">
                    <h3>Jose C. Navarro <span>MD, MSC.CLIN.EPI., FPNA, FPCCM</span></h3>
                    <p>Vice President & Chief Operating Officer</p>
                </div>
            </div>
            <div class="founder-slide">
                <div class="founder-img">
                    <canvas width="350" height="473"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/founder-placeholder.png" width="350" height="473" alt="Neurotain Plus"/>
                </div>
                <div class="founder-info">
                    <h3>Angel V. Luna <span>MD, FPNA</span></h3>
                    <p>Treasurer & Chief Financial Officer</p>
                </div>
            </div>
            <div class="founder-slide">
                <div class="founder-img">
                    <canvas width="350" height="473"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/founder-placeholder.png" width="350" height="473" alt="Neurotain Plus"/>
                </div>
                <div class="founder-info">
                    <h3>Ramon S. Javier <span>MD, FPNA, FPPA</span></h3>
                    <p>Corporate Secretary</p> 
                </div>
            </div>
            <div class="founder-slide">
                <div class="founder-img">
                    <canvas width="350" height="473"></canvas>
                    <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/founder-placeholder.png" width="350" height="473" alt="Neurotain Plus"/>
                </div>
                <div class="founder-info">
                    <h3>Ramon S. Javier <span>MD, FPNA, FPPA</span></h3>
                    <p>Corporate Secretary</p> 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Brains Behind the Company -->

<!-- Start of Newsletter Section -->
<section id="newsletter-section">
    <div class="newsletter-wrap">
        <div class="newsletter-content">
            <h2 class="newsletter-header">Stay updated, stay informed with <br/ > our latest and upcoming activities</h2>
            <div class="newsletter-form flex items-center justify-center">
                <input type="email" name="newsletter-email" id="newsletter-email" placeholder="Insert your email">
                <button type="submit" class="aios-btn aios-btn-red">Submit</button>
            </div>
        </div>
    </div>
</section>
<!-- End of Newsletter Section -->

<!-- Start of Events Section -->
<section id="events-section">
    <div class="events-wrap">
        <h2 class="section-header text-center">
            Upcoming Events
        </h2>
        <div class="events-content flex items-center justify-center">
            <div class="event">
                <div class="event-container">
                    <div class="img-container">
                        <canvas width="350" height="299"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/event-1.png" alt="Stroke Rehabilitation" class="img-responsive" width="350" height="299" />
                    </div>
                    <p class="event-date">03 <span>Sept</span></p>
                    <div class="happen-now">
                        <p>Happening Now</p>
                    </div>
                </div>
                <h3>Stroke Rehabilitation</h3>
            </div>

            <div class="event">
                <div class="event-container">
                    <div class="img-container">
                        <canvas width="350" height="299"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/event-2.png" alt="Aducanumab" class="img-responsive" width="350" height="299" />
                    </div>
                    <p class="event-date">26 <span>Aug</span></p>
                </div>
                <h3>Aducanumab</h3>
            </div>

            <div class="event">
                <div class="event-container">
                    <div class="img-container"> 
                        <canvas width="350" height="299"></canvas>
                        <img src="<?=do_shortcode('[stylesheet_directory]')?>/images/event-3.png" alt="The Promise of Neuroplasticity" class="img-responsive" width="350" height="299" />
                    </div>
                    <p class="event-date">19 <span>Feb</span></p>
                </div>
                <h3>The Promise of Neuroplasticity</h3>
            </div>
        </div>
        <div class="events-button">
            <a href="#" class="aios-btn aios-btn-red">View More</a>
        </div>
    </div>
</section>
<!-- End of Events Section -->

<?php get_footer(); ?>