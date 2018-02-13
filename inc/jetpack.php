<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Beercan
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function beercan_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'beercan_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options', array(
			'post-details' => array(
				'stylesheet' => 'beercan-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
		)
	);
}
add_action( 'after_setup_theme', 'beercan_jetpack_setup' );

/**
 * Filter for portfolio shortcode css classes.
 *
 * @param string $class default css classes.
 * @param int    $portfolio_index_number current index number of loop.
 * @param int    $columns total columns in portfolio loop.
 * @return string css class to apply on portfolio post.
 */
function beercan_portfolio_classes( $class, $portfolio_index_number, $columns ) {
	$colsize = 12 / $columns;
	return "cell medium-{$colsize} small-auto";
}

add_filter( 'portfolio-project-post-class', 'beercan_portfolio_classes', 10, 3 );

/**
 * Custom render function for Infinite Scroll.
 */
function beercan_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
