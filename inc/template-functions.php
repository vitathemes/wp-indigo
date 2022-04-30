<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wp-indigo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

if ( ! function_exists('wp_indigo_body_classes'))  {
	function wp_indigo_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'wp-indigo-primary-sidebar' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'wp_indigo_body_classes' );


if ( ! function_exists('wp_indigo_pingback_header')) {
	function wp_indigo_pingback_header() {
		/**
		 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
		 */
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}
add_action( 'wp_head', 'wp_indigo_pingback_header' );


if ( ! function_exists('wp_indigo_typography')) {
	function wp_indigo_typography() {
		
		(  empty( get_background_color() )  ) ? $wp_indigo_background_color = "#ffffff" : $wp_indigo_background_color = '#'.get_background_color(); 

		(get_theme_mod( 'typography_primary_color' ) == "" ) ? $wp_indigo_primary_color = "#1A1A1A" : $wp_indigo_primary_color = get_theme_mod( 'typography_primary_color' ); 

		(get_theme_mod( 'typography_secondary_color' ) == "" ) ? $wp_indigo_secondary_color = "#555555" : $wp_indigo_secondary_color = get_theme_mod( 'typography_secondary_color' ); 

		(get_theme_mod( 'wp_indigo_tertiary_color' ) == "" ) ? $wp_indigo_tertiary_color = "#C4C4C4" : $wp_indigo_tertiary_color = get_theme_mod( 'wp_indigo_tertiary_color' ); 

		(get_theme_mod( 'wp_indigo_quaternary_color' ) == "" ) ? $wp_indigo_quaternary_color = "#3F51B5" : $wp_indigo_quaternary_color = get_theme_mod( 'wp_indigo_quaternary_color' ); 

		(get_theme_mod( 'wp_indigo_accent_light_color' ) == "" ) ? $wp_indigo_accent_light_color = "#FBFBFF" : $wp_indigo_accent_light_color = get_theme_mod( 'wp_indigo_accent_light_color' ); 

		(get_theme_mod( 'wp_indigo_light_gray_color' ) == "" ) ? $wp_indigo_light_gray_color = "#f0f0f0" : $wp_indigo_light_gray_color = get_theme_mod( 'wp_indigo_light_gray_color' ); 

		(get_theme_mod( 'wp_indigo_border_color' ) == "" ) ? $wp_indigo_border_color = "#e6e6e6" : $wp_indigo_border_color = get_theme_mod( 'wp_indigo_border_color' ); 

		(get_theme_mod( 'wp_indigo_border_secondary_color' ) == "" ) ? $wp_indigo_border_secondary_color = "#d8d8d8" : $wp_indigo_border_secondary_color = get_theme_mod( 'wp_indigo_border_secondary_color' ); 

		(get_theme_mod( 'fade_in_animation' , true ) == true ) ? $wp_indigo_animation = 0 : $wp_indigo_animation = 1; 

		
		$html = ':root {	
					--wp_indigo_background-color: '.$wp_indigo_background_color.';
					--wp_indigo_primary-color: '.$wp_indigo_primary_color.';
					--wp_indigo_secondary-color: '.$wp_indigo_secondary_color.';
					--wp_indigo_tertiary_color: '.$wp_indigo_tertiary_color.';
					--wp_indigo_quaternary_color: '.$wp_indigo_quaternary_color.';
					--wp_indigo_accent_light_color: '.$wp_indigo_accent_light_color.';
					--wp_indigo_light_gray_color: '.$wp_indigo_light_gray_color.';
					--wp_indigo_border_color: '.$wp_indigo_border_color.';
					--wp_indigo_border_secondary_color: '.$wp_indigo_border_secondary_color.';
					--wp_indigo_animation: '.$wp_indigo_animation.';
				}';
		return $html;
		
	}
}

if ( ! function_exists('wp_indigo_theme_settings')) {
	function wp_indigo_theme_settings() {
		$wp_indigo_theme_typography = wp_indigo_typography();
		echo sprintf( '<style>%s</style>' , esc_html($wp_indigo_theme_typography) );
	}
}
add_action( 'admin_head', 'wp_indigo_theme_settings' );
add_action( 'wp_head', 'wp_indigo_theme_settings' );


if ( ! function_exists('wp_indigo_dashicons')) {
	function wp_indigo_dashicons() {
		/**
		 * Enable Dashicons
		 */
		wp_enqueue_style('dashicons');
	}
}
add_action('wp_enqueue_scripts', 'wp_indigo_dashicons', 999);


if ( ! function_exists('wp_indigo_modify_libwp_post_type') ) {
  function wp_indigo_modify_libwp_post_type( $wp_indigo_postTypeName ) {
	/**
	 * Modify LibWP post type name (If libwp plugin exist)
	 */
	$wp_indigo_postTypeName = 'portfolios';
	return $wp_indigo_postTypeName;
  }  
}
add_filter('libwp_post_type_1_name', 'wp_indigo_modify_libwp_post_type');


if ( ! function_exists('wp_indigo_modify_libwp_post_type_argument')) {
	
  function wp_indigo_modify_libwp_post_type_argument ($wp_indigo_postTypeArguments ) {  
  /**
	* Modify LibWP post type arguments (If libwp plugin exist)
	*/
	$wp_indigo_postTypeArguments['labels'] = [
		'name'          => _x('Portfolios', 'Post type general name', 'wp-indigo'),
		'singular_name' => _x('Portfolio', 'Post type singular name', 'wp-indigo'),
		'menu_name'     => _x('Portfolios', 'Admin Menu text', 'wp-indigo'),
		'add_new'       => __('Add New', 'wp-indigo'),
		'edit_item'     => __('Edit Portfolio', 'wp-indigo'),
		'view_item'     => __('View Portfolio', 'wp-indigo'),
		'all_items'     => __('All Portfolios', 'wp-indigo'),
	];
	
	$wp_indigo_postTypeArguments['rewrite']['slug'] = 'portfolios';
	$wp_indigo_postTypeArguments['public'] = true;
	$wp_indigo_postTypeArguments['show_ui'] = true;
	$wp_indigo_postTypeArguments['menu_position'] = 5;
	$wp_indigo_postTypeArguments['show_in_nav_menus'] = true;
	$wp_indigo_postTypeArguments['show_in_admin_bar'] = true;
	$wp_indigo_postTypeArguments['hierarchical'] = true;
	$wp_indigo_postTypeArguments['can_export'] = true;
	$wp_indigo_postTypeArguments['has_archive'] = true;
	$wp_indigo_postTypeArguments['exclude_from_search'] = false;
	$wp_indigo_postTypeArguments['publicly_queryable'] = true;
	$wp_indigo_postTypeArguments['capability_type'] = 'post';
	$wp_indigo_postTypeArguments['show_in_rest'] = true;
	$wp_indigo_postTypeArguments['supports'] = array('title', 'editor' , 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields' , 'comments');

	return $wp_indigo_postTypeArguments;
  }  
}
add_filter('libwp_post_type_1_arguments', 'wp_indigo_modify_libwp_post_type_argument');
  

if ( ! function_exists('wp_indigo_modify_libwp_taxonomy_name')) {
	function wp_indigo_modify_libwp_taxonomy_name($wp_indigo_taxonomyName) {
		/**
		* Modify LibWP taxonomy name (If libwp plugin exist)
		*/
		$wp_indigo_taxonomyName = 'portfolio_category';
		return $wp_indigo_taxonomyName;
	}
}
add_filter('libwp_taxonomy_1_name', 'wp_indigo_modify_libwp_taxonomy_name');


if ( ! function_exists('wp_indigo_modify_libwp_taxonomy_post_type_name')) {
	function wp_indigo_modify_libwp_taxonomy_post_type_name($wp_indigo_taxonomyPostTypeName) {
		/**
		* Modify LibWP taxonomy post type name (If libwp plugin exist)
		*/
		$wp_indigo_taxonomyPostTypeName = 'portfolios';
		return $wp_indigo_taxonomyPostTypeName;
	}
}
add_filter('libwp_taxonomy_1_post_type', 'wp_indigo_modify_libwp_taxonomy_post_type_name');
  
  
if ( ! function_exists('wp_indigo_modify_libwp_taxonomy_argument')) {
function wp_indigo_modify_libwp_taxonomy_argument($wp_indigo_taxonomyArguments) {
	/**
		* Modify LibWP taxonomy name (If libwp plugin exist)
		*/
		$wp_indigo_taxonomyArguments['labels'] = [
			'name'          => _x('Portfolio Categories', 'taxonomy general name', 'wp-indigo'),
			'singular_name' => _x('Portfolio Category', 'taxonomy singular name', 'wp-indigo'),
			'search_items'  => __('Search Portfolio Categories', 'wp-indigo'),
			'all_items'     => __('All Portfolio Categories', 'wp-indigo'),
			'edit_item'     => __('Edit Portfolio Category', 'wp-indigo'),
			'add_new_item'  => __('Add New Portfolio Category', 'wp-indigo'),
			'new_item_name' => __('New Portfolio Category Name', 'wp-indigo'),
			'menu_name'     => __('Portfolio Categories', 'wp-indigo'),
		];
		$wp_indigo_taxonomyArguments['rewrite']['slug'] = 'portfolio_category';
		$wp_indigo_taxonomyArguments['show_in_rest'] = true;
	
		return $wp_indigo_taxonomyArguments;
		
	}
}
add_filter('libwp_taxonomy_1_arguments', 'wp_indigo_modify_libwp_taxonomy_argument');


if ( ! function_exists('wp_indigo_add_menu_link_class')) {
	function wp_indigo_add_menu_link_class( $wp_indigo_atts, $wp_indigo_item, $wp_indigo_args ) {
		/**
		* Add class to nav menu links 
		*/
		if (property_exists($wp_indigo_args, 'link_class')) {
		$wp_indigo_atts['class'] = $wp_indigo_args->link_class;
		}
		return $wp_indigo_atts;
	}
}
add_filter( 'nav_menu_link_attributes', 'wp_indigo_add_menu_link_class', 1, 3 );


if ( ! function_exists('wp_indigo_modify_archive_title')) {
	function wp_indigo_modify_archive_title( $wp_indigo_title ) {
		/**
		 * Modify Archive title 
		 */

		if(is_post_type_archive('portfolios')){
			if(get_theme_mod( 'post_type_archive_custom_title' , 'portfolios')){
				return get_theme_mod( 'post_type_archive_custom_title' , 'portfolios');
			}
			else{
				return esc_html__( 'portfolios' , 'wp-indigo' );// Also Available to change From Kirki
			}
		}
		
		return wp_kses_post( $wp_indigo_title );
	}
}
add_filter( 'wp_title', 'wp_indigo_modify_archive_title' );
add_filter( 'get_the_archive_title', 'wp_indigo_modify_archive_title' );