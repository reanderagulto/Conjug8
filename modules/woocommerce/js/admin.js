(function ($, w, d, h, b) {
    $(document).ready(function () {
        /**
         * Construct.
         */
        function __construct() {
            fileApproved();
        }

        function fileApproved(){
            jQuery('body').on('click', '#fme_accept_btn', function(){
                "use strict";
                let postID = jQuery('#post_ID').val();
                let $this = jQuery(this);
                let url = $this.siblings('a').attr('href');
                console.log(url);
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'html',
                    data: {
                        action: 'product_admin_approve',
                        edit_post_id: postID,
                        edit_url: url,
                    },
                    success: function (res) {      
                        console.log(res);
                    }
                });
            });
        }
        
        /**
         * Instantiate
         */
        __construct();
    });
    $(w).on('load', function () {

    });
})(jQuery, window, document, 'html', 'body');