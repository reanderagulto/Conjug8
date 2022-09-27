(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            onScrollFixed();
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
        /**
         * Instantiate
         */
        __construct();
    });
    $(w).on('load', function () {
        $('body').addClass('siteloaded');
    });
})(jQuery, window, document, 'html', 'body');