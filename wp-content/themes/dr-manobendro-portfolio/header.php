<?php
/**
 * Theme header.
 *
 * @package Dr_Manobendro_Portfolio
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'dr-manobendro-portfolio' ); ?></a>

<header class="site-header" id="site-header">
	<div class="site-header__inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-branding__mark" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-hidden="true" tabindex="-1">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="" width="48" height="48">
				</a>
			<?php endif; ?>
			<div class="site-branding__text">
				<a class="site-branding__title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php $dmp_description = get_bloginfo( 'description', 'display' ); ?>
				<?php if ( $dmp_description ) : ?>
					<p class="site-branding__tagline"><?php echo esc_html( $dmp_description ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<button class="nav-toggle" aria-controls="site-nav" aria-expanded="false">
			<span class="nav-toggle__bar"></span>
			<span class="nav-toggle__bar"></span>
			<span class="nav-toggle__bar"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'dr-manobendro-portfolio' ); ?></span>
		</button>

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'dr-manobendro-portfolio' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'site-nav__list',
					'container'      => false,
					'fallback_cb'    => 'dmp_fallback_menu',
					'depth'          => 2,
				)
			);
			?>
		</nav>
	</div>
</header>

<main id="site-content" class="site-content">
