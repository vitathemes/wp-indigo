<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); ?>
    <div id="content" class="page">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			the_title(  '<h1 class="single-title">', '</h1>' );
			?>

			<?php the_content(); ?><?php endwhile; ?><?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
    </div>
<?php get_footer(); ?>
