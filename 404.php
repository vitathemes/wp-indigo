<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp-indigo
 */

get_header();
?>

<section class="o-page__content o-page__content--center">

    <main id="primary" class="c-main <?php wp_indigo_get_fade_in_animation(); ?> c-main--404 site-main">
        <section class="c-main__content">

            <h1 class="c-main__title">
                <?php esc_html_e( '404', 'wp-indigo' ); ?>
            </h1>

            <p class="c-main__desc c-main__desc--404">
                <?php esc_html_e( 'Page Not Found!', 'wp-indigo' ); ?>
            </p>

            <p class="c-main__desc c-main__desc--404">
                <?php esc_html_e( 'Try a phrase in search box or back to home and start again.', 'wp-indigo' ); ?>
            </p>

            <div class="c-main__search c-main__search--404">
                <div class="c-main__search-form">
                    <?php get_search_form(); ?>
                </div>
            </div>

            <a href=<?php echo esc_url( home_url() ); ?>>
                <button class="btn btn--error h5--secondary">
                    <?php esc_html_e( 'HOMEPAGE', 'wp-indigo' ); ?>
                    <span class="c-main__button-arrow dashicons dashicons-arrow-right-alt2"></span>
                </button>
            </a>

        </section>

    </main><!-- #main -->

    <?php
get_footer();