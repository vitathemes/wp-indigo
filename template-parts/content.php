<div class="item">
    <a class="url" href="<?php the_permalink(); ?>">
        <aside class="date">
            <time datetime="<?php echo get_the_date( "d-m-Y" ); ?>"><?php echo get_the_date(); ?></time>
        </aside>
		<?php the_title( sprintf( '<h3 class="title">', esc_url( get_permalink() ) ), '</h3>' ); ?>
    </a>
</div>