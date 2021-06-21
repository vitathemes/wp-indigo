<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-indigo
 * 
 */
if (!is_active_sidebar( 'wp-indigo-primary-sidebar' )) {
	return;
}
?>
<aside id="secondary" class="c-widget widge-area <?php wp_indigo_get_fade_in_animation( false ); ?>">
    <?php dynamic_sidebar( 'wp-indigo-primary-sidebar' ); ?>
</aside><!-- #secondary -->