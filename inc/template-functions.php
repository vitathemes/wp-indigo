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
		echo '<a class="custom-logo-link" href="'. site_url() .'"><img src="' . get_template_directory_uri() . '/assets/images/profile.jpg" /></a>';
	}
}


// Show Name Field
function indigo_show_socials() {

	if ( get_theme_mod( 'social-facebook' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-facebook' ) . '" href="' . get_theme_mod( 'social-facebook' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-facebook"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-twitter' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-twitter' ) . '" href="' . get_theme_mod( 'social-twitter' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-twitter"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-instagram' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-instagram' ) . '" href="' . get_theme_mod( 'social-instagram' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-instagram"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-pinterest' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-pinterest' ) . '" href="' . get_theme_mod( 'social-pinterest' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-pinterest"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-linkedin' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-linkedin' ) . '" href="' . get_theme_mod( 'social-linkedin' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-linkedin"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-youtube' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-youtube' ) . '" href="' . get_theme_mod( 'social-youtube' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-youtube"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-spotify' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-spotify' ) . '" href="' . get_theme_mod( 'social-spotify' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-spotify"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-github' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-github' ) . '" href="' . get_theme_mod( 'social-github' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-github"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-gitlab' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-gitlab' ) . '" href="' . get_theme_mod( 'social-gitlab' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-gitlab"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-lastfm' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-lastfm' ) . '" href="' . get_theme_mod( 'social-lastfm' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-lastfm"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-stackoverflow' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-stackoverflow' ) . '" href="' . get_theme_mod( 'social-stackoverflow' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-stackoverflow"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-quora' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-quora' ) . '" href="' . get_theme_mod( 'social-quora' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-quora"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-reddit' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-reddit' ) . '" href="' . get_theme_mod( 'social-reddit' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-reddit"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-medium' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-medium' ) . '" href="' . get_theme_mod( 'social-medium' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-medium"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-vimeo' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-vimeo' ) . '" href="' . get_theme_mod( 'social-vimeo' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-vimeo"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-lanyrd' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-lanyrd' ) . '" href="' . get_theme_mod( 'social-lanyrd' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-lanyrd"></use></svg>
		</a>';
	}
	if ( get_theme_mod( 'social-mail' ) != "" ) {
		echo '<a class="link" data-title="' . get_theme_mod( 'social-mail' ) . '" href="mailto:' . get_theme_mod( 'social-mail' ) . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/images/defs.svg#icon-mail"></use></svg>
		</a>';
	}
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


function remove_unused_sections($wp_customize) {
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );
}

add_action( 'customize_register', 'remove_unused_sections', 11 );