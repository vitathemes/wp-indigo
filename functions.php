<?php

include('includes/customizer.php');
include ('includes/fields.php');

// Template url
$theme_url = get_Template_directory_uri();

// External Assets
function scripts() {
	wp_enqueue_style( 'sector-style', get_template_directory_uri() . '/assets/css/style.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'scripts' );

// Navigation
register_nav_menus( array(
	'primary-menu' => esc_html__( 'Primary' ),
) );

// Menu Generator
function show_menu( $menu_name ) {
	$menu_items = wp_get_nav_menu_items( $menu_name );
	if ( $menu_items ) {
	foreach ($menu_items as $menu_item) {
		echo '<li class="item">
              <a class="link" href="'. $menu_item->url . '">'. $menu_item->title .'</a>
              </li>';
	}
	}
}

// Show Post Tags

function show_tags() {
	$post_tags = get_the_tags();
	if ($post_tags) {
		foreach($post_tags as $tag) {
			echo '<a href="'; echo bloginfo('url');
			echo '/?tag=' . $tag->slug . '" class="item">' . $tag->name . '</a>';
		}
	}
}
