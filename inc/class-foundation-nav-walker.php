<?php
/**
 * Nav walker class for menu
 *
 * @package Beercan
 */

/**
 * Extention of WordPress nav walker to add attributes to html in the menu
 */
class Foundation_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Displays start of a level. E.g '<ul>'
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param object $output html output of menu.
	 * @param int    $depth the amount of levels deep.
	 * @param array  $args test.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="submenu menu vertical" data-submenu>';
	}
}
