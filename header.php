<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta id="viewport-tag" name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( has_action( 'aios_seotools_gtm_body' ) ) { do_action('aios_seotools_gtm_body'); } ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Mobile Header") ) : ?><?php endif ?>

	<div id="main-wrapper">


    <?php do_action('aios_landing_page_header'); ?>
    <?php do_action('aios_neighborhoods_header'); ?>


	<header class="header">
		<div class="header-wrap flex items-center justify-between">
			<div class="header-logo">
				<a href="<?php echo esc_url( home_url() ) ?>" class="site-name text-hidden">
					<img src="<?=do_shortcode('[stylesheet_directory]')?>/images/logo.png" width="79" height="54" alt="Conjug8 Logo" class="block img-responsive">
				</a> 
			</div>

			<div class="navigation flex items-center">
				<nav class="main-menu">
					<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'nav', 'theme_location' => 'primary-menu' ) ); ?>
				</nav>

				<div class="side-nav flex items-center">
					<a href="#" class="aios-btn">Medical Practioners Only</a>
					<a href="#">Cart<img src="<?=do_shortcode('[stylesheet_directory]')?>/images/cart-img.png"></a>
				</div>
			</div>
		</div>
	</header>

	<main>
		<h2 class="aios-starter-theme-hide-title">Main Content</h2>

		<!-- ip banner goes here -->
    	<?php if ( 
		!is_home() && 
		!is_page_template( 'template-fullwidth.php' ) && 
		!is_page_template( 'template-homepage.php' ) &&
		!is_page_template( 'templates/homepage.php' ) &&
		!in_category('founders') ) : 
		?>

		<?php
			// inner page banner (acf) | start
			$post_fields = get_fields( get_the_ID() );
			$fields_to_get = array(
				'title',
			);
			foreach ( $fields_to_get as $field ) {
				${$field} = $post_fields[ 'global_' . $field ];
			}
		?>

		<section id="innerpage-banner">
			<div class="innerpage-banner-wrap">
				<h1 class="inner-section-header">
					<?php echo $title['main']; ?>
				</h1>
			</div>
		</section>
		
    	<?php endif; ?>
		<!-- ip banner goes here -->


		<?php if ( 
			!is_home() && 
			!is_page_template( 'template-fullwidth.php' ) && 
			!is_page_template( 'template-homepage.php' ) &&
			!is_page_template( 'templates/homepage.php' ) ) : 
		?>

		<div id="inner-page-wrapper">
			<div class="main-wrapper">

		<?php endif ?>
