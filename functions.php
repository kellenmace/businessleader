<?php
/**
 * Business Leader functions and definitions
 *
 * @package Business Leader
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bus_leader_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bus_leader_setup() {

	// Style the back end visual editor
	$editor_font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,300italic' );
	add_editor_style( array( $editor_font_url, 'inc/custom-editor-style.css' ) );
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Business Leader, use a find and replace
	 * to change 'bus_leader' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bus_leader', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('large-thumb', 1060, 650, true);
	add_image_size('index-thumb', 780, 250, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bus_leader' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'aside', 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'aside' ) );

	/*
	 * Allow WordPress to set title tags
	 * See https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 */
	add_theme_support( 'title-tag' );
}
endif; // bus_leader_setup
add_action( 'after_setup_theme', 'bus_leader_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bus_leader_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bus_leader' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'bus_leader' ),
		'description'   => __( 'Footer widget area appears in the footer of the site', 'bus_leader' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bus_leader_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bus_leader_scripts() {
	wp_enqueue_style( 'bus_leader-style', get_stylesheet_uri() );

	if ( is_page_template( 'page-templates/page-front-page.php' ) ) {
	    wp_enqueue_style( 'bus_leader-layout-style', get_template_directory_uri() . '/layouts/front-page.css' );
	}

	if ( is_page_template( 'page-templates/page-nosidebar.php' ) ) {
	    wp_enqueue_style( 'bus_leader-layout-style', get_template_directory_uri() . '/layouts/no-sidebar.css' );
	}

	// Font & Font Icons
	wp_enqueue_style( 'bus_leader-google-fonts2', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,300italic' );
	wp_enqueue_style( 'bus_leader-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', false, '4.3.0' );

	// Theme scripts
	wp_enqueue_script( 'bus_leader-enquire', get_template_directory_uri() . '/js/enquire.min.js', false, '2.1.2', true );
	wp_enqueue_script( 'bus_leader-superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '1.7.5', true );
	wp_enqueue_script( 'bus_leader-scripts', get_template_directory_uri() . '/js/bus-leader-scripts.min.js', array( 'jquery', 'masonry', 'bus_leader-enquire', 'bus_leader-superfish' ), '20141026', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bus_leader_scripts' );

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';