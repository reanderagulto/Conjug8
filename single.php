<?php 
	get_header(); 
	$post_fields = get_fields( get_the_ID() );
	$fields_to_get = array(
		'title',
	);
	foreach ( $fields_to_get as $field ) {
		${$field} = $post_fields[ 'global_' . $field ];
	}
?>
<div id="<?php echo ai_starter_theme_get_content_id('content-full') ?>" class="blog-single">
	<section id="innerpage-banner">
		<div class="innerpage-banner-wrap">
			<h1 class="inner-section-header">
				<?php echo get_the_title(get_the_ID()); ?>
			</h1>
			<p><?php echo get_the_date( 'F j, Y', $post_id ); ?></p>
			<?php if(!empty($post_image)): ?>
			<div class="banner-bg">
				<img src="<?php echo $post_image['url']; ?>" alt="<?php echo $post_image['alt']; ?>">
			</div>
			<?php endif; ?>
		</div>
	</section>

	<article id="content" class="hfeed">

		<?php get_template_part("content","post") ?>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </article><!-- end #content -->
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>
