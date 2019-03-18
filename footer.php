<footer class="footer-main">

	<?php
	if ( get_theme_mod( 'name' ) != "" ) {
		echo get_theme_mod( 'name' );
	}
	?> © <?php echo date( 'Y' ); ?> <a class="link" href="<?php echo site_url(); ?>/feed.xml" target="_blank">
        <svg class="icon icon-rss">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/defs.svg/#icon-rss"></use>
        </svg>
    </a>

    <p class="extra">
        <a target="_blank" class="link" href="https://github.com/veronalabs/wp-indigo">WP-Indigo theme</a> by
        <a target="_blank" title="WordPress Solutions to Meet Your Needs and Help You Grow" class="link" href="https://veronalabs.com/">VeronaLabs</a>
    </p>
</footer>

<?php wp_footer(); ?>
</div></div></body></html>
