(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            onScrollFixed();
            sliderConfig();
        }
        function onScrollFixed() {
            this.onScrollFixed = function () {
                const $header = $('.header');
                $(w).on('load scroll', function () {
                    let currentScroll = w.pageYOffset || d.documentElement.scrollTop;
                    let isDesktop = w.matchMedia('(min-width: 992px)').matches;
                    if (isDesktop) {
                        if (currentScroll > 0) {
                            $header.addClass('scrolled');
                        }
                        else {
                            $header.removeClass('scrolled');
                        }
                    }
                    else {
                        $header.removeClass('scrolled');
                    }
                });
            }
            this.onScrollFixed();
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

            let $founderSlider = jQuery('.founder-slider');
            $founderSlider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                infinite: true,
                // autoplay: true,
                // autoplaySpeed: 3000,
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
        $('body').addClass('siteloaded');
    });
})(jQuery, window, document, 'html', 'body');