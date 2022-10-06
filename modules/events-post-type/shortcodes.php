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
        }

        /* 
        *
        * Function Name: agentpro_events_archive() 
        * Generate Archive List of Board Members
        */
        public function agentpro_events_archive( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
                'order_by' => 'date',
                'thumbnail_size' => 'full',
                'view_more_link' => home_url() . '/events/',
                'view_more_text' => 'View More Board Members',
                'with_view_more' => false,
                'no_results_text' => 'No Upcoming Events Found...',
                'show_attributes' => false,
            ], $atts );

            wp_enqueue_style( 'events-archive', get_stylesheet_directory_uri() . '/modules/events-post-type/css/events-archive.css' );

            extract( $atts ); // create variables using the above array keys

            $args = [
                'post_type' => 'events',
                'post_status' => 'future',
                'order' => $order,
                'orderby' => $order_by,
                'posts_per_page' => $posts_per_page,
            ];

            $events_query = new WP_Query( $args );
            $events_total = $events_query->post_count;

            if ( $events_total > 0 ) {
                $events_posts = $events_query->posts;

                if ( $with_view_more == 'true' ) {
                    $groupPosts = array_chunk( $events_posts, 4 );
                }
                else {
                    $groupPosts = array_chunk( $events_posts, 6 );
                }

                $group_content = '';

                foreach( $groupPosts as $posts ) {
                    $row_index = 1;
                    $column_index = 1;
                    $delay = 0.1;
                    $column_settings = [
                        [
                            "items" => 3,
                            "sizes" => [
                                [
                                    "width" => 660,
                                    "height" => 373
                                ],
                                [
                                    "width" => 327,
                                    "height" => 183
                                ],
                                [
                                    "width" => 327,
                                    "height" => 183
                                ]
                            ]
                        ],
                        [
                            "items" => 1,
                            "sizes" => [
                                [
                                    "width" => 960,
                                    "height" => 800
                                ]
                            ]
                        ],
                        [
                            "items" => 3,
                            "sizes" => [
                                [
                                    "width" => 327,
                                    "height" => 183
                                ],
                                [
                                    "width" => 327,
                                    "height" => 183
                                ],
                                [
                                    "width" => 327,
                                    "height" => 183
                                ]
                            ]
                        ]
                    ];

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

                    $group_content .= '
                        </div>
                    </div>
                    ';

                    $response .= '
                        <section id="events-section">
                            ' . $group_content . '
                        </div>
                    ';
                }

                wp_reset_postdata();
                wp_reset_query();

            }
            return $response;
        }
    }

    $agentpro_events_shortcodes = new agentpro_events_shortcodes();
}