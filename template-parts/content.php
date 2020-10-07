<div class="meta">
    <div class="author-meta">
        <div class="author-avatar">
            <img class="author-avatar-img" src="<?php echo esc_attr( get_avatar_url( $post->post_author ) ); ?>" alt="<?php echo esc_attr(get_user_by( 'ID', $post->post_author )->display_name); ?>"/>
        </div>
        <h4 class="author-name"><?php echo esc_html(get_the_author_meta( 'display_name' )); ?></h4>
    </div>
    <span class="separator spacer"></span>
    <span class="date">
        <time datetime="<?php echo get_the_date( get_option( 'date_format', $post->post_author ) ); ?>"><?php echo get_the_date(); ?></time>
    </span>
</div>

<div class="single-content-area">
	<?php
	if ( get_theme_mod( 'show_post_thumbnail', true ) ):
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
if ( get_theme_mod( 'show_share_icons', true ) ):
	?>
    <div class="social-share">
        <div class="social-share-title">
            <span><?php esc_html_e( 'Share on Internet:', 'wp-indigo' ); ?></span>
        </div>
        <div class="social-share-links">
			<?php
			$linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();
			?>

            <a target="_blank" href="<?php echo esc_url( $facebook_url ); ?>">
                <svg class="icon icon-share icon-facebook"><use xlink:href="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/defs.svg#icon-facebook' ?>"></use></svg>
            </a>

            <a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>">
                <svg class="icon icon-share icon-twitter"><use xlink:href="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/defs.svg#icon-twitter' ?>"></use></svg>
            </a>

            <a target="_blank" href="<?php echo esc_url( $linkedin_url ); ?>">
                <svg class="icon icon-share icon-linkedin"><use xlink:href="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/defs.svg#icon-linkedin' ?>"></use></svg>
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
		'nextpagelink'     => __( 'Next page', 'wp-indigo' ),
		'previouspagelink' => __( 'Previous page', 'wp-indigo' ),
		'pagelink'         => '%',
		'echo'             => 1
	);
	wp_link_pages( $defaults );
	?>
</div>

<?php comments_template(); ?>
