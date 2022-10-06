			<!-- Start of Newsletter Section -->
			<section id="newsletter-section">
				<div class="accent-bg">
					<div class="accent-red"></div>
					<div class="accent-white"></div>
				</div>
				<div class="newsletter-wrap" data-aos="fade-up" data-aos-once="true">
					<div class="newsletter-content">
						<h2 class="newsletter-header">Stay updated, stay informed with <br/ > our latest and upcoming activities</h2>
						<div class="newsletter-form flex items-center justify-center">
							<input type="email" name="newsletter-email" id="newsletter-email" placeholder="Insert your email">
							<button type="submit" class="aios-btn aios-btn-red">Submit</button>
						</div>
					</div>
				</div>
			</section>
			<!-- End of Newsletter Section -->	

			<?php 
				$form_name = "Get in Touch";
				$form_ID = get_page_by_title( $form_name, '', 'wpcf7_contact_form' )->ID;
				
				$post_id = get_the_ID();
				$post_fields = get_fields( );
				$fields_to_get = array(
					'events_section',
					'contact_section',
				);
				foreach ( $fields_to_get as $field ) {
					${$field} = $post_fields[ $field ];
				}
			?>	
			<?php if ( 
				!is_home() && 
				!is_page_template( 'template-fullwidth.php' ) && 
				!is_page_template( 'templates/homepage.php' ) ) : 
			?>
			<div class="clearfix"></div>
			</div><!-- end of #inner-page-wrapper .inner -->
			</div><!-- end of #inner-page-wrapper -->
			<?php else: ?>

				<!-- Start of Events Section -->
				<?php echo do_shortcode('[agentpro_events_archive posts_per_page="3"]'); ?>
				<!-- End of Events Section -->

				<!-- Start of Get in Touch Section -->
				<?php if($contact_section): ?>
				<?php 
					$contact_header = $contact_section[ 'contact_header' ] ?? '';
					$contact_subheader = $contact_section[ 'contact_subheader' ] ?? '';
					$contact_email = $contact_section[ 'contact_information' ]['contact_email'];
					$contact_location = $contact_section[ 'contact_information' ]['contact_location'];
					$contact_phone = $contact_section[ 'contact_information' ]['contact_phone'];
				?>
				<section id="contact-section">
					<div class="contact-wrap flex items-start justify-center">
						<div class="contact-info" data-aos="fade-right" data-aos-once="true">
							<h2 class="section-header"><?= $contact_header ?></h2>
							<h3 class="section-subheader"><?= $contact_subheader ?></h3>
							<a href="<?php echo (!empty($contact_email) ? 'mailto: ' . $contact_email : '#' ); ?>" class="contact-links flex items-center">
								<i class="ai-font-envelope"></i>
								<p><?= $contact_email ?></p>
							</a>
							<div class="contact-links flex items-start">
								<i class="ai-font-location-c"></i>
								<p><?= nl2br($contact_location) ?></p>
							</div>
							<a href="<?php echo (!empty($contact_email) ? 'tel: ' . $contact_phone : '#' ); ?>" class="contact-links flex items-center">
								<i class="ai-font-mobile-b"></i>
								<p><?= $contact_phone ?> </p>
							</a>

							<div class="mobile-contact-form">
								<a href="#" class="aios-btn aios-btn-red" id="mobile-contact">Contact Us</a>
							</div>
						</div>
						<div class="contact-form" data-aos="fade-left" data-aos-once="true">							
							<div class="contact-form-wrap">
								<div class="contact-form-main">
									<h3 class="contact-header">Get in Touch</h3>
									<button class="contact-close ai-font-close-e" id="contact-close"></button>
									<?= do_shortcode('[contact-form-7 id="' . $form_ID . '" title="' . $form_name . '" html_class="use-floating-validation-tip"]') ?>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php endif; ?>
				<!-- End of Get in Touch Section -->
		<?php endif ?>
	</main>
	
		<footer class="footer">
			<div class="footer-wrap">
				<div class="footer-logo">
					<a href="<?php echo esc_url( home_url() ) ?>" class="site-name text-hidden">
						<img src="<?=do_shortcode('[stylesheet_directory]')?>/images/logo.png" width="79" height="54" alt="Conjug8 Logo" class="block img-responsive">
					</a>
				</div>
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'footernav', 'theme_location' => 'primary-menu','depth'=>1 ) ); ?>
				<div class="footer-smi">
					<a href="https://www.facebook.com/conjug8corp" target="_blank" class="text-hidden">Facebook <i class="ai-font-facebook"></i></a>
					<a href="https://www.youtube.com/channel/UCmbjYVZFcmjZ3cl6555_r_A" target="_blank" class="text-hidden">Youtube <i class="ai-font-youtube"></i></a>
					<a href="https://www.linkedin.com/company/conjug8-ph/" target="_blank" class="text-hidden">Linkedin <i class="ai-font-linkedin"></i></a>
				</div>
			</div>
			<hr class="footer-divider" />		
			<div class="copyright">
					&copy; <?php echo date('Y') ?> Conjug8 Corporation. All right reserved. <!-- aios shortcode here -->
				</div>
		</footer>
		
		<?php do_action('aios_neighborhoods_footer')?>
		<?php do_action('aios_landing_page_footer')?>
		
	</div><!-- end of #main-wrapper -->


	<?php wp_footer(); ?>
</body>
</html>
