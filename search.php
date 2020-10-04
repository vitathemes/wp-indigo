<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */
get_header();
wp_indigo_show_profile(); ?>

    <section class="blog search">

        <h1>
            <?php
            /* translators: %s: search query. */
            printf( esc_html__('Search Results for: %s', 'wp-indigo' ), esc_html(get_search_query()));
            ?>
        </h1>
        <div id="content" class="list">
			<?php if ( have_posts() ) : ?><?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/list', 'search' );

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
