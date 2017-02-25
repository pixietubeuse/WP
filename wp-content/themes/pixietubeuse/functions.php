<?php
// if not in the admin call the styles and scripts for pixietubeuse template
if(!is_admin()){
    // get css files
    wp_enqueue_style( 'style', get_stylesheet_uri());

    // get script files
    wp_enqueue_script('jquery');
    wp_register_script('application-global', get_template_directory_uri() . "/js/application-global.js");
    wp_enqueue_script('application-global');
    wp_register_script('youtube', "https://apis.google.com/js/platform.js");
    wp_enqueue_script('youtube');
}

wp_enqueue_style( 'avatar', get_template_directory_uri() . '/avatar.css');

// enable posts and comments rss
add_theme_support( 'automatic-feed-links' );

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

// add custom header
add_theme_support( 'custom-header' );

// Change text of the read more link
function modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">Lire la suite</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

// comments disposition : move the comment field under the others fields
function move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );