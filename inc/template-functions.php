<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Gilape
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gilape_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gilape_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gilape_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gilape_pingback_header' );

/**
 * Pagination
 * 
 * @since 0.1
 */
function gilape_the_posts_pagination(){
	the_posts_pagination( array(
		'mid_size' => 2,
		'prev_text' => __( 'Previous', 'gilape' ),
		'next_text' => __( 'Next', 'gilape' ),
	) );
}