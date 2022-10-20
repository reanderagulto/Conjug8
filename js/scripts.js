(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            refreshCartItems();
            onScrollFixed();
            burgerMenu();
            onPlusMinus();
            sliderConfig();
            showMorePosts();
            popup();
            addedToCart();
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

        function onPlusMinus(){
            $number = $('input[type="number"].qty');
            jQuery(document.body).on('click','input[type="button"].minus', function(){
                let $this = $(this);
                let $id = $this.attr('id').split('-')[1];
                if(parseInt($('#' + $id).val()) > 1){
                    $('#' + $id).val(parseInt($('#' + $id).val()) - 1);
                }
                $('#' + $id).trigger('change');
            });

            jQuery(document.body).on('click', 'input[type="button"].plus', function(){
                let $this = $(this);
                let $id = $this.attr('id').split('-')[1];
                $('#' + $id).val(parseInt($('#' + $id).val()) + 1);
                $('#' + $id).trigger('change');
            });
        }

        function sliderConfig(){
            let $featuredPost = jQuery('.featured-post-slider');
            $featuredPost.slick({
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

        function showMorePosts(){
            let $eventLoadMore = $('#see-more-posts');
            let currentPage = 6;
            let paged = 2;
            let numPost = 0;
            $eventLoadMore.on('click', function(e){
                e.preventDefault();
                paged++;
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    dataType: 'html',
                    data: {
                      action: 'show_more_posts',
                      offset: currentPage + numPost,
                      paged: paged,
                    },
                    success: function (res) {                        
                        numPost = numPost + 3;
                        $('.blog-archive-wrap').append(res);
                        let maxnumpage = parseInt($('#posts-max').val());
                        if(paged == maxnumpage){
                            $('.load-more-container').hide();
                        }
                    },
                });
            });
        }

        function popup(){
            $('.trigger-popup').click(function(){
                $('#choose-login-popup').addClass('active');
            }); 

            $('.popup-close, .popup-wrapper').click(function(){
                $('.popup-container').removeClass('active');
            });

            $('.popup-main').on('click', function (e) {
                e.stopImmediatePropagation();
            });

            $('.popup-cta-item .trigger-member-popup').click(function(){
                $('#login-form-popup').addClass('active');
                $('#choose-login-popup').removeClass('active');
            }); 

            $('.popup-return').click(function(){
                $('#login-form-popup').removeClass('active');
                $('#choose-login-popup').addClass('active');
            }); 
        }

        function addedToCart(){
            jQuery(document.body).on('click', '.ajax_add_to_cart', function(event){
                let $this = $(this); // Get button jQuery Object and set it in a variable
                let $id = $this.attr('data-product_id');
                if($this.hasClass('btn-slider')){
                    $('#slider-' + $id).addClass('added');
                }
                else if($this.hasClass('btn-loop')){
                    $('#loop-product-' + $id).addClass('added');
                }
                $('.header-cart-count').text(parseInt($('.header-cart-count').text()) + 1);
                jQuery(document.body).on('added_to_cart', function(event,b,data){
                    setTimeout(function() {
                        $this.removeClass('added');
                    }, 300);
                });
            });   

            $('.added-cart-text').on('click', function(){
                let $this = $(this);
                $this.parent().removeClass('added');
            });

            jQuery(document.body).on('click', 'button[name="update_cart"]', function(){
                let ek = $('.input-text.qty').map((_,el) => el.value).get();
                let total = 0;
                ek.forEach(element => {
                    total += parseInt(element);
                });
                $('.header-cart-count').text(total);
            });

            jQuery(document.body).on('click', '.woocommerce a.remove', function(){
                let $this = $(this);
                $id = $this.attr('data-product_id');
                $qty = $this.parent().siblings(".product-quantity").find('.quantity .qty-container .input-text.qty').val();
                $('.header-cart-count').text(parseInt($('.header-cart-count').text()) - $qty);
            })
        }

        function refreshCartItems(){
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                  action: 'cart_count_retriever',
                },
                success: function (res) {                        
                    $('.header-cart-count').text(res);
                },
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