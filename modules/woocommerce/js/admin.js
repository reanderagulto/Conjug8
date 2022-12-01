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
                let postID = jQuery('#post_ID').val();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'html',
                    data: {
                        action: 'product_admin_approve',
                        edit_post_id: postID,
                    },
                    success: function (res) {      
                        console.log(res + ' ' + postID);
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