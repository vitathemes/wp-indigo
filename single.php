<?php get_header(); ?>
    <div class="wrapper-normal">
        <div id="content-area" class="post">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php the_title( sprintf( '<h1 class="title">', esc_url( get_permalink() ) ), '</h1>' ); ?>
                <span class="date">
                <time datetime="<?php echo get_the_date( "d-m-Y" ); ?>"><?php echo get_the_date(); ?></time> - <span id="reading-time" class="reading-time" title="Estimated read time">0 mins</span>
				</span>

                <div class="post-tags">
					<?php
					indigo_show_tags();
					?>
                </div>

				<?php the_content(); ?>

			<?php endwhile; ?><?php
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
        </div>
        <?php
        comments_template();
       ?>
    </div>
    <script>
        function get_text(el) {
            ret = "";
            var length = el.childNodes.length;
            for (var i = 0; i < length; i++) {
                var node = el.childNodes[i];
                if (node.nodeType != 8) {
                    ret += node.nodeType != 1 ? node.nodeValue : get_text(node);
                }
            }
            return ret;
        }

        var words = get_text(document.getElementById('content-area'));
        var count = words.split(' ').length;
        var mins = (count * 0.4) / 60;
        if (mins < 1) {
            document.getElementById('reading-time').innerHTML = "<1 MIN";
        } else {
            document.getElementById('reading-time').innerHTML = Math.round(mins) + " MINS";
        }
    </script>
<?php get_footer();
