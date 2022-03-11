<?php
/**
 * gingco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gingco
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
define("VERSION", time());
define("ASSETS_DIR", get_template_directory_uri() . "/assets/");
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gingco_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on gingco, use a find and replace
		* to change 'gingco' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'gingco', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'gingco' ),
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
			'gingco_custom_background_args',
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
add_action( 'after_setup_theme', 'gingco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gingco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gingco_content_width', 640 );
}
add_action( 'after_setup_theme', 'gingco_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gingco_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gingco' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gingco' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'gingco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gingco_scripts() {
	global $wp_query;
	wp_enqueue_style( 'gingco-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'gingco-style', 'rtl', 'replace' );
	
    wp_enqueue_script("jquery"); 


	wp_enqueue_script( 'gingco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'api-main-js', get_template_directory_uri() . '/js/api-main.js', null );

    wp_localize_script( 'api-main-js', 'gingco',
		array(
			'ajaxurl'        => admin_url( 'admin-ajax.php' ),
			'nonce'          => wp_create_nonce( "mindapp-nonce" ),
			'posts'          => json_encode( $wp_query->query_vars ), // everything about your loop is here
			'current_page'   => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			'max_page'       => $wp_query->max_num_pages,
			'posts_per_page' => !empty( get_option( 'posts_per_page ' ) ) ? get_option( 'posts_per_page ' ) : 3
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	$css_files = array(
        'gingco-css' => ASSETS_DIR . 'css/gingco.css',
    );

    foreach ($css_files as $handle => $css_file) {
        wp_enqueue_style($handle, $css_file, null, VERSION);
    }

}
add_action( 'wp_enqueue_scripts', 'gingco_scripts' );


function mind_defer_scripts($tag, $handle, $src) {

	if( $handle === 'api-main-js' ) {
		return '<script src="'. $src .'" defer="defer" type="text/javascript"> </script>';
	}


}

add_action('script_loader_tag', 'mind_defer_scripts', 10, 3);

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Added By Me

