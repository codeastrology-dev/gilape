<?php
/**
 * Gilape functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gilape
 */

if ( ! defined( '_GILAPE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_GILAPE_VERSION', '0.1' );
}

if ( ! function_exists( 'gilape_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gilape_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gilape, use a find and replace
		 * to change 'gilape' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gilape', get_template_directory() . '/languages' );

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
				'primary' => esc_html__( 'Primary', 'gilape' ),
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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'gilape_custom_background_args',
				array(
					'default-color' => 'ffffff',
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
	}
endif;
add_action( 'after_setup_theme', 'gilape_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gilape_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gilape_content_width', 640 );
}
add_action( 'after_setup_theme', 'gilape_content_width', 0 );

/**
 * Enqueue scripts and styles.
 * 
 * @since 0.6
 */
function gilape_scripts() {
	wp_enqueue_style( 'gilape-style', get_stylesheet_uri(), array(), _GILAPE_VERSION );
	wp_style_add_data( 'gilape-style', 'rtl', 'replace' );

	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	
	wp_enqueue_style( 'navbar', get_template_directory_uri() . '/assets/css/navbar.min.css');
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
	
	wp_enqueue_style( 'gilape-main-style', get_template_directory_uri() . '/assets/css/gilape-style.css');
	
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'gilape-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _GILAPE_VERSION, true );
	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '20210901', true );
	/**
	 * enqueu js.
	 */
	wp_enqueue_script( 'navbar-js', get_template_directory_uri() . '/assets/js/navbar.min.js', array(), '20210901', true );
	
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/assets/js/lazy-load-images.min.js', array(), '20210901', true );
			
	wp_enqueue_script( 'gilape-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '20210901', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gilape_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gilape_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gilape' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gilape' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'gilape_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Function which enhance the theme by hooking into the theme.
 */
require get_template_directory() . '/inc/hooked-functions.php';

/**
 * Kirki Customizer.
 */
require get_template_directory() . '/inc/kirki/kirki.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-social.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
// if ( class_exists( 'WooCommerce' ) ) {
// 	require get_template_directory() . '/inc/woocommerce.php';
// }
