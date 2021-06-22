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
	$wp_indigo_comments_args = array(
		//Define Fields
		'fields' => array(
						
			// Author field
			'author' => '<p class="comment-form-author h5 u-letter-space-small">'. esc_html__( 'Name*', 'wp-indigo' ).'<br /><input type="text" id="author" name="author" aria-required="true" required /></p>',
			// Email Field
			'email' => '<p class="comment-form-email h5 u-letter-space-small">'. esc_html__( 'Email*', 'wp-indigo' ).'<br /><input type="email" id="email" name="email" required /></p>',
			// URL Field
			'url' => '<p class="comment-form-url h5 u-letter-space-small">'. esc_html__( 'Website', 'wp-indigo' ).'<br /><input type="url" id="url" name="url" required /></p>',
			// Cookies
			'cookies' => '<div class="c-comment__cookie"><input type="checkbox" name="wp-comment-cookies-consent" required><span class="c-comments__cookie h5 u-letter-space-small">' . esc_html__(' Save my name, email, and website in this browser for the next time I comment', 'wp-indigo' ) .'</span></div>',
			
		),
		// Change the title of send button
		'label_submit' => esc_html__( 'POST COMMENT', 'wp-indigo'),
		// Change the title of the reply section
		'title_reply' => '<span class="c-comments__title c-comments__title--primary h2">'. esc_html__( 'Join the Conversation' , 'wp-indigo') .'</span><span class="c-comments__title c-comments__title--reply h3 u-letter-space-medium">'. esc_html__( 'Leave a reply' , 'wp-indigo') .'</span>',
		// Change the title of the reply section
		'title_reply_to' =>   esc_html__( 'Reply' , 'wp-indigo'),
		//Cancel Reply Text
		'cancel_reply_link' =>	'<span class="h4 u-link--secondary">'.esc_html__( 'Cancel Reply', 'wp-indigo' ).'</span>',
		// Redefine your own textarea (the comment body).
		'comment_field' => '<p class="comment-form-comment h5 u-letter-space-small">'. esc_html__( 'Comment*', 'wp-indigo' ).'<br /><textarea id="comment" name="comment" aria-required="true" ></textarea></p>',
		//Message Before Comment
		'comment_notes_before' =>'<p class="c-comments__desc h5 u-letter-space-small">'. esc_html__( 'Your email address will not be published. Required fields are marked *' , 'wp-indigo') .'</p>',
		// Remove "Text or HTML to be displayed after the set of comment fields".
		'comment_notes_after' => '',
		//Submit Button ID
		'id_submit' =>  esc_html__( 'comment-submit' , 'wp-indigo'),
		'class_submit' =>  esc_html__( 'wp-indigo-comment-submit' , 'wp-indigo'),
	);
	
	comment_form( $wp_indigo_comments_args );

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

				if( get_theme_mod( 'comment_count' , false ) == true ){
					echo esc_html( $wp_indigo_comment_count ) . esc_html__( " Comments", "wp-indigo" );
				}
				else{
					echo esc_html__( "Comments", "wp-indigo" );
				}

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