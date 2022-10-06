( function($) {

	var app = {
		
		initTopPanel: function(){
		    jQuery(window).on('load scroll orientationchange', function () {
		        var currentScroll = window.pageYOffset || document.documentElement.scrollTop,
		            headerHeight = jQuery('header.header').height(),
		            fixedHeaderEl = jQuery('.ip-sp-top-panel');

	
			        if (currentScroll > headerHeight) {
			            fixedHeaderEl.addClass('active');
			        }
			        else {
			            fixedHeaderEl.removeClass('active');
			        }
		        
		    });
		},

		initGallerySlider: function() {
			$('.ip-sp-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: false,
				arrows: true,
				infinite: true,
				autoplay: false,
				autoplaySpeed: 5000,
				prevArrow: '.ip-sp-slider-controls .ip-sp-gallery-prev',
				nextArrow: '.ip-sp-slider-controls .ip-sp-gallery-next',
				fade: true
			});
		},

		initPostTabs: function(){
			$('.ip-sp-post-tab-item').on('click', function () {
			    var $this = $(this),
			        target = $this.data('tabaccess');

			    $('.ip-sp-post-tab-item').removeClass('active');
			    $this.addClass('active');

			    $('.ip-sp-post-holder[data-tabpanel]').hide();
			    $('.ip-sp-post-holder[data-tabpanel="' + target + '"]').show();
			});
		}
		
	}

	
	$(document).ready( function() {
		app.initTopPanel();
		app.initGallerySlider();
		app.initPostTabs();
	});
	
	$(window).on('load', function(){


	})


})(jQuery);
