(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            eventsLoadMore();
        }

        function eventsLoadMore(){
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

        /**
         * Instantiate
         */
        __construct();
    });
    $(w).on('load', function () {
        $('body').addClass('siteloaded');
    });
})(jQuery, window, document, 'html', 'body');