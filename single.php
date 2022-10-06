<?php 
	get_header(); 
	$post_id = get_the_ID();
	$post_fields = get_fields( get_the_ID() );
	$fields_to_get = array(
		'title',
	);
	foreach ( $fields_to_get as $field ) {
		${$field} = $post_fields[ 'global_' . $field ];
	}
?>
<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>" class="blog-single">
	<section id="innerpage-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post_id, 'full' )?>)">
		<div class="innerpage-banner-wrap">
			<h1 class="inner-section-header">
				<?php echo get_the_title(get_the_ID()); ?>
			</h1>
			<p><?php echo get_the_date( 'F j, Y', $post_id ); ?></p>
			<?php if(!empty($post_image)): ?>
			<?php endif; ?>
		</div>
		<div class="accent-bg">
			<div class="accent-red"></div>
			<div class="accent-dark-blue"></div>
		</div>
	</section>

	<article id="content" class="hfeed">

		<?php get_template_part("content","post") ?>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </article><!-- end #content -->
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>
