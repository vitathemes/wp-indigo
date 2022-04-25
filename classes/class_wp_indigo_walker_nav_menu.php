<?php
class Wp_indigo_walker_nav_menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;


		$output .= "<li class='h3 u-letter-space-medium " . esc_attr(implode( " ", $item->classes )) . "'>";

		//Add SPAN if no Permalink
		if ( $permalink ) {
			$output .= '<a href="' . esc_url($permalink) . '">';
		}

		$output .= $title;

		if ( $permalink ) {
			$output .= '</a>';
		}

		if ( $args->walker->has_children ) {
			$output .= '<span aria-label="Toggle sub menu" role="button" class="c-nav__arrow-icon dashicons dashicons-arrow-down-alt2 js-toggle-submenu"></span>';
		}
	}
}