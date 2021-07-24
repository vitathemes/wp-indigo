<?php
/**
 *
 * Template part for displaying profile component
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 * 
 */
?>

<div class="c-profile <?php wp_indigo_get_fade_in_up_animation(); ?>">
    
    <?php
        $wp_indigo_profile_image = get_theme_mod( 'profile_image', '' );
        if ( $wp_indigo_profile_image ) : ?>
        <div class="c-profile__image">
            <?php wp_indigo_get_profile_image(); ?>
        </div>
    <?php endif; ?>

    <div class="c-profile__title">
        <a class="c-profile__title__link h1" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php esc_html(bloginfo( 'name' )); ?>
        </a>
    </div>

    <div class="c-profile__desc">
        <?php wp_indigo_show_description(); ?>
    </div>
    
</div>


