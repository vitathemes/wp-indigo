<?php
if ( get_theme_mod( 'show_profile_section', 1 ) ):
	?>
    <header class="header-home animated">
        <div class="selfie <?php echo get_theme_mod( 'profile_animation', true ) ? "has-animation" : ''; ?>"><?php indigo_show_avatar(); ?></div>
        <a class="title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1
                    class="title"><?php bloginfo( 'name' ); ?></h1></a>
		<?php if ( get_bloginfo( 'description' ) !== '' ) { ?>
            <h2 class="description"><?php bloginfo( 'description' ); ?></h2>
		<?php } ?>
        <div class="social-links">
			<?php
			indigo_show_social( 'social-facebook' );
			indigo_show_social( 'social-twitter' );
			indigo_show_social( 'social-instagram' );
			indigo_show_social( 'social-pinterest' );
			indigo_show_social( 'social-linkedin' );
			indigo_show_social( 'social-youtube' );
			indigo_show_social( 'social-spotify' );
			indigo_show_social( 'social-github' );
			indigo_show_social( 'social-gitlab' );
			indigo_show_social( 'social-lastfm' );
			indigo_show_social( 'social-stackoverflow' );
			indigo_show_social( 'social-quora' );
			indigo_show_social( 'social-reddit' );
			indigo_show_social( 'social-medium' );
			indigo_show_social( 'social-vimeo' );
			indigo_show_social( 'social-lanyrd' );
			indigo_show_social( 'social-mail' );
			?>
        </div>
    </header>
<?php
endif;