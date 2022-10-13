<?php 

if( !class_exists( 'agentpro_events_shortcodes' ) ) {
    class agentpro_events_shortcodes{
        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct(){
            add_shortcode( 'agentpro_events_archive', [ $this, 'agentpro_events_archive' ] );
            add_shortcode( 'featured_events_slider', [ $this, 'featured_events_slider' ] );
        }

        /* 
        *
        * Function Name: agentpro_events_archive() 
        * Generate Archive List of Events
        */
        public function agentpro_events_archive( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
                'order_by' => 'date',
                'post_status' => 'future',
                'thumbnail_size' => 'full',
                'view_more_link' => home_url() . '/events/',
                'view_more_text' => 'View More',
                'with_view_more' => false,
                'no_results_text' => 'No Events Found...',
                'show_attributes' => false,
            ], $atts );

            wp_enqueue_style( 'events-archive', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-archive.css' );

            extract( $atts ); // create variables using the above array keys

            $args = [
                'post_type' => 'events',
                'post_status' => $post_status,
                'order' => $order,
                'orderby' => $order_by,
                'posts_per_page' => $posts_per_page,
            ];

            $events_query = new WP_Query( $args );
            $events_total = $events_query->post_count;

            if ( $events_total > 0 ) {
                $events_posts = $events_query->posts;
                $groupPosts = array_chunk( $events_posts, 6 );

                $group_content = '';

                foreach( $groupPosts as $posts ) {
                    $row_index = 1;
                    $column_index = 1;
                    $delay = 0.1;

                    $group_content .= '
                        <div class="events-wrap">
                            <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true">Upcoming Events</h2>
                            <div class="events-content flex flex-wrap-wrap items-center justify-center"  data-aos="fade-up" data-aos-once="true">
                    ';
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $post_title = $post->post_title;
                        $month = date('M', strtotime($post->post_date));
                        $day = date('j', strtotime($post->post_date));
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, $thumbnail_size );
                        
                        $group_content .= '
                            <div class="event">
                                <div class="event-container">
                                    <div class="img-container">
                                        <canvas width="350" height="299"></canvas>
                                        <img src="' . $post_thumbnail_url . '" alt="' . $post_title . '" width="350" height="299" />
                                    </div>
                                    <p class="event-date">' . $day . ' <span>' . $month . '</span></p>
                                </div>
                                <h3>' . $post_title . '</h3>
                            </div>
                        ';
                    }          
                    
                    if ( $with_view_more == 'true' ) {
                        $group_content  .= '<a href="' . $view_more_link . '" class="view-more aios-btn aios-btn-red">' . $view_more_text . '</a>';
                    }

                    $group_content .= '
                        </div>
                    </div>
                    ';

                    $response .= '
                        <section id="events-section">
                            ' . $group_content . '
                        </div>';
                    
                    
                }

                wp_reset_postdata();
                wp_reset_query();

            }
            else{
                $response = $no_results_text;
            }
            return $response;
        }

        public function featured_events_slider( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
            ], $atts );
        
            extract( $atts ); // create variables using the above array keys

            wp_enqueue_style( 'event-slider', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-archive.css' );
            wp_enqueue_script( 'event-slider', get_stylesheet_directory_uri() . '/modules/events-post-type/js/events-archive.js' );
        
            $args = [
                'post_type' => 'events',
                'post_status' => array('publish', 'future'),
                'order' => $order,
                'posts_per_page' => $posts_per_page,
                'meta_query' =>[
                    [
                        'key' => 'featured-event',
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
                <section class="featured-events">
                    <div class="featured-events-wrap">
                        <div class="featured-event-slider">';
                            foreach( $posts as $key => $post ) {
                                $post_id = $post->ID;
                                $post_title = $post->post_title;
                                $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
                                $post_date = get_the_date( 'F j, Y', get_the_ID());
                                $post_url = get_permalink($post_id);
        
                                $return .= '
                                    <div class="event-slide" style="background-image: url(' . $post_thumbnail_url . ')">
                                        <div class="event-info">
                                            <h3 class="section-header">' . $post_title . '</h3>
                                            <p>' . $post_date . '</p>
                                            <p>' . ai_starter_theme_truncate_string( strip_tags( strip_shortcodes( $post->post_content ) ), 150, "..." ) . '</p>
                                            <a class="events-more aios-btn aios-btn-red" href="' . $post_url . '">Learn more</a>
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
    }

    $agentpro_events_shortcodes = new agentpro_events_shortcodes();
}