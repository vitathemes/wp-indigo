<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header(); ?>
<div class="wrapper-normal">
    <div id="content-area" class="post">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><?php the_title( sprintf( '<h1 class="title">', esc_url( get_permalink() ) ), '</h1>' ); ?>
            <span class="date">
                    <time datetime="<?php echo get_the_date( get_option( 'date_format' ) ); ?>"><?php echo get_the_date(); ?></time> - <span id="reading-time" class="reading-time" title="Estimated read time">0 mins</span>
				</span>

            <div class="post-tags">
				<?php indigo_show_tags(); ?>
            </div>
            <div class="single-content-area">
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
	        $linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=". get_permalink() ."&title=". get_the_title() ."&summary=". get_the_excerpt();
	        $twitter_url = "https://twitter.com/intent/tweet?url=". get_permalink() ."&text=". get_the_excerpt() ."&hashtags=wp_sms_pro,veronalabs,wordpress";
	        $facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();
	        ?>

            <a target="_blank" href="<?php echo $facebook_url; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt="Share on facebook" />
            </a>

            <a target="_blank" href="<?php echo $twitter_url; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg" alt="Share on facebook" />
            </a>

            <a target="_blank" href="<?php echo $linkedin_url; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.svg" alt="Share on facebook" />
            </a>

        </div>
    </div>

	<?php comments_template(); ?>
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
<?php get_footer(); ?>
