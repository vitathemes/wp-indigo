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

<footer id="colophon" class="c-footer site-footer <?php wp_indigo_get_fade_in_animation(); ?>">

    <div class="c-footer__wrapper">

        <?php wp_indigo_socials_links( false ); ?>

        <div class="c-footer__content">

            <div class="c-footer__site-info <?php wp_indigo_is_footer_widget_active() ?>">

                <?php  if( is_active_sidebar( 'footer-widget' ) && get_theme_mod( 'footer_style' , 'no-widget') !== 'no-widget' ) : ?>
                <div class="c-footer__widgets">
                    <div id="header-widget-area" class="c-footer__widget widget-area" role="complementary">
                        <?php dynamic_sidebar( 'footer-widget' ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="c-footer__copy <?php wp_indigo_get_footer_menu_class(); ?>">

                    <div class="c-footer__copy__author-info">
                        <?php echo esc_html__( 'WP-Indigo by', 'wp-indigo' ); ?>

                        <a target="_blank" class="c-footer__link h5 u-link--secondary"
                            href="<?php echo esc_url( 'https://vitathemes.com/' ); ?>">
                            <?php echo esc_html__( 'VitaThemes' , 'wp-indigo'); ?>
                        </a>
                    </div>


                    <?php if( get_theme_mod('footer_menu_pos' , 'center') !== 'center' ) :?>
                    <div class="c-footer__menu">
                        <?php endif; ?>

                        <?php wp_indigo_get_footer_menu('wp-indigo-primary-footer'); ?>

                        <?php if( get_theme_mod('footer_menu_pos' , 'center') !== 'center' ) : ?>
                    </div>
                    <?php endif; ?>

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