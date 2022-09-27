<?php 

if( !class_exists( 'agentpro_board_members_shortcodes' ) ) {
    class agentpro_board_members_shortcodes{
        /* 
        *
        * Function Name: __construct() 
        *
        */
        function __construct(){
            add_shortcode( 'agentpro_board_members_archive', [ $this, 'agentpro_board_members_archive' ] );
        }

        /* 
        *
        * Function Name: agentpro_board_members_archive() 
        * Generate Archive List of Board Members
        */
        public function agentpro_board_members_archive( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
                'order_by' => 'title',
                'thumbnail_size' => 'full',
                'view_more_link' => home_url() . '/board-members/',
                'view_more_text' => 'View More Board Members',
                'with_view_more' => false,
                'no_results_text' => 'No Board Members Found...',
                'show_attributes' => false,
            ], $atts );

            // for shortcode attributes helper
            if ( $atts[ 'show_attributes' ] ) {
                echo '<pre>';
                var_dump( $atts );
                echo '</pre>';
                
                return;
                exit;
            }

            extract( $atts ); // create variables using the above array keys

            $args = [
                'post_type' => 'board-members',
                'post_status' => 'publish',
                'order' => $order,
                'orderby' => $order_by,
                'posts_per_page' => $posts_per_page,
            ];

            $board_members_query = new WP_Query( $args );
            $board_members_total = $board_members_query->post_count;

            if ( $board_members_total > 0 ) {
                $board_members_posts = $board_members_query->posts;

                if ( with_view_more == 'true' ) {
                    $groupPosts = array_chunk( $board_members_posts, 4 );
                }
                else {
                    $groupPosts = array_chunk( $board_members_posts, 6 );
                }

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

                    $group_content = '';

                    if ( $with_view_more == 'true' ) {
                        $posts[] = [ 'fc_title_holder' => true ];
                    }

                    foreach( $posts as $key => $post ) {
                        if ( ! array_key_exists( 'fc_title_holder', $post ) ) {
                            $post_id = $post->ID;
                            $post_title = $post->post_title;
                            $post_permalink = get_the_permalink( $post_id );
                            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, $thumbnail_size );
                        }
                        
                        // canvas size
                        $canvas_width = $column_settings[ $row_index - 1 ][ 'sizes' ][ $column_index -1 ][ 'width' ];
                        $canvas_height = $column_settings[ $row_index - 1 ][ 'sizes' ][ $column_index -1 ][ 'height' ];
                        
                        if ( $column_index == 1 ) {
                            // starting tag of .fc-col
                            $group_content .= '
                                <div class="fc-col' . $row_index . '">
                            ';
                        }
                        
                        if ( array_key_exists( 'fc_title_holder', $post ) ) {
                            $view_more_text = str_replace( '{{tag_span}}', '<span>', $view_more_text );
                            $view_more_text = str_replace( '{{/tag_span}}', '</span>', $view_more_text );
                            
                            $group_content .= '
                                <div class="fc-list fc-title-holder" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="' . $delay . 's">
                                    <a href="' . $view_more_link . '">
                                        <div class="fc-photo">
                                            <canvas width="' . $canvas_width . '" height="' . $canvas_height . '"></canvas>
                                        </div>
                                        <div class="fc-title-inner">
                                            <div class="fc-title-content">
                                                <div class="fc-title">
                                                    ' . $view_more_text . '
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ';
                        }
                        else {
                            $group_content .= '
                                <div class="fc-list" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="' . $delay . 's">
                                    <a href="' . $post_permalink . '">
                                        <div class="fc-photo" style="background-image: url(' . $post_thumbnail_url . ');">
                                            <canvas width="' . $canvas_width . '" height="' . $canvas_height . '"></canvas>
                                        </div>
                                        <div class="fc-content">
                                            <div class="fc-label">
                                                ' . $post_title . '
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            ';
                        }
                        
                        if ( $column_index == $column_settings[ $row_index - 1 ][ 'items' ] ) {
                            // closing tag of .fc-col
                            $group_content .= '
                                </div><!-- End of .fc-col' . $row_index . '-->
                            ';
                        }
                        
                        $delay += 0.2;
                        $column_index++;
                        
                        if ( $column_index > $column_settings[ $row_index - 1 ][ 'items' ]  ) {
                            $row_index++;
                            $column_index = 1;
                        }
                    }
                    
                    $response .= '
                        <div class="fc-holder" data-aios-staggered-parent="true" data-aios-animation-offset="0.2" data-aios-animation-reset="false">
                            ' . $group_content . '
                        </div>
                    ';
                    

                }

                wp_reset_postdata();
                wp_reset_query();

            }
            else{
                $response = $no_results_text;
            }

            return $response;
        }
    }

    $agentpro_board_members_shortcodes = new agentpro_board_members_shortcodes();
}