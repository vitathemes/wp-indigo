<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

$wp_indigo_discussion = wp_indigo_get_discussion_data();
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
    <div class="<?php echo $wp_indigo_discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
        <h2 class="comments-title">
			<?php
			if ( comments_open() ) {
				if ( have_comments() ) {
					esc_html_e( 'Join the Conversation', 'wp-indigo' );
				} else {
					esc_html_e( 'Leave a comment', 'wp-indigo' );
				}
			}
			?>
        </h2><!-- .comments-title -->
    </div><!-- .comments-title-flex -->
	<?php


	// Show comment form at top if showing newest comments at the top.
	if ( comments_open() ) {
		comment_form();

		echo "<h3>" . esc_html_e( 'Comments', 'wp-indigo' ) . "</h3>";
	}

	?>
    <ol class="comment-list comments">
		<?php
		if ( have_comments() ) :
			wp_list_comments(
				array(
					'walker'      => new Wp_indigo_walker_comment(),
					'avatar_size' => 60,
					'short_ping'  => true,
					'style'       => 'ol',
				)
			);
		endif;
		?>
    </ol><!-- .comment-list -->
	<?php

	// Show comment navigation
	if ( get_comment_pages_count() > 1 ) :
		$wp_indigo_comments_text = __( 'Comments', 'wp-indigo' );
		the_comments_navigation(
			array(
				'prev_text' => sprintf( ' <span class="nav-prev-text"> < <span class="secondary-text">%s</span></span>', esc_html_e( 'Previous', 'wp-indigo' ) ),
				'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> > </span> ', esc_html_e( 'Next', 'wp-indigo' ) ),
			)
		);
	endif;

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() ) :
		?>
        <h3 class="no-comments">
			<?php esc_html_e( 'Comments are disabled.', 'wp-indigo' ); ?>
        </h3>
	<?php
	endif;
	?>
</div><!-- #comments -->
