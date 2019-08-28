<?php
require "classes/indigo_Walker_Comment.php";

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
		echo '<a aria-label="Go to HomePage" class="custom-logo-link" href="' . site_url() . '"><img alt="" src="' . get_template_directory_uri() . '/assets/images/profile.jpg" /></a>';
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
			if ( strpos( $name[1], 'mail' ) !== false ) {
				echo '<a rel="noopener" aria-label="Email me" class="link" data-title="' . $social . '" href="mailto:' . $social . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-' . $name[1] . '"></use></svg>
		</a>';
			} else {
				$name = explode( '-', $social_name );
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
	$text_typography            = get_theme_mod( 'text_typography' );
	$heading_typography         = get_theme_mod( 'headings_typography' );
	$default_heading_typography = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "26px",
		'variant'     => 'regular',
		'line-height' => '28px',
		'color'       => '#1a1a1a'
	);
	$default_text_typography    = array(
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
	$authors  = array();
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
			'author'  =>
				'<p class="comment-form-author">' .
				'<input placeholder="Your Name" id="author" name="author" type="text" size="30" /></p>',
			'email'   =>
				'<p class="comment-form-email">' .
				'<input placeholder="Your Email" id="email" name="email" type="email" value="" size="30" /></p>',
			'url'     => '',
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