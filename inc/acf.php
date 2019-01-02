<?php
/**
 * Functions using the Advanced custom fields plugin
 *
 * @package Beercan
 */

/**
 * Displays the button fields for the portfolio.
 */
function beercan_portfolio_links() {
	if ( function_exists( 'get_field_object' ) ) {

		$demo_link = get_field_object( 'demo_link' );
		$repo_link = get_field_object( 'github_repository' );

		echo '<div class="portfolio-buttons">';
		if ( $demo_link['value'] ) {
			echo '<a href=' . esc_url( $demo_link['value'] ) . ' class="button">' . esc_html( $demo_link['label'] ) . '</a>';
		}
		if ( $repo_link['value'] ) {
			echo '<a href=' . esc_url( $repo_link['value'] ) . ' class="button">' . esc_html( $repo_link['label'] ) . '</a>';
		}
		echo '</div>';

	}
}

/**
 * Display the portfolio screenshot.
 */
function beercan_portfolio_screenshot() {
	if ( function_exists( 'get_field_object' ) ) {
		$img = get_field_object( 'screenshot' );

		if ( $img['value'] ) {
			$output = '<div class="cell medium-6"><img src="%s" /></div>';
			sprintf( $output, esc_url( $img['value'] ) );
		}
	}
}
