<?php
if ( get_theme_mod( 'show_profile_section' , 1 ) ):
?>
<header class="header-home animated">
    <div class="selfie <?php echo get_theme_mod('profile_animation' , true) ? "has-animation" : ''; ?>"><?php indigo_show_avatar(); ?></div>
    <a class="title-link" href="<?php echo site_url(); ?>"><h1 class="title"><?php echo bloginfo( 'name' ); ?></h1></a>
    <h2 class="description"><?php echo bloginfo( 'description' );; ?></h2>
    <div class="social-links">
		<?php indigo_show_socials(); ?>
    </div>
</header>
<?php
endif;