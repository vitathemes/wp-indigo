<?php

/**
 * WordPress Comment Walker
 *
 * @package     Wordpress
 * @subpackage  Comment_Walker
 * @author      Boone Software <support@boone.io>
 */
class Wp_indigo_walker_comment extends Walker_Comment {
	/**
	 * Output a comment in the HTML5 format. Don't worry, we're
	 * just extending default WordPress functionality.
	 *
	 * @access protected
	 *
	 * @param object $comment Comment to display.
	 * @param int $depth Depth of comment.
	 * @param array $args An array of arguments.
	 *
	 * @see wp_list_comments()
	 *
	 * @since 3.6.0
	 *
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		// Determine which tag we're using
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-meta">
                <div class="comment-author">
                    <div class="comment-avatar">
						<?php if ( $args['avatar_size'] !== 0 ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						} ?>
						<?php
						if ( get_comment_author_url( $comment ) != "" ) {
							printf( __( '<a href="%s">%s</a>' ), esc_url( get_comment_author_url( $comment ) ), esc_html( get_comment_author( $comment ) ) );
						} else {
							printf( __( '%s' ), get_comment_author( $comment ) );
						}
						?>
                        <time datetime="<?php comment_time( 'c' ); ?>">
		                    <?php
		                    printf( __( '%1$s' ), get_comment_date( '', $comment ) );
		                    ?>
                        </time>
                    </div>

                    <div class="comment-content">
                        <div class="comment-header">


                            <div class="time">

                            </div>
                        </div>
                    </div>
					<?php if ( ! $comment->comment_approved ): ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>

					<?php comment_text(); ?>

					<?php
					// Output Edit link
					edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' );

					// Output Reply link
					comment_reply_link( [
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					] );
					?>
                </div>
            </div>
        </article>
		<?php
	}
}
