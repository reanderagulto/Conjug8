<?php 

if( !class_exists('blog_posts_hooks')) {
    class blog_posts_hooks{

        function __construct(){
            $this->blogposts_page();
            add_shortcode( 'featured_post_slider', [ $this, 'featured_post_slider' ] );
        }

        function blogposts_page(){
            add_action( 'add_meta_boxes', [$this, 'add_featured_metabox'] );
            add_action( 'save_post', [$this, 'save_featured_metabox'] );
        }

        function add_featured_metabox(){
            add_meta_box( 'featured_post', __('Featured post', 'aios-textdomain'), [$this, 'display_featured_metabox'], 'post', 'side', 'high' );
        }

        function display_featured_metabox( $post ){
            wp_nonce_field( basename( __FILE__ ), 'featured_post_nonce' );
            $stored_meta = get_post_meta( $post->ID ); ?>
            <label for="featured-post">
                <input type="checkbox" name="featured-post" id="featured-post" value="yes" <?php if ( isset ( $stored_meta['featured-post'] ) ) checked( $stored_meta['featured-post'][0], 'yes' ); ?> />
                <?php _e( 'Is featured?', 'aios-textdomain' )?>
            </label>
        <?php }

        function save_featured_metabox( $post_id ) {
            $is_autosave = wp_is_post_autosave( $post_id );
            $is_revision = wp_is_post_revision( $post_id );
            $is_valid_nonce = ( isset( $_POST[ 'featured_post_nonce' ] ) && wp_verify_nonce( $_POST[ 'featured_post_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

            // Exits script depending on save status
            if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
                return;
            }

            // Checks for input and saves - save checked as yes and unchecked at no
            if( isset( $_POST[ 'featured-post' ] ) ) {
                update_post_meta( $post_id, 'featured-post', 'yes' );
            } else {
                update_post_meta( $post_id, 'featured-post', 'no' );
            }
        }

        public function featured_post_slider( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
            ], $atts );

            extract( $atts ); // create variables using the above array keys

            $args = [
                'post_type' => 'post',
                'post_status' => 'publish',
                'order' => $order,
                'posts_per_page' => $posts_per_page,
                'meta_query' =>[
                    [
                        'key' => 'featured-post',
                        'value' => 'yes',
                        'compare' => '='
                    ]
                ],
            ];

            $posts_query = new WP_Query( $args );
            $posts_total = $posts_query->post_count;

            if($posts_total > 0){
                $return = '';
                $posts = $posts_query->posts;

                $return .= '
                <section class="featured-posts">
                    <div class="featured-posts-wrap">
                        <div class="featured-post-slider">';
                            foreach( $posts as $key => $post ) {
                                $post_id = $post->ID;
                                $post_title = $post->post_title;
                                $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
                                $post_date = get_the_date( 'F j, Y', get_the_ID());
                                $post_url = get_permalink($post_id);

                                $return .= '
                                    <div class="post-slide" style="background-image: url(' . $post_thumbnail_url . ')">
                                        <div class="post-info">
                                            <h3 class="section-header">' . $post_title . '</h3>
                                            <p>' . $post_date . '</p>
                                            <p>' . ai_starter_theme_truncate_string( strip_tags( strip_shortcodes( $post->post_content ) ), 150, "..." ) . '</p>
                                            <a class="archive-more aios-btn aios-btn-red" href="' . $post_url . '">Read more</a>
                                        </div>
                                    </div>';
                            }
                $return .= '
                        </div>
                        <div class="slider-navs">
                            <button type="button" class="aios-btn aios-btn-transparent slider-nav prod-prev"><i class="ai-font-arrow-h-p"></i></button>
                            <button type="button" class="aios-btn aios-btn-transparent slider-nav prod-next"><i class="ai-font-arrow-h-n"></i></button>
                        </div>
                        <div class="accent-bg">
                            <div class="accent-red">
                        </div>
                    </div>
                </section>';

                wp_reset_postdata();
                wp_reset_query();
            }
            else{
                $return = "No Post(s) Found";
            }
            return $return;

        }

    }

    $blog_posts_hooks = new blog_posts_hooks();
}