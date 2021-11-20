<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */

get_header();
?>
<main id="primary"
    class="c-main <?php wp_indigo_get_fade_in_animation(); ?> <?php wp_indigo_get_archives_class(); ?> site-main">

    <header class="c-main__header">
        <h1 class="c-main__page-title">
            <?php echo wp_kses_post(get_the_archive_title()); ?>
        </h1>
        <?php if ( 'portfolios' === get_post_type() && true == get_theme_mod( 'portfolio_category', true ) ) : ?>
        <div class="c-main__category">
            <?php wp_indigo_taxonomy_filter("c-main__cat h3" , "" , false , "portfolio_category"); ?>
        </div>
        <?php endif; ?>
    </header>

    <section class="c-main__content">
        <?php
			if ( have_posts() ) :
				if( 'portfolios' === get_post_type() ){
					/** translator %s: Class Name from kirki */
					echo sprintf('<div class="c-main__portfolios %s">' , esc_attr(wp_indigo_get_portfolios_style()) ); // Also Escaped in function using esc_attr()
				}
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();	
						get_template_part( 'template-parts/content' , get_post_type() );	
					endwhile;
				
				if( 'portfolios' === get_post_type() ){
					echo wp_kses_post( '</div>' );
				}
				wp_indigo_get_default_pagination();
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
		?>
    </section>
</main><!-- #main -->
<?php
get_footer();