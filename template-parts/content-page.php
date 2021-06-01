<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <!-- Get the page thumbnail -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="c-single__thumbnail">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>
    <?php endif; ?>

    <!-- Get the page thumbnail -->
    <div class="c-single__entry-content">
        <?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-indigo' ),
					'after'  => '</div>',
				)
			);
		?>
    </div><!-- .entry-content -->

    <!-- Get the entry footer -->
    <?php if ( get_edit_post_link() ) : ?>
    <footer class="c-single__entry-footer">
        <?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-indigo' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
    </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->