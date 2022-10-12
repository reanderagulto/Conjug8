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
			
			<div class="burger-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<div class="header-logo">
				<a href="<?php echo esc_url( home_url() ) ?>" class="site-name text-hidden">
					<img src="<?=do_shortcode('[stylesheet_directory]')?>/images/logo.png" width="79" height="54" alt="Conjug8 Logo" class="block img-responsive">
				</a> 
			</div>

			<div class="navigation flex items-center">
				<div class="inside-nav flex items-center">
					<nav class="main-menu">
						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'nav', 'theme_location' => 'primary-menu' ) ); ?>
					</nav>

					<div class="side-nav">
						<a href="#" class="aios-btn trigger-popup">Medical Practioners Only</a>
					</div>
					
					<div class="nav-close"> <i class="ai-font-close-g"></i></div>
				</div>
				
				<div class="cart-container">
					<a href="<?php echo esc_url( home_url() ) ?>/cart/" class="cart-icon">Cart<img src="<?=do_shortcode('[stylesheet_directory]')?>/images/cart-img.png"></a>
					<div class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>	
				</div>
				
			</div>
		</div>
	</header>

	<div id="choose-login-popup" class="popup-container">
		<div class="popup-wrapper">
			<div class="popup-main">
				<button class="popup-close ai-font-close-e"></button>
				<div class="popup-content">
					<div class="popup-cta-container">
						<div class="popup-cta-title">
							<h2>Welcome to Conjug8</h2>
						</div>
						<div class="popup-cta-list">
							<div class="popup-cta-item">
								<a href="<?php echo do_shortcode('[blogurl]');?>/medical-practitioners-portal/">
									<span>
									<em class="ai-icon-person"></em>
									Guest
									</span>
								</a>
							</div>
							<div class="popup-cta-item">
								<a href="#" class="trigger-member-popup">
									<span>
										<em class="ai-icon-lock"></em>
										Member
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="login-form-popup" class="popup-container">
		<div class="popup-wrapper">
			<div class="popup-main">
				<button class="popup-return"><em class="ai-icon-arrow"></em>Back</button>
				<button class="popup-close ai-font-close-e"></button>
				<div class="popup-content">
					<div class="popup-form-title">
						<h2>Welcome to Conjug</h2>
					</div>
					<div class="popup-form">
						<form action="#" method="post">
							<div class="popup-form-row full">
								<div class="popup-form-col">
									<label for="popup-username">Username</label>
									<input type="text" name="popup-username" id="popup-username" required>
								</div>
								<div class="popup-form-col">
									<label for="popup-password">Password</label>
									<input type="password" name="popup-password" id="popup-password" required>
								</div>
							</div>
							<div class="popup-form-row">
								<div class="popup-form-col is-option">
									<label class="checkbox-label" for="remember-me" checked="">
										<input type="checkbox" name="type[]" id="remember-me">Remember Me
									</label>
								</div>
								<div class="popup-form-col is-button">
									<button class="forgot-password">Forgot Password</button>
								</div>
							</div>
							<div class="popup-form-row">
								<button class="popup-submit" type="submit">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<main>
		<h2 class="aios-starter-theme-hide-title">Main Content</h2>

		<!-- ip banner goes here -->
    	<?php if ( 
		!is_home() && 
		!is_page_template( 'template-fullwidth.php' ) && !is_page_template( 'template-homepage.php' ) && !is_page_template( 'templates/homepage.php' ) && 
		!is_singular('board-members') && !is_post_type_archive( 'board-members' ) && 
		!is_singular('events') && !is_post_type_archive( 'events' ) && 
		!is_category( 'blog' ) && !is_single() && 
		!is_product() && !is_shop() &&
		!is_404() ): 
		?>

		<?php
			// inner page banner (acf) | start
			$post_fields = get_fields( );
			$fields_to_get = array(
				'title',
				'post_image'
			);
			foreach ( $fields_to_get as $field ) {
				${$field} = $post_fields[ 'global_' . $field ];
			}
		?>

		<section id="innerpage-banner">
			<div class="innerpage-banner-wrap">
				<h1 class="inner-section-header">
					<?php echo (!empty($title['main']) ? $title['main'] : get_the_title() ); ?>
				</h1>
			</div>
			<div class="accent-bg">
				<div class="accent-red"></div>
				<div class="accent-dark-blue"></div>
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
