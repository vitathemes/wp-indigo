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
	if ( get_theme_mod( 'name' ) != "" ) {
		echo get_theme_mod( 'name' );
	}
	?> © <?php echo date( 'Y' ); ?> <a class="link" href="<?php echo bloginfo('rss2_url'); ?>" target="_blank">
        <svg class="icon icon-rss">
            <use xlink:href="<?php echo get_bloginfo('template_url') ?>/assets/images/defs.svg#icon-rss"></use>
        </svg>
    </a>

    <p class="extra">
        <a target="_blank" class="link" href="https://github.com/veronalabs/wp-indigo">WP-Indigo theme</a> by
        <a target="_blank" title="WordPress Solutions to Meet Your Needs and Help You Grow" class="link"
           href="https://veronalabs.com/">VeronaLabs</a>
    </p>
</footer>

<?php wp_footer(); ?>
</div></div></body></html>
