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
			$avatar = get_avatar_url( $post->post_author );
			?>
            <div class="meta">
                <div class="author-meta">
                    <img class="author-avatar" src="<?php echo $avatar; ?>" alt="author avatar"/>
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

		<?php endwhile; ?>

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
			$twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title() ;
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
<?php get_footer(); ?>
