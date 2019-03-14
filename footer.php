        <footer class="footer-main">

	        <?php
	        if( get_theme_mod( 'name') != "" ) {
		        echo get_theme_mod( 'name');
	        }
	        ?> © 2019 <a class="link" href="http://localhost:4000/feed.xml" target="_blank"><svg class="icon icon-rss"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/defs.svg/#icon-rss"></use></svg></a>

            <p class="extra">
                <a class="link" href="https://github.com/sergiokopplin/indigo">Indigo theme</a> by <a class="link" href="https://github.com/sergiokopplin/indigo">Kopplin</a>
            </p>
        </footer>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
