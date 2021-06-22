<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wp-indigo
 */

get_header();
?>

<main id="primary" class="c-main <?php wp_indigo_get_fade_in_animation(); ?> site-main">

    <header class="c-main__header">
        <h1 class="c-main__page-title"><?php esc_html_e( 'Search Result', 'wp-indigo' ); ?></h1>
    </header>

    <section class="c-main__content c-main__content--search">
        <?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :

					the_post();
					get_template_part( 'template-parts/content' );
					
				endwhile;

				wp_indigo_get_default_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

		?>
    </section>
</main><!-- #main -->

<?php
get_footer();