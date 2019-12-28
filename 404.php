<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */

get_header();
?>
    <section class="lost-container">
        <h2><?php esc_html_e('Page Not Found - 404' , 'wp-indigo'); ?></h2>
        <p><?php esc_html_e('This page not found (deleted or never exists). try a phrase in search box or back to home and start again.' , 'wp-indigo'); ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Take me home!' , 'wp-indigo'); ?></a>
        <br>
        <br>
        <?php get_search_form(); ?>
    </section>
<?php
get_footer();