<?php 
/**
 * The main template file
 *
 *
 * @link https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
 *
 * @package wp-indigo
 */
?>
<h2><?php _e( 'Categories', 'wp-indigo' ); ?></h2>
<form id="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
 
    <?php
    $wp_indigo_category_args = array(
        'show_option_none' => __( 'Select category', 'wp-indigo' ),
        'show_count'       => 1,
        'orderby'          => 'name',
        'echo'             => 0,
    );
    ?>
 
    <?php $wp_indigo_select  = wp_dropdown_categories( $wp_indigo_category_args ); ?>
    <?php $wp_indigo_replace = "<select$1 onchange='return this.form.submit()'>"; ?>
    <?php $wp_indigo_select  = preg_replace( '#<select([^>]*)>#', $wp_indigo_replace, $wp_indigo_select ); ?>
 
    <?php echo $wp_indigo_select; ?>
 
    <noscript>
        <input type="submit" value="View" />
    </noscript>
 
</form>