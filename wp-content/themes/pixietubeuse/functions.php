<?php
// get css files
wp_enqueue_style( 'style', get_stylesheet_uri());

// get menu
function register_menu() {
    register_nav_menus(
        array(
            'menu' => __( 'Menu' ),
            'reseauxSociaux' => __( 'Réseaux sociaux')
        )
    );
}
add_action( 'init', 'register_menu' );

// get sidebar
$argsSidebar = array(
    'name'          => sprintf(__( 'Sidebar left' )),
    'id'            => "sidebar-left",
);
register_sidebar( $argsSidebar );

// get theme support
add_theme_support( 'post-formats', array(
    'aside',
    'gallery',
    'image',
    'link',
    'video',
    'quote',
    'status',
    'audio',
    'chat'
) );

// add post thumbnail
add_theme_support( 'post-thumbnails' );