<div class="item">
	<?php if ( has_post_thumbnail() ): ?>
        <div class="item-image">
			<?php the_post_thumbnail( 'large' ); ?>
        </div>
	<?php endif; ?>
    <a class="url" href="<?php the_permalink(); ?>">
        <aside class="date">
            <time datetime="<?php echo get_the_date( get_option( 'date_format' ) ); ?>"><?php echo get_the_date(); ?></time>
        </aside>
		<?php the_title( sprintf( '<h3 class="title">', esc_url( get_permalink() ) ), '</h3>' ); ?>
    </a>
</div>