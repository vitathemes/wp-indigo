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
<script>

    /**
     * File navigation.js.
     *
     * Handles toggling the navigation menu for small screens and enables TAB key
     * navigation support for dropdown menus.
     */
    (function () {
        var container, menu, links, i, len;

        container = document.getElementById('site-navigation');
        if (!container) {
            return;
        }

        menu = container.getElementsByTagName('ul')[0];

        menu.setAttribute('aria-expanded', 'false');
        if (-1 === menu.className.indexOf('navigation')) {
            menu.className += ' navigation';
        }

        // Get all the link elements within the menu.
        links = menu.getElementsByTagName('a');

        // Each time a menu link is focused or blurred, toggle focus.
        for (i = 0, len = links.length; i < len; i++) {
            links[i].addEventListener('focus', toggleFocus, true);
            links[i].addEventListener('blur', toggleFocus, true);
        }

        /**
         * Sets or removes .focus class on an element.
         */
        function toggleFocus() {
            var self = this;

            // Move up through the ancestors of the current link until we hit .nav-home.
            while (-1 === self.className.indexOf('navigation')) {
                console.log(self.className.indexOf('navigation'));
                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    if (-1 !== self.className.indexOf('focus')) {
                        self.className = self.className.replace(' focus', '');
                    } else {
                        self.className += ' focus';
                    }
                }

                self = self.parentElement;
            }
        }
    })();


</script>
</body>
</html>
