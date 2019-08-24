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

        <?php
			$text_typography = get_theme_mod('text_typography');
			$heading_typography = get_theme_mod('headings_typography');

			if ($heading_typography <= 0) {
				$heading_typography = array(
				        'font-family' => "Roboto Mono",
                        'font-size'=> "26px",
                         'variant' => '700',
                         'line-height' => '31px',
                         'color' => '#1a1a1a'
                         );
			}

			if ($text_typography <= 0) {
				$text_typography = array(
				        'font-family' => "Roboto Mono",
                        'font-size'=> "16px",
                         'variant' => 'regular',
                         'line-height' => '28px',
                         'color' => '#666666'
                         );
			}

		?>  --heading-typography-font-size: <?php echo $heading_typography['font-size'];?>;
            --heading-typography-font-family: <?php echo $heading_typography['font-family']; ?>;
            --heading-typography-line-height: <?php echo $heading_typography['line-height']; ?>;
            --heading-typography-variant: <?php echo $heading_typography['variant']; ?>;
            --text-typography-font-size: <?php echo $text_typography['font-size']?>;
            --text-typography-font-family: <?php echo $text_typography['font-family'];?>;
            --text-typography-line-height: <?php echo $text_typography['line-height'];?>;
            --text-typography-variant: <?php echo $text_typography['variant'];?>;
        }
    </style>
</head>
<body <?php body_class(); ?>>

<div class="wrapper-normal">
    <div class="page">
		<?php if ( ! is_front_page() ) : ?><?php indigo_show_menu(); ?><?php endif; ?>
