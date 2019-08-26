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

$discussion = indigo_get_discussion_data();
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
    <div class="<?php echo $discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
        <h2 class="comments-title">
			<?php
			if ( comments_open() ) {
				if ( have_comments() ) {
					_e( 'Join the Conversation', 'wp-indigo' );
				} else {
					_e( 'Leave a comment', 'wp-indigo' );
				}
			} else {
				if ( '1' == $discussion->responses ) {
					/* translators: %s: post title */
					printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'wp-indigo' ), get_the_title() );
				} else {
					printf(
					/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s reply on &ldquo;%2$s&rdquo;',
							'%1$s replies on &ldquo;%2$s&rdquo;',
							$discussion->responses,
							'comments title',
							'wp-indigo'
						),
						number_format_i18n( $discussion->responses ),
						get_the_title()
					);
				}
			}
			?>
        </h2><!-- .comments-title -->
        <?php
        // Show comment form.
        indigo_comment_form( 'asc' );
        ?>
		<?php
		// Only show discussion meta information when comments are open and available.
		if ( have_comments() && comments_open() ) {
			get_template_part( 'template-parts/post/discussion', 'meta' );
		}
		?>
    </div><!-- .comments-title-flex -->
	<?php
	if ( have_comments() ) :

		// Show comment form at top if showing newest comments at the top.
		if ( comments_open() ) {
			indigo_comment_form( 'desc' );

			echo "<h3>" . __( 'Comments', 'wp-indigo' ) . "</h3>";
		}

		?>
        <ol class="comment-list comments">
			<?php
			wp_list_comments(
				array(
					'walker'      => new Indigo_Walker_Comment(),
					'avatar_size' => 60,
					'short_ping'  => true,
					'style'       => 'ol',
				)
			);
			?>
        </ol><!-- .comment-list -->
		<?php

		// Show comment navigation
		if ( have_comments() ) :
			$comments_text = __( 'Comments', 'wp-indigo' );
			the_comments_navigation(
				array(
					'prev_text' => sprintf( ' <span class="nav-prev-text"> < <span class="secondary-text">%s</span></span>', __( 'Previous', 'wp-indigo' )),
					'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> > </span> ', __( 'Next', 'wp-indigo' )),
				)
			);
		endif;
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
            <h3 class="no-comments">
				<?php _e( 'Comments are disabled.', 'wp-indigo' ); ?>
            </h3>
		<?php
		endif;

	else :

	endif; // if have_comments();
	?>
</div><!-- #comments -->