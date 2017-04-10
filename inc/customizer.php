<?php

/**
 * beercan Theme Customizer
 *
 * @package beercan
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beercan_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $wp_customize->add_section( 'theme_options', array(
        'title' => __( 'Theme Options', 'beercan' ),
        'priority' => 130, // Before Additional CSS.
    ) );

    $wp_customize->add_setting( 'page_layout', array(
        'default' => 'two-column',
        'sanitize_callback' => 'beercan_sanitize_page_layout',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( 'page_layout', array(
        'label' => __( 'Page Layout', 'beercan' ),
        'section' => 'theme_options',
        'type' => 'radio',
        'description' => __( 'When the two column layout is assigned, the page title is in one column and content is in the other.', 'beercan' ),
        'choices' => array(
            'one-column' => __( 'One Column', 'beercan' ),
            'two-column' => __( 'Two Column', 'beercan' ),
        ),
        'active_callback' => 'beercan_is_view_with_layout_option',
    ) );

    /**
     * Filter number of front page sections in Twenty Seventeen.
     *
     * @since Beercan 1.0
     *
     * @param $num_sections integer
     */
    $num_sections = apply_filters( 'beercan_front_page_sections', 4 );

    // Create a setting and control for each of the sections available in the theme.
    for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
        $wp_customize->add_setting( 'panel_' . $i, array(
            'default' => false,
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage',
        ) );

        $wp_customize->add_control( 'panel_' . $i, array(
            /* translators: %d is the front page section number */
            'label' => sprintf( __( 'Front Page Section %d Content', 'beercan' ), $i ),
            'description' => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'beercan' ) ),
            'section' => 'theme_options',
            'type' => 'dropdown-pages',
            'allow_addition' => true,
            'active_callback' => 'beercan_is_static_front_page',
        ) );

        $wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
            'selector' => '#panel' . $i,
            'render_callback' => 'beercan_front_page_section',
            'container_inclusive' => true,
        ) );
    }
}

add_action( 'customize_register', 'beercan_customize_register' );

/**
 * Sanitize the page layout options.
 */
function beercan_sanitize_page_layout( $input ) {
    $valid = array(
        'one-column' => __( 'One Column', 'beercan' ),
        'two-column' => __( 'Two Column', 'beercan' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }

    return '';
}

/**
 * Sanitize the colorscheme.
 */
function beercan_sanitize_colorscheme( $input ) {
    $valid = array( 'light', 'dark', 'custom' );

    if ( in_array( $input, $valid ) ) {
        return $input;
    }

    return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Seventeen 1.0
 * @see beercan_customize_register()
 *
 * @return void
 */
function beercan_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Seventeen 1.0
 * @see beercan_customize_register()
 *
 * @return void
 */
function beercan_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function beercan_is_static_front_page() {
    return ( is_front_page() && !is_home() );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function beercan_is_view_with_layout_option() {
    // This option is available on all pages. It's also available on archives when there isn't a sidebar.
    return ( is_page() || ( is_archive() && !is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beercan_customize_preview_js() {
    wp_enqueue_script( 'beercan-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '1.0', true );
}

add_action( 'customize_preview_init', 'beercan_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function beercan_frontpage_panels_js() {
    wp_enqueue_script( 'beercan-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array(), '1.0', true );
}

add_action( 'customize_controls_enqueue_scripts', 'beercan_frontpage_panels_js' );
