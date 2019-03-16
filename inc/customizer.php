<?php
add_action( 'customize_register', 'indigo_customizer_settings' );

function indigo_customizer_settings( $wp_customize ) {
	// Profile section
	$wp_customize->add_section( 'profile-section' , array(
		'title'      => 'Profile',
		'priority'   => 30,
	) );
	$wp_customize->add_setting( 'name' , array(
		'default'     => 'John Dou',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'bio' , array(
		'default'     => 'John Dou bio goes here',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'avatar' , array(
		'default'     => get_template_directory_uri() . '/assets/images/profile.jpg',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'profile_avatar', array(
		'label'        => 'Avatar',
		'section'    => 'profile-section',
		'settings'   => 'avatar',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_name', array(
		'label'        => 'Name',
		'section'    => 'profile-section',
		'settings'   => 'name',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_bio', array(
		'label'        => 'Bio',
		'type'        => 'textarea',
		'section'    => 'profile-section',
		'settings'   => 'bio',
	) ) );
	// Profile section
	// Social Networks section
	$wp_customize->add_section( 'social-section' , array(
		'title'      => 'Social Networks',
		'priority'   => 31,
	) );
	$wp_customize->add_setting( 'social-mail' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-facebook' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-twitter' , array(
		'transport'   => 'refresh',
		'default'       => 'https://twitter.com',
	) );
	$wp_customize->add_setting( 'social-instagram' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-pinterest' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-linkedin' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-youtube' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-spotify' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-github' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-gitlab' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-lastfm' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-stackoverflow' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-quora' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-reddit' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-medium' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-vimeo' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'social-lanyrd' , array(
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-mail', array(
		'label'        => 'Mail',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'mailto:youremail@example.com', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-facebook', array(
		'label'        => 'Facebook',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.facebook.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-twitter', array(
		'label'        => 'Twitter',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://twitter.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-instagram', array(
		'label'        => 'Instagram',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.instagram.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-pinterest', array(
		'label'        => 'Pinterest',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.pinterest.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-linkedin', array(
		'label'        => 'Linkedin',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.linkedin.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-youtube', array(
		'label'        => 'Youtube',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.youtube.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-spotify', array(
		'label'        => 'Spotify',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.spotify.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-github', array(
		'label'        => 'Github',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.github.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-gitlab', array(
		'label'        => 'Gitlab',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.gitlab.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-lastfm', array(
		'label'        => 'Lastfm',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.lastfm.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-stackoverflow', array(
		'label'        => 'Stackoverflow',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.stackoverflow.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-quora', array(
		'label'        => 'Quora',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.quora.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-reddit', array(
		'label'        => 'Reddit',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.reddit.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-medium', array(
		'label'        => 'Medium',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.medium.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-vimeo', array(
		'label'        => 'Vimeo',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.vimeo.com/example', 'indigo' ),
		)
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social-lanyrd', array(
		'label'        => 'Lanyrd',
		'type'        => 'url',
		'section'    => 'social-section',
		'input_attrs' => array(
			'placeholder' => __( 'https://www.lanyrd.com/example', 'indigo' ),
		)
	) ) );
	// Social Networks section
}

