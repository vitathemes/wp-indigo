<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 */
?>

<header class="c-single__entry-header">

    <div class="c-single__entry-header__content">

        <?php
            if ( is_singular() ) :
                the_title( '<h1 class="c-single__entry-title u-letter-space-medium">', '</h1>' );
            else :              
                the_title( '<h2 class="c-single__entry-title u-letter-space-medium"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;		            
        ?>

        <div class="c-single__entry-meta">

            <?php 
                if ( 'portfolios' == get_post_type() ) {
                    if(get_theme_mod( 'post_category', true )) { 
                        wp_indigo_get_taxonomy( "portfolio_category" , "c-single__cat c-single__cat--sep u-link--secondary h6" , "a" );
                    }
                }
            ?>

            <?php if( 'portfolios' == get_post_type() ) :  ?>
            <span class="u-ellipse"></span>
            <?php endif; ?>

            <?php if ( 'portfolios' !== get_post_type() ) : ?>
            <div class="c-single__cats">
                <?php wp_indigo_show_categories(); ?>
            </div><!-- c-single__date -->
            <?php endif; ?>

            <?php  if( get_theme_mod( 'author_name', true ) ) : ?>
            <div class="c-single__author">
                <?php  if(get_avatar( get_current_user_id() ) ) : ?>
                <div class="c-single__author__avatar">
                    <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
                </div>
                <?php endif; ?>

                <div class="c-single__author__info">
                    <?php wp_indigo_posted_by(); ?>
                </div>
            </div>
            <?php
                endif;
            ?>

            <?php if( get_theme_mod( 'publish_date', true ) == true && get_theme_mod( 'author_name', true ) == true ) : ?>
            <span class="u-ellipse"></span>
            <?php endif; ?>


            <?php if( get_theme_mod( 'publish_date', true ) ) : ?>
            <div class="c-single__date">
                <span class="h6 u-letter-space-regular">
                    <a href="<?php echo esc_url( get_permalink() ) ?>">
                        <?php echo esc_html( get_the_date() ); ?>
                    </a>
                </span>
            </div><!-- c-single__date -->
            <?php  endif; ?>

        </div><!-- c-single__entry-meta -->

    </div><!-- c-single__entry-header__content -->

</header><!-- c-single__entry-header -->


<article id="post-<?php the_ID(); ?>" <?php post_class('c-single'); ?>>

    <section class="c-single__entry-content">

        <!-- Get the post thumbnail -->
        <?php if ( has_post_thumbnail() && get_theme_mod( 'post_thumbnail' , true )) : ?>
        <div class="c-single__thumbnail c-single__thumbnail--centerd">
            <?php the_post_thumbnail( 'full' ); ?>
        </div>
        <?php endif; ?>

        <!-- Get the post content -->
        <div class="c-single__content">
            <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-indigo' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    )
                );
            ?>
        </div>

        <!-- Get The Post Tags -->
        <?php if(get_theme_mod( 'post_tags', true ) ) : ?>
        <div class="c-single__tags">
            <?php wp_indigo_get_post_tags('c-single__tag h6 u-letter-space-regular'); ?>
        </div>
        <?php endif; ?>

        <!-- Get The Post Share Icons  -->
        <?php if ( 'portfolios' != get_post_type() && true == get_theme_mod( 'post_share_icons', true )  ) :  ?>
        <div class="c-single__share">
            <?php wp_indigo_share_links(); ?>
        </div>
        <?php endif; ?>

    </section><!-- c-single__entry-content -->

    <?php if(get_theme_mod( 'show_post_nav', false ) === true ) : ?>
    <div class="c-single__post-nav">
        <?php wp_indigo_show_post_nav(); ?>
    </div><!-- c-single__post-nav -->
    <?php endif; ?>

    <?php 
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    ?>

</article><!-- #post-<?php the_ID(); ?> -->