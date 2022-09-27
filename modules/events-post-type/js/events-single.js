(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            videoPlayer();
        }

        function videoPlayer(){
            let $videoContainer = $('.events-single');

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