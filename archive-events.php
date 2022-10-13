<?php 

get_header(); 

$args = [
    'post_type' => 'events',
    'post_status' => 'publish', 
    'order' => 'ASC',
    'posts_per_page' => -1,
    'date_query'     => array(
        array(
            'year'  => $today['year'],
            'month' => $today['mon'],
            'day'   => $today['mday'],
        ),
        //allow exact matches to be returned
        'inclusive' => true,
    ),
    'meta_query' =>[
        [
            'key' => 'livestream-event',
            'value' => 'yes',
            'compare' => '='
        ]
    ],
];

$posts_query = new WP_Query( $args );
$happening_now = $posts_query->post_count;
wp_reset_query();
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

        <?php if($happening_now > 0): ?>
            <?php echo do_shortcode('[happening_now]'); ?>
        <?php else: ?>
            <section class="featured-section" data-aos="fade-up" data-aos-once="true">
                <?php echo do_shortcode('[featured_events_slider]'); ?>
            </section>
        <?php endif; ?>
        
        <!-- Upcoming Events -->
        <?php
            $args = [
                'post_type'      => 'events',
                'post_status'    => 'future',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'posts_per_page' => 6,
            ];
            $events_query = new WP_Query( $args );
        ?>
        <?php if($events_query->have_posts()): ?>
            <section id="events-section">
                <div class="events-wrap">
                    <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true">Upcoming Events</h2>
                    <div class="upcoming-events-contents events-content flex flex-wrap-wrap items-center justify-center">
                        <?php 
                            while($events_query->have_posts()): $events_query->the_post(); ?>
                                <div class="event" data-aos="fade-up" data-aos-once="true">
                                    <div class="event-container">
                                        <div class="img-container">
                                            <canvas width="350" height="299"></canvas>
                                            <img src="<?php the_post_thumbnail_url('full')?>" alt="<?php the_title(); ?>" width="350" height="299" />
                                        </div>
                                        <p class="event-date"><?php echo get_the_date( 'j', get_the_ID() ); ?> <span><?php echo get_the_date( 'M', get_the_ID() ); ?></span></p>
                                    </div>
                                    <h3><?php the_title(); ?></h3>
                                </div>
                            <?php endwhile; ?>                        
                        <?php wp_reset_query(); ?>
                    </div>
                    <?php if($events_query->found_posts > 6): ?>
                    <div class="upcoming-load-more-container" data-aos="fade-up" data-aos-once="true">
                        <a href="#!" class="aios-btn aios-btn-red" id="upcoming-load-more">View More</a>
                    </div>
                    <?php endif; ?>
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
                <?php if($completed_events->found_posts > 6): ?>
                <div class="load-more-container" data-aos="fade-up" data-aos-once="true">
                    <a href="#!" class="aios-btn aios-btn-red" id="completed-load-more">See More</a>
                </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </section><!-- end #content -->

</div><!-- end #content-sidebar -->

<?php get_footer(); ?>