<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-post'); ?>>

    <section class="c-post__entry-header">

        <div class="c-post__entry-meta">

            <?php
                if ( is_singular() ) :
                    the_title( '<h4 class="c-post__entry-title">', '</h4>' );
                else :              
                    the_title( '<h4 class="c-post__entry-title"><a  href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
                endif;			            
            ?>

            <div class="c-post__category">
                <?php  wp_indigo_get_custom_category('' , 'c-post__cat c-post__cat--blog u-link--secondary h6'); ?>
            </div>

        </div><!-- c-post__entry-meta -->

        <div class="c-post__date">
            <span>
                <a class="h6" href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
                    <?php echo esc_html( get_the_date() ) ?>
                </a>
            </span>
        </div><!-- c-post__date -->

    </section><!-- c-post__entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->