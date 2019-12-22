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
	if ( get_theme_mod( 'copyright_text' ) ) {
		echo esc_html( get_theme_mod( 'copyright_text' ) ); ?>
        <a class="link" href="<?php echo bloginfo( 'rss2_url' ); ?>" target="_blank">
            <svg class="icon icon-rss">
                <use xlink:href="<?php echo esc_html( get_template_directory_uri() ) ?>/assets/images/defs.svg#icon-rss"></use>
            </svg>
        </a>
		<?php
	}
	?>

    <p class="extra">
        <a rel="noreferrer" target="_blank" class="link" href="https://github.com/vitathemes/wp-indigo"><?php echo esc_html_e( 'WP-Indigo', 'wp-indigo' ); ?></a> <?php echo esc_html_e( 'by', 'wp-indigo' ); ?>
        <a rel="noreferrer" target="_blank" title="Clean, Minimal and Fast-loading WordPress Themes" class="link" href="https://vitathemes.com/"><?php echo esc_html_e( 'VitaThemes', 'wp-indigo' ); ?></a>
    </p>
</footer>

<?php wp_footer(); ?>
</div>
</div>
</body>
</html>
