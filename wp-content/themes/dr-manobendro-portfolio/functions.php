<?php
/**
 * Dr. Manobendro Portfolio theme functions.
 *
 * @package Dr_Manobendro_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DMP_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function dmp_setup() {
	load_theme_textdomain( 'dr-manobendro-portfolio', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/main.css' );

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 64,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'dr-manobendro-portfolio' ),
			'footer'  => __( 'Footer Menu', 'dr-manobendro-portfolio' ),
		)
	);
}
add_action( 'after_setup_theme', 'dmp_setup' );

/**
 * Set content width for legacy builders and embeds.
 */
function dmp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dmp_content_width', 1140 );
}
add_action( 'after_setup_theme', 'dmp_content_width', 0 );

/**
 * Enqueue styles and scripts.
 */
function dmp_enqueue_assets() {
	wp_enqueue_style(
		'dmp-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		DMP_VERSION
	);

	wp_enqueue_script(
		'dmp-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		DMP_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dmp_enqueue_assets' );

/**
 * Register the footer widget area.
 */
function dmp_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'dr-manobendro-portfolio' ),
			'id'            => 'footer-widgets',
			'description'   => __( 'Appears above the footer credits.', 'dr-manobendro-portfolio' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-widget__title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'dmp_widgets_init' );

/**
 * Register block pattern category and patterns shipped with the theme.
 */
function dmp_register_patterns() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'dr-manobendro-portfolio',
			array( 'label' => __( 'Dr. Manobendro Portfolio', 'dr-manobendro-portfolio' ) )
		);
	}

	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$patterns = array(
		'hero'     => __( 'Veterinary Hero Section', 'dr-manobendro-portfolio' ),
		'services' => __( 'Veterinary Services Grid', 'dr-manobendro-portfolio' ),
		'cta'      => __( 'Appointment Call to Action', 'dr-manobendro-portfolio' ),
	);

	foreach ( $patterns as $slug => $title ) {
		$file = get_template_directory() . '/patterns/' . $slug . '.php';
		if ( ! file_exists( $file ) ) {
			continue;
		}
		ob_start();
		include $file;
		$content = ob_get_clean();

		register_block_pattern(
			'dr-manobendro-portfolio/' . $slug,
			array(
				'title'      => $title,
				'categories' => array( 'dr-manobendro-portfolio' ),
				'content'    => $content,
			)
		);
	}
}
add_action( 'init', 'dmp_register_patterns' );

/**
 * Fallback menu: list pages when no menu has been assigned yet,
 * so the site is navigable right after the demo import.
 */
function dmp_fallback_menu() {
	wp_page_menu(
		array(
			'menu_class'  => 'site-nav__fallback',
			'show_home'   => true,
			'sort_column' => 'menu_order, post_title',
		)
	);
}

/**
 * After the theme is activated, point the front page at the imported
 * "Home" page and the blog at "Blog" (only if the site still shows
 * the default latest-posts front page).
 */
function dmp_setup_front_page() {
	if ( 'page' === get_option( 'show_on_front' ) ) {
		return; // Site owner already configured a static front page.
	}

	$home = get_page_by_path( 'home' );
	$blog = get_page_by_path( 'blog' );

	if ( $home instanceof WP_Post ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
		if ( $blog instanceof WP_Post ) {
			update_option( 'page_for_posts', $blog->ID );
		}
	}
}
add_action( 'after_switch_theme', 'dmp_setup_front_page' );

/**
 * Helper: theme image URL (used by bundled patterns).
 *
 * @param string $file Filename inside assets/images.
 * @return string
 */
function dmp_image( $file ) {
	return esc_url( get_template_directory_uri() . '/assets/images/' . $file );
}
