<?php 

/**
 * Enqueue scripts and styles.
 */
function spicy_scripts() {

	wp_enqueue_style( 'spicy-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bootstrap-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' ); 

	wp_enqueue_style( 'spicy-custom', get_template_directory_uri() . '/css/spicy.css', 'bootstrap-min', '' , screen );

	wp_enqueue_script( 'spicy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'spicy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spicy_scripts' );