<?php

// Disable Kiriki help notice
add_filter( 'kirki_telemetry', '__return_false' );


// Add config
Kirki::add_config( 'indigo', array(
	'option_type' => 'theme_mod'
) );

// Add sections
Kirki::add_section( 'branding', array(
	'title'    => esc_html__( 'Branding', 'indigo' ),
	'panel'    => '',
	'priority' => 3,
) );

Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'indigo' ),
	'panel'    => '',
	'priority' => 4,
) );

Kirki::add_section( 'elements', array(
	'title'    => esc_html__( 'Elements', 'indigo' ),
	'panel'    => '',
	'priority' => 5,
) );

Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'indigo' ),
	'panel'    => '',
	'priority' => 6,
) );

// Add Branding fields

// -- Branding Fields --
Kirki::add_field( 'indigo', [
	'type'      => 'background',
	'settings'  => 'branding_background',
	'label'     => esc_html__( 'Background', 'indigo' ),
	'section'   => 'branding',
	'default'   => [
		'background-color'      => 'fff',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport' => 'auto',
	'output'    => [
		[
			'element' => 'body',
		],
	],
] );

Kirki::add_field( 'indigo', [
	'type'     => 'color',
	'settings' => 'branding_primary_color',
	'label'    => __( 'Primary Color', 'indigo' ),
	'section'  => 'branding',
	'default'  => '#3F51B5',
] );


Kirki::add_field( 'indigo', [
	'type'     => 'color',
	'settings' => 'branding_secondary_color',
	'label'    => __( 'Secondary Color', 'indigo' ),
	'section'  => 'typography',
	'default'  => '#1A1A1A',
] );

Kirki::add_field( 'indigo', [
	'type'     => 'color',
	'settings' => 'branding_tertiary_color',
	'label'    => __( 'Tertiary Color', 'indigo' ),
	'section'  => 'typography',
	'default'  => '#666666',
] );


Kirki::add_field( 'indigo', [
	'type'     => 'toggle',
	'settings' => 'show_share_icons',
	'label'    => esc_html__( 'Show Share Icons', 'indigo' ),
	'section'  => 'elements',
	'default'  => '1',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'toggle',
	'settings' => 'show_post_thumbnail',
	'label'    => esc_html__( 'Show Post Thumbnail', 'indigo' ),
	'section'  => 'elements',
	'default'  => '1',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'        => 'toggle',
	'settings'    => 'show_profile_section',
	'label'       => esc_html__( 'Show Profile Section', 'indigo' ),
	'description' => esc_html__( 'Show profile section in pages: About/Blog/Home', 'indigo' ),
	'section'     => 'elements',
	'default'     => '1',
	'priority'    => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'text',
	'settings' => 'copyright_text',
	'label'    => esc_html__( 'Copyright Text', 'indigo' ),
	'section'  => 'elements',
	'default'  => 'Max Edwards © 2019',
	'priority' => 10,
] );


Kirki::add_field( 'indigo', [
	'type'        => 'toggle',
	'settings'    => 'profile_animation',
	'label'       => esc_html__( 'Profile Animation', 'indigo' ),
	'description' => esc_html__( 'Animation for profile section.', 'indigo' ),
	'section'     => 'elements',
	'priority'    => 9,
] );


// Social Networks Fields
Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-mail',
	'label'    => __( 'Email', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-facebook',
	'label'    => __( 'Facebook', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-twitter',
	'label'    => __( 'Twitter', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-instagram',
	'label'    => __( 'Instagram', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-pinterest',
	'label'    => __( 'Pinterest', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-linkedin',
	'label'    => __( 'Linkedin', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-youtube',
	'label'    => __( 'Youtube', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-spotify',
	'label'    => __( 'Spotify', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-github',
	'label'    => __( 'Github', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-gitlab',
	'label'    => __( 'Gitlab', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-lastfm',
	'label'    => __( 'Lastfm', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-stackoverflow',
	'label'    => __( 'Stackoverflow', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-quora',
	'label'    => __( 'Quora', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-reddit',
	'label'    => __( 'Reddit', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-medium',
	'label'    => __( 'Medium', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-vimeo',
	'label'    => __( 'Vimeo', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );

Kirki::add_field( 'indigo', [
	'type'     => 'link',
	'settings' => 'social-lanyrd',
	'label'    => __( 'Lanyrd', 'indigo' ),
	'section'  => 'socials',
	'priority' => 10,
] );


// -- Typography Fields --
Kirki::add_field( 'indigo', [
	'type'     => 'typography',
	'settings' => 'headings_typography',
	'label'    => esc_html__( 'Headlines', 'indigo' ),
	'section'  => 'typography',
	'default'  => [
		'font-family' => 'Roboto Mono',
		'font-size'   => '26px',
		'variant'     => 'regular',
		'color'       => '#1a1a1a'
	],

	'priority'  => 10,
	'transport' => 'auto',
] );

Kirki::add_field( 'indigo', [
	'type'      => 'typography',
	'settings'  => 'text_typography',
	'label'     => esc_html__( 'Texts', 'indigo' ),
	'section'   => 'typography',
	'default'   => [
		'font-family' => 'Roboto Mono',
		'font-size'   => '16px',
		'variant'     => 'regular',
		'line-height' => '26px',
		'color'       => '#666666'
	],
	'output'    => ':root',
	'priority'  => 10,
	'transport' => 'auto',
] );

// -- Typography Fields --

function add_edit_icons()
{
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
add_action( 'customize_preview_init', 'add_edit_icons' );