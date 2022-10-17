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
            add_shortcode( 'agentpro_board_members_slider', [ $this, 'agentpro_board_members_slider' ] );
            add_shortcode( 'agentpro_board_members_about_archive', [$this, 'agentpro_board_members_about_archive'] );
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
                'order_by' => 'date',
                'thumbnail_size' => 'full',
                'view_more_link' => home_url() . '/board-members/',
                'view_more_text' => 'View More Board Members',
                'with_view_more' => false,
                'no_results_text' => 'No Board Members Found...',
                'show_attributes' => false,
            ], $atts );

            wp_enqueue_style( 'shortcode-archive', get_stylesheet_directory_uri() . '/modules/board-members-post-type/css/shortcode-archive.css' );

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

                if ( $with_view_more == 'true' ) {
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

                    /* Start of board-container */
                    $group_content .= '
                    <div class="board-container">
                        <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">The Brains Behind The Company</h2>
                        <div class="board-wrap flex flex-wrap-wrap items-center justify-center">
                    ';
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $founder_info = get_field('founder_info', $post_id);
                        $post_title = $post->post_title;
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, $thumbnail_size );

                        $group_content .= '
                            <div class="board-info" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">
                                <a href="' . $post_permalink . '">
                                    <div class="img-container">
                                        <canvas width="346" height="261"></canvas>
                                        <img src="' . $post_thumbnail_url . '"  width="346" height="261" alt="' . $post_title . '">
                                    </div>
                                    <div class="content">
                                        <h3 class="section-header">
                                            ' . $post_title . '
                                            <span>' . $founder_info['title'] . '</span>
                                        </h3>
                                        <p>' . $founder_info['position'] . '</p>

                                    </div>
                                </a>
                            </div>
                        ';
                        
                    }
                    $group_content .= '
                        </div>';
                        /* End of board-wrap */
                    $group_content .= 
                    '</div>';
                    /* End of board-container */
                    
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

        public function agentpro_board_members_slider( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
                'order_by' => 'date',
                'thumbnail_size' => 'full',
                'view_more_link' => home_url() . '/board-members/',
                'view_more_text' => 'View More Board Members',
                'with_view_more' => false,
                'no_results_text' => 'No Board Members Found...',
                'show_attributes' => false,
            ], $atts );

            wp_enqueue_style( 'shortcode-slider', get_stylesheet_directory_uri() . '/modules/board-members-post-type/css/shortcode-slider.css' );
            wp_enqueue_script( 'shortcode-slider', get_stylesheet_directory_uri() . '/modules/board-members-post-type/js/shortcode-slider.js' );

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
                $groupPosts = array_chunk( $board_members_posts, 6 );
                foreach( $groupPosts as $posts ) {
                    $row_index = 1;
                    $column_index = 1;
                    $delay = 0.1;

                    $group_content = '';

                    /* Start of Founders Section */
                    $group_content .= '
                    <div class="founder-wrap">
                        <div class="founder-nav flex items-center justify-between" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">
                            <h2 class="section-header">The Brains Behind The Company</h2>
                            <div class="the-company-nav flex items-center">
                                <button type="button" class="aios-btn-sm aios-btn-red slider-nav founder-prev ai-icon-prev"></button>
                                <button type="button" class="aios-btn-sm aios-btn-red slider-nav founder-next ai-icon-next"></button>
                            </div>
                        </div>
                        <div class="founder-slider"  data-aos="fade-left" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">
                    ';
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $founder_info = get_field('founder_info', $post_id);
                        $post_title = $post->post_title;
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, $thumbnail_size );
                        $group_content .= '
                            <div class="founder-slide">
                                <a href="' . $post_permalink . '">
                                    <div class="founder-img">
                                        <canvas width="348" height="389"></canvas>
                                        <img src="' . $post_thumbnail_url . '" width="348" height="389" alt="' . $post_title . '"/>
                                    </div>
                                    <div class="founder-info">
                                        <h3>' . $post_title . ' <span>' . $founder_info['title'] . '</span></h3>
                                        <p>' . $founder_info['position'] . '</p>
                                    </div>
                                </a>
                            </div>';

                    }

                    $group_content .= '
                        </div>
                    </div>
                    ';

                    $response .= '
                        <section id="founders-section">
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

        public function agentpro_board_members_about_archive( $atts ){
            $atts = shortcode_atts( [
                'posts_per_page' => -1,
                'order' => 'ASC',
                'order_by' => 'date',
                'thumbnail_size' => 'full',
                'view_more_link' => home_url() . '/board-members/',
                'view_more_text' => 'View More Board Members',
                'with_view_more' => false,
                'no_results_text' => 'No Board Members Found...',
                'show_attributes' => false,
            ], $atts );

            wp_enqueue_style( 'shortcode-archive', get_stylesheet_directory_uri() . '/modules/board-members-post-type/css/shortcode-archive.css' );

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

                if ( $with_view_more == 'true' ) {
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

                    /* Start of board-container */
                    $group_content .= '
                    <div class="board-container">
                        <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">The Brains Behind The Company</h2>
                        <div class="board-wrap flex flex-wrap-wrap items-center justify-center">
                    ';
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $founder_info = get_field('founder_info', $post_id);
                        $post_title = $post->post_title;
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'large' );

                        $group_content .= '
                            <div class="board-info-container" data-aos="fade-up" data-aos-once="true" data-aos-offset="200" data-aos-duration="800">
                                <a href="' . $post_permalink . '">
                                    <div class="img-container">
                                        <canvas width="295" height="295"></canvas>
                                        <img src="' . $post_thumbnail_url . '" width="295" height="295" alt="' . $post_title . '">
                                    </div>
                                    <div class="content">
                                        <p>
                                            ' . $post_title . '
                                            <span>' . $founder_info['title'] . '</span>
                                        </p>
                                        <p>' . $founder_info['position'] . '</p>

                                    </div>
                                </a>
                            </div>
                        ';
                        
                    }
                    $group_content .= '
                        </div>';
                        /* End of board-wrap */
                    $group_content .= 
                    '</div>';
                    /* End of board-container */
                    
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