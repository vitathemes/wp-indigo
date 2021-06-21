<?php 
/**
 * Categories File Showing as drop down
 *
 * @link https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
 *
 * @package wp-indigo
 */
?>
<h2><?php esc_html_e( 'Categories', 'wp-indigo' ); ?></h2>
<div class="c-categories c-categories--dropdown s-categories--dropdown">
    <?php the_widget('WP_Widget_Categories', array('title' => ' ', 'dropdown' => true) ); ?>
</div>