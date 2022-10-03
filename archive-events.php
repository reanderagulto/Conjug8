<?php 

get_header(); 

?>

<section id="innerpage-banner">
    <div class="innerpage-banner-wrap">
        <h1 class="inner-section-header">
            Conjug8 Events
        </h1>
    </div>
    <div class="accent-bg">
		<div class="accent-red"></div>
		<div class="accent-dark-blue"></div>
	</div>
</section>

<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>" class="events-archive">
	<section id="content" class="hfeed">

        <?php
            $args = [
                'post_type'      => 'events',
                'post_status'    => 'future',
                'order'          => 'ASC',
                'orderby'        => 'date',
                'posts_per_page' => -1,
            ];

            /* Upcoming Events */
            $events_query = new WP_Query( $args );
            $events_total = $events_query->post_count;
            if($events_total > 0){
                $events_posts = $events_query->posts;
                $groupPosts = array_chunk( $events_posts, 6 );

                $group_content = '';

                $group_content .= '<section id="events-section">
                            <div class="events-wrap">
                                <h2 class="section-header text-center">Upcoming Events</h2>';

                foreach( $groupPosts as $posts ) {
                    
                    $group_content .= '<div class="events-content flex flex-wrap-wrap items-center justify-center">';
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

                    $group_content .= '</div>';
                } 
                $group_content .= '</div>
                </div>';
                echo $group_content;
                wp_reset_postdata();
                wp_reset_query();
            }
        ?>

        <?php 
            $completredArgs = [
                'post_type'      => 'events',
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'posts_per_page' => -1,
                'date_query'     => array(
                    //set date ranges with strings!
                    'before'     => 'today',
                    //allow exact matches to be returned
                    'inclusive' => true,
                ),
            ];

            /* Completed Events */
            $events_query = new WP_Query( $completredArgs );
            $events_total = $events_query->post_count;
            if($events_total > 0){
                $events_posts = $events_query->posts;
                $groupPosts = array_chunk( $events_posts, 6 );
                $group_content = '';

                $group_content .= '
                    <section id="completed-events-section">
                        <div class="completed-events-wrap">
                        <h2 class="section-header text-center">Completed Events</h2>
                ';

                foreach( $groupPosts as $posts ) {

                    $group_content .= '
                        <div class="completed-events-content flex flex-wrap-wrap items-center">
                    ';
            
                    foreach( $posts as $key => $post ) {
                        $post_id = $post->ID;
                        $post_title = $post->post_title;
                        $post_date = date('F j, Y', strtotime($post->post_date));
                        $post_permalink = get_the_permalink( $post_id );
                        $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'post-thumbnail' );
            
                        $group_content .= '
                            <div class="completed-events">
                                <a href="' . $post_permalink . '">
                                    <div class="completed-event-container flex items-center justify-center">
                                        <div class="img-container">
                                            <canvas width="136" height="117"></canvas>
                                            <img src="' . $post_thumbnail_url . '" alt="' . $post_title . '" width="136" height="117" />
                                        </div>
                                        <div class="events-content">
                                            <h3>' . $post_title . '</h3>
                                            <p>' . $post_date . '</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ';
                    }
            
                    $group_content .= '</div>';
                }

                $group_content .= '</div>
                </div>';
            
                echo $group_content;
                wp_reset_postdata();
                wp_reset_query();

            }

        ?>

        

    </section><!-- end #content -->

</div><!-- end #content-sidebar -->

<?php get_footer(); ?>