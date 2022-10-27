(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            showUpcomingEvents();
            showCompletedEvents();
            completedEvents();
            upcomingEvents();
            sliderConfig();
            videoPlayer();
        }

        
        function showUpcomingEvents(){
            let post_per_page = 6;
            let paged = 1;
            let offset = 0;
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'html',
                data: {
                    action: 'upcoming_events',
                    offset: offset,
                    paged: paged,
                    post_per_page: post_per_page,
                },
                success: function (res) {      
                    $('.upcoming-events-contents').append(res);
                    let maxPost = parseInt($('#upcoming-events').val());
                    console.log(maxPost);
                    if(maxPost > 1){
                        let html = '<div class="upcoming-load-more-container" data-aos="fade-up" data-aos-once="true"><a href="#!" class="aios-btn aios-btn-red" id="upcoming-load-more">View More</a></div>';
                        $('.events-wrap').append(html);
                    }
                },
            });
        }

        function upcomingEvents(){
            let currentPage = 6;
            let paged = 2;
            let numPost = 0;
            jQuery(document.body).on('click', '#upcoming-load-more', function(e){
                console.log("Clicked");
                e.preventDefault();
                paged++;
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
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
                        if(paged >= maxnumpage){
                            $('.upcoming-load-more-container').hide();
                        }
                    },
                    error: function(res, a){
                        console.log(res);
                    }
                });
            });
        }


        function showCompletedEvents(){
            let post_per_page = 6;
            let paged = 1;
            let offset = 0;
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'html',
                data: {
                    action: 'completed_events',
                    offset: offset,
                    paged: paged,
                    post_per_page: post_per_page,
                },
                success: function (res) {      
                    $('.completed-events-content').html(res);
                    let maxPost = parseInt($('#completed-events').val());
                    if(maxPost > 1){
                        let html = '<div class="load-more-container" data-aos="fade-up" data-aos-once="true"><a href="#!" class="aios-btn aios-btn-red" id="completed-load-more">See More</a></div>';
                        $('.completed-events-wrap').append(html);
                    }
                },
            });
        }

        function completedEvents(){
            let currentPage = 6;
            let post_per_page = 3;
            let paged = 2;
            let numPost = 0;
            jQuery(document.body).on('click', '#completed-load-more', function(e){
                e.preventDefault();
                paged++;
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'html',
                    data: {
                      action: 'completed_events',
                      offset: currentPage + numPost,
                      paged: paged,
                      post_per_page: post_per_page,
                    },
                    success: function (res) {                        
                        numPost = numPost + 3;
                        $('.completed-events-content').append(res);
                        let maxnumpage = parseInt($('#completed-events').val());
                        if(paged >= maxnumpage){
                            $('.load-more-container').hide();
                        }   
                    },
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