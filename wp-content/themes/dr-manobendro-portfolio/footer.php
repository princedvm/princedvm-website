<?php
/**
 * Theme footer.
 *
 * @package Dr_Manobendro_Portfolio
 */
?>
</main><!-- #site-content -->

<footer class="site-footer">
	<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
		<div class="site-footer__widgets">
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</div>
	<?php else : ?>
		<div class="site-footer__widgets">
			<div class="footer-widget">
				<h3 class="footer-widget__title"><?php esc_html_e( 'Dr. Manobendro Majumder, DVM', 'dr-manobendro-portfolio' ); ?></h3>
				<p><?php esc_html_e( 'Upazila Livestock Officer, Baliakandi, Rajbari, Bangladesh. Dedicated to animal health, farmer empowerment and sustainable livestock development.', 'dr-manobendro-portfolio' ); ?></p>
			</div>
			<div class="footer-widget">
				<h3 class="footer-widget__title"><?php esc_html_e( 'Office', 'dr-manobendro-portfolio' ); ?></h3>
				<p>
					<?php esc_html_e( 'Upazila Livestock Office & Veterinary Hospital', 'dr-manobendro-portfolio' ); ?><br>
					<?php esc_html_e( 'Baliakandi, Rajbari-7730, Bangladesh', 'dr-manobendro-portfolio' ); ?><br>
					<?php esc_html_e( 'Sun – Thu: 9:00 AM – 5:00 PM', 'dr-manobendro-portfolio' ); ?>
				</p>
			</div>
			<div class="footer-widget">
				<h3 class="footer-widget__title"><?php esc_html_e( 'Contact', 'dr-manobendro-portfolio' ); ?></h3>
				<p>
					<a href="mailto:princedvm@gmail.com">princedvm@gmail.com</a><br>
					<?php esc_html_e( 'Phone: +880 1XXX-XXXXXX', 'dr-manobendro-portfolio' ); ?>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<div class="site-footer__bottom">
		<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'dr-manobendro-portfolio' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'site-footer__menu',
					'fallback_cb'    => false,
					'depth'          => 1,
				)
			);
			?>
		</nav>
		<p class="site-footer__credit">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'dr-manobendro-portfolio' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
