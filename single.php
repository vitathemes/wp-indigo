<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header(); ?>

<div id="content-area" class="post">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php the_title( sprintf( '<h1 class="title">', esc_url( get_permalink() ) ), '</h1>' ); ?><?php

		get_template_part( 'template-parts/content', get_post_type() );

	endwhile; ?>

		<?php
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</div>

<div class="social-share">
    <div class="social-share-title">
        <span>Share this post:</span>
    </div>
    <div class="social-share-links">
		<?php
		$linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
		$twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
		$facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();
		?>

        <a target="_blank" href="<?php echo $facebook_url; ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt="Share on facebook"/>
        </a>

        <a target="_blank" href="<?php echo $twitter_url; ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg" alt="Share on facebook"/>
        </a>

        <a target="_blank" href="<?php echo $linkedin_url; ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.svg" alt="Share on facebook"/>
        </a>

    </div>
</div>

<?php comments_template(); ?>

<?php get_footer(); ?>
