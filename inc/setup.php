<?php

if ( ! defined( 'WP_INDIGO_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'WP_INDIGO_VERSION', '2.2.0' );
}


if ( ! function_exists( 'wp_indigo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_indigo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wp-indigo, use a find and replace
		 * to change 'wp-indigo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-indigo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'wp-indigo-primary-menu' => esc_html__( 'Primary', 'wp-indigo' ),
			)
		);

		register_nav_menus(
			array(
				'wp-indigo-primary-footer' => esc_html__( 'Footer', 'wp-indigo' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wp_indigo_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		remove_theme_support( 'custom-header' );
	}
endif;
add_action( 'after_setup_theme', 'wp_indigo_setup' );


if( ! function_exists('wp_indigo_widgets_init') ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function wp_indigo_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'wp-indigo' ),
				'id'            => 'wp-indigo-primary-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'wp-indigo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
endif;
add_action( 'widgets_init', 'wp_indigo_widgets_init' );



if( ! function_exists('wp_indigo_footer_widgets_init') ) : 
	/**
	 * Register footer widget Area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function wp_indigo_footer_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'wp-indigo' ),
				'id'            => 'footer-widget',
				'description'   => esc_html__( 'Add Footer widgets here.', 'wp-indigo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="c-footer_widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
endif;
add_action( 'widgets_init', 'wp_indigo_footer_widgets_init' );


if( ! function_exists('wp_indigo_content_width') ) : 
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function wp_indigo_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'wp_indigo_content_width', 640 );
	}
endif;
add_action( 'after_setup_theme', 'wp_indigo_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function wp_indigo_scripts() {
	wp_enqueue_style( 'wp-indigo-style', get_stylesheet_uri(), array(), WP_INDIGO_VERSION );
	wp_style_add_data( 'wp-indigo-style', 'rtl', 'replace' );
	wp_enqueue_script('jquery');

	wp_enqueue_style( 'wp-indigo-main-style', get_template_directory_uri() . '/assets/css/style.css' );

	wp_enqueue_script( 'wp-indigo-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), WP_INDIGO_VERSION , true );
	wp_enqueue_script( 'wp-indigo-vendor-script', get_template_directory_uri() . '/assets/js/vendor.js', array(), false, true);
	wp_enqueue_script( 'wp-indigo-script', get_template_directory_uri() . '/assets/js/script.js', array(), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_indigo_scripts' );


if( ! function_exists(('wp_indigo_register_plugins')) ) : 
	// OCDI - Demo Importer Config
	function wp_indigo_register_plugins( $plugins ) {
		$theme_plugins = [
			[ // A WordPress.org plugin repository example.
				'name'     => __( 'LibWp', 'wp-indigo' ),
				'slug'     => 'libwp',
				'required' => false,
			],
			[
				'name'     => __( 'Kirki Customizer Framework', 'wp-indigo' ),
				'slug'     => 'kirki',
				'required' => false,
			]
		];

		return array_merge( $plugins, $theme_plugins );
	}
endif;
add_filter( 'ocdi/register_plugins', 'wp_indigo_register_plugins' );


if( ! function_exists(('wp_indigo_import_files')) ) : 
	function wp_indigo_import_files() {
		return [
			[
				'import_file_name'           => 'Default Demo',
				'import_file_url'            => 'https://demo.vitathemes.com/ocdi/wp-indigo/wp-indigo.xml',
				'import_widget_file_url'     => 'https://demo.vitathemes.com/ocdi/wp-indigo/demo.vitathemes.com-indigo-widgets.wie',
				'import_customizer_file_url' => 'https://demo.vitathemes.com/ocdi/wp-indigo/indigo-export.dat',
				'import_preview_image_url'   => 'https://demo.vitathemes.com/ocdi/wp-indigo/screenshot.png',
				'preview_url'                => 'https://demo.vitathemes.com/indigo',
			],
		];
	}
endif;
add_filter( 'ocdi/import_files', 'wp_indigo_import_files' );


if( ! function_exists('wp_indigo_after_import_setup') ) : 
	function wp_indigo_after_import_setup() {
		// Assign menus to their locations.
		$primary_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
		$footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', [
				'wp-indigo-primary-menu' => $primary_menu->term_id,
				'wp-indigo-primary-footer' => $footer_menu->term_id,
			]
		);

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		// Unset Logo
		set_theme_mod( 'custom_logo', 0);

		// Social Networks
		set_theme_mod( 'facebook', '#' );
		set_theme_mod( 'twitter', 'https://twitter.com/veronalabs' );
		set_theme_mod( 'instagram', 'https://www.instagram.com/veronalabs/' );
		set_theme_mod( 'linkedin', 'https://www.linkedin.com/company/veronalabs/' );
		set_theme_mod( 'github', 'https://github.com/vitathemes/' );
		set_theme_mod( 'mail', 'hi@veronalabs.com' );
	}
endif;
add_action( 'ocdi/after_import', 'wp_indigo_after_import_setup' );
