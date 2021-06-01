<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-indigo
 */
?>

<footer id="colophon" class="c-footer site-footer">

    <div class="c-footer__wrapper">

        <?php wp_indigo_socials_links( false ); ?>        

        <div class="c-footer__content">

            <div class="c-footer__site-info">
                <div class="c-footer__copy">
        
                    <?php echo esc_html(get_theme_mod( 'copytext' , esc_html__( 'WP-Indigo by', 'wp-indigo' ) )); ?>

                    
                    <a class="c-footer__link h5 u-link--secondary" href="<?php echo esc_url( get_theme_mod( 'copylink', esc_url('http://vitathemes.com/') ) ); ?>">
                        <?php echo esc_html(get_theme_mod( 'copylink_text', esc_html( 'VitaThemes') ) ) ; ?>
                    </a>


                    <?php
                    if ( has_nav_menu( 'primary-footer' ) ) {
                
                        $wp_indigo_menuParameters = array(
                            'theme_location'  => 'primary-footer',
                            'container'       => false,
                            'echo'            => false,
                            'items_wrap'      => '%3$s',
                            'depth'           => 0,
                            'link_class'   => 'c-footer__link c-footer__link--nav'

                        );

                        echo wp_kses_post(strip_tags(wp_nav_menu( $wp_indigo_menuParameters ), '<a>' ));
                        
                    }
                    ?>

                </div>              
            
            </div><!-- .site-info -->

        </div>

    </div>

</footer><!-- #colophon -->

<?php wp_indigo_get_home_section_close_tag(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>