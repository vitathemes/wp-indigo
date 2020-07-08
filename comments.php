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

$wpindigo_discussion = wpindigo_get_discussion_data();
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
    <div class="<?php echo $wpindigo_discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
        <h2 class="comments-title">
			<?php
			if ( comments_open() ) {
				if ( have_comments() ) {
					esc_html_e( 'Join the Conversation', 'wp-indigo' );
				} else {
					esc_html_e( 'Leave a comment', 'wp-indigo' );
				}
			} else {
				if ( '1' == $wpindigo_discussion->responses ) {
					/* translators: %s: post title */
					printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'wp-indigo' ), esc_html(get_the_title()) );
				} else {
					printf(
					/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s reply on &ldquo;%2$s&rdquo;',
							'%1$s replies on &ldquo;%2$s&rdquo;',
							$wpindigo_discussion->responses,
							'comments title',
							'wp-indigo'
						),
						number_format_i18n( $wpindigo_discussion->responses ),
						esc_html( get_the_title())
					);
				}
			}
			?>
        </h2><!-- .comments-title -->
        <?php
        // Show comment form.
        wpindigo_comment_form( 'asc' );
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
			wpindigo_comment_form( 'desc' );

			echo "<h3>" . esc_html_e( 'Comments', 'wp-indigo' ) . "</h3>";
		}

		?>
        <ol class="comment-list comments">
			<?php
			wp_list_comments(
				array(
					'walker'      => new WpIndigo_Walker_Comment(),
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
			$wpindigo_comments_text = __( 'Comments', 'wp-indigo' );
			the_comments_navigation(
				array(
					'prev_text' => sprintf( ' <span class="nav-prev-text"> < <span class="secondary-text">%s</span></span>', esc_html_e( 'Previous', 'wp-indigo' )),
					'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> > </span> ', esc_html_e( 'Next', 'wp-indigo' )),
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
	endif; // if have_comments();
	?>
</div><!-- #comments -->
