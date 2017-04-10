<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package beercan
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function beercan_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Add class on front page.
    if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
        $classes[] = 'beercan-front-page';
    }

    // Add class for one or two column page layouts.
    if ( is_page() || is_archive() ) {
        if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
            $classes[] = 'page-one-column';
        } else {
            $classes[] = 'page-two-column';
        }
    }

    return $classes;
}

add_filter( 'body_class', 'beercan_body_classes' );

if ( !function_exists( 'beercan_time_link' ) ) :

    /**
     * Gets a nicely formatted string for the published date.
     */
    function beercan_time_link() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
        );

        // Wrap the time string in a link, and preface it with 'Posted on'.
        return sprintf(
                /* translators: %s: post date */
                __( '<span class="screen-reader-text">Posted on</span> %s', 'beercan' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );
    }

endif;

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function beercan_panel_count() {

    $panel_count = 0;

    /**
     * Filter number of front page sections in Beercan.
     *
     * @since Beercan 1.0
     *
     * @param $num_sections integer
     */
    $num_sections = apply_filters( 'beercan_front_page_sections', 4 );

    // Create a setting and control for each of the sections available in the theme.
    for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
        if ( get_theme_mod( 'panel_' . $i ) ) {
            $panel_count++;
        }
    }

    return $panel_count;
}

/**
 * Checks to see if we're on the homepage or not.
 */
function beercan_is_frontpage() {
    return ( is_front_page() && !is_home() );
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function beercan_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}

add_action( 'wp_head', 'beercan_pingback_header' );
