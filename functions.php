<?php

require get_template_directory() . '/inc/setup.php';

require get_template_directory() . '/vendor/autoload.php';

require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/template-functions.php';

/**
 * Enqueue scripts and styles.
 */
// External Assets
function indigo_scripts() {
	wp_enqueue_style( 'indigo-style', get_template_directory_uri() . '/assets/css/style.css' );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'indigo_scripts' );

