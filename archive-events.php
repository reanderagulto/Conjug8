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

<div class="events-archive">
	<section class="hfeed">
        <!-- Upcoming Events -->
        <?php
            $args = [
                'post_type'      => 'events',
                'post_status'    => 'future',
                'order'          => 'ASC',
                'orderby'        => 'date',
                'posts_per_page' => -1,
            ];
            $events_query = new WP_Query( $args );
        ?>
        <?php if($events_query->have_posts()): ?>
            <section id="events-section">
                <div class="events-wrap">
                    <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true">Upcoming Events</h2>
                    <div class="events-content flex flex-wrap-wrap items-center justify-center" data-aos="fade-up" data-aos-once="true">
                        <?php 
                            while($events_query->have_posts()): $events_query->the_post();
                                get_template_part('loop', 'upcoming-events');
                            endwhile;
                        ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Completed Events -->
        <?php 
            $completredArgs = [
                'post_type'      => 'events',
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'posts_per_page' => 6,
                'paged'          => 1,
                'date_query'     => array(
                    //set date ranges with strings!
                    'before'     => 'today',
                    //allow exact matches to be returned
                    'inclusive' => true,
                ),
            ];

            $completed_events = new WP_Query( $completredArgs );
        ?>
        <?php if($completed_events->have_posts()): ?>
            <section id="completed-events-section">
                <div class="completed-events-wrap">
                    <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true">Completed Events</h2>
                    <div class="completed-events-content flex flex-wrap-wrap items-center">
                        <?php 
                            while($completed_events->have_posts()): $completed_events->the_post();
                                get_template_part('loop', 'completed-events');
                            endwhile;
                        ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
                <div class="load-more-container" data-aos="fade-up" data-aos-once="true">
                    <a href="#!" class="aios-btn aios-btn-red" id="completed-load-more">See More</a>
                </div>
            </section>
        <?php endif; ?>
    </section><!-- end #content -->

</div><!-- end #content-sidebar -->

<?php get_footer(); ?>