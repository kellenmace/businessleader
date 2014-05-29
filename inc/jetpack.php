<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Business Leader
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function bus_leader_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'bus_leader_jetpack_setup' );
