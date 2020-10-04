<?php

//Show Profile
function wp_indigo_show_profile() {
	get_template_part( "template-parts/profile" );
}

// Register Menu
function wp_indigo_register_primary_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'wp-indigo' ) );
}

add_action( 'after_setup_theme', 'wp_indigo_register_primary_menu' );

// Menu Generator
function wp_indigo_show_menu() {
	if ( has_nav_menu( 'primary-menu' ) ) {
		$wp_indigo_menu_args = array(
			'theme_location' => 'primary-menu',
			'menu_class'     => 'list navigation',
			'menu_id'        => 'navigation',
			'container'      => '',
			'depth'          => 2,
		);
		if ( ! is_front_page() ) {
			$wp_indigo_menu_args['container_class'] = 'nav';
		}
		echo '<nav id="site-navigation" class="main-navigation nav-home nav" role="navigation">'; ?>
        <button class="c-menu-toggle hamburger--boring js-menu-toggle hamburger" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
        </button>
		<?php
		wp_nav_menu( $wp_indigo_menu_args );
		echo '</nav>';
	}
}

// Show Post Tags
function wp_indigo_show_tags() {
	the_tags( '', ' ', '' );
}

// Show Name Field
function wp_indigo_show_avatar() {
	if ( has_custom_logo() ) {
		the_custom_logo();
	}
}

/**
 * Show socials list
 *
 * @param $wp_indigo_social_names | array
 */
function wp_indigo_show_socials( $wp_indigo_social_names ) {
	foreach ( $wp_indigo_social_names as $wp_indigo_social_name ) {
		$social = esc_attr( get_theme_mod( $wp_indigo_social_name ) );
		if ( $social != "" ) {
			$name = explode( '-', $wp_indigo_social_name );
			if ( strpos( $name[1], 'mail' ) !== false ) {
				echo '<a rel="noopener" aria-label="' . esc_attr__( 'Email me', 'wp-indigo' ) . '" class="link" data-title="' . esc_attr(sanitize_email( $social )) . '" href="mailto:' . esc_attr(sanitize_email( $social )) . '" target="_blank">
			<svg class="icon icon-' . esc_attr($name[1]) . '"><use xlink:href="' . esc_url( get_template_directory_uri() ) . '/assets/images/defs.svg#icon-' . esc_attr($name[1]) . '"></use></svg>
		</a>';
			} else {
				$name = explode( '-', $wp_indigo_social_name );
				echo '<a rel="noopener" aria-label="View ' . esc_attr($name[1]) . ' page" class="link" data-title="' . esc_attr($social) . '" href="' . esc_attr($social) . '" target="_blank">
			<svg class="icon icon-' . esc_attr($name[1]) . '"><use xlink:href="' . esc_attr( get_template_directory_uri() ) . '/assets/images/defs.svg#icon-' . esc_attr($name[1]) . '"></use></svg>
		</a>';
			}
		}
	}
}

/**
 * Check active socials
 *
 * @param $wp_indigo_social_names
 *
 * @return bool
 */
function wp_indigo_check_socials( $wp_indigo_social_names ) {
	foreach ( $wp_indigo_social_names as $wp_indigo_social_name ) {
		$social = get_theme_mod( $wp_indigo_social_name );
		if ( $social != "" ) {
			return true;
		}
	}

	return false;
}

// Load theme typography
function wp_indigo_typography() {
	$wp_indigo_text_typography            = get_theme_mod( 'text_typography' );
	$wp_indigo_heading_typography         = get_theme_mod( 'headings_typography' );
	$wp_indigo_default_heading_typography = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "26px",
		'variant'     => 'regular',
		'line-height' => '31px',
		'color'       => '#1a1a1a'
	);
	$default_text_typography              = array(
		'font-family' => "Roboto Mono",
		'font-size'   => "16px",
		'variant'     => 'regular',
		'line-height' => '28px',
		'color'       => '#666666'
	);
	if ( empty( $wp_indigo_heading_typography ) ) {
		$wp_indigo_heading_typography = $wp_indigo_default_heading_typography;
	} else {
		$wp_indigo_heading_typography = array_merge( $wp_indigo_default_heading_typography, $wp_indigo_heading_typography );
	}
	if ( empty( $wp_indigo_text_typography ) ) {
		$wp_indigo_text_typography = $default_text_typography;
	} else {
		$wp_indigo_text_typography = array_merge( $default_text_typography, $wp_indigo_text_typography );
	}
	$html = ':root {
				--heading-typography-font-size: ' . $wp_indigo_heading_typography["font-size"] . ';
	            --heading-typography-font-family: ' . $wp_indigo_heading_typography["font-family"] . ';
	            --heading-typography-line-height: ' . $wp_indigo_heading_typography["line-height"] . ';
	            --heading-typography-variant: ' . $wp_indigo_heading_typography["variant"] . ';
	            --text-typography-font-size: ' . $wp_indigo_text_typography["font-size"] . ';
	            --text-typography-font-family: ' . $wp_indigo_text_typography["font-family"] . ';
	            --text-typography-line-height: ' . $wp_indigo_text_typography["line-height"] . ';
	            --text-typography-variant: ' . $wp_indigo_text_typography["variant"] . ';
	
	            --primary-color: ' . get_theme_mod( "branding_primary_color", "#3F51B5" ) . ';
	            --secondary-color: ' . $wp_indigo_heading_typography["color"] . ';
	            --tertiary-color: ' . $wp_indigo_text_typography['color'] . ';
			}';

	return esc_html( $html );
}

add_action( 'wp_head', 'wp_indigo_theme_settings' );
function wp_indigo_theme_settings() {
	$wp_indigo_theme_typography = wp_indigo_typography();
	?>
    <style>
        <?php echo esc_html($wp_indigo_theme_typography); ?>
    </style>
	<?php
}

;

//
function wp_indigo_get_discussion_data() {
	static $discussion, $post_id;
	$wp_indigo_current_post_id = get_the_ID();
	if ( $wp_indigo_current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $wp_indigo_current_post_id;
	}
	$wp_indigo_comments = get_comments(
		array(
			'post_id' => $wp_indigo_current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);
	$wp_indigo_authors  = array();
	foreach ( $wp_indigo_comments as $wp_indigo_comment ) {
		$wp_indigo_authors[] = ( (int) $wp_indigo_comment->user_id > 0 ) ? (int) $wp_indigo_comment->user_id : $wp_indigo_comment->comment_author_email;
	}
	$wp_indigo_authors = array_unique( $wp_indigo_authors );
	$discussion        = (object) array(
		'authors'   => array_slice( $wp_indigo_authors, 0, 6 ),
		/* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $wp_indigo_current_post_id ),
		/* Number of responses. */
	);

	return $discussion;
}


function wp_indigo_enqueue_fonts() {
	$wp_indigo_text_typography    = get_theme_mod( 'text_typography' );
	$wp_indigo_heading_typography = get_theme_mod( 'headings_typography' );

	if ( $wp_indigo_heading_typography['font-family'] ) {
		wp_enqueue_style( 'wp-meliora-headings-fonts', '//fonts.googleapis.com/css2?family=' . $wp_indigo_heading_typography['font-family'] . ':wght@' . $wp_indigo_heading_typography['font-weight'] );
	} else {
		wp_enqueue_style( 'wp-meliora-headings-fonts', '//fonts.googleapis.com/css2?family=Roboto+Mono:wght@400' );
	}
	if ( $wp_indigo_text_typography['font-family'] ) {
		wp_enqueue_style( 'wp-meliora-body-font', '//fonts.googleapis.com/css2?family=' . $wp_indigo_text_typography['font-family'] . ':wght@' . $wp_indigo_text_typography['font-weight'] );
	} else {
		wp_enqueue_style( 'wp-meliora-headings-fonts', '//fonts.googleapis.com/css2?family=Roboto+Mono:wght@300' );
	}
}

add_action( 'wp_head', 'wp_indigo_enqueue_fonts' );
