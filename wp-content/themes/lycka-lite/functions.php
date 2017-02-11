<?php
/**
 * lycka-lite functions and definitions
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */

$theme = wp_get_theme();
define ('LYCKA_VERSION', $theme -> get('Version'));
define ('LYCKA_AUTHOR_URI', $theme -> get('AuthorURI'));

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1050; /* pixels */
}

if ( ! function_exists( 'lycka_lite_setup' ) ) :
	
/** Sets up theme defaults and registers support for various WordPress features. */
function lycka_lite_setup() {
	
	// Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'lycka-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
	
	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support( 'post-thumbnails' );

	/* Add callback for custom TinyMCE editor stylesheets. (editor-style.css) */
	 add_editor_style('editor-style.css');
	 
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lycka-lite' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lycka_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
	
	// Custom logo
	add_theme_support( 'custom-logo', array(
	   'height'      => 175,
	   'width'       => 400,
	   'flex-width' => true,
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
}
endif; // lycka_lite_setup
add_action( 'after_setup_theme', 'lycka_lite_setup' );
 
/**
 * Enqueue scripts.
 */
function lycka_lite_scripts() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'lycka-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'lycka-lite-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20130115', true );

}
add_action( 'wp_enqueue_scripts', 'lycka_lite_scripts' );

/**
 * Enqueue styles.
 */
function lycka_lite_css() {
	// Loads our main stylesheet.
	wp_enqueue_style( 'lycka-lite-style', get_stylesheet_uri(), '', LYCKA_VERSION );
	
	$font_url = '';
	/* translators: If there are characters in your language that are not supported by Lora and Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lora and Lato fonts: on or off', 'lycka-lite' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lora:400,700,400italic,700italic|Lato:400,400italic,700,700italic' ), '//fonts.googleapis.com/css' );
	}
	wp_enqueue_style( 'lycka-lite-google-font', esc_url( $font_url ) );
	
}
add_action( 'wp_enqueue_scripts', 'lycka_lite_css' );

/* Add Admin stylesheet to the admin page */
function lycka_lite_selectively_enqueue_admin_script( $hook ) {
	if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'lycka-lite-adminstyle', get_template_directory_uri() . '/css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'lycka_lite_selectively_enqueue_admin_script' );

/**
 * Print the attached image with a link to the next attached image.
 *
 * @since lycka-lite 1.0
 */
if ( ! function_exists( 'lycka_lite_the_attached_image' ) ) :
function lycka_lite_the_attached_image() {
	$post = get_post();
	/**
	 *
	 * @since lycka-lite 1.0
	 *
	 * @param array $dimensions {
	 * An array of height and width dimensions.
	 *
	 * @type int $height Height of the image in pixels. Default 810.
	 * @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'lycka_lite_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns a "Read more" link for excerpts
 *
 * @since lycka-lite 1.0
 */
function lycka_lite_excerpt_more( $more ) {
	return '<a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . __( '[Read more]', 'lycka-lite' ) . '</a>';
}
add_filter( 'excerpt_more', 'lycka_lite_excerpt_more' );

// Custom Excerpt Length
function lycka_lite_custom_excerpt_length( $length ) {
   return 50;
}
add_filter( 'excerpt_length', 'lycka_lite_custom_excerpt_length', 999 );

/** Load functions */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/header-logo.php';
require get_template_directory() . '/inc/extras.php';

/** Theme customizer */
require_once( get_template_directory() . '/inc/lycka-customizer.php' );
require_once( get_template_directory() . '/inc/lycka-customization.php' );
require_once( get_template_directory() . '/inc/theme-options.php' );

/** Load Widgets */
require get_template_directory() . '/inc/lycka-widgets.php';

/* Load Jetpack compatibility file */
require get_template_directory() . '/inc/jetpack.php';