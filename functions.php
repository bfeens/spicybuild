<?php 

/** 
 * Add theme support for stuff 
 */

if ( ! function_exists( 'spicy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function spicy_setup() {

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
		) 
	);

	/* This theme uses wp_nav_menu() in two locations. */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'spicy' ),
		'secondary' => esc_html__( 'Secondary Menu', 'spicy' ),
		) 
	);
} 
endif; // spicy_setup
add_action( 'after_setup_theme', 'spicy_setup' );



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function spicy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'spicy' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'spicy_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function spicy_scripts() {

	wp_enqueue_style( 'spicy-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bootstrap-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' ); 

	wp_enqueue_style( 'google-font-roboto-slab', 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,100,300' );

	wp_enqueue_style( 'spicy-custom', get_template_directory_uri() . '/css/spicy.css', 'bootstrap-min', '' , screen );

	wp_enqueue_script( 'spicy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'spicy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spicy_scripts' );



