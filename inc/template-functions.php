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
function wp_indigo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wp_indigo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_indigo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wp_indigo_pingback_header' );



function wp_indigo_typography() {
	
	/** Colors */
	if ( get_theme_mod( 'typography_primary_color' ) == "" ) {
		$wp_indigo_primary_color = "#1A1A1A";
	} else {
		$wp_indigo_primary_color = get_theme_mod( 'typography_primary_color' );
	}
	if ( get_theme_mod( 'typography_secondary_color' ) == "" ) {
		$wp_indigo_secondary_color = "#555555";
	} else {
		$wp_indigo_secondary_color = get_theme_mod( 'typography_secondary_color' );
	}
	if ( get_theme_mod( 'wp_indigo_tertiary_color' ) == "" ) {
		$wp_indigo_tertiary_color = "#C4C4C4";
	} else {
		$wp_indigo_tertiary_color = get_theme_mod( 'wp_indigo_tertiary_color' );
	}
	if ( get_theme_mod( 'wp_indigo_quaternary_color' ) == "" ) {
		$wp_indigo_quaternary_color = "#3F51B5";
	} else {
		$wp_indigo_quaternary_color = get_theme_mod( 'wp_indigo_quaternary_color' );
	}
	



	$html = ':root {	
	            --wp_indigo_primary-color: '.$wp_indigo_primary_color.';
	            --wp_indigo_secondary-color: '.$wp_indigo_secondary_color.';
				--wp_indigo_tertiary_color: '.$wp_indigo_tertiary_color.';
				--wp_indigo_quaternary_color: '.$wp_indigo_quaternary_color.'

			}';
			
	return $html;
	
}

add_action( 'admin_head', 'wp_indigo_theme_settings' );
add_action( 'wp_head', 'wp_indigo_theme_settings' );

function wp_indigo_theme_settings() {
	$wp_indigo_theme_typography = wp_indigo_typography();

	?>
<style>
<?php echo esc_html($wp_indigo_theme_typography);
?>
</style>
<?php
}


function wp_indigo_show_description() {
	/**
	 * Display Description for profile section 
	 */
	if ( get_bloginfo( 'description' ) !== '' ) { 

		printf('<h4 class="description">');// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo  esc_html(bloginfo( 'description' ));
		printf( '</h4>' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

function wp_indigo_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'wp_indigo_dashicons', 999);



if( true == get_theme_mod( 'portfolios_control', true ) ) {
  /**
	* Check if portfolios Part is activated
	*/


  function wp_indigo_modify_libwp_post_type($wp_indigo_postTypeName){
  /**
    * Modify LibWP post type name (If libwp plugin exist)
    */
	$wp_indigo_postTypeName = 'portfolios';
	return $wp_indigo_postTypeName;
  }  
  add_filter('libwp_post_type_1_name', 'wp_indigo_modify_libwp_post_type');

  
  function wp_indigo_modify_libwp_post_type_argument($wp_indigo_postTypeArguments){  
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
	$wp_indigo_postTypeArguments['supports'] = array('title', 'editor' , 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields');
  
	return $wp_indigo_postTypeArguments;
  }  
  add_filter('libwp_post_type_1_arguments', 'wp_indigo_modify_libwp_post_type_argument');
  
  

  function wp_indigo_modify_libwp_taxonomy_name($wp_indigo_taxonomyName){
    /**
	* Modify LibWP taxonomy name (If libwp plugin exist)
	*/
	$wp_indigo_taxonomyName = 'portfolio_category';
	return $wp_indigo_taxonomyName;
	
  }
  add_filter('libwp_taxonomy_1_name', 'wp_indigo_modify_libwp_taxonomy_name');
  
  
  
  function wp_indigo_modify_libwp_taxonomy_post_type_name($wp_indigo_taxonomyPostTypeName){
  /**
	* Modify LibWP taxonomy post type name (If libwp plugin exist)
	*/
	$wp_indigo_taxonomyPostTypeName = 'portfolios';
	return $wp_indigo_taxonomyPostTypeName;
  }
  add_filter('libwp_taxonomy_1_post_type', 'wp_indigo_modify_libwp_taxonomy_post_type_name');
  
  

function wp_indigo_modify_libwp_taxonomy_argument($wp_indigo_taxonomyArguments){
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
  
add_filter('libwp_taxonomy_1_arguments', 'wp_indigo_modify_libwp_taxonomy_argument');

}

function wp_indigo_add_menu_link_class( $wp_indigo_atts, $wp_indigo_item, $wp_indigo_args ) {
	/**
	* Add class to nav menu links 
	*/
	if (property_exists($wp_indigo_args, 'link_class')) {
	  $wp_indigo_atts['class'] = $wp_indigo_args->link_class;
	}
	return $wp_indigo_atts;
  }
add_filter( 'nav_menu_link_attributes', 'wp_indigo_add_menu_link_class', 1, 3 );
