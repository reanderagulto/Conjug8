(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            onScrollFixed();
            burgerMenu();
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
        function burgerMenu() {

			const $menu = $('.burger-menu');
			const $menuBody = $('.inside-nav');
			const $close = $('.nav-close');
			const $menuContainer = $('.navigation');

			let mouse_is_inside = false;


			$menu.on('click', function () {
				$menuBody.addClass('active')
			});
			$close.on('click', function () {
				$menuBody.removeClass('active')
			});



			$menuContainer.hover(function () {
				mouse_is_inside = true;
				
			}, function () {
				mouse_is_inside = false;
			});

			$menuBody.on('click', function () {
				if (mouse_is_inside == false) {
					$menuBody.removeClass('active');
				}
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