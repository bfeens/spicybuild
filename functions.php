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



if ( ! function_exists( 'spicy_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function spicy_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'spicy' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'spicy' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'spicy_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function spicy_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'spicy' ) );
		if ( $categories_list && spicy_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'spicy' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'spicy' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'spicy' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'spicy' ), esc_html__( '1 Comment', 'spicy' ), esc_html__( '% Comments', 'spicy' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'spicy' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'spicy' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'spicy' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'spicy' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'spicy' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'spicy' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'spicy' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'spicy' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'spicy' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'spicy' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'spicy' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'spicy' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'spicy' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'spicy' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'spicy' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function spicy_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'spicy_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'spicy_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so spicy_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so spicy_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in spicy_categorized_blog.
 */
function spicy_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'spicy_categories' );
}
add_action( 'edit_category', 'spicy_category_transient_flusher' );
add_action( 'save_post',     'spicy_category_transient_flusher' );


function spicy_theme_customizer( $wp_customize ) {

	/* Note: These logo fields can be deleted if you are using 
	up-to-date Jetpack controls to build the logo */ 

	/* 1. These are the fields to load in a new site logo */
	$wp_customize->add_section( 'spicy_logo_section' , array(
	    'title'       => __( 'Logo', 'spicy' ),
	    'priority'    => 30,
	    'description' => 'Upload a logo to replace the default site name and description in the header',
		) 
	);

	/* 2. This adds the setting control to add the logo */
	$wp_customize->add_setting( 'spicy_logo' );

	/* 3. This builds the PHP controls */
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'spicy_logo', array(
    	'label'    => __( 'Logo', 'spicy' ), 
   		'section'  => 'spicy_logo_section',
    	'settings' => 'spicy_logo',
    	) 
	) 
);
}
add_action( 'customize_register', 'spicy_theme_customizer' );


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
 * Enables the Excerpt meta box in Page edit screen. This allows for a "top-content area" to display.
 */
function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );



/**
 * Enables a featured image to display for pages
 */
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 9999, 9999, true ); // default Post Thumbnail dimensions (unlimited height, width)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
}


/**
 * Enqueue scripts and styles.
 */
function spicy_scripts() {

	wp_enqueue_style( 'spicy-style', get_stylesheet_uri() );

	/* Helping with breakpoints */
	wp_enqueue_style( 'bootstrap-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' ); 

	wp_enqueue_style( 'google-font-roboto-slab', 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,100,300' );

	wp_enqueue_style( 'google-font-oswald', 'http://fonts.googleapis.com/css?family=Oswald:400,700,300' );

	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css', 'bootstrap-min', '' , screen );

	wp_enqueue_style( 'spicy-custom', get_template_directory_uri() . '/css/spicy.css', 'bootstrap-min', '' , screen );

	wp_enqueue_style( 'spicy-media-queries', get_template_directory_uri() . '/css/spicy-media-queries.css', 'bootstrap-min', '' , screen );

	wp_enqueue_script( 'spicy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'spicy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spicy_scripts' );



