<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
global $theme_url;
get_header();
?>
    <section class="lost-container">
        <h1>Uh oh!</h1>
        <div class="link">
            <img class="selfie" alt="Nothing Found" src="<?php echo $theme_url ?>/assets/images/error.gif"/>
        </div>
        <br/>
        <br/>
        <a href="/">Take me home!</a>
    </section>
<?php
get_footer();