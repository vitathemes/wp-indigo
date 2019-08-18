<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */

get_header();
?>
    <section class="lost-container">
        <h1>Uh oh!</h1>
        <div class="link">
            <img class="selfie" alt="Nothing Found" src="<?php echo get_bloginfo('template_url') ?>/assets/images/error.gif"/>
        </div>
        <br/>
        <br/>
        <h2><?php _e('Page Not Found - 404' , 'indigo'); ?></h2>
        <p><?php _e('This page not found (deleted or never exists). try a phrase in search box or back to home and start again.' , 'indigo'); ?></p>
        <a href="<?php echo site_url(); ?>"><?php _e('Take me home!' , 'indigo'); ?></a>
        <br>
        <br>
        <?php get_search_form(); ?>
    </section>
<?php
get_footer();