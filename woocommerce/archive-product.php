<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$shop = get_option( 'woocommerce_shop_page_id' );

$title = get_field('global_title', $shop);

?>

<section id="innerpage-banner">
	<div class="innerpage-banner-wrap">
		<h2 class="inner-section-header test">
			<?php echo (!empty($title['main']) ? $title['main'] : get_the_title($shop) ); ?>
		</h2>
	</div>
	<div class="accent-bg">
		<div class="accent-red"></div>
		<div class="accent-dark-blue"></div>
	</div>
</section>

<div class="main_content-category shop-container" role="main">
	<div class="shop-wrap">
		<?php echo do_shortcode('[featured_products_slider order="DESC"]'); ?>

		<!-- Product Loop -->
		<?php if( woocommerce_product_loop() ): ?>
			<!--  Woocommerce Before Loop -->
			
			<div class="shop-before-loop flex items-center justify-between" data-aos="fade-up" data-aos-once="true">
				<?php do_action( 'woocommerce_before_shop_loop' ); ?>	
			</div>
			
			<!-- Start of Product Loop -->
			<?php woocommerce_product_loop_start(); ?>
				<?php if ( wc_get_loop_prop( 'total' ) ): ?>
					<?php while ( have_posts() ) { ?>
						<?php the_post(); ?>

						<?php do_action( 'woocommerce_shop_loop' ); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php } ?>
				<?php endif; ?>
			<?php woocommerce_product_loop_end(); ?>
			<!-- End of Product Loop -->
		<?php endif; ?>
	</div>
</div>
<?php
get_footer( 'shop' );
?>
