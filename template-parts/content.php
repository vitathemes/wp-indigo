<div class="meta">
    <div class="author-meta">
        <div class="author-avatar">
            <img class="author-avatar-img" src="<?php echo get_avatar_url( $post->post_author ); ?>" alt="author avatar"/>
        </div>
        <h4 class="author-name"><?php echo get_the_author_meta( 'display_name' ); ?></h4>
    </div>
    <span class="separator spacer"></span>
    <span class="date">
        <time datetime="<?php echo get_the_date( get_option( 'date_format', $post->post_author ) ); ?>"><?php echo get_the_date(); ?></time>
    </span>
</div>

<div class="single-content-area">
	<?php
	if ( get_theme_mod( 'show_post_thumbnail' , true ) ):
	?>
    <div class="post-thumbnail">
		<?php the_post_thumbnail( 'full' ); ?>
    </div>
		<?php
	endif;
	?>
	<?php the_content(); ?>
</div>

<?php
if ( get_theme_mod( 'show_share_icons' , true ) ):
    ?>
    <div class="social-share">
        <div class="social-share-title">
            <span><?php _e( 'Share on facebook:', 'wp-indigo' ); ?></span>
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
	<?php
endif;
?>
<div class="">
    <?php
    $defaults = array(
	    'before'           => '<p>' . __( 'Pages:', 'wp-indigo' ),
	    'after'            => '</p>',
	    'link_before'      => '',
	    'link_after'       => '',
	    'next_or_number'   => 'number',
	    'separator'        => ' ',
	    'nextpagelink'     => __( 'Next page', 'wp-indigo'),
	    'previouspagelink' => __( 'Previous page', 'wp-indigo' ),
	    'pagelink'         => '%',
	    'echo'             => 1
    );

    wp_link_pages( $defaults );

    ?>
</div>

<?php comments_template(); ?>