(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            completedEvents();
            upcomingEvents();
            sliderConfig();
            videoPlayer();
        }

        function completedEvents(){
            let $eventLoadMore = $('#completed-load-more');
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
                      action: 'completed_events',
                      offset: currentPage + numPost,
                      paged: paged,
                    },
                    success: function (res) {                        
                        numPost = numPost + 3;
                        $('.completed-events-content').append(res);
                        let maxnumpage = parseInt($('#completed-events').val());
                        if(paged == maxnumpage){
                            $('.load-more-container').hide();
                        }
                    },
                });
            });
        }

        function upcomingEvents(){
            let $eventLoadMore = $('#upcoming-load-more');
            let currentPage = 6;
            let paged = 2;
            let numPost = 0;
            $eventLoadMore.on('click', function(e){
                console.log("Clicked");
                e.preventDefault();
                paged++;
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    dataType: 'html',
                    data: {
                      action: 'upcoming_events',
                      offset: currentPage + numPost,
                      paged: paged,
                    },
                    success: function (res) {                        
                        numPost = numPost + 3;
                        $('.upcoming-events-contents').append(res);
                        let maxnumpage = parseInt($('#upcoming-events').val());
                        if(paged == maxnumpage){
                            $('.upcoming-load-more-container').hide();
                        }
                    },
                    error: function(res, a){
                        console.log(res);
                    }
                });
            });
        }

        function sliderConfig() {
            let $featuredevent = jQuery('.featured-event-slider');
            $featuredevent.slick({
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

        function videoPlayer(){
            let $videoContainer = $('.live-event-container');

            if(typeof w.Plyr === 'function'){
                var $target = $videoContainer.find('.what-plyr video');
                var plyr = new Plyr($target[0], {
                    controls: [
                        'play-large', 
                        'play', 
                        'progress', 
                        'current-time', 
                        'mute', 
                        'volume', 
                        'settings', 
                        'fullscreen'
                    ],
                });

            }
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