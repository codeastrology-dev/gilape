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
 * Add Image Size
 * 
 * @since 0.1
 */
function gilape_thumbsize() {
	add_image_size( 'gilape-sidebar-thumbnail', 100, 100, true );
	add_image_size( 'gilape-home-thumbnail', 370, 320, true );
	add_image_size( 'gilape-blog-thumbnail', 1200, 628, true );
}
add_action( 'after_setup_theme', 'gilape_thumbsize' );

/**
 * Custom Excerpt
 * 
 * @since 0.1
 */
add_filter( 'excerpt_length', 'gilape_get_excerpt' );

function gilape_get_excerpt( $count ) {
	global $post;
	$permalink = esc_url( get_permalink( $post->ID ) );
	$excerpt = get_the_content();
	$excerpt = strip_tags( $excerpt );
	$excerpt = substr( $excerpt, 0, $count );
	$excerpt = wp_kses_post( substr( $excerpt, 0, strripos( $excerpt, " " ) ) );
	$read_more_btn = sprintf( '<p class="read-more-button-container"><a class="read_more_btn" href="%1$s">%2$s</a></p>',
			$permalink,
			__( 'Continue reading', 'gilape' )
		);
		$excerpt = '<p>' . $excerpt . '...</p>' . $read_more_btn;
		return $excerpt;
}
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