<?php 

get_header(); 

$post_id = get_the_ID();
$post_fields = get_fields( );
$fields_to_get = array(
    'founder_info',
);
foreach ( $fields_to_get as $field ) {
    ${$field} = $post_fields[ $field ];
}

?>

<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>" class="founders-single">
	<article id="content" class="hfeed">
		
		<?php if(have_posts()) : ?>
		
            <?php while(have_posts()) : the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php do_action('aios_starter_theme_before_entry_content') ?>
                    <h1 class="entry-title hidden-md hidden-lg"><?php the_title() ?></h1>
                    <div class="entry entry-content">
                        <div class="founder-wrap">
                            <div class="founder-inner flex items-start justify-between">
                                <div class="content-left">
                                    <div class="founder-featured-image" data-aios-reveal="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                                        <img width="800" height="600" class="img-responsive" src="<?= get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>">
                                    </div>
                                    <div class="smi-wrap">
                                        <?php if(!empty($founder_info['social_media_links'])): ?>
                                            <a href="<?php echo (!empty($founder_info['social_media_links']['facebook']) ? $founder_info['social_media_links']['facebook'] : '#'); ?>" class="text-hidden" target="_blank">Facebook<span class="ai-font-facebook"></span></a>
                                            <a href="<?php echo (!empty($founder_info['social_media_links']['linkedin']) ? $founder_info['social_media_links']['linkedin'] : '#'); ?>" class="text-hidden" target="_blank">Facebook<span class="ai-font-linkedin"></span></a>
                                            <a href="<?php echo (!empty($founder_info['social_media_links']['instagram']) ? $founder_info['social_media_links']['instagram'] : '#'); ?>" class="text-hidden" target="_blank">Facebook<span class="ai-font-instagram"></span></a>
                                            <a href="<?php echo (!empty($founder_info['social_media_links']['twitter']) ? $founder_info['social_media_links']['twitter'] : '#'); ?>" class="text-hidden" target="_blank">Facebook<span class="ai-font-twitter"></span></a>
                                        <?php endif; ?>
                                    </div>
                                </div>                               
                                <div class="founder-main" data-aios-reveal="true" data-aios-animation="fadeInRight" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                                    <h2 class="section-header">
                                        <?php the_title() ?>
                                        <?php if(!empty($founder_info['title'])): ?>
                                            <span><?php echo $founder_info['title']; ?></span>
                                        <?php endif; ?>
                                    </h2>
                                    <h3 class="section-subheader">
                                        <?php if(!empty($founder_info['title'])): ?>
                                            <?php echo $founder_info['position']; ?>
                                        <?php endif; ?>
                                    </h3>
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
