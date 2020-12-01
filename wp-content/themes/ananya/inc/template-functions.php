<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Ananya
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 1.0
 */
function ananya_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ananya_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 * @since 1.0
 */
function ananya_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ananya_pingback_header' );

if ( ! function_exists( 'ananya_filter_the_archive_title' ) ) {
	/**
	 * Alter the_archive_title() function to match our original archive title function
	 *
	 * @since 1.0
	 *
	 * @param string $title The archive title
	 * @return string The altered archive title
	 */
	function ananya_filter_the_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} 

		return $title;

	}
	add_filter( 'get_the_archive_title', 'ananya_filter_the_archive_title' );
}

if ( ! function_exists( 'ananya_default_menu' ) ) :
	/**
	 * Display default page as navigation if no custom menu was set
	 */
	function ananya_default_menu() {
		echo '<div id="navbarResponsive" class="collapse-grp collapse navbar-collapse">';
		echo '<ul id="nav-menu-primary" class="menu nav-menu-primary ml-auto">' . wp_list_pages( 'title_li=&echo=0' ) . '</ul>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
	}
endif;