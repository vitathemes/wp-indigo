<?php 
/**
 * 
 * Template Name: Home
 * 
 * The main template file for home page
 *
 * If this page doesn't exists index.php will show ( Recommended for using as home page )
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); 
?>
<section class="o-page__content o-page__content--center">

    <div id="primary" class="c-main c-main <?php wp_indigo_get_fade_in_animation(); ?> site-main">

        <section class="c-main__content">

            <?php get_template_part( "template-parts/components/profile" ); ?>

        </section>

    </div><!-- #main -->

    <?php get_footer();