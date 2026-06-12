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
 * Read a bundled demo content file and resolve URL placeholders.
 *
 * @param string $slug Demo file slug (without extension).
 * @return string Block markup, or empty string if the file is missing.
 */
function dmp_demo_content( $slug ) {
	$file = get_template_directory() . '/demo/' . $slug . '.html';
	if ( ! file_exists( $file ) ) {
		return '';
	}
	$html = (string) file_get_contents( $file );
	return str_replace(
		array( '{{THEME_URI}}', '{{HOME_URI}}' ),
		array( get_template_directory_uri(), untrailingslashit( home_url() ) ),
		$html
	);
}

/**
 * One-time demo content installer, run on theme activation.
 *
 * Creates the demo pages, blog posts, primary menu and reading settings
 * so the full website appears right after the theme is activated. Skips
 * everything if demo content already exists (e.g. imported via WXR) and
 * never runs twice.
 */
function dmp_install_demo_content() {
	if ( get_option( 'dmp_demo_imported' ) ) {
		dmp_setup_front_page();
		return;
	}

	if ( get_page_by_path( 'home' ) instanceof WP_Post ) {
		// Content already present (manual WXR import) — just wire it up.
		update_option( 'dmp_demo_imported', 1 );
		dmp_setup_front_page();
		return;
	}

	$pages = array(
		'home'     => array( 'Home', 1, 'templates/template-full-width.php' ),
		'about'    => array( 'About', 2, '' ),
		'services' => array( 'Services', 3, '' ),
		'gallery'  => array( 'Gallery', 4, '' ),
		'blog'     => array( 'Blog', 5, '' ),
		'contact'  => array( 'Contact', 6, '' ),
	);

	$page_ids = array();
	foreach ( $pages as $slug => $page ) {
		$page_ids[ $slug ] = wp_insert_post(
			array(
				'post_title'     => $page[0],
				'post_name'      => $slug,
				'post_content'   => dmp_demo_content( $slug ),
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'menu_order'     => $page[1],
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'page_template'  => $page[2],
			)
		);
	}

	$posts = array(
		'fmd-prevention-tips'              => array(
			'Foot-and-Mouth Disease: Prevention Tips for Cattle Farmers in Rajbari',
			'Animal Health',
			array( 'Cattle', 'Vaccination' ),
			'-3 weeks',
			'FMD rarely kills adult cattle but devastates milk yield and incomes. Here are five practical prevention steps for the farmers of Rajbari.',
		),
		'artificial-insemination-benefits' => array(
			'Why Artificial Insemination Pays Off for Smallholder Dairy Farmers',
			'Farmer Advisory',
			array( 'Dairy', 'Breeding' ),
			'-6 weeks',
			'Artificial insemination is safer and more profitable than keeping a bull. Here is what every smallholder dairy farmer should know about AI.',
		),
		'poultry-monsoon-preparation'      => array(
			'Preparing Your Poultry Flock for the Monsoon Season',
			'Animal Health',
			array( 'Poultry' ),
			'-10 weeks',
			'Wet months mean coccidiosis, fowl cholera and mouldy feed. Use this pre-monsoon checklist to keep your flock healthy through the rains.',
		),
	);

	foreach ( $posts as $slug => $post ) {
		$category = term_exists( $post[1], 'category' );
		if ( ! $category ) {
			$category = wp_insert_term( $post[1], 'category' );
		}
		$category_id = is_array( $category ) ? (int) $category['term_id'] : (int) $category;

		wp_insert_post(
			array(
				'post_title'    => $post[0],
				'post_name'     => $slug,
				'post_content'  => dmp_demo_content( $slug ),
				'post_excerpt'  => $post[4],
				'post_status'   => 'publish',
				'post_type'     => 'post',
				'post_date'     => gmdate( 'Y-m-d 09:00:00', strtotime( $post[3] ) ),
				'post_category' => array( $category_id ),
				'tags_input'    => $post[2],
			)
		);
	}

	// Build and assign the primary menu.
	if ( ! wp_get_nav_menu_object( 'Primary' ) ) {
		$menu_id = wp_create_nav_menu( 'Primary' );
		if ( ! is_wp_error( $menu_id ) ) {
			foreach ( $pages as $slug => $page ) {
				if ( empty( $page_ids[ $slug ] ) || is_wp_error( $page_ids[ $slug ] ) ) {
					continue;
				}
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $page[0],
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $page_ids[ $slug ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
					)
				);
			}
			$locations            = (array) get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	// Pretty permalinks, so demo links like /contact/ resolve.
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
		flush_rewrite_rules();
	}

	update_option( 'dmp_demo_imported', 1 );
	dmp_setup_front_page();
}
add_action( 'after_switch_theme', 'dmp_install_demo_content' );

/**
 * Point the front page at "Home" and the blog at "Blog" (only if the
 * site still shows the default latest-posts front page).
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

/**
 * Helper: theme image URL (used by bundled patterns).
 *
 * @param string $file Filename inside assets/images.
 * @return string
 */
function dmp_image( $file ) {
	return esc_url( get_template_directory_uri() . '/assets/images/' . $file );
}
