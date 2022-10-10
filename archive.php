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
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => $paged,
            );

            $loop = new WP_Query($args);
        ?>
        <div class="blog-archive">
            <?php echo do_shortcode('[featured_post_slider]'); ?>
            <?php if($loop->have_posts()): ?>
                <div class="blog-archive-wrap flex justify-center">
                <?php 
                    while($loop->have_posts()): $loop->the_post();
                        get_template_part('loop','archive');
                    endwhile;
                ?>
                <?php wp_reset_query(); ?>
                </div> 
                <?php if($loop->found_posts > 6): ?>
                <div class="load-more-container flex items-center justify-center" data-aos="fade-up" data-aos-once="true">
                    <a href="#!" class="aios-btn aios-btn-red" id="see-more-posts">See More Posts</a>
                </div>
                <?php endif; ?> 
            <?php endif; ?>  
        </div>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </section><!-- end #content -->
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>