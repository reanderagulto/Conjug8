<?php if(have_posts()) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  data-aos="fade-up" data-aos-once="true">

	<div class="entry">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="archive-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
			</div>
		<?php endif ?>
		<div class="archive-content-container">
			<div class="archive-date">
				<?php echo get_the_date( 'F j, Y', get_the_ID() ); ?>
			</div>
			<div class="archive-content <?php echo has_post_thumbnail() ? "archive-has-thumbnail" : "" ?>">
				<h2 class="archive-subtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p>
					<?php if ( has_excerpt( get_the_ID() ) ) : ?>
						<?php the_excerpt(); ?>
					<?php else: ?>
						<?php echo ai_starter_theme_truncate_string( strip_tags( strip_shortcodes( get_the_content() ) ), 75, "..." ) ?>
					<?php endif ?>
				</p>
				<a class="archive-more" href="<?php the_permalink() ?>">Read more</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

</article>
<?php else: ?>
	<p>Coming soon...</p>
<?php endif ?>