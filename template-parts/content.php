
<div class="meta">
    <div class="author-meta">
        <div class="author-avatar">
            <img class="author-avatar-img" src="<?php echo get_avatar_url( $post->post_author ); ?>" alt="author avatar"/>
        </div>
        <h4 class="author-name"><?php echo  get_the_author_meta( 'display_name' ); ?></h4>
    </div>
    <span class="separator spacer"></span>
    <span class="date">
                <time datetime="<?php echo get_the_date( get_option( 'date_format' , $post->post_author ) ); ?>"><?php echo get_the_date(); ?></time>
            </span>
</div>

<div class="single-content-area">
    <div class="post-thumbnail">
		<?php the_post_thumbnail('full'); ?>
    </div>
	<?php the_content(); ?>
</div>