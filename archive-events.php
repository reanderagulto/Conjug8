<?php 

get_header(); 

$args = [
    'post_type' => 'events',
    'post_status' => 'publish', 
    'order' => 'ASC',
    'posts_per_page' => -1,
    'meta_query' =>[
        [
            'key' => 'livestream-event',
            'value' => 'yes',
            'compare' => '='
        ]
    ],
    'date_query'     => array(
        array(
            'year'  => $today['year'],
            'month' => $today['mon'],
            'day'   => $today['mday'],
        ),
        //allow exact matches to be returned
        'inclusive' => true,
    ),
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
        <section id="events-section">
            <div class="events-wrap">
                <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true">Upcoming Events</h2>
                <div class="upcoming-events-contents events-content flex flex-wrap-wrap items-center">
                </div>
            </div>
        </section>

        <!-- Completed Events -->
        <section id="completed-events-section">
            <div class="completed-events-wrap">
                <h2 class="section-header text-center" data-aos="fade-up" data-aos-once="true">Completed Events</h2>
                <div class="completed-events-content flex flex-wrap-wrap items-center"></div>
            </div>
        </section>
    </section><!-- end #content -->

</div><!-- end #content-sidebar -->

<?php get_footer(); ?>