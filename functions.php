<?php
/**
 * wp-indigo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp-indigo
 */

/**
 * Theme Setup
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Comments walker
 */
require get_template_directory() . '/classes/class_wp_indigo_walker_comment.php';

/**
 * Nav walker
 */
require get_template_directory() . '/classes/class_wp_indigo_walker_nav_menu.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
  * Load TGMPA file
  */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/tgmpa-config.php';