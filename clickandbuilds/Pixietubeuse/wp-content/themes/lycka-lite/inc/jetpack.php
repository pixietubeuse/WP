<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package lycka-lite
 * @since lycka-lite 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function lycka_lite_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'lycka_lite_jetpack_setup' );
