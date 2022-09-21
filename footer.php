			<?php if ( !is_home() && !is_page_template( 'template-fullwidth.php' ) && !is_page_template( 'template-homepage.php' ) ) : ?>
			<div class="clearfix"></div>
			</div><!-- end of #inner-page-wrapper .inner -->
			</div><!-- end of #inner-page-wrapper -->
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
