<?php
/**
 * Template Name: Blank Canvas (No Header/Footer)
 * Template Post Type: page
 *
 * Completely blank canvas — no theme header, footer or wrappers.
 * Ideal for Elementor, Divi, Beaver Builder and Brizy layouts that
 * supply their own header and footer.
 *
 * @package Dr_Manobendro_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'template-canvas' ); ?>>
<?php wp_body_open(); ?>

<main id="site-content" class="site-content site-content--canvas">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php wp_footer(); ?>
</body>
</html>
