<?php get_header(); ?>
<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>">
	<section id="content" class="hfeed">
        <section id="innerpage-banner">
            <div class="innerpage-banner-wrap">
                <h1 class="inner-section-header">Blog</h1>
            </div>
            <div class="accent-bg">
                <div class="accent-red"></div>
                <div class="accent-dark-blue"></div>
            </div>
        </section>
        <?php 
            $post = $posts[0]; // Hack. Set $post so that the_date() works. 
            $aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );
            if ( ! is_custom_field_banner( get_queried_object() ) || $aios_metaboxes_banner_title_layout[1] != 1 ) :
                $taxonomy_id        = get_queried_object()->term_id;
                $taxonomy_name      = get_queried_object()->name;
                $taxonomy_meta      = get_option( "term_meta_" . $taxonomy_id );
            endif;
        ?>
        <div class="blog-archive">
            <?php echo do_shortcode('[featured_post_slider]'); ?>
            <div class="blog-archive-wrap flex justify-center">
                <?php get_template_part('loop','archive') ?>
            </div>		    
        </div>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </section><!-- end #content -->
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>