<?php

/**
 * beercan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package beercan
 */
if ( !function_exists( 'beercan_setup' ) ) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function beercan_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on beercan, use a find and replace
         * to change 'beercan' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'beercan', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'top' => __( 'Top Menu', 'beercan' ),
            'social' => __( 'Social Links Menu', 'beercan' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'beercan_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        add_theme_support( 'custom-logo', array(
            'height' => 400,
            'width' => 400,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }

endif;
add_action( 'after_setup_theme', 'beercan_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beercan_content_width() {
    $GLOBALS[ 'content_width' ] = apply_filters( 'beercan_content_width', 900 );
}

add_action( 'after_setup_theme', 'beercan_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beercan_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar', 'beercan' ),
        'id' => 'sidebar-1',
        'description' => esc_html__( 'Add widgets here.', 'beercan' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}

add_action( 'widgets_init', 'beercan_widgets_init' );

function get_full_width_grid() {
    return 'columns large-12 medium-12 small-12';
}

function get_page_grid() {
    if ( is_front_page() ) {
        return 'columns large-12 medium-12 small-12';
    } else {
        return 'columns large-8 medium-8 small-8';
    }
}

/**
 * Enqueue scripts and styles.
 */
function beercan_scripts() {

    // Enqueue stylesheets    
    wp_enqueue_style( 'css-foundation', get_template_directory_uri() . '/assets/css/foundation.min.css' );
    wp_enqueue_style( 'beercan-style', get_stylesheet_uri() );
    wp_enqueue_style( 'css-customizer', get_template_directory_uri() . '/assets/css/customizer.css' );
    wp_enqueue_style( 'font-google', 'https://fonts.googleapis.com/css?family=Raleway' );


    // Enqueue javascript    
    wp_enqueue_script( 'beercan-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0', true );

    $beercan_l10n = array(
        'quote' => beercan_get_svg( array( 'icon' => 'quote-right' ) ),
    );

    if ( has_nav_menu( 'top' ) ) {
        wp_enqueue_script( 'beercan-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '1.0', true );
        $beercan_l10n[ 'expand' ] = __( 'Expand child menu', 'beercan' );
        $beercan_l10n[ 'collapse' ] = __( 'Collapse child menu', 'beercan' );
        $beercan_l10n[ 'icon' ] = beercan_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
    }

    wp_enqueue_script( 'beercan-global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'jquery-scrollto', get_template_directory_uri() . '/assets/js/jquery.scrollTo.js', array( 'jquery' ), '2.1.2', true );
    wp_localize_script( 'beercan-skip-link-focus-fix', 'beercanScreenReaderText', $beercan_l10n );
    wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
    wp_enqueue_script( 'js-foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', array(), '1.0', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'beercan_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
