<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wp-mint-magazine
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wp_mint_magazine_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if( !is_singular() ) {
		$classes[] = 'hfeed';
	}
	$classes[] = 'header_' . esc_attr( get_theme_mod( 'wp_mint_magazine_header_style', 'style_1' ) );
	$classes[] = 'layout_' . esc_attr( get_theme_mod( 'wp_mint_magazine_layout_style', 'box' ) );

	return $classes;
}

add_filter( 'body_class', 'wp_mint_magazine_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_mint_magazine_pingback_header() {
	if( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'wp_mint_magazine_pingback_header' );
