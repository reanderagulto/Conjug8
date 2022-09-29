(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            sliderConfig();
        }
        function sliderConfig() {
            let $founderSlider = jQuery('.founder-slider');
            $founderSlider.slick({
                slidesToShow: 3,
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
                        slidesToScroll: 1,
                      }
                    }
                  ],
                nextArrow: $('.slider-nav.founder-next'),
                prevArrow: $('.slider-nav.founder-prev'),
            });
        }
        /**
         * Instantiate
         */
        __construct();
    });
    $(w).on('load', function () {
        
    });
})(jQuery, window, document, 'html', 'body');