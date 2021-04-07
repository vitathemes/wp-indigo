<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>
<footer class="footer-main">

    <?php
    if (has_nav_menu('footer-menu')) {
	    wp_nav_menu( array(
		    'theme_location' => 'footer-menu',
		    'menu_class'     => 'list navigation navigation--footer',
		    'menu_id'        => 'navigation',
		    'container'      => '',
		    'depth'          => 2,
	    ) );
    }?>

	<?php
	if ( get_theme_mod( 'copyright_text' ) ) {
		echo esc_html( get_theme_mod( 'copyright_text' ) ); ?>
        <a class="link" href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" target="_blank">
            <svg class="icon icon-rss">
                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/images/defs.svg#icon-rss"></use>
            </svg>
        </a>
		<?php
	}
	?>

    <p class="extra">
        <?php esc_html_e( 'WP-Indigo', 'wp-indigo' ); ?> <?php esc_html_e( 'by', 'wp-indigo' ); ?>
        <a rel="noreferrer" target="_blank" title="<?php esc_attr_e( 'Clean, Minimal and Fast-loading WordPress Themes', 'wp-indigo' ); ?>" class="link" href="<?php echo esc_url( 'https://vitathemes.com' ); ?>"><?php esc_html_e( 'VitaThemes', 'wp-indigo' ); ?></a>
    </p>
</footer>

</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
