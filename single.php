<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp-indigo
 */

get_header();
?>

<main id="primary" class="c-main c-main--wide site-main <?php wp_indigo_portfolios_get_class_name(); ?>">

    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/components/single-header' );

			get_template_part( 'template-parts/content', 'single' );

			// Display Side bar if current page was not a single of portfolios
			if ('portfolios' != get_post_type()) get_sidebar();
			
		endwhile;// End of the loop.	
	?>

</main><!-- #main -->

<?php
get_footer();