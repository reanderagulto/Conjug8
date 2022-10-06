(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            sliderConfig();
            contactFormPopup();
        }
        function sliderConfig() {
            let $topfolderSlider = jQuery('.banner-wrap-slider');
            $topfolderSlider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 5000,
            })
        }

        function contactFormPopup(){
            let $contactButton = jQuery('#mobile-contact');
            let $contactContainer = jQuery('.contact-form');
            let $contactMain = jQuery('.contact-form-main');
            let $contactClose = jQuery('#contact-close');
            $contactButton.on('click', function(){
                $contactContainer.addClass('active');
                $contactMain.addClass('mobile');
            });

            $contactClose.on('click', function(){
                $contactContainer.removeClass('active');
                $contactMain.removeClass('mobile');
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