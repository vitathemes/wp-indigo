<?php

// Disable Kiriki help notice
add_filter( 'kirki_telemetry', '__return_false' );


// Add config
Kirki::add_config( 'wp-indigo', array(
	'option_type' => 'theme_mod'
) );

// Add sections
Kirki::add_section( 'wpindigo_branding', array(
	'title'    => esc_html__( 'Branding', 'wp-indigo' ),
	'panel'    => '',
	'priority' => 3,
) );

Kirki::add_section( 'wpindigo_typography', array(
	'title'    => esc_html__( 'Typography', 'wp-indigo' ),
	'panel'    => '',
	'priority' => 4,
) );

Kirki::add_section( 'wpindigo_elements', array(
	'title'    => esc_html__( 'Elements', 'wp-indigo' ),
	'panel'    => '',
	'priority' => 5,
) );

Kirki::add_section( 'wpindigo_socials', array(
	'title'    => esc_html__( 'Social Networks', 'wp-indigo' ),
	'panel'    => '',
	'priority' => 6,
) );

// Add Branding fields

// -- Branding Fields --
Kirki::add_field( 'wp-indigo', [
	'type'     => 'color',
	'settings' => 'branding_primary_color',
	'label'    => __( 'Primary Color', 'wp-indigo' ),
	'section'  => 'wpindigo_branding',
	'default'  => '#3F51B5',
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'toggle',
	'settings' => 'show_share_icons',
	'label'    => esc_html__( 'Show Share Icons (on single post)', 'wp-indigo' ),
	'section'  => 'wpindigo_elements',
	'default'  => '1',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'toggle',
	'settings' => 'show_post_thumbnail',
	'label'    => esc_html__( 'Show Post Thumbnail (on single post)', 'wp-indigo' ),
	'section'  => 'wpindigo_elements',
	'default'  => '1',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'        => 'toggle',
	'settings'    => 'show_profile_section',
	'label'       => esc_html__( 'Show Profile Section', 'wp-indigo' ),
	'description' => esc_html__( 'Show profile section in pages: About/Blog/Home', 'wp-indigo' ),
	'section'     => 'wpindigo_elements',
	'default'     => '1',
	'priority'    => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'text',
	'settings' => 'copyright_text',
	'label'    => esc_html__( 'Copyright Text', 'wp-indigo' ),
	'section'  => 'wpindigo_elements',
	'priority' => 10,
] );


Kirki::add_field( 'wp-indigo', [
	'type'        => 'toggle',
	'settings'    => 'profile_animation',
	'label'       => esc_html__( 'Profile Animation', 'wp-indigo' ),
	'description' => esc_html__( 'Animation for profile section.', 'wp-indigo' ),
	'section'     => 'wpindigo_elements',
	'priority'    => 9,
] );


// Social Networks Fields
Kirki::add_field( 'wp-indigo', [
	'type'     => 'text',
	'settings' => 'social-mail',
	'label'    => __( 'Email', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-facebook',
	'label'    => __( 'Facebook', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-twitter',
	'label'    => __( 'Twitter', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-instagram',
	'label'    => __( 'Instagram', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-pinterest',
	'label'    => __( 'Pinterest', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-linkedin',
	'label'    => __( 'Linkedin', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-youtube',
	'label'    => __( 'Youtube', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-spotify',
	'label'    => __( 'Spotify', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-github',
	'label'    => __( 'Github', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-gitlab',
	'label'    => __( 'Gitlab', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-lastfm',
	'label'    => __( 'Lastfm', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-stackoverflow',
	'label'    => __( 'Stackoverflow', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-quora',
	'label'    => __( 'Quora', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-reddit',
	'label'    => __( 'Reddit', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-medium',
	'label'    => __( 'Medium', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-vimeo',
	'label'    => __( 'Vimeo', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );

Kirki::add_field( 'wp-indigo', [
	'type'     => 'link',
	'settings' => 'social-lanyrd',
	'label'    => __( 'Lanyrd', 'wp-indigo' ),
	'section'  => 'wpindigo_socials',
	'priority' => 10,
] );


// -- Typography Fields --
Kirki::add_field( 'wp-indigo', [
	'type'     => 'typography',
	'settings' => 'headings_typography',
	'label'    => esc_html__( 'Headlines', 'wp-indigo' ),
	'section'  => 'wpindigo_typography',
	'default'  => [
		'font-family' => 'Roboto Mono',
		'font-size'   => '26px',
		'font-weight'     => 'regular',
		'color'       => '#1A1A1A'
	],
	'transport' => 'auto',
	'priority'  => 10,
	'output'    => array(
		array(
			'element' => 'h1',
		),
		array(
			'element' => '.h1',
		),
		array(
			'element'       => 'h2',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 0.5em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => 'h2',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => 'h2',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => 'h2',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => '.h2',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 0.5em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => '.h2',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => '.h2',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => '.h2',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => 'h3',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 0.75em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => 'h3',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => 'h3',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => 'h3',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => '.h3',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 0.75em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => '.h3',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => '.h3',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => '.h3',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => 'h4',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 0.85em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => 'h4',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => 'h4',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => 'h4',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => '.h4',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 0.85em‬)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => '.h4',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => '.h4',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => '.h4',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => 'h5',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 1em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => 'h5',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => 'h5',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => 'h5',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => '.h5',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 1em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => '.h5',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => '.h5',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => '.h5',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => 'h6',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 1.25em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => 'h6',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => 'h6',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => 'h6',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

		array(
			'element'       => '.h6',
			'property'      => 'font-size',
			'value_pattern' => 'calc($ - 1.25em)',
			'choice'        => 'font-size',
		),
		array(
			'element'       => '.h6',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => '.h6',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => '.h6',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

	),
] );

Kirki::add_field( 'wp-indigo', [
	'type'      => 'typography',
	'settings'  => 'text_typography',
	'label'     => esc_html__( 'Texts', 'wp-indigo' ),
	'section' =>'wpindigo_typography',
	'default'   => [
		'font-family' => 'Roboto',
		'font-weight'     => 'regular',
		'font-size'   => '14px',
		'line-height' => '1.5',
		'color'       => '#666666',
	],
	'output'    => array(
		array(
			'element'       => 'body',
			'property'      => 'font-size',
			'value_pattern' => '$',
			'choice'        => 'font-size',
		),
		array(
			'element'       => 'body',
			'property'      => 'line-height',
			'value_pattern' => '$',
			'choice'        => 'line-height',
		),
		array(
			'element'       => 'body',
			'property'      => 'font-weight',
			'value_pattern' => '$',
			'choice'        => 'font-weight',
		),
		array(
			'element'       => 'body',
			'property'      => 'font-family',
			'value_pattern' => '$',
			'choice'        => 'font-family',
		),
		array(
			'element'       => 'body',
			'property'      => 'letter-spacing',
			'value_pattern' => '$',
			'choice'        => 'letter-spacing',
		),

	),
	'priority'  => 10,
	'transport' => 'auto',
] );

// -- Typography Fields --

function wp_indigo_add_edit_icons( $wp_customize ) {
	$wp_customize->selective_refresh->add_partial( 'copyright_text', array(
		'selector' => '.footer-main',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.header-home .title',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.description',
	) );

	$wp_customize->selective_refresh->add_partial( 'social-mail', array(
		'selector' => '.social-links',
	) );

	$wp_customize->selective_refresh->add_partial( 'show_post_thumbnail', array(
		'selector' => '.post-thumbnail',
	) );

	$wp_customize->selective_refresh->add_partial( 'show_share_icons', array(
		'selector' => '.social-share',
	) );
}

add_action( 'customize_preview_init', 'wp_indigo_add_edit_icons' );
