<?php
/**
 * Beercan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beercan
 */

if ( ! function_exists( 'beercan_setup' ) ) :

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
		 * If you're building a theme based on Beercan, use a find and replace
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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'top-menu' => esc_html__( 'Top bar menu', 'beercan' ),
			)
		);

		/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
			*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'beercan_custom_background_args',
				array(
					'default-color' => '0a0a0a',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support(
			'post-formats',
			array( 'audio', 'video', 'image', 'gallery' )
		);
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
	$GLOBALS['content_width'] = apply_filters( 'beercan_content_width', 640 );
}

add_action( 'after_setup_theme', 'beercan_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beercan_widgets_init() {

	// Register Sidebar widget area.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'beercan' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'beercan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s cell">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar 404', 'beercan' ),
			'id'            => 'sidebar-404',
			'description'   => esc_html__( 'Add widgets here.', 'beercan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s cell">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	$footer_columns = get_footer_columns();

	for ( $i = 1; $i <= $footer_columns; $i++ ) {
		$name = 'Footer Column ' . $i;
		$id   = 'footer-widgets-' . $i;

		register_sidebar(
			array(
				'name'          => esc_html( $name ),
				'id'            => esc_html( $id ),
				'description'   => esc_html__( 'Add widgets here.', 'beercan' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s cell">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}
}

add_action( 'widgets_init', 'beercan_widgets_init' );

/**
 * Enqueues theme styles
 *
 * @return void
 */
function beercan_enqueue_style() {
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'beercan-style', get_stylesheet_directory_uri() . '/dist/main.css', null, '2.0' );
}

add_action( 'wp_enqueue_scripts', 'beercan_enqueue_style' );

/**
 * Enqueue theme scripts
 *
 * @return void
 */
function beercan_scripts() {
	wp_enqueue_script( 'beercan-bundle', get_template_directory_uri() . '/dist/bundle.js', array(), '1.0', true );

	wp_localize_script(
		'beercan-bundle',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'beercan' ),
			'collapse' => __( 'collapse child menu', 'beercan' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'beercan_scripts' );

/**
 * Add hook to execute code after header.php.
 */
function beercan_after_header_hook() {
	do_action( 'beercan_after_header' );
}



/**
 * Advanced custom fields
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Get the custom nav menu walker
 */
require get_template_directory() . '/inc/class-foundation-nav-walker.php';

/**
 * Get custom comment callback.
 */
require get_template_directory() . '/inc/beercan-comment-callback.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	include get_template_directory() . '/inc/jetpack.php';
}

if ( ! function_exists( 'get_theme_author_url' ) ) :
	/**
	 * Get the url for theme author.
	 */
	function get_theme_author_url() {
		return 'http://github.com/kaz-yamada/beercan';
	}
endif;
