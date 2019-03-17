<?php /*  Template Name: About */
get_header();
?>
    <div class="wrapper-normal">
        <div class="page">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php the_content(); ?><?php endwhile; ?><?php
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
        </div>
    </div>
<?php get_footer(); ?>
