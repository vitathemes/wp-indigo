<?php
require "classes/WpIndigo_Walker_Comment.php";
require "classes/WpIndigo_Walker_Nav.php";

//Show Profile
function wpindigo_show_profile() {
	get_template_part( "template-parts/profile" );
}

// Menu Generator
function wpindigo_show_menu() {
	if ( has_nav_menu( 'primary-menu' ) ) {
		$wpindigo_menu_args = array(
			'theme_location'  => 'primary-menu',
			'menu_class'      => 'list navigation',
			'menu_id'        => 'navigation',
			'container'       => '',
			'depth'           => 2,
			'walker' => new WpIndigo_Walker_Nav()
		);
		if ( ! is_front_page() ) {
			$wpindigo_menu_args['container_class'] = 'nav';
		}
		echo '<nav id="site-navigation main-nav" class="main-navigation nav-home nav" role="navigation" aria-label="Main Navigation">';
		wp_nav_menu( $wpindigo_menu_args );
		echo '</nav>';
	}
}

// Show Post Tags
function wpindigo_show_tags() {
	the_tags( '', ' ', '' );
}

// Show Name Field
function wpindigo_show_avatar() {
	if ( has_custom_logo() ) {
		the_custom_logo();
	}
}

/**
 * Show socials list
 *
 * @param $wpindigo_social_names | array
 */
function wpindigo_show_socials( $wpindigo_social_names ) {
	foreach ( $wpindigo_social_names as $wpindigo_social_name ) {
		$social = esc_attr(get_theme_mod( $wpindigo_social_name ));
		if ( $social != "" ) {
			$name = explode( '-', $wpindigo_social_name );
			if ( strpos( $name[1], 'mail' ) !== false ) {
				echo '<a rel="noopener" aria-label="Email me" class="link" data-title="' . sanitize_email($social) . '" href="mailto:' . sanitize_email($social) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-' . $name[1] . '"></use></svg>
		</a>';
			} else {
				$name = explode( '-', $wpindigo_social_name );
				echo '<a rel="noopener" aria-label="View ' . $name[1] . ' page" class="link" data-title="' . $social . '" href="' . $social . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-' . $name[1] . '"></use></svg>
		</a>';
			}
		}
	}
}

/**
 * Check active socials
 *
 * @param $wpindigo_social_names
 *
 * @return bool
 */
function wpindigo_check_socials( $wpindigo_social_names ) {
	foreach ( $wpindigo_social_names as $wpindigo_social_name ) {
		$social = get_theme_mod( $wpindigo_social_name );
		if ( $social != "" ) {
			return true;
		}
	}

	return false;
}

// Load theme typography
function wpindigo_typography() {
	$wpindigo_text_typography            = get_theme_mod( 'text_typography' );
	$wpindigo_heading_typography         = get_theme_mod( 'headings_typography' );
	$wpindigo_default_heading_typography = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "26px",
		'variant'     => 'regular',
		'line-height' => '31px',
		'color'       => '#1a1a1a'
	);
	$default_text_typography    = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "16px",
		'variant'     => 'regular',
		'line-height' => '28px',
		'color'       => '#666666'
	);
	if ( empty( $wpindigo_heading_typography ) ) {
		$wpindigo_heading_typography = $wpindigo_default_heading_typography;
	} else {
		$wpindigo_heading_typography = array_merge( $wpindigo_default_heading_typography, $wpindigo_heading_typography );
	}
	if ( empty( $wpindigo_text_typography ) ) {
		$wpindigo_text_typography = $default_text_typography;
	} else {
		$wpindigo_text_typography = array_merge( $default_text_typography, $wpindigo_text_typography );
	}
	$html = ':root {
				--heading-typography-font-size: ' . $wpindigo_heading_typography["font-size"] . ';
	            --heading-typography-font-family: ' . $wpindigo_heading_typography["font-family"] . ';
	            --heading-typography-line-height: ' . $wpindigo_heading_typography["line-height"] . ';
	            --heading-typography-variant: ' . $wpindigo_heading_typography["variant"] . ';
	            --text-typography-font-size: ' . $wpindigo_text_typography["font-size"] . ';
	            --text-typography-font-family: ' . $wpindigo_text_typography["font-family"] . ';
	            --text-typography-line-height: ' . $wpindigo_text_typography["line-height"] . ';
	            --text-typography-variant: ' . $wpindigo_text_typography["variant"] . ';
	
	            --primary-color: ' . get_theme_mod( "branding_primary_color", "#3F51B5" ) . ';
	            --secondary-color: ' . $wpindigo_heading_typography["color"] . ';
	            --tertiary-color: ' . $wpindigo_text_typography['color'] . ';
			}';
	echo esc_html($html);
}

//
function wpindigo_get_discussion_data() {
	static $discussion, $post_id;
	$wpindigo_current_post_id = get_the_ID();
	if ( $wpindigo_current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $wpindigo_current_post_id;
	}
	$wpindigo_comments = get_comments(
		array(
			'post_id' => $wpindigo_current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);
	$wpindigo_authors  = array();
	foreach ( $wpindigo_comments as $wpindigo_comment ) {
		$wpindigo_authors[] = ( (int) $wpindigo_comment->user_id > 0 ) ? (int) $wpindigo_comment->user_id : $wpindigo_comment->comment_author_email;
	}
	$wpindigo_authors    = array_unique( $wpindigo_authors );
	$discussion = (object) array(
		'authors'   => array_slice( $wpindigo_authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $wpindigo_current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

//
function wpindigo_comment_form( $wpindigo_order ) {
	if ( true === $wpindigo_order || strtolower( $wpindigo_order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
		$wpindigo_fields = array(
			'author'  =>
				'<p class="comment-form-author">' .
				'<input placeholder="'. esc_html( 'Your Name', 'wp-indigo' ) .'" id="author" name="author" type="text" size="30" /></p>',
			'email'   =>
				'<p class="comment-form-email">' .
				'<input placeholder="'. esc_html( 'Comments are disabled.', 'wp-indigo' ) .'" id="email" name="email" type="email" value="" size="30" /></p>',
			'url'     => '',
			'cookies' => ''
		);
		comment_form(
			array(
				'logged_in_as'         => null,
				'title_reply'          => null,
				'comment_notes_before' => false,
				'label_submit'         => 'Submit',
				'fields'               => $wpindigo_fields,
				'comment_field'        => '<p class="comment-form-comment"><textarea placeholder="'. esc_html( 'Write Your Comment', 'wp-indigo' ) .'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
			)
		);
	}
}
