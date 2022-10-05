(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            sliderConfig();
        }
        function sliderConfig() {
            let $productSlider = jQuery('.product-slider');
            $productSlider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                infinite: true,
                // autoplay: true,
                // autoplaySpeed: 3000,
                responsive: [
                    {
                      breakpoint: 992,
                      settings: {
                        slidesToShow: 2,
                      }
                    },
                    {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: 1,
                      }
                    }
                  ],
                nextArrow: $('.slider-nav.prod-next'),
                prevArrow: $('.slider-nav.prod-prev'),
            });

            let $featuredProduct = jQuery('.featured-product-slider');
            $featuredProduct.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                infinite: true,
                draggable: false,
                // autoplay: true,
                // autoplaySpeed: 3000,
                nextArrow: $('.slider-nav.prod-next'),
                prevArrow: $('.slider-nav.prod-prev'),
            });

        }
        
        /**
         * Instantiate
         */
        __construct();
    });
    $(w).on('load', function () {
        $('body').addClass('siteloaded');
    });
})(jQuery, window, document, 'html', 'body');