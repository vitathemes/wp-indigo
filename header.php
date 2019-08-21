<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <style>
        :root {
            --primary-color: <?php echo get_theme_mod('branding_primary_color' , '#3F51B5');?>;
            --secondary-color: <?php echo get_theme_mod('branding_secondary_color' , '#1A1A1A');?>;
            --tertiary-color: <?php echo get_theme_mod('branding_tertiary_color' , '#666666');?>;
        }
    </style>
</head>
<body <?php body_class(); ?>>

<div class="wrapper-normal">
    <div class="page">
		<?php if ( ! is_front_page() ) : ?><?php indigo_show_menu(); ?><?php endif; ?>
