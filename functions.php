<?php
/**
 * Himalayas functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 *
 * @uses       add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses       register_nav_menu() To add support for navigation menu.
 * @uses       set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package    ThemeGrill
 * @subpackage Himalayas
 * @since      Himalayas 1.0
 */

add_action( 'after_setup_theme', 'himalayas_setup' );
/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if ( ! function_exists( 'himalayas_setup' ) ) :
	function himalayas_setup() {

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 783;
		}

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'himalayas', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
		add_theme_support( 'post-thumbnails' );

		// Registering navigation menu.
		register_nav_menu( 'primary', __( 'Primary Menu', 'himalayas' ) );
		register_nav_menu( 'footer', __( 'Footer Menu', 'himalayas' ) );

		// Cropping the images to different sizes to be used in the theme
		add_image_size( 'himalayas-featured-post', 781, 512, true );
		add_image_size( 'himalayas-portfolio-image', 400, 350, true );
		add_image_size( 'himalayas-featured-image', 319, 142, true );
		add_image_size( 'himalayas-services', 470, 280, true );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		// Gutenberg layout support.
		add_theme_support( 'align-wide' );

		// Adding excerpt option box for pages as well
		add_post_type_support( 'page', 'excerpt' );

		// Adds the support for the Custom Logo introduced in WordPress 4.5
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
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

		// Added WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;

/**
 * Define Directory Location Constants
 */
define( 'HIMALAYAS_PARENT_DIR', get_template_directory() );
define( 'HIMALAYAS_CHILD_DIR', get_stylesheet_directory() );

define( 'HIMALAYAS_INCLUDES_DIR', HIMALAYAS_PARENT_DIR . '/inc' );
define( 'HIMALAYAS_CSS_DIR', HIMALAYAS_PARENT_DIR . '/css' );
define( 'HIMALAYAS_JS_DIR', HIMALAYAS_PARENT_DIR . '/js' );
define( 'HIMALAYAS_LANGUAGES_DIR', HIMALAYAS_PARENT_DIR . '/languages' );

define( 'HIMALAYAS_ADMIN_DIR', HIMALAYAS_INCLUDES_DIR . '/admin' );
define( 'HIMALAYAS_WIDGETS_DIR', HIMALAYAS_INCLUDES_DIR . '/widgets' );

define( 'HIMALAYAS_ADMIN_IMAGES_DIR', HIMALAYAS_ADMIN_DIR . '/images' );

/**
 * Define URL Location Constants
 */
define( 'HIMALAYAS_PARENT_URL', get_template_directory_uri() );
define( 'HIMALAYAS_CHILD_URL', get_stylesheet_directory_uri() );

define( 'HIMALAYAS_INCLUDES_URL', HIMALAYAS_PARENT_URL . '/inc' );
define( 'HIMALAYAS_CSS_URL', HIMALAYAS_PARENT_URL . '/css' );
define( 'HIMALAYAS_JS_URL', HIMALAYAS_PARENT_URL . '/js' );
define( 'HIMALAYAS_LANGUAGES_URL', HIMALAYAS_PARENT_URL . '/languages' );

define( 'HIMALAYAS_ADMIN_URL', HIMALAYAS_INCLUDES_URL . '/admin' );
define( 'HIMALAYAS_WIDGETS_URL', HIMALAYAS_INCLUDES_URL . '/widgets' );

define( 'HIMALAYAS_ADMIN_IMAGES_URL', HIMALAYAS_ADMIN_URL . '/images' );

// Load functions
require_once( HIMALAYAS_INCLUDES_DIR . '/functions.php' );
require_once( HIMALAYAS_INCLUDES_DIR . '/header-functions.php' );
require_once( HIMALAYAS_INCLUDES_DIR . '/customizer.php' );
require_once( HIMALAYAS_INCLUDES_DIR . '/custom-header.php' );
require_once( HIMALAYAS_ADMIN_DIR . '/meta-boxes.php' );
// Load Widgets and Widgetized Area
require_once( HIMALAYAS_WIDGETS_DIR . '/widgets.php' );

/**
 * Load Demo Importer Configs.
 */
if ( class_exists( 'TG_Demo_Importer' ) ) {
	require get_template_directory() . '/inc/demo-config.php';
}

/**
 * Assign the Himalayas version to a variable.
 */
$theme             = wp_get_theme( 'himalayas' );
$himalayas_version = $theme['Version'];

/**
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-himalayas-admin.php';
	require get_template_directory() . '/inc/admin/class-himalayas-new-theme-notice.php';
}

/**
 * Load TGMPA Configs.
 */
require_once( HIMALAYAS_INCLUDES_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once( HIMALAYAS_INCLUDES_DIR . '/tgm-plugin-activation/tgmpa-himalayas.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once HIMALAYAS_INCLUDES_DIR . '/jetpack.php';
}
