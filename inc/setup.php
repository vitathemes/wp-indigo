<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function indigo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'wp-indigo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wp-indigo', get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary', 'wp-indigo' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
add_action( 'after_setup_theme', 'indigo_setup' );
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
//Show Profile
function indigo_show_profile() {
	get_template_part( "template-parts/profile" );
}
// Menu Generator
function indigo_show_menu() {
	if ( has_nav_menu( 'primary-menu' ) ) {
		$menu_args = array(
			'theme_location'  => 'primary-menu',
			'menu_class'      => 'list',
			'container'       => 'div',
			'container_class' => 'nav-home',
			'depth'           => 1
		);
		if ( ! is_front_page() ) {
			$menu_args['container_class'] = 'nav';
			$menu_args['depth']           = 0;
		}
		wp_nav_menu( $menu_args );
	}
}
// Show Post Tags
function indigo_show_tags() {
	the_tags( '', ' ', '' );
}
// Show Name Field
function indigo_show_avatar() {
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		echo '<a class="custom-logo-link" href="' . site_url() . '"><img src="' . get_bloginfo( 'template_url' ) . '/assets/images/profile.jpg" /></a>';
	}
}
/**
 * Show socials list
 *
 * @param $social_names | array
 */
function indigo_show_socials( $social_names ) {
	foreach ( $social_names as $social_name ) {
		$social = get_theme_mod( $social_name );
		if ( $social != "" ) {
			$name = explode( '-', $social_name );
			if (strpos($name[1], 'mail') !== false) {
				echo '<a class="link" data-title="' . $social . '" href="mailto:' . $social . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_bloginfo( 'template_url' ) . '/assets/images/defs.svg#icon-' . $name[1] . '"></use></svg>
		</a>';
			} else{
			$name = explode( '-', $social_name );
			echo '<a class="link" data-title="' . $social . '" href="' . $social . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_bloginfo( 'template_url' ) . '/assets/images/defs.svg#icon-' . $name[1] . '"></use></svg>
		</a>';
			}
		}
	}
}
/**
 * Check active socials
 *
 * @param $social_names
 *
 * @return bool
 */
function indigo_check_socials( $social_names ) {
	foreach ( $social_names as $social_name ) {
		$social = get_theme_mod( $social_name );
		if ( $social != "" ) {
			return true;
		}
	}
	return false;
}
// Load theme typography
function indigo_typography() {
	$text_typography    = get_theme_mod( 'text_typography' );
	$heading_typography = get_theme_mod( 'headings_typography' );
	$default_heading_typography = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "16px",
		'variant'     => 'regular',
		'line-height' => '28px',
		'color'       => '#666666'
	);
	$default_text_typography = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "16px",
		'variant'     => 'regular',
		'line-height' => '28px',
		'color'       => '#666666'
	);
	if ( empty( $heading_typography ) ) {
		$heading_typography = $default_heading_typography;
	} else {
		$heading_typography = array_merge( $default_heading_typography, $heading_typography );
	}
	if ( empty( $text_typography ) ) {
		$text_typography = $default_text_typography;
	} else {
		$text_typography = array_merge( $default_text_typography, $text_typography );
	}
	$html = '<style>
	        :root {
				--heading-typography-font-size: ' . $heading_typography["font-size"] . ';
	            --heading-typography-font-family: ' . $heading_typography["font-family"] . ';
	            --heading-typography-line-height: ' . $heading_typography["line-height"] . ';
	            --heading-typography-variant: ' . $heading_typography["variant"] . ';
	            --text-typography-font-size: ' . $text_typography["font-size"] . ';
	            --text-typography-font-family: ' . $text_typography["font-family"] . ';
	            --text-typography-line-height: ' . $text_typography["line-height"] . ';
	            --text-typography-variant: ' . $text_typography["variant"] . ';
	
	            --primary-color: ' . get_theme_mod( "branding_primary_color", "#3F51B5" ) . ';
	            --secondary-color: ' . $heading_typography["color"] . ';
	            --tertiary-color: ' . $text_typography['color'] . ';
			}
		    </style>';
	echo $html;
}
//
function indigo_get_discussion_data() {
	static $discussion, $post_id;
	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}
	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);
	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}
	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);
	return $discussion;
}
//
function indigo_comment_form( $order ) {
	if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
		$fields = array(
			'author' =>
				'<p class="comment-form-author">' .
				'<input placeholder="Your Name" id="author" name="author" type="text" size="30" /></p>',
			'email' =>
				'<p class="comment-form-email">' .
				'<input placeholder="Your Email" id="email" name="email" type="email" value="" size="30" /></p>',
			'url' => '',
			'cookies' => ''
		);
		comment_form(
			array(
				'logged_in_as'         => null,
				'title_reply'          => null,
				'comment_notes_before' => false,
				'label_submit'         => 'Submit',
				'fields'               => $fields,
				'comment_field'        => '<p class="comment-form-comment"><textarea placeholder="Write your comment" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
			)
		);
	}
}
//
function indigo_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}
// Remove unnecessary fields from comment form
add_filter( 'comment_form_default_fields', 'website_field_remove' );
function website_field_remove( $fields ) {
	if ( isset( $fields['url'] ) ) {
		unset( $fields['url'] );
		unset( $fields['cookies'] );
	}
	return $fields;
}
function remove_unused_sections( $wp_customize ) {
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );
}
add_action( 'customize_register', 'remove_unused_sections', 11 );
if ( ! isset( $content_width ) ) {
	$content_width = 560;
}