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

<div class="c-profile">
    
    <?php 
        $wp_indigo_profile_image = get_theme_mod( 'profile_image', '' );
        if ( $wp_indigo_profile_image ) : ?>
        <div class="c-profile__image">
            
          <img src="<?php echo esc_url( $wp_indigo_profile_image ); ?>" alt="<?php esc_attr__( "Profile Image" , "wp-indigo" ) ?>" />

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


