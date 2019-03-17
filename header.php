<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="http://localhost:4000/assets/images/favicon/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="http://localhost:4000/assets/images/favicon/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="http://localhost:4000/assets/images/favicon/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="http://localhost:4000/assets/images/favicon/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="http://localhost:4000/assets/images/favicon/favicon-128.png" sizes="128x128" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="wrapper-normal">
    <div class="page">
    <?php if( !is_front_page() ) : ?>
        <?php indigo_show_menu(); ?>
    <?php endif; ?>
