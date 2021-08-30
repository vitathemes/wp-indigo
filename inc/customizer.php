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
		'priority' => 50,
		'title'    => esc_html__( 'Typography', 'wp-indigo' ),
	) );

	// Typography
	Kirki::add_panel( 'elements', array(
		'priority' => 75,
		'title'    => esc_html__( 'Elements', 'wp-indigo' ),
	));
	
	/*
	 *	Kirki -> Sections
	 */

	/* Typography Fonts */
	Kirki::add_section( 'typography_fonts', array(
		'title'          => esc_html__( 'Typography Fonts', 'wp-indigo' ),
		'description'    => esc_html__( 'Change typography fonts and customize theme.', 'wp-indigo' ),
		'panel'          => 'typography',
		'priority'       => 160,
	) );

	/* Typography Size*/
	Kirki::add_section( 'typography_size', array(
		'title'          => esc_html__( 'Typography Size', 'wp-indigo' ),
		'description'    => esc_html__( 'Change typography size and customize theme.', 'wp-indigo' ),
		'panel'          => 'typography',
		'priority'       => 160,
	) );


	/* Portfolios Options */
	Kirki::add_section( 'portfolios_options', array(
		'title'          => esc_html__( 'Portfolios Options', 'wp-indigo' ),
		'panel'          => 'elements',
		'priority'       => 200,
	) );

	/* Footer Options */
	Kirki::add_section( 'footer_styles', array(
		'title'          => esc_html__( 'Footer', 'wp-indigo' ),
		'panel'          => '',
		'priority'       => 70,
	) );

	/* Social medias */
	Kirki::add_section( 'socials', array(
		'title'    => esc_html__( 'Social Networks', 'wp-indigo' ),
		'panel'    => '',
		'priority' => 80,
	) );

	/* Single Options */
	Kirki::add_section( 'single_options', array(
		'title'          => esc_html__( 'Single Options', 'wp-indigo' ),
		'panel'          => 'elements',
		'priority'       => 100,
	) );
	
	/* Archive Options */
	Kirki::add_section( 'archive_options', array(
		'title'          => esc_html__( 'Archive Options', 'wp-indigo' ),
		'panel'          => 'elements',
		'priority'       => 110,
	) );

	/* SideBar Options */
	Kirki::add_section( 'sidebar_options', array(
		'title'          => esc_html__( 'Sidebar Options', 'wp-indigo' ),
		'panel'          => 'elements',
		'priority'       => 120,
	) );

	/* Blog  Options */
	Kirki::add_section( 'blog_options', array(
		'title'          => esc_html__( 'Blog Options', 'wp-indigo' ),
		'panel'          => 'elements',
		'priority'       => 130,
	) );

	/* Animation  Options */
	Kirki::add_section( 'theme_animation', array(
		'title'          => esc_html__( 'Animation', 'wp-indigo' ),
		'panel'          => '',
		'priority'       => 76,
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

	
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'link',
		'settings' => 'codepen',
		'label'    => __( 'Codepen', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 28,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'telegram',
		'label'    => __( 'Telegram', 'wp-indigo' ),
		'section'  => 'socials',
		'priority' => 29,
	] );


	/*------------------------------------*\
	  #Theme Colors
	\*------------------------------------*/
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'typography_primary_color',
		'label'    => __( 'Headings Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#1a1a1a',
		'priority' => 9,
		
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'typography_secondary_color',
		'label'    => __( 'Primary Texts Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#555555',
		'priority' => 9
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'wp_indigo_tertiary_color',
		'label'    => __( 'Secondary Texts Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#C4C4C4',
		'priority' => 9
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'color',
		'settings' => 'wp_indigo_quaternary_color',
		'label'    => __( 'Primary Accent Color', 'wp-indigo' ),
		'section'  => 'colors',
		'default'  => '#3F51B5',
		'priority' => 9
	] );


	/*------------------------------------*\
	  #Typography 
	\*------------------------------------*/

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
		'priority'    => 4,
		'transport'   => 'auto',
	] );


	// typography font text 
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
		'priority'    => 5,
		'transport'   => 'auto',
	] );

	//  typography font text secondary 
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_text_secondary_font',
		'label'       => esc_html__( 'Meta Text Fonts', 'wp-indigo' ),
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
		'priority'    => 6,
		'transport'   => 'auto',
	] );
	


	// Body
	Kirki::add_field( 'wp_indigo_theme' , [
		'type'        => 'typography',
		'settings'    => 'typography_body',
		'label'       => esc_html__( 'Base Font', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '13px',
			'line-height'     	  => '21px',
		],
		'priority'    => 3,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'body' ),
			],
		],
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
		'priority'    => 7,
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
		'priority'    => 8,
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
		'priority'    => 9,
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
		'priority'    => 10,
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
		'priority'    => 11,
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
		'label'       => esc_html__( 'Paragraph', 'wp-indigo' ),
		'section'     => 'typography_size',
		'default'     => [
			'font-size'			  => '16px',
			'line-height'     	  => '27px',
		],
		'priority'    => 13,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'p' ),
			],
		],
	] );

	
	// Profile Image
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'image',
		'settings'    => 'profile_image',
		'label'       => esc_html__( 'Profile Image', 'wp-indigo' ),
		'description' => esc_html__( 'Add Profile Image here', 'wp-indigo' ),
		'section'     => 'title_tagline',
		'priority'    => 9,
		'choices' => array(
			'save_as' => 'array',
		),
	] );

	// change footer style
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'radio-buttonset',
		'settings'    => 'footer_style',
		'label'       => esc_html__( 'Footer Widgets style', 'wp-indigo' ),
		'section'     => 'footer_styles',
		'default'     => 'one-widget',
		'priority'    => 13,
		'choices'     => [
			'one-widget' => esc_html__( 'One Column Widgets', 'wp-indigo' ),
			'two-widget'  => esc_html__( 'Two Column Widgets', 'wp-indigo' ),
		],
		'active_callback' => [
			[
				'setting'  => 'archives_category',
				'operator' => '===',
				'value'    => true,
			],
		]
	]);

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'radio-buttonset',
		'settings'    => 'footer_menu_pos',
		'label'       => esc_html__( 'Menu Position', 'wp-indigo' ),
		'section'     => 'footer_styles',
		'default'     => 'center',
		'priority'    => 14,
		'choices'     => [
			'top'   => esc_html__( 'Top', 'wp-indigo' ),
			'center' => esc_html__( 'Next to the copy', 'wp-indigo' ),
			'bottom'  => esc_html__( 'Bottom', 'wp-indigo' ),
		],
	] );

	// Custom Post type Archive title
	Kirki::add_field( 'wp_indigo_theme', [
		'type'     => 'text',
		'settings' => 'post_type_archive_custom_title',
		'label'    => esc_html__( 'Post Type Archive title', 'wp-indigo' ),
		'section'  => 'portfolios_options',
		'priority' => 10,
	] );

	// Portfolios Items Style
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'radio-image',
		'settings'    => 'portfolios_item_style',
		'label'       => esc_html__( 'Portfolios Items Style', 'wp-indigo' ),
		'section'     => 'portfolios_options',
		'default'     => 'masonry',
		'priority'    => 10,
		'choices'     => [
			'normal'   => get_template_directory_uri() . '/assets/images/normal.jpg',
			'masonry' => get_template_directory_uri() . '/assets/images/masonry.jpg',
			
		],
	] );

	/*------------------------------------*\
	  #Single Options
	\*------------------------------------*/
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'publish_date',
		'label'       => esc_html__( 'Show Publish Date', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 10,
	] );
	
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'author_name',
		'label'       => esc_html__( 'Show Author Name', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 20,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'comment_count',
		'label'       => esc_html__( 'Show Comments Count', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '0',
		'priority'    => 30,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'post_category',
		'label'       => esc_html__( 'Show Posts Categories', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 40,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'post_tags',
		'label'       => esc_html__( 'Show Posts Tags', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 50,
	] );

	// Post Share icons Checkbox
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'post_share_icons',
		'label'       => esc_html__( 'Display Share icons for posts', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 60,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'post_thumbnail',
		'label'       => esc_html__( 'Show Post Thumbnail', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 70,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'show_single_cat',
		'label'       => esc_html__( 'Display Category', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 80,
	] );

	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'show_post_nav',
		'label'       => esc_html__( 'Display Post Navigation', 'wp-indigo' ),
		'section'     => 'single_options',
		'default'     => '0',
		'priority'    => 90,
	] );

	/*------------------------------------*\
	  #Archive Options
	\*------------------------------------*/
	// Show Archives Posts Categories
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'archives_posts_category',
		'label'       => esc_html__( 'Show Archives Posts Categories', 'wp-indigo' ),
		'section'     => 'archive_options',
		'default'     => '1',
		'priority'    => 20,
	] );

	// Enable Portfolios (Custom Post type) Category
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'portfolio_category',
		'label'       => esc_html__( 'Show Portfolios Category', 'wp-indigo' ),
		'section'     => 'archive_options',
		'default'     => '1',
		'priority'    => 30,
	] );

	/*------------------------------------*\
	  #Sidebar Options
	\*------------------------------------*/
	// Show SiedBar
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'sidebar_display',
		'label'       => esc_html__( 'Show Siedbar', 'wp-indigo' ),
		'section'     => 'sidebar_options',
		'default'     => '1',
		'priority'    => 10,
	] );

	/*------------------------------------*\
	  #Animation Options
	\*------------------------------------*/
	// Theme Animation
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'fade_in_animation',
		'label'       => esc_html__( 'Enable Animation Option', 'wp-indigo' ),
		'section'     => 'theme_animation',
		'default'     => '1',
		'priority'    => 10,
	] );

	/*------------------------------------*\
	  #Blog Options
	\*------------------------------------*/
	// Show Categories
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'toggle',
		'settings'    => 'archives_category',
		'label'       => esc_html__( 'Show Categories', 'wp-indigo' ),
		'section'     => 'blog_options',
		'default'     => '1',
		'priority'    => 20,
	] );

	// Categories Style
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'radio-buttonset',
		'settings'    => 'blog_category_style',
		'label'       => esc_html__( 'Categories style', 'wp-indigo' ),
		'section'     => 'blog_options',
		'default'     => 'list',
		'priority'    => 30,
		'choices'     => [
			'list'   => esc_html__( 'List', 'wp-indigo' ),
			'dropdown' => esc_html__( 'Drop Down', 'wp-indigo' ),
		],
		'active_callback' => [
			[
				'setting'  => 'archives_category',
				'operator' => '===',
				'value'    => true,
			],
		]
	]);

	// change blog page alignment 
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'radio-buttonset',
		'settings'    => 'blog_date_alignment',
		'label'       => esc_html__( 'Blog Page Date Alignment', 'wp-indigo' ),
		'section'     => 'blog_options',
		'default'     => 'front_title',
		'priority'    => 40,
		'choices'     => [
			'front_category' => esc_html__( 'Front of Category', 'wp-indigo' ),
			'front_title'  => esc_html__( 'Front of  Title', 'wp-indigo' ),
		]
	]);

	// text transform option 
	Kirki::add_field( 'wp_indigo_theme', [
		'type'        => 'radio-buttonset',
		'settings'    => 'blog_title_transform',
		'label'       => esc_html__( 'Titles Text Transform Style', 'wp-indigo' ),
		'section'     => 'blog_options',
		'default'     => 'none',
		'priority'    => 40,
		'choices'     => [
			'none' => esc_html__( 'No transform', 'wp-indigo' ),
			'capitalize'  => esc_html__( 'Capitalize', 'wp-indigo' ),
		]
	]);


}