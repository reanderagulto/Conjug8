<?php
/**
 * Template Name: Cart
 *
 */
get_header(); ?>
	<div id="primary" class="cart-page-container">
        <div class="cart-wrap" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php echo the_content();?>
                </div><!-- .entry-content -->
            </article><!-- #post -->		
        </div><!--.row -->
	</div><!-- .primary -->
<?php get_footer(); ?>