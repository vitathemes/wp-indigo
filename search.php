<?php get_header(); ?>
<?php indigo_show_profile(); ?>

	<section class="blog search">

		<h1>Search: <?php the_search_query(); ?></h1>

		<div class="list">
			<?php if ( have_posts() ) : ?><?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => __( 'Previous', 'indigo' ),
					'next_text' => __( 'Next', 'indigo' ),
				) );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>
	</section>
<?php get_footer(); ?>