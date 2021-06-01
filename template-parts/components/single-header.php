<section class="c-single__entry-header">

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
                if ( 'portfolios' == get_post_type() ){ 
                    wp_indigo_get_taxonomy( "portfolio_category" , "c-single__cat u-link--secondary h6" , "a" , ", ");
                }
                else { 
            ?>

            <div class="c-single__author">
                <?php  if(get_avatar( get_current_user_id() ) ) : ?>
                <div class="c-single__author__avatar">
                    <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
                </div>
                <?php endif; ?>
                <div class="c-single__author__info">
                    
                <span class="byline">
                    <span class="author vcard">
                        <a class="c-single__author__link h6 url fn n" href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                            <?php 
                                $wp_indigo_author_id = get_the_author_meta( 'ID' );
                                echo esc_html( get_the_author_meta( 'nicename', $wp_indigo_author_id ) ) 
                            ?>
                        </a>
                    </span>
                </span>
                    
                </div>
            </div>

            <?php } ?>

            <span class="u-ellipse"></span>

            <div class="c-single__date">
                <span class="h6 u-letter-space-regular">
                    <a href="<?php echo esc_url( get_permalink() ) ?>">
                        <?php echo esc_html( get_the_date() ) ?>
                    </a>
                </span>
            </div><!-- c-single__date -->

        </div><!-- c-single__entry-meta -->

    </div><!-- c-single__entry-header__content -->

</section><!-- c-single__entry-header -->