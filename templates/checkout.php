<?php
/**
 * Template Name: Checkout
 *
 */
get_header(); ?>
	<div id="primary" class="checkout-page-container">
        <div class="checkout-wrap" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php echo the_content();?>
                </div><!-- .entry-content -->
            </article><!-- #post -->		
        </div><!--.row -->
	</div><!-- .primary -->
<?php get_footer(); ?>