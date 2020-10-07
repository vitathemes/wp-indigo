<div class="item">
    <a class="url" href="<?php the_permalink(); ?>">
        <aside class="date">
            <time datetime="<?php echo get_the_date( get_option( 'date_format' ) ); ?>"><?php echo get_the_date(); ?></time>
        </aside>
		<?php the_title( sprintf( '<h3 class="title h3">', esc_url( get_permalink() ) ), '</h3>' ); ?>
    </a>
</div>
