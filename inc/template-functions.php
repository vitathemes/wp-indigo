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
		echo '<a class="custom-logo-link" href="' . site_url() . '"><img src="' . get_bloginfo( 'template_url' ) . '/assets/images/profile.jpg" /></a>';
	}
}


// Show social Field
function indigo_show_social( $social_name ) {
	$social = get_theme_mod( $social_name );
	if ( $social != "" ) {
		$name = explode( '-', $social_name );
		echo '<a class="link" data-title="' . $social . '" href="' . $social . '" target="_blank">
			<svg class="icon icon-facebook"><use xlink:href="' . get_bloginfo( 'template_url' ) . '/assets/images/defs.svg#icon-' . $name[1] . '"></use></svg>
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


function remove_unused_sections( $wp_customize ) {
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );
}

add_action( 'customize_register', 'remove_unused_sections', 11 );