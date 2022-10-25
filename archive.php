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

        <div class="blog-archive">
            <?php echo do_shortcode('[featured_post_slider]'); ?>
            <div class="blog-archive-wrap flex justify-center"></div>
        </div>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </section><!-- end #content -->
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>