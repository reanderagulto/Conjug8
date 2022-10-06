<?php 

if( !class_exists('blog_posts_hooks')) {
    class blog_posts_hooks{

        function __construct(){
            $this->blogposts_page();
            add_shortcode( 'featured_post_slider', [ $this, 'featured_post_slider' ] );

            // Ajax Functions
            add_action('wp_ajax_show_more_posts', array($this, 'show_more_posts'));
            add_action('wp_ajax_nopriv_show_more_posts', array($this, 'show_more_posts'));
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
                            <button type="button" class="aios-btn aios-btn-transparent slider-nav prod-prev ai-font-arrow-b-p"></button>
                            <button type="button" class="aios-btn aios-btn-transparent slider-nav prod-next ai-font-arrow-b-n"></button>
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

        function show_more_posts(){
            $ajaxposts = new WP_Query([
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'offset' => $_POST['offset'],
            ]);

            $max_pages = $ajaxposts->max_num_pages;
            if($ajaxposts->have_posts()): 
                while($ajaxposts->have_posts()): $ajaxposts->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  data-aos="fade-up" data-aos-once="true">
                        <input type="hidden" id="posts-max" value="<?php echo $max_pages; ?>" />
                        <div class="entry">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="archive-thumbnail">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
                                </div>
                            <?php endif ?>
                            <div class="archive-content-container">
                                <div class="archive-date">
                                    <?php echo get_the_date( 'F j, Y', get_the_ID() ); ?>
                                </div>
                                <div class="archive-content <?php echo has_post_thumbnail() ? "archive-has-thumbnail" : "" ?>">
                                    <h2 class="archive-subtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <p>
                                        <?php if ( has_excerpt( get_the_ID() ) ) : ?>
                                            <?php the_excerpt(); ?>
                                        <?php else: ?>
                                            <?php echo ai_starter_theme_truncate_string( strip_tags( strip_shortcodes( get_the_content() ) ), 75, "..." ) ?>
                                        <?php endif ?>
                                    </p>
                                    <a class="archive-more" href="<?php the_permalink() ?>">Read more</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                <?php endwhile;
            endif; 
            wp_die();

        }
    }

    $blog_posts_hooks = new blog_posts_hooks();
}