<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

?>

<div id="comments" class="comments-area">

    <?php
	//Custom comment form 
	$comments_args = array(
		//Define Fields
		'fields' => array(
						
			// Author field
			'author' => '<p class="comment-form-author h5 u-letter-space-small">'. __( 'Name*', 'wp-indigo' ).'<br /><input type="text" id="author" name="author" aria-required="true" required></input></p>',
			// Email Field
			'email' => '<p class="comment-form-email h5 u-letter-space-small">'. __( 'Email*', 'wp-indigo' ).'<br /><input type="email" id="email" name="email" required></input></p>',
			// URL Field
			'url' => '<p class="comment-form-url h5 u-letter-space-small">'. __( 'Website', 'wp-indigo' ).'<br /><input type="url" id="url" name="url" required></input></p>',
			// Cookies
			'cookies' => '<div class="c-comment__cookie"><input type="checkbox" name="wp-comment-cookies-consent" required><span class="c-comments__cookie h5 u-letter-space-small">' . __(' Save my name, email, and website in this browser for the next time I comment', 'wp-indigo' ) .'</span></div>',
			
		),
		// Change the title of send button
		'label_submit' => __( 'POST COMMENT', 'wp-indigo'),
		// Change the title of the reply section
		'title_reply' => '<p class="c-comments__title c-comments__title--primary h2">'. __( 'Join the Conversation' , 'wp-indigo') .'</p><p class="c-comments__title h3 u-letter-space-medium">'. __( 'Leave a reply' , 'wp-indigo') .'</p>',
		// Change the title of the reply section
		'title_reply_to' =>   __( 'Reply' , 'wp-indigo'),
		//Cancel Reply Text
		'cancel_reply_link' =>	'<p class="h4 u-link--secondary">'.__( 'Cancel Reply', 'wp-indigo' ).'</p>',
		// Redefine your own textarea (the comment body).
		'comment_field' => '<p class="comment-form-comment h5 u-letter-space-small">'. __( 'Comment*', 'wp-indigo' ).'<br /><textarea id="comment" name="comment" aria-required="true" ></textarea></p>',
		//Message Before Comment
		'comment_notes_before' =>'<p class="c-comments__desc h5 u-letter-space-small">'. __( 'Your email address will not be published. Required fields are marked *' , 'wp-indigo') .'</p>',
		// Remove "Text or HTML to be displayed after the set of comment fields".
		'comment_notes_after' => '',
		//Submit Button ID
		'id_submit' =>  __( 'comment-submit' , 'wp-indigo'),
		'class_submit' =>  __( 'wp-indigo-comment-submit' , 'wp-indigo'),
	);
	
	comment_form( $comments_args );

	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
    <div class="comment-list">
        <h2 class="comments-title h3 u-letter-space-medium">
            <?php
			$wp_indigo_comment_count = get_comments_number();
			if ( '1' === $wp_indigo_comment_count ) {
				echo esc_html__( "Comment", "wp-indigo" );
			} else {
				echo esc_html__( "Comments", "wp-indigo" );
			}
			?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'walker'     => new Wp_indigo_walker_comment(),
					'avatar_size' => 64,
				)
			);
			?>
        </ol><!-- .comment-list -->

        <?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-indigo' ); ?></p>
        <?php
		endif;?>
    </div>

    <?php

	endif; // Check for have_comments().
	
	?>

</div><!-- #comments -->