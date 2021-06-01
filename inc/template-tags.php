<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wp-indigo
 */



if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'wp_indigo_get_custom_category' ) ) :
	/**
	 * Get category lists
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */ 

	function wp_indigo_get_custom_category($wp_indigo_seprator = " ", $wp_indigo_custom_class = "c-post__cat", $wp_indigo_is_limited = false) {

		if( ! empty( get_the_category() ) ){
			/* get category */
			$categories = get_the_category();
			$separator = $wp_indigo_seprator;
			$output = '';
			$category_counter = 0;
			if ( ! empty( $categories ) ) {
			
				foreach( $categories as $category ) {

					if( $wp_indigo_is_limited === true && $category_counter === 3){
						break;
					}
		
					$category_counter++;
					/* translators: used between list items, there is a space after the comma */
					$output .= '<a class="'.esc_attr(  $wp_indigo_custom_class ).'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'wp-indigo' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . esc_html($separator);
				}
				echo  wp_kses_post(trim( $output, $separator ));
			}
		}

	}
endif;


if (! function_exists('wp_indigo_get_default_pagination')) :
	/**
	* Show numeric pagination
	*/
	function wp_indigo_get_default_pagination( $wp_indigo_class_name = "" ) {
		echo'<div class="c-pagination '.esc_attr( $wp_indigo_class_name  ).' ">' . wp_kses_post(
			paginate_links(
				array(
				'prev_text'          => __( 'Previous', 'wp-indigo' ),
				'next_text'          => __( 'Next', 'wp-indigo' ),
				)
			)) .'</div>';
	}
endif;


if ( ! function_exists( 'wp_indigo_share_links' ) ) {
	/**
	  * Display Share icons 
	  */
	function wp_indigo_share_links( $wp_indigo_share_title = true ) {
		if ( get_theme_mod( 'show_share_icons', true ) ) {
			
			$wp_indigo_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$wp_indigo_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$wp_indigo_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();


			if($wp_indigo_share_title){
				printf('<span class="c-social-share__title h6 u-letter-space-regular">');// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo esc_html_e( 'Share on:' , 'wp-indigo' );
				printf( '</span>' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			echo '<div class="c-social-share__items">';
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-facebook-alt c-social-share__item__icon"></span></a>', esc_url( $wp_indigo_facebook_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-twitter c-social-share__item__icon"></span></a>', esc_url( $wp_indigo_twitter_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-linkedin c-social-share__item__icon"></span></a>', esc_url( $wp_indigo_linkedin_url ) );
			echo '</div>';
			
		}
	}
}


if ( ! function_exists( 'wp_indigo_socials_links' ) ) :
	/**
	  * Display Social Networks
	  */
	function wp_indigo_socials_links() {
		
		$wp_indigo_facebook  		=  get_theme_mod( 'facebook', "" );
		$wp_indigo_twitter   		=  get_theme_mod( 'twitter', "" );
		$wp_indigo_instagram 		=  get_theme_mod( 'instagram', "" );
		$wp_indigo_linkedin  		=  get_theme_mod( 'linkedin', "" );
		$wp_indigo_github    		=  get_theme_mod( 'github', "" );
		$wp_indigo_mail   			=  get_theme_mod( 'mail', "" );
		$wp_indigo_pinterest    	=  get_theme_mod( 'pinterest', "" );
		$wp_indigo_youtube    		=  get_theme_mod( 'youtube', "" );
		$wp_indigo_spotify    		=  get_theme_mod( 'spotify', "" );
		$wp_indigo_gitlab    		=  get_theme_mod( 'gitlab', "" );
		$wp_indigo_lastfm    		=  get_theme_mod( 'lastfm', "" );
		$wp_indigo_stackoverflow    =  get_theme_mod( 'stackoverflow', "" );
		$wp_indigo_quora    		=  get_theme_mod( 'quora', "" );
		$wp_indigo_reddit    		=  get_theme_mod( 'reddit', "" );
		$wp_indigo_medium    		=  get_theme_mod( 'medium', "" );
		$wp_indigo_vimeo    		=  get_theme_mod( 'vimeo', "" );
		$wp_indigo_lanyrd    		=  get_theme_mod( 'lanyrd', "" );
		$wp_indigo_dribbble    		=  get_theme_mod( 'dribbble', "" );
		$wp_indigo_behance    		=  get_theme_mod( 'behance', "" );


		// If variable was not empty will display the icons
		$wp_indigo_social_variables  = array($wp_indigo_facebook,$wp_indigo_twitter,$wp_indigo_instagram,$wp_indigo_linkedin,$wp_indigo_github,
		$wp_indigo_mail, $wp_indigo_pinterest ,$wp_indigo_youtube ,$wp_indigo_spotify , $wp_indigo_gitlab,$wp_indigo_lastfm ,$wp_indigo_stackoverflow ,$wp_indigo_quora ,$wp_indigo_reddit ,$wp_indigo_medium ,
		$wp_indigo_vimeo, $wp_indigo_lanyrd,$wp_indigo_dribbble ,$wp_indigo_behance
		) ;

		// Check if one of the variables are not empty 
		$wp_indigo_social_variable_flag = 0;		
		foreach($wp_indigo_social_variables as $wp_indigo_social){
			if( !empty($wp_indigo_social)){
				$wp_indigo_social_variable_flag = 1;
				break;
			}
		}

		// Display the icons here 
		if( $wp_indigo_social_variable_flag === 1 ) {

			echo '<div class="c-social-share c-social-share--footer">';

			if ( $wp_indigo_facebook ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>', esc_url( $wp_indigo_facebook ), esc_html__( 'Facebook', 'wp-indigo' ) );
			}

			if ( $wp_indigo_twitter ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-twitter"></span></a>', esc_url( $wp_indigo_twitter ), esc_html__( 'Twitter', 'wp-indigo' ) );
			}

			if ( $wp_indigo_instagram ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-instagram"></span></a>', esc_url( $wp_indigo_instagram ), esc_html__( 'Instagram', 'wp-indigo' ) );
			}

			if ( $wp_indigo_linkedin ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>', esc_url( $wp_indigo_linkedin ), esc_html__( 'Linkedin', 'wp-indigo' ) );
			}

			if ( $wp_indigo_github ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="ant-design:github-filled" data-inline="false"></span></a>', esc_url( $wp_indigo_github ), esc_html__( 'Github', 'wp-indigo' ) );
			}

			if ( $wp_indigo_mail ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="ant-design:mail-outlined" data-inline="false"></span></a>', esc_url( $wp_indigo_mail ), esc_html__( 'Mail', 'wp-indigo' ) );
			}
			
			if ( $wp_indigo_pinterest ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="bx:bxl-pinterest" data-inline="false"></span></a>', esc_url( $wp_indigo_pinterest ), esc_html__( 'pinterest', 'wp-indigo' ) );
			}

			if ( $wp_indigo_youtube ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="akar-icons:youtube-fill" data-inline="false"></span></a>', esc_url( $wp_indigo_youtube ), esc_html__( 'youtube', 'wp-indigo' ) );
			}
			
			if ( $wp_indigo_spotify ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="bx:bxl-spotify" data-inline="false"></span></a>', esc_url( $wp_indigo_spotify ), esc_html__( 'spotify', 'wp-indigo' ) );
			}
			
			if ( $wp_indigo_lastfm ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="brandico:lastfm-rect" data-inline="false"></span></a>', esc_url( $wp_indigo_lastfm ), esc_html__( 'lastfm', 'wp-indigo' ) );
			}

			if ( $wp_indigo_gitlab ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="ion:logo-gitlab" data-inline="false"></span></a>', esc_url( $wp_indigo_gitlab ), esc_html__( 'gitlab', 'wp-indigo' ) );
			}
			
			if ( $wp_indigo_stackoverflow ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="cib:stackoverflow" data-inline="false"></span></a>', esc_url( $wp_indigo_stackoverflow ), esc_html__( 'stackoverflow', 'wp-indigo' ) );
			}

			if ( $wp_indigo_reddit ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="akar-icons:reddit-fill" data-inline="false"></span></a>', esc_url( $wp_indigo_reddit ), esc_html__( 'reddit', 'wp-indigo' ) );
			}
			
			if ( $wp_indigo_quora ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="bx:bxl-quora" data-inline="false"></span></a>', esc_url( $wp_indigo_quora ), esc_html__( 'quora', 'wp-indigo' ) );
			}

			if ( $wp_indigo_medium ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="ant-design:medium-circle-filled" data-inline="false"></span></a>', esc_url( $wp_indigo_medium ), esc_html__( 'medium', 'wp-indigo' ) );
			}			

			if ( $wp_indigo_vimeo ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="brandico:vimeo-rect" data-inline="false"></span></a>', esc_url( $wp_indigo_vimeo ), esc_html__( 'vimeo', 'wp-indigo' ) );
			}

			if ( $wp_indigo_dribbble ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="akar-icons:dribbble-fill" data-inline="false"></span></a>', esc_url( $wp_indigo_dribbble ), esc_html__( 'dribbble', 'wp-indigo' ) );
			}

			if ( $wp_indigo_behance ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="ant-design:behance-outlined" data-inline="false"></span></a>', esc_url( $wp_indigo_behance ), esc_html__( 'behance', 'wp-indigo' ) );
			}

			if ( $wp_indigo_lanyrd ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="cib:lanyrd" data-inline="false"></span></a>', esc_url( $wp_indigo_lanyrd ), esc_html__( 'lanyrd', 'wp-indigo' ) );
			}

			echo '</div>';
		}
	}
endif;



if (! function_exists('wp_indigo_get_home_section_close_tag')) :
	/**
	 * Add tag depend on page
	 */
	function wp_indigo_get_home_section_close_tag() {
		if ( is_page_template( 'page-template/home.php' || is_404() ) ) {
			echo "</section>";
		}
		else{
			return;
		}
	}
endif;


if (! function_exists('wp_indigo_portfolios_get_class_name')) :
	/**
	 * Add class depend on page in single protfolios page
	 */
	function wp_indigo_portfolios_get_class_name() {
		if ( 'portfolios' == get_post_type() ) {
			echo esc_attr( "c-main--single-portfolios" );
		}
	}
endif;


if ( ! function_exists( 'wp_indigo_taxonomy_filter' ) ) :
	/**
	 *  Return taxonomy filter with (active class)
	 */
	function wp_indigo_taxonomy_filter( $wp_indigo_className = "" ,  $wp_indigo_getSeparator = ", " , $wp_indigo_is_limited = false ,  $wp_indigo_taxonomy = "category" , $wp_indigo_hard_limit = false ) {
		
		global $wp_query;
		
		$taxonomies = get_terms( array(
			'taxonomy' => $wp_indigo_taxonomy,
			'hide_empty' => false
		) );
		
		$taxonomny_counter = 0;
		$separator = $wp_indigo_getSeparator;
			
		$wp_indigo_all_active_class = "";
		if(empty($wp_query->query['portfolio_category'])){
			$wp_indigo_all_active_class = "active";
		}

		echo '<a class="'.esc_attr( $wp_indigo_className ).' '.esc_attr( $wp_indigo_all_active_class ).'" href='.esc_url(site_url().'/'.get_post_type()).'>';
		echo esc_html_e( 'All ', 'wp-indigo' );
		echo '</a>';

		if ( !empty($taxonomies) ) {
			$output = '';

			foreach( $taxonomies as $category ) {

				if($wp_indigo_is_limited === true && $taxonomny_counter === 4 || $wp_indigo_hard_limit === true && $taxonomny_counter === 1){
					break;
				}

				if(!empty($wp_query->query['portfolio_category'])){
					$current_category = $wp_query->query['portfolio_category'];
				}			
				if($category != null && !empty($wp_query->query['portfolio_category'])  && $category->slug  === $current_category){
					$classactive = "active";
				}
				else{
					$classactive = "";
				}

				$taxonomny_counter++;

				if ($category->count != 0) {
					/* translators: return poject_category items for filtering */
					$output .= '<a class="'.esc_attr($wp_indigo_className). ' ' .esc_attr( $classactive ).'" href="'. esc_url( site_url() . '/'. get_post_type().'/?'.$wp_indigo_taxonomy.'=' . esc_html( $category->slug ) ). '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'wp-indigo' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . esc_html($separator);
				}
			}
			echo wp_kses_post(trim( $output , $separator ));
		}		
	}
endif;


if ( ! function_exists( 'wp_indigo_category_filter' ) ) :
	/**
	  *  Return Category filter
	  */
	function wp_indigo_category_filter( $wp_indigo_className = "" ) {
		$categories = get_categories();
		global $wp_query;
	
		$wp_indigo_all_active_class = "";
		if(empty($wp_query->query['category_name'])){
			$wp_indigo_all_active_class = "active";
		}
		
		echo '<a class="'.esc_attr( $wp_indigo_className ).' '.esc_attr( $wp_indigo_all_active_class ).'" href='.esc_url(site_url()).'/blog>';
		echo esc_html_e( 'All ', 'wp-indigo' );
		echo '</a>';
		
		foreach($categories as $category) {
			$classactive = "";
			
			// Check not empty 
			if(!empty($wp_query->query['category_name'])){
				// get current category 
				$current_category = $wp_query->query['category_name'];				
			}
			// Check if current category match with url (and add active class) 
			if($category != null && !empty($wp_query->query['category_name'])  && $category->slug == $current_category){
				$classactive = "active";
			}
			// The output
			echo '<a class="'.esc_attr( $wp_indigo_className.' '.$classactive ).'" href="'.esc_url(site_url()) . '/blog/?category_name=' . esc_html( $category->slug ) . '">' . esc_html($category->name) . '</a>';
		}
	}	
endif;


if ( ! function_exists( 'wp_indigo_get_taxonomy' ) ) :
    /**
	  * 
	  * Display Post Tags (Custom taxonomy)
      */
    function wp_indigo_get_taxonomy( $wp_indigo_taxonomy_name = "" , $wp_indigo_class_name = "" , $wp_indigo_tag_name = "span" , $wp_indigo_seprator = "" ) {
        $wp_indigo_custom_taxs = get_the_terms( get_the_ID(), $wp_indigo_taxonomy_name );
	
		$wp_indigo_output = "";

        if (is_array($wp_indigo_custom_taxs) && !empty($wp_indigo_custom_taxs)) {
            if( !empty( $wp_indigo_taxonomy_name ) ){
                foreach ( $wp_indigo_custom_taxs as $wp_indigo_custom_tax ) {
                    $wp_indigo_output .= '<'. esc_html($wp_indigo_tag_name) .' class="'.esc_attr(  $wp_indigo_class_name  ).' " href="'.esc_url( get_tag_link( $wp_indigo_custom_tax->term_id ) ).'">' . esc_html( $wp_indigo_custom_tax->name ) . '</'. esc_html($wp_indigo_tag_name) .'>';
                }
				echo wp_kses_post($wp_indigo_output);
            }
        }
    }
endif;

if ( ! function_exists( 'wp_indigo_branding' ) ) :
	/**
	 * Display Custom logo if exist otherwise show site title
	 */
	function wp_indigo_branding() {
	
		if( has_custom_logo() ) {
			the_custom_logo();
		}
		else{
			?>

			<h1 class="c-header__title site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
			</h1>

			<?php
		}
		
	}
	
endif;

if (! function_exists('wp_indigo_get_archives_class')) :
	/**
	  * Get archive class
	  */
	function wp_indigo_get_archives_class() {
		if ( 'portfolios' == get_post_type() ) {
			echo esc_attr( 'c-main--portfolios' );
		}
	}
endif;

if (! function_exists('wp_indigo_get_archives_title')) :
	/**
	  * Display archive title 
	  */
	function wp_indigo_get_archives_title() {
		if ( 'portfolios' == get_post_type() ) {
			$wp_indigo_archive_title = esc_html__( 'Portfolio', 'wp-indigo' );
		}
		else{
			$wp_indigo_archive_title = wp_kses_post( get_the_archive_title() );
		}

		echo wp_kses_post( $wp_indigo_archive_title );


	}
endif;