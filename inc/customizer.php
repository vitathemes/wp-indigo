<?php
/**
 * wp-indigo Theme Customizer
 *
 * @package wp-indigo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_indigo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wp_indigo_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wp_indigo_customize_partial_blogdescription',
			)
		);

	}
}
add_action( 'customize_register', 'wp_indigo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_indigo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_indigo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_indigo_customize_preview_js() {
	wp_enqueue_script( 'wp-indigo-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), WP_INDIGO_VERSION, true );
}
add_action( 'customize_preview_init', 'wp_indigo_customize_preview_js' );



/* Kirki  */
if( function_exists( 'kirki' ) ) {

	/*
     *	Kirki - Config
	 */
	Kirki::add_config( 'wp_indigo_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );


	/*
	 *	Kirki -> Panels
	 */

	// Typography
	Kirki::add_panel( 'typography', array(
		'priority' => 180,
		'title'    => esc_html__( 'Typography', 'wp-indigo' ),
	) );
	
	// Footer
	Kirki::add_panel( 'footer', array(
		'priority' => 180,
		'title'    => esc_html__( 'Footer', 'wp-indigo' ),
	) );

	
	/*
	 *	Kirki -> Sections
	 */

	/* Social medias */
	Kirki::add_section( 'socials', array(
		'title'    => esc_html__( 'Social Networks', 'wp-indigo' ),
		'panel'    => '',
		'priority' => 6,
	) );

	/* Typography Fonts */
	Kirki::add_section( 'typography_fonts', array(
		'title'          => esc_html__( 'Typography Fonts', 'wp-indigo' ),
		'description'    => esc_html__( 'Change Typography and customize theme.', 'wp-indigo' ),
		'panel'          => 'typography',
		'priority'       => 160,
	) );

	/* Typography Size*/
	Kirki::add_section( 'typography_size', array(
		'title'          => esc_html__( 'Typography Size', 'wp-indigo' ),
		'description'    => esc_html__( 'Change Typography color and customize theme.', 'wp-indigo' ),
		'panel'          => 'typography',
		'priority'       => 160,
	) );

	/* Elements */
	Kirki::add_section( 'elements', array(
		'title'          => esc_html__( 'Elements', 'wp-indigo' ),
		'description'    => esc_html__( 'Change Custom Options of theme.', 'wp-indigo' ),
		'panel'          => '',
		'priority'       => 160,
	) );

	/* Footer Options */
	Kirki::add_section( 'copyrights', array(
		'title'          => esc_html__( 'Copyright', 'wp-indigo' ),
		'panel'          => 'footer',
		'priority'       => 170,
	) );

 	/*
     *	Kirki -> fields
	 */
	// -- Socials --
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => esc_html__( 'Facebook', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	]);

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => esc_html__( 'Twitter', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'linkedin',
		'label'    => esc_html__( 'Linkedin', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );
	
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'github',
		'label'    => esc_html__( 'Github', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'text',
		'settings' => 'mail',
		'label'    => __( 'Email', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );


	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'pinterest',
		'label'    => __( 'Pinterest', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );


	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'youtube',
		'label'    => __( 'Youtube', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'spotify',
		'label'    => __( 'Spotify', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'gitlab',
		'label'    => __( 'Gitlab', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'lastfm',
		'label'    => __( 'Lastfm', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'stackoverflow',
		'label'    => __( 'Stackoverflow', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'quora',
		'label'    => __( 'Quora', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'reddit',
		'label'    => __( 'Reddit', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'medium',
		'label'    => __( 'Medium', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'vimeo',
		'label'    => __( 'Vimeo', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'lanyrd',
		'label'    => __( 'Lanyrd', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'dribbble',
		'label'    => __( 'Dribbble', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'behance',
		'label'    => __( 'Behance', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 10,
	] );



	// -- Typography Colors --
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'typography_primary_color',
		'label'    => __( 'Primary Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#1a1a1a',
		'priority' => 9,
		
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'typography_secondary_color',
		'label'    => __( 'Secondary  Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#555555',
		'priority' => 9
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'wp_indigo_tertiary_color',
		'label'    => __( 'Tertiary Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#C4C4C4',
		'priority' => 9
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'wp_indigo_quaternary_color',
		'label'    => __( 'Quaternary Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#3F51B5',
		'priority' => 9
	] );

	// -- Typography --

	//Headings typography 
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_headings_font',
		'label'       => esc_html__( 'Headings fonts', 'wp-indigo' ),
		'section'     => 'typography_fonts',
		'default'     => [
			'font-family'   	 => 'Overpass',
			'variant'         	 => 'regular',
		],
		'output'      => [
			[
				'element' => array( 'h1' , '.h1' , 'h2' , '.h2' ,'h3' , '.h3' , ),
			],
		],
		'priority'    => 11,
		'transport'   => 'auto',
	] );


	//  typography font text 
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_texts_font',
		'label'       => esc_html__( 'Texts fonts', 'wp-indigo' ),
		'section'     => 'typography_fonts',
		'default'     => [
			'font-family'   	 => 'Source Serif Pro',
			'variant'         	 => 'regular',
		],
		'output'      => [
			[
				'element' => array( 'p' , '.h4' , '.h4' , 'h5' ,'.h5' , '.comment-replly-link' , '.submenu .menu-item' , 'body' ),
			],
		],
		'priority'    => 11,
		'transport'   => 'auto',
	] );

	//  typography font text secondary 
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_text_secondary_font',
		'label'       => esc_html__( 'Texts Secondary fonts', 'wp-indigo' ),
		'section'     => 'typography_fonts',
		'default'     => [
			'font-family'   	 => 'Overpass',
			'variant'         	 => '300',
		],
		'output'      => [
			[
				'element' => array( 'h6' , '.h6' , '.page-numbers' , '.menu-item' , '.widget ul' , '.btn'),
			],
		],
		'priority'    => 11,
		'transport'   => 'auto',
	] );
	

	// Headings typography h1
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h1',
		'label'       => esc_html__( 'H1', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '26px',
			'line-height' 		  => '40px'
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h1' , '.h1' ),
			],
		],
	] );


	// Headings typography h2
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h2',
		'label'       => esc_html__( 'H2', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '20px',
			'line-height' 		  => '31px'
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h2' , '.h2' ),
			],
		],
	] );

	
	// Headings typography h3
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h3',
		'label'       => esc_html__( 'H3', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '16px',
			'line-height'     	  => '24px',
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h3' , '.h3' ),
			],
		],
	] );
	
	
	// Headings typography h4
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h4',
		'label'       => esc_html__( 'H4', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '16px',
			'line-height'     	  => '27px',
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h4' , '.h4' ),
			],
		],
	] );

	
	// Headings typography h5
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h5',
		'label'       => esc_html__( 'H5', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '13px',
			'line-height'     	  => '16px',
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h5' , '.h5' ),
			],
		],
	] );

	
	// Headings typography h6
	Kirki::add_field( 'wp_indigo_theme' , [
		'type'        => 'typography',
		'settings'    => 'typography_h6',
		'label'       => esc_html__( 'H6', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '13px',
			'line-height'     	  => '21px',
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h6' , '.h6' , '.page-numbers' ),
			],
		],
	] );

	// Headings typography p
	Kirki::add_field( 'wp_indigo_theme' , [
		'type'        => 'typography',
		'settings'    => 'typography_p',
		'label'       => esc_html__( 'p', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '16px',
			'line-height'     	  => '27px',
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'p' ),
			],
		],
	] );


	// Post Share icons Checkbox
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'post_share_icons',
		'label'       => esc_html__( 'Display Share icons for posts', 'wp-indigo' ),
		'section'     => 'elements',
		'default'     => '1',
		'priority'    => 10,
	] );

	// Custom Category  in sidebar Checkbox
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'sidebar_related_tags',
		'label'       => esc_html__( 'Display Related Tags in side bar', 'wp-indigo' ),
		'section'     => 'elements',
		'default'     => '1',
		'priority'    => 10,
	] );

	// Control for portfolio Area Checkbox
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'portfolios_control',
		'label'       => esc_html__( 'Portfolios section control', 'wp-indigo' ),
		'section'     => 'elements',
		'default'     => '1',
		'priority'    => 11,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'image',
		'settings'    => 'profile_image',
		'label'       => esc_html__( 'Profile Image', 'wp-indigo' ),
		'description' => esc_html__( 'Add Profile Image here', 'wp-indigo' ),
		'section'     => 'elements',
		'priority'    => 12,
	] );
	
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'portfolio_category',
		'label'       => esc_html__( 'Enable Portfolios Category', 'wp-indigo' ),
		'section'     => 'elements',
		'default'     => '1',
		'priority'    => 13,
	] );

	
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'text',
		'settings' => 'copytext',
		'label'    => esc_html__( 'Copyright text', 'wp-indigo' ),
		'section'  => 'copyrights',
		'default'  => esc_html__( 'wp-indigo Theme by', 'wp-indigo' ),
		'priority' => 10,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'text',
		'settings' => 'copylink_text',
		'label'    => __( 'Copyright link text (like your company name)', 'wp-indigo' ),
		'default'  => esc_html__( 'VitaThemes', 'wp-indigo' ),
		'section'  => 'copyrights',
		'priority' => 11,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'copylink',
		'label'    => __( 'Copyright link text', 'wp-indigo' ),
		'section'  => 'copyrights',
		'default'  => esc_url('http://vitathemes.com/'),
		'priority' => 12,
	] );
}