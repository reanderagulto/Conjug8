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