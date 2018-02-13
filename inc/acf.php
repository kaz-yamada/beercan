<?php

/**
 * Displays the button fields for the portfolio.
 */
function beercan_portfolio_links() {
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

	return;
}

/**
 * Display the portfolio screenshot.
 */
function beercan_portfolio_screenshot() {
	$img = get_field_object( 'screenshot' );

	if ( $img['value'] ) :
		echo '<div class="cell medium-6">';
		echo '<img src="' . $img['value'] . '" />';
		echo '</div>';
	endif;
}
