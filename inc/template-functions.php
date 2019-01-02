<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Beercan
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function beercan_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

		return $classes;
}

add_filter( 'body_class', 'beercan_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function beercan_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'beercan_pingback_header' );

/**
 * Replace the ellipsis that is displayed after the excerpt
 */
function bearcan_excerpt_more() {
		return '...';
}

add_filter( 'excerpt_more', 'bearcan_excerpt_more' );

/**
 * Change the excerpt length
 *
 * @param int $length the word count of the excerpt.
 */
function beercan_excerpt_length( $length ) {
		return 30;
}

add_filter( 'excerpt_length', 'beercan_excerpt_length', 99 );

/**
 * Adds additional classes to the post content.
 *
 * @param string|array $classes (Optional) One or more classes to add to the class list. Default value: ''.
 */
function beercan_post_classes( $classes ) {

		return $classes;
}

add_filter( 'post_class', 'beercan_post_classes' );

/**
 * Limits the length of the comments and replies to posts.
 *
 * @param string $comment the comment of the post.
 *
 * @return string a valid comment.
 */
function beercan_limit_comment_length( $comment ) {
		$max_length = 5000;
		$min_length = 10;

	if ( strlen( $comment['comment_content'] ) > $max_length ) {
		wp_die( 'Comment is too long. Please keep your comment under ' . esc_js( $max_length ) . ' characters.' );
	}

	if ( strlen( $comment['comment_content'] ) < $min_length ) {
		wp_die( 'Comment is too short. Please use at least ' . esc_js( $min_length ) . ' characters.' );
	}

		return $comment;
}

add_filter( 'preprocess_comment', 'beercan_limit_comment_length' );

/**
 * Removes label from post archive title.
 *
 * @param string $title the post title.
 * @return string the formatted post title.
 */
function beercan_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'beercan_archive_title' );


/**
 * Function to display header content.
 */
function beercan_header_content() {
	$id = get_the_id();
	if ( is_home() ) {
		$id = get_option( 'page_for_posts' );
	}

	$post_type = get_post_type( $id );

	// Get top menu nav bar.
	get_template_part( 'template-parts/header/topbar', $post_type );

	if ( ! beercan_no_header() ) {
		get_template_part( 'template-parts/header/page-header', $post_type );
	}
}

add_action( 'beercan_do_header', 'beercan_header_content' );

/**
 * Function to display page/post title bar
 */
function beercan_page_header_title() {
	get_template_part( 'template-parts/header/title-bar' );
}

add_action( 'beercan_header_title', 'beercan_page_header_title' );
