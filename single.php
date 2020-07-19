<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header(); ?>

<div id="content-area post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php the_title( sprintf( '<h1 id="content" class="title">', esc_url( get_permalink() ) ), '</h1>' ); ?><?php

		get_template_part( 'template-parts/content', get_post_type() );

	endwhile; ?>

		<?php
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</div>

<?php get_footer(); ?>
