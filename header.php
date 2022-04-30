<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-indigo
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="o-page">

        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e( 'Skip to content', 'wp-indigo' ); ?>
        </a>

        <header id="masthead" class="c-header site-header <?php wp_indigo_get_fade_in_down_animation(); ?>">

            <div class="c-header__main" id="site-navigation">

                <div class="c-header__branding">
                    <?php wp_indigo_branding(); ?>
                </div>

                <button class="c-header__menu js-header__menu" aria-label="<?php esc_attr_e('Primary menu', 'wp-indigo'); ?>" aria-controls="wp-indigo-primary-menu"
                    aria-expanded="false">
                    <span class="c-header__menu__icon">
                        <span class="hamburger"></span>
                    </span>
                </button>

                <nav class="c-header__navigation">
                    <?php
                        if ( has_nav_menu( 'wp-indigo-primary-menu' ) ) {
                            wp_nav_menu(
                                array(
                                    'walker'          => new Wp_indigo_walker_nav_menu(),
                                    'theme_location'  => 'wp-indigo-primary-menu',
                                    'menu_id'         => 'wp-indigo-primary-menu',
                                    'menu_class'      => 's-nav nav-menu',
                                    'container_class' => 'c-nav',
                                )
                            );
                        }
                    ?>

                    <?php wp_indigo_get_search(); ?>
                </nav><!-- #site-navigation -->

            </div>
            <!--c-header__main -->

        </header><!-- #masthead -->

        <?php if( get_theme_mod( 'display_search_icon' , false ) === true  ) : ?>
        <div id="c-header__search__form-box" class="c-header__search__form-box js-header__search__form-box">
            <div class="c-header__close-search">
                <button class="c-hedaer__close-search__btn js-hedaer__close-search__btn" aria-label="<?php esc_attr_e('Close Search', 'wp-indigo'); ?>"
                    aria-controls="c-header__search__form-box">
                    <span class="c-hedaer__close-search__icon iconify" data-icon="ei:close"></span>
                </button>
            </div>
            <div class="c-header__search__form">
                <?php get_search_form() ?>
            </div>
        </div>
        <?php endif; ?>