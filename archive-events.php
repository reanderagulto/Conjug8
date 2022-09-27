<?php 

get_header(); 

?>

<section id="innerpage-banner">
    <div class="innerpage-banner-wrap">
        <h1 class="inner-section-header">
            Conjug8 Events
        </h1>
    </div>
</section>

<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>" class="events-archive">
	<section id="content" class="hfeed">

        <?php
            $upcomingArgs = [
                'post_type'      => 'events',
                'post_status'    => 'future',
                'order'          => 'ASC',
                'orderby'        => 'date',
                'posts_per_page' => -1,
            ];

            $completedArgs = [
                'post_type'      => 'events',
                'post_status'    => '',
                'order'          => 'ASC',
                'orderby'        => 'date',
                'posts_per_page' => -1,
                'date_query'     => array(
                    //set date ranges with strings!
                    'before'     => 'today',
                    //allow exact matches to be returned
                    'inclusive' => true,
                ),
            ];

            /* Upcoming Events */
            $upcoming_events_query = new WP_Query( $upcomingArgs );
            $upcoming_events_total = $upcoming_events_query->post_count;
            if($upcoming_events_total > 0){
                $upcoming_events_posts = $upcoming_events_query->posts;
                $groupPosts = array_chunk( $upcoming_events_posts, 6 );

                $group_content = '';

                foreach( $groupPosts as $posts ) {
                    
                    $group_content .= '<section id="events-section">
                            <div class="events-wrap">
                                <h2 class="section-header text-center">Upcoming Events</h2>
                                <div class="events-content flex flex-wrap-wrap items-center justify-center">
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
                                        <img src="' . $post_thumbnail_url . '" alt="' . $post_title . '" class="img-responsive" width="350" height="299" />
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
                    </div>
                    ';
                } 
                echo $group_content;
                wp_reset_postdata();
                wp_reset_query();
            }
        ?>

    </section><!-- end #content -->

</div><!-- end #content-sidebar -->

<?php get_footer(); ?>