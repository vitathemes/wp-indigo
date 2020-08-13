<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header();
wp_indigo_show_profile(); ?>

    <section class="blog archive">


        <?php the_archive_title('<h1>', '</h1>') ?>
        <div id="content" class="list">
			<?php if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/list', 'archive' );

				endwhile;

				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => __( 'Previous', 'wp-indigo' ),
					'next_text' => __( 'Next', 'wp-indigo' ),
				) );

			else :

				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
        </div>
    </section>
<?php get_footer(); ?>
