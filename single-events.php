<?php 

get_header(); 

$post_id = get_the_ID();
$post_fields = get_fields( );
$fields_to_get = array(
    'event_banner',
);
foreach ( $fields_to_get as $field ) {
    ${$field} = $post_fields[ $field ];
}

?>

<section id="innerpage-banner">
    <div class="innerpage-banner-wrap">
        <h1 class="inner-section-header">
            <?php echo get_the_title( $post_id ); ?>
        </h1>
        <p><?php echo get_the_date( 'F j, Y', $post_id ); ?></p>
    </div>
    <div class="accent-bg">
        <div class="accent-red"></div>
        <div class="accent-dark-blue"></div>
    </div>
</section>

<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>" class="events-single">
	<article id="content" class="hfeed">
		
		<?php if(have_posts()) : ?>
		
            <?php while(have_posts()) : the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php do_action('aios_starter_theme_before_entry_content') ?>
                    <div class="entry entry-content">
                        <div class="events-wrap">
                            <div class="events-inner">
                                <?php if(!empty($event_banner)): ?>
                                <div class="video-content text-center">
                                    <div class="what-plyr">
                                        <video id="player" playsinline controls data-poster="<?php echo $event_banner[ 'thumbnail_image' ]['url']; ?>" poster="<?php echo $event_banner[ 'thumbnail_image' ]['url']; ?>">
                                            <source src="<?php echo $event_banner[ 'video_link' ]; ?>" type="video/mp4" />
                                        </video>
                                    </div>
                                </div>
                                <?php endif; ?>               
                                <div class="events-main" data-aios-reveal="true" data-aios-animation="fadeInRight" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php do_action('aios_starter_theme_after_entry_content') ?>

                </div>

            <?php endwhile; ?>

        <?php endif; ?>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </article><!-- end #content -->

</div><!-- end #content-full -->

<?php get_footer(); ?>
